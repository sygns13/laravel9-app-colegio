<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Traslado;
use App\Models\Alumno;
use App\Models\Niveles;
use App\Models\Grado;
use App\Models\CicloSeccion;

use DB;
use stdClass;

class Matricula extends Model
{
    use HasFactory;

    protected $table = 'matriculas';
    protected $fillable = ['alumno_id',
                            'ciclo_escolar_id',
                            'fecha',
                            'estado',
                            'es_traslado',
                            'tiene_discapacidad',
                            'vive_madre',
                            'vive_padre',
                            'responsable_matricula_nombres',
                            'cargo_responsable',
                            'ciclo_seccion_id',
                            'situacion_final',
                            'nota_final',
                            'situacion',
                            'sigla_situacion',
                            'trabaja',
                            'activo',
                            'borrado',
                            'created_at',
                            'updated_at',
                            'DI',
                            'DA',
                            'DV',
                            'DM',
                            'SC',
                            'OT',
                            'sigla_situacion_final',
                        ];
	protected $guarded = ['id'];

    public static function GetMatriculasByCicloAndAlumno($ciclo_id, $alumno_id){

        $matricula = Matricula::where('ciclo_escolar_id', $ciclo_id)
                                ->where('alumno_id', $alumno_id)
                                ->where('activo', 1)
                                ->where('borrado', 0)
                                ->first();
        
        if(!$matricula){
            return null;
        }

        $traslado = Traslado::where('alumno_id', $alumno_id)
                    ->where('matricula_id', $matricula->id)
                    ->where('activo', 1)
                    ->where('borrado', 0)
                    ->first();

        if(!$traslado){
            $matricula->es_traslado = 0;
            $matricula->traslado = null;

            return $matricula;
        }

        $matricula->es_traslado = 1;
        $matricula->traslado = $traslado;

        return $matricula;
    }

    public static function GetNominaCicloSeccion($ciclo_seccion_id){

        $ciclo_seccion = CicloSeccion::findOrFail($ciclo_seccion_id);

        $ciclo = CicloEscolar::find($ciclo_seccion->ciclo_escolar_id);
        $ciclo_grado = CicloGrado::find($ciclo_seccion->ciclo_grados_id);
        $ciclo_nivel = CicloNivel::find($ciclo_grado->ciclo_niveles_id);

        $ciclo_seccion->ciclo = $ciclo;
        $ciclo_seccion->ciclo_grado = $ciclo_grado;
        $ciclo_seccion->ciclo_nivel = $ciclo_nivel;

        $matriculas = DB::table('matriculas')
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

                    ->where('matriculas.ciclo_seccion_id', $ciclo_seccion->id)
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
                    
                    $ciclo_seccion->matriculas = $matriculas;

        return $ciclo_seccion;

    }

    public static function GetDatosGenericsByCiclo($ciclo_id){

        $ciclo = CicloEscolar::find($ciclo_id);

        $data = InstitucionEducativa::where('borrado','0')
                                    ->where('activo','1')
                                    ->first();
        
        $data->ciclo = $ciclo;

        if($ciclo){
            $niveles = CicloNivel::where('borrado','0')
            ->where('activo','1')
            ->where('institucion_educativa_id', $data->id)
            ->where('ciclo_escolar_id', $ciclo_id)
            ->orderBy('nivel_id')
            ->get();

            foreach ($niveles as $key => $value) {
            $grados = CicloGrado::where('borrado','0')
                            ->where('activo','1')
                            ->where('ciclo_niveles_id', $value->id)
                            ->where('ciclo_escolar_id', $ciclo_id)
                            ->orderBy('orden')
                            ->get();

            $nivel = Niveles::find($value->nivel_id);

            $value->siglas = $nivel->siglas;

            foreach ($grados as $keyG => $valueG) {
                $seccions = CicloSeccion::where('borrado','0')
                                    ->where('activo','1')
                                    ->where('ciclo_grados_id', $valueG->id)
                                    ->where('ciclo_escolar_id', $ciclo_id)
                                    ->orderBy('sigla')
                                    ->orderBy('nombre')
                                    ->get();
                
                foreach ($seccions as $keyS => $valueS) {

                    $matriculas = DB::table('matriculas')
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

                    ->where('matriculas.ciclo_seccion_id', $valueS->id)
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
                    
                    $valueS->matriculas = $matriculas;
                }

                $cursos = CicloCurso::where('borrado','0')
                                    ->where('activo','1')
                                    ->where('ciclo_grado_id', $valueG->id)
                                    ->where('ciclo_escolar_id', $ciclo_id)
                                    ->orderBy('orden')
                                    ->orderBy('nombre')
                                    ->get();

                $valueG->seccions = $seccions;
                $valueG->cursos = $cursos;
            }

            $value->grados = $grados;
            }

            $data->niveles = $niveles;
        }
        

        return $data;
    }

