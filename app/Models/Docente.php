<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;

use App\Models\DocenteAsistenciaDia;
use App\Models\AsistenciaDocente;
use App\Models\AsignacionCurso;
use App\Models\Asistencia;

class Docente extends Model
{
    use HasFactory;

    protected $table = 'docentes';
    protected $fillable = ['id',
                            'tipo_documento_id',
                            'num_documento',
                            'apellidos',
                            'nombre',
                            'especialidad',
                            'genero',
                            'telefono',
                            'direccion',
                            'codigo_plaza',
                            'user_id',
                            'activo',
                            'borrado',
                        ];
	protected $guarded = ['id'];

    public static function GetDocentes(Request $request){

        $buscar=$request->busca;

        $registros = DB::table('docentes')
        ->join('tipo_documentos', 'tipo_documentos.id', '=', 'docentes.tipo_documento_id')
        ->join('users', 'users.id', '=', 'docentes.user_id')
        ->join('tipo_users', 'tipo_users.id', '=', 'users.tipo_user_id')

        
        ->where('docentes.borrado','0')

        ->where(function($query) use ($buscar){
            $query->where('docentes.num_documento','like','%'.$buscar.'%');
            $query->orWhere('docentes.nombre','like','%'.$buscar.'%');
            $query->orWhere('docentes.apellidos','like','%'.$buscar.'%');
            $query->orWhere('docentes.especialidad','like','%'.$buscar.'%');
            $query->orWhere('tipo_documentos.nombre','like','%'.$buscar.'%');
            $query->orWhere('users.name','like','%'.$buscar.'%');
            $query->orWhere('users.email','like','%'.$buscar.'%');
            }) 
            ->orderBy('docentes.apellidos')
            ->orderBy('docentes.nombre')
            ->orderBy('docentes.id')
        ->select(
                'docentes.id',
                'docentes.tipo_documento_id',
                'docentes.num_documento',
                'docentes.apellidos',
                'docentes.nombre',
                'docentes.especialidad',
                'docentes.genero',
                'docentes.telefono',
                'docentes.direccion',
                'docentes.codigo_plaza',
                'docentes.user_id',
                'docentes.activo',
                'docentes.borrado',

                'tipo_documentos.id as tipo_documentos_id',
                'tipo_documentos.nombre as tipo_documentos_nombre',
                'tipo_documentos.sigla as tipo_documentos_sigla',
                'tipo_documentos.digitos as tipo_documentos_digitos',

                'tipo_users.id as tipo_users_id',
                'tipo_users.nombre as tipo_users_nombre',
                'tipo_users.descripcion as tipo_users_descripcion',

                'users.id as users_id',
                'users.name as users_name',
                'users.email as users_email',
                'users.activo as users_activo',
         )
        ->paginate(30);


          return [
            'pagination'=>[
                'total'=> $registros->total(),
                'current_page'=> $registros->currentPage(),
                'per_page'=> $registros->perPage(),
                'last_page'=> $registros->lastPage(),
                'from'=> $registros->firstItem(),
                'to'=> $registros->lastItem(),
            ],
            'registros'=>$registros
        ];

    }

