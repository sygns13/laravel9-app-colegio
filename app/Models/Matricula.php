<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Traslado;
use App\Models\Alumno;

use DB;

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


    /* function object_sorter($clave,$orden=null) {
        return function ($a, $b) use ($clave,$orden) {
              $result=  ($orden=="DESC") ? strnatcmp($b->$clave, $a->$clave) :  strnatcmp($a->$clave, $b->$clave);
              return $result;
        };
    } */
}