    public static function GetDatosGenericsByCicloDocente($ciclo_id, $iduser){

        $user = User::find($iduser);

        $docente = Docente::where('borrado','0')
        ->where('user_id',$iduser)
        ->where('activo','1')
        ->first();

        $ciclo = CicloEscolar::find($ciclo_id);

        $data = InstitucionEducativa::where('borrado','0')
                                    ->where('activo','1')
                                    ->first();
        
        $data->ciclo = $ciclo;

        if($ciclo){
            $niveles = CicloNivel::where('borrado','0')
            ->where('activo','1')
            ->where('institucion_educativa_id', $data->id)
            ->where('ciclo_escolar_id', $ciclo_id)
            ->orderBy('nivel_id')
            ->get();

            foreach ($niveles as $key => $value) {
                $grados = DB::select("select cg.id, cg.orden, cg.nombre, cg.ciclo_niveles_id, ac.docente_id from asignacion_cursos as ac
                inner join ciclo_seccion cs on ac.ciclo_seccion_id=cs.id
                inner join ciclo_grados cg on cs.ciclo_grados_id=cg.id
                where ac.docente_id = ?
                and cg.ciclo_escolar_id = ?
                and cg.ciclo_niveles_id = ?
                group by cg.orden
                order by cg.orden;", [$docente->id, $ciclo_id, $value->id]);

                $nivel = Niveles::find($value->nivel_id);

                $value->siglas = $nivel->siglas;

                foreach ($grados as $keyG => $valueG) {

                        $seccions = DB::select("select cs.id, cs.sigla, cs.nombre, cs.ciclo_grados_id from asignacion_cursos as ac
                        inner join ciclo_seccion cs on ac.ciclo_seccion_id=cs.id
                        where ac.docente_id = ?
                        and cs.ciclo_escolar_id = ?
                        and cs.ciclo_grados_id = ?
                        group by cs.id
                        order by cs.id;", [$docente->id, $ciclo_id, $valueG->id]);
                    
                        foreach ($seccions as $keyS => $valueS) {

                            $matriculas = DB::table('matriculas')
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

                            ->where('matriculas.ciclo_seccion_id', $valueS->id)
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
                            
                            $valueS->matriculas = $matriculas;
                        }

                        $cursos = DB::select("select cc.id, cc.orden, cc.nombre, cc.ciclo_grado_id, cc.opcion from asignacion_cursos as ac
                        inner join ciclo_cursos cc on ac.ciclo_cursos_id=cc.id
                        where ac.docente_id = ?
                        and cc.ciclo_escolar_id = ?
                        and cc.ciclo_grado_id = ?
                        group by cc.id
                        order by cc.id;", [$docente->id, $ciclo_id, $valueG->id]);

                        $valueG->seccions = $seccions;
                        $valueG->cursos = $cursos;
                }

                $value->grados = $grados;
            }

            $data->niveles = $niveles;
        }
        

        return $data;
    }



    public static function GetMatriculadosPendientes($ciclo_id){

        $ciclo = CicloEscolar::find($ciclo_id);

        $data = InstitucionEducativa::where('borrado','0')
                                    ->where('activo','1')
                                    ->first();
        
        $data->ciclo = $ciclo;

        if($ciclo){

            $matriculas = DB::table('matriculas')
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

                    ->where('matriculas.ciclo_escolar_id', $ciclo_id) //TODO: Filtro de Ciclo
                    ->where('alumnos.estado_grado', '1') //TODO: Filtro de Matriculado Pendiente
                    ->where('matriculas.estado', '<', 2) //TODO: Filtro de Matriculado Pendiente
                    ->where('matriculas.activo','1')
                    ->where('matriculas.borrado','0')
                    ->orderBy('matriculas.ciclo_seccion_id')
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
                    );

                    $matriculas = $matriculas->get();
                    $cantAlumnos = $matriculas->count();
                    
                    $data->matriculas = $matriculas;
                    $data->cantAlumnos = $cantAlumnos;

                foreach ($matriculas as $keyMat => $matricula) {
                    $seccion = CicloSeccion::find($matricula->ciclo_seccion_id);
                    $grado = CicloGrado::find($seccion->ciclo_grados_id);
                    $nivel = CicloNivel::find($grado->ciclo_niveles_id);

                    $matricula->seccion = $seccion;
                    $matricula->grado = $grado;
                    $matricula->nivel = $nivel;
                }
        }
        

        return $data;
    }

    public static function ValidarDelete($ciclo_id){

        $ciclo = CicloEscolar::find($ciclo_id);

        $data = InstitucionEducativa::where('borrado','0')
                                    ->where('activo','1')
                                    ->first();
        
        $data->ciclo = $ciclo;

        if($ciclo){

            $matriculas = DB::table('matriculas')
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

                    ->where('matriculas.ciclo_escolar_id', $ciclo_id) //TODO: Filtro de Ciclo
                    ->where('matriculas.activo','1')
                    ->where('matriculas.borrado','0')
                    ->orderBy('matriculas.ciclo_seccion_id')
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
                    );

                    $matriculas = $matriculas->get();
                    $cantAlumnos = $matriculas->count();
                    
                    $data->matriculas = $matriculas;
                    $data->cantAlumnos = $cantAlumnos;

                foreach ($matriculas as $keyMat => $matricula) {
                    $seccion = CicloSeccion::find($matricula->ciclo_seccion_id);
                    $grado = CicloGrado::find($seccion->ciclo_grados_id);
                    $nivel = CicloNivel::find($grado->ciclo_niveles_id);

                    $matricula->seccion = $seccion;
                    $matricula->grado = $grado;
                    $matricula->nivel = $nivel;
                }
        }
        

        return $data;
    }


    public static function PromoverAlumno($matricula_id){


        $matricula = Matricula::find($matricula_id);


        $matricula->situacion = "Promovido";
        $matricula->sigla_situacion = "A";
        $matricula->situacion_final = "Promovido";
        $matricula->sigla_situacion_final = "A";
        $matricula->estado = "2"; // 2->cerrado aprobado - aprobado estado final

        $matricula->save();


        $alumno = Alumno::find($matricula->alumno_id);

        $alumno->estado_grado = "2"; //cerrado aprobado - aprobado estado fina   - matricular siguiente

        $alumno->save();

        return true;
    }


    public static function PermanecerAlumno($matricula_id){


        $matricula = Matricula::find($matricula_id);


        $matricula->situacion = "Desaprobado";
        $matricula->sigla_situacion = "D";
        $matricula->situacion_final = "Desaprobado";
        $matricula->sigla_situacion_final = "D";
        $matricula->estado = "3"; // cerrado repitente  - repitente estado final

        $matricula->save();


        $alumno = Alumno::find($matricula->alumno_id);

        $alumno->estado_grado = "3"; // cerrado repitente  - repitente estado final  - matricular mismo grado

        $alumno->save();

        return true;
    }


    public static function ExpulsarAlumno($matricula_id){


        $matricula = Matricula::find($matricula_id);


        $matricula->situacion = "Retirado";
        $matricula->sigla_situacion = "R";
        $matricula->situacion_final = "Retirado";
        $matricula->sigla_situacion_final = "R";
        $matricula->estado = "4"; // expulsado              - expulsado estado final  

        $matricula->save();


        $alumno = Alumno::find($matricula->alumno_id);

        $alumno->estado_grado = "4"; // expulsado              - expulsado estado final - expulsado 

        $alumno->save();

        return true;
    }


    public static function CancelConclusionAlumno($matricula_id){


        $matricula = Matricula::find($matricula_id);


        $matricula->situacion = null;
        $matricula->sigla_situacion = null;
        $matricula->situacion_final = null;
        $matricula->sigla_situacion_final = null;
        $matricula->estado = "1"; // en proceso            - proceso de matricula transitivo  

        $matricula->save();


        $alumno = Alumno::find($matricula->alumno_id);

        $alumno->estado_grado = "1"; // expulsado              - expulsado estado final - expulsado 

        $alumno->save();

        return true;
    }

    public static function GetDatosPendientesBySeccion($ciclo_seccion_id){

        $ciclo_seccion = CicloSeccion::findOrFail($ciclo_seccion_id);
        $cicloEval = CicloEscolar::find($ciclo_seccion->ciclo_escolar_id);

        $matriculas = Matricula::select('alumno_id')
            ->where('borrado','0')
            ->where('activo','1')
            ->whereIn('estado', [2, 3])
            ->where('ciclo_seccion_id', $ciclo_seccion_id)
            ->where('ciclo_escolar_id', $cicloEval->id)
            ->orderBy('alumno_id')
            ->get();

        $alumnos = Alumno::where('borrado','0')
            ->where('activo','1')
            ->whereIn('estado_grado', [2, 3])
            ->whereIn('id', $matriculas)
            ->orderBy('apellido_paterno')
            ->orderBy('apellido_materno')
            ->orderBy('nombres')
            ->get();

            foreach ($alumnos as $key => $alumno) {
                $matricula = Matricula::where('borrado','0')
                ->where('activo','1')
                ->whereIn('estado', [2, 3])
                ->where('ciclo_seccion_id', $ciclo_seccion_id)
                ->where('ciclo_escolar_id', $cicloEval->id)
                ->where('alumno_id', $alumno->id)
                ->orderBy('ciclo_escolar_id', 'desc')
                ->first();

                $nivel = Niveles::find($alumno->nivel_actual);
                $grado = Grado::find($alumno->grado_actual);
                $cicloSeccion = null;

                if($matricula){
                    $cicloSeccion = CicloSeccion::find($matricula->ciclo_seccion_id);
                }

                $alumno->numero_matricula = str_pad($alumno->numero_matricula, 4, "0", STR_PAD_LEFT);
                $alumno->matriculaLast = $matricula;
                $alumno->nivel = $nivel;
                $alumno->grado = $grado;
                $alumno->cicloSeccion = $cicloSeccion;

            }


        return $alumnos;
    }

    public static function GetDatosActualesBySeccionLast($ciclo_seccion_id, $ciclo_grado_id, $ciclo_nivel_id){

        //Data Transaccional
        $ciclo_seccion = CicloSeccion::findOrFail($ciclo_seccion_id);
        $seccion = Secciones::findOrFail($ciclo_seccion->seccion_id);

        $ciclo_grado = CicloGrado::findOrFail($ciclo_grado_id);
        $grado = Grado::findOrFail($ciclo_grado->grado_id);

        $ciclo_nivel = CicloNivel::findOrFail($ciclo_nivel_id);
        $nivel = Niveles::findOrFail($ciclo_nivel->nivel_id);

        //Data Historica
        $cicloActivo = CicloEscolar::GetCicloActivo();
        $response = new stdClass();

        $ciclo_seccion_r = CicloSeccion::where('borrado','0')
        ->where('activo','1')
        ->where('seccion_id', $seccion->id)
        ->where('ciclo_escolar_id', $cicloActivo->id)
        ->first();

        $ciclo_grado_r = CicloGrado::where('borrado','0')
        ->where('activo','1')
        ->where('grado_id', $grado->id)
        ->where('ciclo_escolar_id', $cicloActivo->id)
        ->first();

        $ciclo_nivel_r = CicloNivel::where('borrado','0')
        ->where('activo','1')
        ->where('nivel_id', $nivel->id)
        ->where('ciclo_escolar_id', $cicloActivo->id)
        ->first();

        $response->nivel_R =$ciclo_nivel_r;
        $response->grado_R =$ciclo_grado_r;
        $response->seccion_R =$ciclo_seccion_r;

        //Obtener Grado Siguiente
        $nivel_p = $nivel->id;
        $grado_p = intval($grado->id) +1 ;


        if($grado->nivele_id == 1 && $grado->orden == 2){
            $nivel_p = 2;
            $grado_p = 3;
        }
        if($grado->nivele_id == 2 && $grado->orden == 6){
            $nivel_p = 3;
            $grado_p = 9;
        }
        if($grado->nivele_id == 3 && $grado->orden == 5){
            $nivel_p = 0;
            $grado_p = 0;
        }

        if($nivel_p == 0 && $grado_p == 0){
            $response->nivel_P = null;
            $response->grado_P = null;
            $response->seccion_P = null;
            $response->isQuintoSecundariaBefore = true;

            return $response;
        }


        $ciclo_grado_p = CicloGrado::where('borrado','0')
        ->where('activo','1')
        ->where('grado_id', $grado_p)
        ->where('ciclo_escolar_id', $cicloActivo->id)
        ->first();

        $ciclo_nivel_p = CicloNivel::where('borrado','0')
        ->where('activo','1')
        ->where('nivel_id', $nivel_p)
        ->where('ciclo_escolar_id', $cicloActivo->id)
        ->first();

        $ciclo_seccion_p = CicloSeccion::where('borrado','0')
        ->where('activo','1')
        ->where('ciclo_grados_id', $ciclo_grado_p->id)
        ->where('ciclo_escolar_id', $cicloActivo->id)
        ->first();

        $response->nivel_P =$ciclo_nivel_p;
        $response->grado_P =$ciclo_grado_p;
        $response->seccion_P =$ciclo_seccion_p;
        $response->isQuintoSecundariaBefore = false;

        return $response;
        
    }

    public static function MatriculaRapida($alumno, $cabecera, $dataMatricular){

        $cicloActivo = CicloEscolar::GetCicloActivo();

        $matricula = new Matricula;
        $matricula->alumno_id = $alumno->matriculaLast->alumno_id;
        //$matricula->ciclo_escolar_id = $alumno->matriculaLast->ciclo_escolar_id;
        //$matricula->fecha = $alumno->matriculaLast->fecha;
        //$matricula->estado = $alumno->matriculaLast->estado;
        //$matricula->es_traslado = $alumno->matriculaLast->es_traslado;
        $matricula->tiene_discapacidad = $alumno->matriculaLast->tiene_discapacidad;
        $matricula->vive_madre = $alumno->matriculaLast->vive_madre;
        $matricula->vive_padre = $alumno->matriculaLast->vive_padre;
        //$matricula->responsable_matricula_nombres = $alumno->matriculaLast->responsable_matricula_nombres;
        //$matricula->cargo_responsable = $alumno->matriculaLast->cargo_responsable;
        //$matricula->ciclo_seccion_id = $alumno->matriculaLast->ciclo_seccion_id;
        //$matricula->situacion_final = $alumno->matriculaLast->situacion_final;
        $matricula->nota_final = $alumno->matriculaLast->nota_final;
        //$matricula->situacion = $alumno->matriculaLast->situacion;
        $matricula->sigla_situacion = $alumno->matriculaLast->sigla_situacion;
        $matricula->trabaja = $alumno->matriculaLast->trabaja;
        $matricula->activo = $alumno->matriculaLast->activo;
        $matricula->borrado = $alumno->matriculaLast->borrado;
        $matricula->created_at = $alumno->matriculaLast->created_at;
        $matricula->updated_at = $alumno->matriculaLast->updated_at;
        $matricula->DI = $alumno->matriculaLast->DI;
        $matricula->DA = $alumno->matriculaLast->DA;
        $matricula->DV = $alumno->matriculaLast->DV;
        $matricula->DM = $alumno->matriculaLast->DM;
        $matricula->SC = $alumno->matriculaLast->SC;
        $matricula->OT = $alumno->matriculaLast->OT;
        //$matricula->sigla_situacion_final = $alumno->matriculaLast->sigla_situacion_final;


        $matricula->ciclo_escolar_id = $cicloActivo->id;
        $matricula->fecha = $cabecera->fecha;
        $matricula->estado = 5; //Pendiente Transitivo
        $matricula->es_traslado = 0; //No

        $matricula->responsable_matricula_nombres = $cabecera->responsable_matricula_nombres; //No
        $matricula->cargo_responsable = ""; //No
        $matricula->ciclo_seccion_id = $dataMatricular->seccion; //No
        $matricula->situacion = null;
        $matricula->situacion_final = null; //null
        $matricula->sigla_situacion = null; //null
        $matricula->sigla_situacion_final = null; //null

        $matricula->save();

        //Update Alumno

        $nivelCiclo = CicloNivel::find($dataMatricular->nivel);
        $gradoCiclo = CicloGrado::find($dataMatricular->grado);

        $alumnoBD = Alumno::find($alumno->id);

        $alumnoBD->grado_actual = $gradoCiclo->grado_id;
        $alumnoBD->nivel_actual = $nivelCiclo->nivel_id;
        $alumnoBD->old_estado_grado = $alumnoBD->estado_grado;
        $alumnoBD->estado_grado = 0; // Por Matricular

        $alumnoBD->save();

        //Apoderado Matricula
        $apoderados = Apoderado::where('alumno_id', $alumnoBD->id)
                            ->where('activo',1)
                            ->where('borrado',0)
                            ->get();

        foreach ($apoderados as $apoderado) {
            if($apoderado->principal == "1"){

                $registroD = new ApoderadoMatricula;

                $registroD->alumno_id = $alumnoBD->id;
                $registroD->matricula_id = $matricula->id;
                $registroD->apellido_paterno = $apoderado->apellido_materno;
                $registroD->apellido_materno = $apoderado->apellido_paterno;
                $registroD->nombres = $apoderado->nombres;
                $registroD->parentesco = $apoderado->tipo_apoderado;
                $registroD->fecha_nac = $apoderado->fecha_nacimiento;
                $registroD->instruccion = $apoderado->grado_instruccion;
                $registroD->ocupacion = $apoderado->ocupacion;
                $registroD->direccion = $apoderado->direccion;
                $registroD->telefono = $apoderado->telefono;
                $registroD->activo = '1';
                $registroD->borrado = '0';

                $registroD->save();
            }
        }

        //Domicilio
        $registroC = new Domicilio;

        $registroC->anio = $cicloActivo->year;
        $registroC->direccion = $alumno->direccion;
        $registroC->lugar = $alumno->lugar;
        $registroC->departamento = $alumno->departamento;
        $registroC->provincia = $alumno->provincia;
        $registroC->distrito = $alumno->distrito;
        $registroC->telefono = $alumno->telefono;
        $registroC->alumno_id = $alumno->id;
        $registroC->activo = '1';
        $registroC->borrado = '0';
        $registroC->matricula_id = $matricula->id;
        
        $registroC->save();

        return [ 
            'alumno' => $alumnoBD,
            'matricula' => $matricula,
           ];

    }


}