    public static function GetListaAlumnos($iduser, $ciclo_id){

        $ciclo = CicloEscolar::find($ciclo_id);

        $data = InstitucionEducativa::where('borrado','0')
                                    ->where('activo','1')
                                    ->first();

        $data->ciclo = $ciclo;

        $docente = Docente::where('user_id',$iduser)->where('activo','1')->where('borrado','0')->first();

        if($ciclo && $docente){
            $niveles = CicloNivel::where('borrado','0')
            ->where('activo','1')
            ->where('institucion_educativa_id', $data->id)
            ->where('ciclo_escolar_id', $ciclo_id)
            ->orderBy('nivel_id')
            ->get();

            foreach ($niveles as $key => $nivel) {

                $listaGeneral = DB::select("select cur.nombre as curso, gra.nombre as grado, sec.nombre as seccion, sec.sigla, t.nombre as turno , asig.id, count(mat.id) as matriculados
                , doc.apellidos as apeDocente, doc.nombre as nomDocente
                from
                ciclo_cursos cur
                inner join ciclo_grados gra on gra.id = cur.ciclo_grado_id and gra.activo='1' and gra.borrado='0'
                inner join asignacion_cursos asig on cur.id = asig.ciclo_cursos_id and asig.activo='1' and asig.borrado='0'
                inner join ciclo_seccion sec on gra.id = sec.ciclo_grados_id and sec.id = asig.ciclo_seccion_id and sec.activo='1' and sec.borrado='0'
                inner join turnos t on t.id = sec.turno_id
                inner join docentes doc on doc.id = asig.docente_id
                left join matriculas mat on sec.id = mat.ciclo_seccion_id and mat.activo='1' and mat.borrado='0'
                where
                cur.activo='1' and cur.borrado='0'
                and
                gra.ciclo_escolar_id = ?
                and
                gra.ciclo_niveles_id = ?
                and
                asig.docente_id= ?
                group by sec.id, cur.id
                order by gra.id, sec.id, cur.orden;", [$ciclo_id, $nivel->id, $docente->id]);

                $nivel->listaGeneral = $listaGeneral;

            }

            $data->niveles = $niveles;
        }
        else{
            $data->niveles = [];
        }
        return $data;
    }

    public static function GetListaAlumnosAsignacion($idAsig){

        $asignacionCurso = AsignacionCurso::find($idAsig);

        $response = [];

        if($asignacionCurso){

            $response =DB::table('matriculas')
            ->join('alumnos', 'alumnos.id', '=', 'matriculas.alumno_id')
            ->join('tipo_documentos', 'tipo_documentos.id', '=', 'alumnos.tipo_documento_id')
            ->leftjoin('apoderados as madre',  function($join) {
                $join->on('madre.alumno_id', '=', 'alumnos.id');
                $join->on('madre.tipo_apoderado_id', '=', DB::raw('1'));

            })
            ->leftjoin('situacion_laborals as trabajo',  function($join) {
                $join->on('trabajo.alumno_id', '=', 'alumnos.id');
                $join->on('trabajo.matricula_id', '=', 'matriculas.id');

            })
            ->leftjoin('traslados as traslado',  function($join) {
                $join->on('traslado.alumno_id', '=', 'alumnos.id');
                $join->on('traslado.matricula_id', '=', 'matriculas.id');
                $join->on('traslado.tipo', '=', DB::raw('1'));

            })

            ->where('matriculas.ciclo_seccion_id', $asignacionCurso->ciclo_seccion_id)
            ->where('matriculas.activo','1')
            ->where('matriculas.borrado','0')
            ->orderBy('alumnos.apellido_paterno')
            ->orderBy('alumnos.apellido_materno')
            ->orderBy('alumnos.nombres')
            ->orderBy('matriculas.id')
            ->select('matriculas.id',
                'matriculas.alumno_id',
                'matriculas.ciclo_escolar_id',
                'matriculas.fecha',
                'matriculas.estado',
                'matriculas.es_traslado',
                'matriculas.tiene_discapacidad',
                'matriculas.vive_madre',
                'matriculas.vive_padre',
                'matriculas.responsable_matricula_nombres',
                'matriculas.cargo_responsable',
                'matriculas.ciclo_seccion_id',
                'matriculas.situacion_final',
                'matriculas.nota_final',
                'matriculas.situacion',
                'matriculas.sigla_situacion',
                'matriculas.trabaja',
                'matriculas.activo',
                'matriculas.borrado',
                'matriculas.created_at',
                'matriculas.updated_at',
                'matriculas.DI',
                'matriculas.DA',
                'matriculas.DV',
                'matriculas.DM',
                'matriculas.SC',
                'matriculas.OT',
                'matriculas.sigla_situacion_final',
                'alumnos.id as id_alu',
                'alumnos.tipo_documento_id as tipo_documento_id_alu',
                'alumnos.num_documento as num_documento_alu',
                'alumnos.apellido_paterno as apellido_paterno_alu',
                'alumnos.apellido_materno as apellido_materno_alu',
                'alumnos.nombres as nombres_alu',
                'alumnos.fecha_nacimiento as fecha_nacimiento_alu',
                'alumnos.genero as genero_alu',
                'alumnos.grado_actual as grado_actual_alu',
                'alumnos.nivel_actual as nivel_actual_alu',
                'alumnos.telefono as telefono_alu',
                'alumnos.direccion as direccion_alu',
                'alumnos.correo as correo_alu',
                'alumnos.pais as pais_alu',
                'alumnos.sigla_pais as sigla_pais_alu',
                'alumnos.departamento as departamento_alu',
                'alumnos.provincia as provincia_alu',
                'alumnos.distrito as distrito_alu',
                'alumnos.lugar as lugar_alu',
                'alumnos.lengua_materna as lengua_materna_alu',
                'alumnos.segunda_lengua as segunda_lengua_alu',
                'alumnos.num_hermanos as num_hermanos_alu',
                'alumnos.lugar_hermano as lugar_hermano_alu',
                'alumnos.religion as religion_alu',
                'alumnos.DI as DI_alu',
                'alumnos.DA as DA_alu',
                'alumnos.DV as DV_alu',
                'alumnos.nacimiento as nacimiento_alu',
                'alumnos.obs_nacimiento as obs_nacimiento_alu',
                'alumnos.levanto_cabeza as levanto_cabeza_alu',
                'alumnos.se_sento as se_sento_alu',
                'alumnos.se_paro as se_paro_alu',
                'alumnos.se_camino as se_camino_alu',
                'alumnos.se_control_esfinter as se_control_esfinter_alu',
                'alumnos.se_primeras_palabras as se_primeras_palabras_alu',
                'alumnos.se_hablo_fluido as se_hablo_fluido_alu',
                'alumnos.nacimiento_registrado as nacimiento_registrado_alu',
                'alumnos.activo as activo_alu',
                'alumnos.borrado as borrado_alu',
                'alumnos.created_at as created_at_alu',
                'alumnos.updated_at as updated_at_alu',
                'alumnos.estado_grado as estado_grado_alu',
                'alumnos.DM as DM_alu',
                'alumnos.SC as SC_alu',
                'alumnos.OT as OT_alu',
                'alumnos.user_id as user_id_alu',
                'alumnos.pais_id as pais_id_alu',
                'alumnos.departamento_id as departamento_id_alu',
                'alumnos.provincia_id as provincia_id_alu',
                'alumnos.distrito_id as distrito_id_alu',
                'alumnos.anio_ingreso as anio_ingreso_alu',
                'alumnos.codigo_modular as codigo_modular_alu',
                'alumnos.numero_matricula as numero_matricula_alu',
                'alumnos.flag as flag_alu',
                'alumnos.old_estado_grado as old_estado_grado_alu',

                'tipo_documentos.id as id_tipodoc',
                'tipo_documentos.nombre as nombre_tipodoc',
                'tipo_documentos.sigla as sigla_tipodoc',
                'tipo_documentos.digitos as digitos_tipodoc',

                DB::Raw("IFNULL( `madre`.`escolaridad_sigla` , '' ) as escolaridad_sigla_madre"),
                DB::Raw("IFNULL( `madre`.`grado_instruccion` , '' ) as grado_instruccion_madre"),
                DB::Raw("IFNULL( `trabajo`.`horas_semanales` , '' ) as horas_semanales"),

                DB::Raw("IFNULL( `traslado`.`codigo_modular` , '' ) as codigo_modular_traslado"),
                DB::Raw("IFNULL( `traslado`.`ie_nombre` , '' ) as ie_nombre_traslado"),
                DB::Raw("IFNULL( `traslado`.`res_traslado` , '' ) as res_traslado_traslado")
                )
            ->get();
        }


        return $response;
    }


    public static function GetItemsAsistenciaAlumnos($iduser, $ciclo_id, $dia_semana, $fecha){

        $ciclo = CicloEscolar::find($ciclo_id);

        $data = InstitucionEducativa::where('borrado','0')
                                    ->where('activo','1')
                                    ->first();

        $data->error = false;
        $data->ciclo = $ciclo;

        $docente = Docente::where('user_id',$iduser)->where('activo','1')->where('borrado','0')->first();

        if($ciclo && $docente){
            $niveles = CicloNivel::where('borrado','0')
            ->where('activo','1')
            ->where('institucion_educativa_id', $data->id)
            ->where('ciclo_escolar_id', $ciclo_id)
            ->orderBy('nivel_id')
            ->get();

            foreach ($niveles as $key => $nivel) {

                $cursos = DB::select("select cur.id as idcurso, cur.nombre as curso, gra.id as ciclo_grado_id, gra.nombre as grado, sec.id as ciclo_seccion_id, sec.nombre as seccion, sec.sigla, 
                t.nombre as turno , asig.id as idasignacion, doc.apellidos as apeDocente, doc.nombre as nomDocente,
                h.id as idhorario, h.dia_semana, h.hora_ini, h.hora_fin
                from ciclo_cursos cur 
                inner join ciclo_grados gra on gra.id = cur.ciclo_grado_id and gra.activo='1' and gra.borrado='0' 
                inner join asignacion_cursos asig on cur.id = asig.ciclo_cursos_id and asig.activo='1' and asig.borrado='0' 
                inner join ciclo_seccion sec on gra.id = sec.ciclo_grados_id and sec.id = asig.ciclo_seccion_id and sec.activo='1' and sec.borrado='0' 
                inner join turnos t on t.id = sec.turno_id 
                inner join docentes doc on doc.id = asig.docente_id
                inner join horarios h on h.ciclo_curso_id = cur.id and h.ciclo_seccion_id = sec.id and h.activo='1' and h.borrado='0'  and h.turno_id = sec.turno_id
                where 
                cur.activo='1' and cur.borrado='0' 
                and 
                gra.ciclo_escolar_id = ?
                and 
                gra.ciclo_niveles_id = ?
                and 
                asig.docente_id= ?
                and 
                h.dia_semana = ?
                order by gra.id, sec.id, cur.orden, h.hora_ini;", [$ciclo_id, $nivel->id, $docente->id, $dia_semana]);

                

                foreach ($cursos as $keyC => $curso) {


                    $asistencia = Asistencia::where('fecha', $fecha)
                                            ->where('ciclo_escolar_id', $ciclo_id)
                                            ->where('ciclo_seccion_id', $curso->ciclo_seccion_id)
                                            ->where('ciclo_curso_id', $curso->idcurso)
                                            ->where('activo', '1')
                                            ->where('borrado', '0')
                                            ->first();

                    $curso->asistencia = $asistencia;

                    $idAsistencia = 0;

                    if($asistencia){
                        $idAsistencia = $asistencia->id;
                    }

                    $curso->idAsistencia = $idAsistencia;

                    $response =DB::table('matriculas')
                    ->join('alumnos', 'alumnos.id', '=', 'matriculas.alumno_id')
                    ->join('tipo_documentos', 'tipo_documentos.id', '=', 'alumnos.tipo_documento_id')
                    ->leftjoin('apoderados as madre',  function($join) {
                        $join->on('madre.alumno_id', '=', 'alumnos.id');
                        $join->on('madre.tipo_apoderado_id', '=', DB::raw('1'));

                    })
                    ->leftjoin('situacion_laborals as trabajo',  function($join) {
                        $join->on('trabajo.alumno_id', '=', 'alumnos.id');
                        $join->on('trabajo.matricula_id', '=', 'matriculas.id');

                    })
                    ->leftjoin('traslados as traslado',  function($join) {
                        $join->on('traslado.alumno_id', '=', 'alumnos.id');
                        $join->on('traslado.matricula_id', '=', 'matriculas.id');
                        $join->on('traslado.tipo', '=', DB::raw('1'));

                    })

                    ->leftjoin('asistencia_alumnos as asistencia',  function($join) use ($idAsistencia, $curso){
                        $join->on('asistencia.alumno_id', '=', 'alumnos.id');
                        $join->on('asistencia.asistencia_id', '=', DB::raw($idAsistencia));
                        $join->on('asistencia.ciclo_seccion_id', '=', DB::raw($curso->ciclo_seccion_id));
                        $join->on('asistencia.activo', '=', DB::raw('1'));
                        $join->on('asistencia.borrado', '=', DB::raw('0'));

                    })

                    ->where('matriculas.ciclo_seccion_id', $curso->ciclo_seccion_id)
                    ->where('matriculas.activo','1')
                    ->where('matriculas.borrado','0')
                    ->orderBy('alumnos.apellido_paterno')
                    ->orderBy('alumnos.apellido_materno')
                    ->orderBy('alumnos.nombres')
                    ->orderBy('matriculas.id')
                    ->select('matriculas.id',
                        'matriculas.alumno_id',
                        'matriculas.ciclo_escolar_id',
                        'matriculas.fecha',
                        'matriculas.estado',
                        'matriculas.es_traslado',
                        'matriculas.tiene_discapacidad',
                        'matriculas.vive_madre',
                        'matriculas.vive_padre',
                        'matriculas.responsable_matricula_nombres',
                        'matriculas.cargo_responsable',
                        'matriculas.ciclo_seccion_id',
                        'matriculas.situacion_final',
                        'matriculas.nota_final',
                        'matriculas.situacion',
                        'matriculas.sigla_situacion',
                        'matriculas.trabaja',
                        'matriculas.activo',
                        'matriculas.borrado',
                        'matriculas.created_at',
                        'matriculas.updated_at',
                        'matriculas.DI',
                        'matriculas.DA',
                        'matriculas.DV',
                        'matriculas.DM',
                        'matriculas.SC',
                        'matriculas.OT',
                        'matriculas.sigla_situacion_final',
                        'alumnos.id as id_alu',
                        'alumnos.tipo_documento_id as tipo_documento_id_alu',
                        'alumnos.num_documento as num_documento_alu',
                        'alumnos.apellido_paterno as apellido_paterno_alu',
                        'alumnos.apellido_materno as apellido_materno_alu',
                        'alumnos.nombres as nombres_alu',
                        'alumnos.fecha_nacimiento as fecha_nacimiento_alu',
                        'alumnos.genero as genero_alu',
                        'alumnos.grado_actual as grado_actual_alu',
                        'alumnos.nivel_actual as nivel_actual_alu',
                        'alumnos.telefono as telefono_alu',
                        'alumnos.direccion as direccion_alu',
                        'alumnos.correo as correo_alu',
                        'alumnos.pais as pais_alu',
                        'alumnos.sigla_pais as sigla_pais_alu',
                        'alumnos.departamento as departamento_alu',
                        'alumnos.provincia as provincia_alu',
                        'alumnos.distrito as distrito_alu',
                        'alumnos.lugar as lugar_alu',
                        'alumnos.lengua_materna as lengua_materna_alu',
                        'alumnos.segunda_lengua as segunda_lengua_alu',
                        'alumnos.num_hermanos as num_hermanos_alu',
                        'alumnos.lugar_hermano as lugar_hermano_alu',
                        'alumnos.religion as religion_alu',
                        'alumnos.DI as DI_alu',
                        'alumnos.DA as DA_alu',
                        'alumnos.DV as DV_alu',
                        'alumnos.nacimiento as nacimiento_alu',
                        'alumnos.obs_nacimiento as obs_nacimiento_alu',
                        'alumnos.levanto_cabeza as levanto_cabeza_alu',
                        'alumnos.se_sento as se_sento_alu',
                        'alumnos.se_paro as se_paro_alu',
                        'alumnos.se_camino as se_camino_alu',
                        'alumnos.se_control_esfinter as se_control_esfinter_alu',
                        'alumnos.se_primeras_palabras as se_primeras_palabras_alu',
                        'alumnos.se_hablo_fluido as se_hablo_fluido_alu',
                        'alumnos.nacimiento_registrado as nacimiento_registrado_alu',
                        'alumnos.activo as activo_alu',
                        'alumnos.borrado as borrado_alu',
                        'alumnos.created_at as created_at_alu',
                        'alumnos.updated_at as updated_at_alu',
                        'alumnos.estado_grado as estado_grado_alu',
                        'alumnos.DM as DM_alu',
                        'alumnos.SC as SC_alu',
                        'alumnos.OT as OT_alu',
                        'alumnos.user_id as user_id_alu',
                        'alumnos.pais_id as pais_id_alu',
                        'alumnos.departamento_id as departamento_id_alu',
                        'alumnos.provincia_id as provincia_id_alu',
                        'alumnos.distrito_id as distrito_id_alu',
                        'alumnos.anio_ingreso as anio_ingreso_alu',
                        'alumnos.codigo_modular as codigo_modular_alu',
                        'alumnos.numero_matricula as numero_matricula_alu',
                        'alumnos.flag as flag_alu',
                        'alumnos.old_estado_grado as old_estado_grado_alu',

                        'tipo_documentos.id as id_tipodoc',
                        'tipo_documentos.nombre as nombre_tipodoc',
                        'tipo_documentos.sigla as sigla_tipodoc',
                        'tipo_documentos.digitos as digitos_tipodoc',

                        DB::Raw("IFNULL( `madre`.`escolaridad_sigla` , '' ) as escolaridad_sigla_madre"),
                        DB::Raw("IFNULL( `madre`.`grado_instruccion` , '' ) as grado_instruccion_madre"),
                        DB::Raw("IFNULL( `trabajo`.`horas_semanales` , '' ) as horas_semanales"),

                        DB::Raw("IFNULL( `traslado`.`codigo_modular` , '' ) as codigo_modular_traslado"),
                        DB::Raw("IFNULL( `traslado`.`ie_nombre` , '' ) as ie_nombre_traslado"),
                        DB::Raw("IFNULL( `traslado`.`res_traslado` , '' ) as res_traslado_traslado"),

                        DB::Raw("IFNULL( `asistencia`.`id` , 0 ) as id_asistencia"),
                        DB::Raw("IFNULL( `asistencia`.`fecha` , '' ) as fecha_asistencia"),
                        DB::Raw("IFNULL( `asistencia`.`estado` , '0' ) as estado_asistencia"),
                        DB::Raw("IFNULL( `asistencia`.`observacion` , '' ) as observacion_asistencia")
                        );

                        $matriculas = $response->get();
                        $cantAlumnos = $response->count();

                    $curso->matriculas = $matriculas;
                    $curso->cantAlumnos = $cantAlumnos;

                    

                }

                $nivel->cursos = $cursos;

            }

            $data->niveles = $niveles;
        }
        else{
            $data->niveles = [];
        }
        return $data;
    }
}
