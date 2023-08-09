<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

use App\Models\TipoDocumento;
use App\Models\Apoderado;
use App\Models\Tipoapoderado;
use App\Models\SituacionLaboral;
use App\Models\RegistroSalud;
use App\Models\Controles;
use App\Models\Domicilio;
use App\Models\Matricula;
use App\Models\CicloEscolar;
use App\Models\CicloSeccion;
use App\Models\CicloGrado;
use App\Models\CicloNivel;
use App\Models\CicloCurso;
use App\Models\Turno;
use App\Models\ApoderadoMatricula;
use App\Models\AsignacionCurso;
use App\Models\CicloCompetencia;
use App\Models\CicloIndicador;

use DB;

use DateTime;
use DateInterval;

class Alumno extends Model
{
    use HasFactory;

    
    protected $table = 'alumnos';
    protected $fillable = ['tipo_documento_id',
                            'num_documento',
                            'apellido_paterno',
                            'apellido_materno',
                            'nombres',
                            'fecha_nacimiento',
                            'genero',
                            'grado_actual',
                            'nivel_actual',
                            'telefono',
                            'celular',
                            'direccion',
                            'correo',
                            'pais',
                            'sigla_pais',
                            'departamento',
                            'provincia',
                            'distrito',
                            'lugar',
                            'lengua_materna',
                            'segunda_lengua',
                            'num_hermanos',
                            'lugar_hermano',
                            'religion',
                            'DI',
                            'DA',
                            'DV',
                            'nacimiento',
                            'obs_nacimiento',
                            'levanto_cabeza',
                            'se_sento',
                            'se_paro',
                            'se_camino',
                            'se_control_esfinter',
                            'se_primeras_palabras',
                            'se_hablo_fluido',
                            'nacimiento_registrado',
                            'activo',
                            'borrado',
                            'estado_grado',
                            'DM',
                            'SC',
                            'OT',
                            'user_id',
                            'pais_id',
                            'departamento_id',
                            'provincia_id',
                            'distrito_id',
                            'anio_ingreso',
                            'codigo_modular',
                            'numero_matricula',
                            'flag',
                            'old_estado_grado',
                        ];
	protected $guarded = ['id'];

    public static function GetListaCursos($alumno_id, $ciclo_id){

        $data = Matricula::where('ciclo_escolar_id', $ciclo_id)
                                ->where('alumno_id', $alumno_id)
                                ->where('activo', 1)
                                ->where('borrado', 0)
                                ->first();

        $alumno = Alumno::find($alumno_id);
        $tipoDocumento = TipoDocumento::find($alumno->tipo_documento_id);
        $alumno->tipoDocumento = $tipoDocumento;

        $ciclo = CicloEscolar::find($ciclo_id);

        if(!$data){
            return null;
        }

        $ciclo_seccion = CicloSeccion::find($data->ciclo_seccion_id);

        if(!$ciclo_seccion){
            return null;
        }

        $grado = CicloGrado::find($ciclo_seccion->ciclo_grados_id);
        $nivel = CicloNivel::find($grado->ciclo_niveles_id);

        $data->alumno = $alumno;
        $data->cicloSeccion = $ciclo_seccion;
        $data->grado = $grado;
        $data->nivel = $nivel;

        $ciclo_cursos = CicloCurso::where('ciclo_escolar_id', $ciclo_id)
                                    ->where('ciclo_grado_id', $ciclo_seccion->ciclo_grados_id)
                                    ->where('activo', 1)
                                    ->where('borrado', 0)
                                    ->orderBy('orden')
                                    ->get();

        foreach ($ciclo_cursos as $key => $curso) {

            $docentes = DB::select("select d.id, d.tipo_documento_id, d.num_documento, d.apellidos, d.nombre
            from asignacion_cursos ac
            inner join docentes d on d.id=ac.docente_id
            where ac.ciclo_seccion_id = ?
            and ac.ciclo_cursos_id= ?
            and ac.activo='1'
            and ac.borrado='0';", [$ciclo_seccion->id, $curso->id]);

            $curso->docente = null;
            $curso->evalProgramadas = 0;

            if(count($docentes) > 0){
                $curso->docente = $docentes[0];
            }

            $competencias = CicloCompetencia::where('ciclo_escolar_id', $ciclo_id)
                                        ->where('ciclo_cursos_id', $curso->id)
                                        ->where('activo', 1)
                                        ->where('borrado', 0)
                                        ->orderBy('orden')
                                        ->get();

            foreach ($competencias as $keyC => $competencia) {
                $indicadores = CicloIndicador::where('ciclo_escolar_id', $ciclo_id)
                                            ->where('ciclo_competencia_id', $competencia->id)
                                            ->where('activo', 1)
                                            ->where('borrado', 0)
                                            ->orderBy('orden')
                                            ->get();

                foreach ($indicadores as $keyI => $indicador) {
                    if($indicador->fecha_programada1 != null && $indicador->fecha_programada1 != ''){
                        $curso->evalProgramadas++;
                    }

                    if($indicador->fecha_programada2 != null && $indicador->fecha_programada2 != ''){
                        $curso->evalProgramadas++;
                    }

                    if($indicador->fecha_programada3 != null && $indicador->fecha_programada3 != ''){
                        $curso->evalProgramadas++;
                    }

                    if($indicador->fecha_programada4 != null && $indicador->fecha_programada4 != ''){
                        $curso->evalProgramadas++;
                    }
                }
            }


            //Data Notas

            $notaFinal = Nota::where('matricula_id', $data->id)
            ->where('tipo', 3)
            ->where('ciclo_curso_id', $curso->id)
            ->where('alumno_id', $data->alumno_id)
            ->where('periodo', 0)
            ->where('activo', 1)
            ->where('borrado', 0)
            ->first();

            $data->notaFinal = $notaFinal;

            //Primer Bimestre/Trimestre
            $notaPrimerPeriodo = Nota::where('matricula_id', $data->id)
                                    ->where('tipo', 3)
                                    ->where('ciclo_curso_id', $curso->id)
                                    ->where('alumno_id', $data->alumno_id)
                                    ->where('periodo', 1)
                                    ->where('activo', 1)
                                    ->where('borrado', 0)
                                    ->first();

            $data->notaPrimerPeriodo = $notaPrimerPeriodo;

            //Segundo Bimestre/Trimestre
            $notaSegundoPeriodo = Nota::where('matricula_id', $data->id)
                                    ->where('tipo', 3)
                                    ->where('ciclo_curso_id', $curso->id)
                                    ->where('alumno_id', $data->alumno_id)
                                    ->where('periodo', 2)
                                    ->where('activo', 1)
                                    ->where('borrado', 0)
                                    ->first();

            $data->notaSegundoPeriodo = $notaSegundoPeriodo;

            //Tercer Bimestre/Trimestre
            $notaTercerPeriodo = Nota::where('matricula_id', $data->id)
                                    ->where('tipo', 3)
                                    ->where('ciclo_curso_id', $curso->id)
                                    ->where('alumno_id', $data->alumno_id)
                                    ->where('periodo', 3)
                                    ->where('activo', 1)
                                    ->where('borrado', 0)
                                    ->first();

            $data->notaTercerPeriodo = $notaTercerPeriodo;




            if($ciclo->opcion == 2){
                //Cuarto Bimestre solo si aplica
                $notaCuartoPeriodo = Nota::where('matricula_id', $data->id)
                                    ->where('tipo', 3)
                                    ->where('ciclo_curso_id', $curso->id)
                                    ->where('alumno_id', $data->alumno_id)
                                    ->where('periodo', 4)
                                    ->where('activo', 1)
                                    ->where('borrado', 0)
                                    ->first();

                $data->notaCuartoPeriodo = $notaCuartoPeriodo;
            }

            $competencias = CicloCompetencia::where('ciclo_cursos_id', $curso->id)
                                        ->where('ciclo_escolar_id', $ciclo_id)
                                        ->orderBy('orden')
                                        ->orderBy('nombre')
                                        ->get();

                foreach ($competencias as $keyCom => $competencia) {
                    $indicadores = CicloIndicador::where('ciclo_competencia_id', $competencia->id)
                                            ->where('ciclo_escolar_id', $ciclo_id)
                                            ->orderBy('orden')
                                            ->orderBy('nombre')
                                            ->get();

                    foreach ($indicadores as $keyInd => $indicador) {
                        $hoy = date('Y-m-d');
                        $indicador->activo1 = '0';
                        $indicador->activo2 = '0';
                        $indicador->activo3 = '0';
                        $indicador->activo4 = '0';

                        if($indicador->fecha_programada1 == $hoy){
                            $indicador->activo1 = '1';
                        }
                        if($indicador->fecha_programada2 == $hoy){
                            $indicador->activo2 = '1';
                        }
                        if($indicador->fecha_programada3 == $hoy){
                            $indicador->activo3 = '1';
                        }
                        if($indicador->fecha_programada4 == $hoy){
                            $indicador->activo4 = '1';
                        }
                    }

                    $competencia->indicadores = $indicadores;
                }

            //Notas Competencias
            foreach ($competencias as $keyCom => $competencia) {

                //Nota Final
                $notaFinal = Nota::where('matricula_id', $data->id)
                    ->where('tipo', 2)
                    ->where('ciclo_curso_id', $curso->id)
                    ->where('ciclo_competencia_id', $competencia->id)
                    ->where('alumno_id', $data->alumno_id)
                    ->where('periodo', 0)
                    ->where('activo', 1)
                    ->where('borrado', 0)
                    ->first();

                $competencia->notaFinal = $notaFinal;

                //Primer Bimestre/Trimestre
                $notaPrimerPeriodo = Nota::where('matricula_id', $data->id)
                ->where('tipo', 2)
                ->where('ciclo_curso_id', $curso->id)
                ->where('ciclo_competencia_id', $competencia->id)
                ->where('alumno_id', $data->alumno_id)
                ->where('periodo', 1)
                ->where('activo', 1)
                ->where('borrado', 0)
                ->first();

                $competencia->notaPrimerPeriodo = $notaPrimerPeriodo;

                //Segundo Bimestre/Trimestre
                $notaSegundoPeriodo = Nota::where('matricula_id', $data->id)
                                        ->where('tipo', 2)
                                        ->where('ciclo_curso_id', $curso->id)
                                        ->where('ciclo_competencia_id', $competencia->id)
                                        ->where('alumno_id', $data->alumno_id)
                                        ->where('periodo', 2)
                                        ->where('activo', 1)
                                        ->where('borrado', 0)
                                        ->first();

                $competencia->notaSegundoPeriodo = $notaSegundoPeriodo;

                //Tercer Bimestre/Trimestre
                $notaTercerPeriodo = Nota::where('matricula_id', $data->id)
                                        ->where('tipo', 2)
                                        ->where('ciclo_curso_id', $curso->id)
                                        ->where('ciclo_competencia_id', $competencia->id)
                                        ->where('alumno_id', $data->alumno_id)
                                        ->where('periodo', 3)
                                        ->where('activo', 1)
                                        ->where('borrado', 0)
                                        ->first();

                $competencia->notaTercerPeriodo = $notaTercerPeriodo;

                if($ciclo->opcion == 2){
                    //Cuarto Bimestre solo si aplica
                    $notaCuartoPeriodo = Nota::where('matricula_id', $data->id)
                                        ->where('tipo', 2)
                                        ->where('ciclo_curso_id', $curso->id)
                                        ->where('ciclo_competencia_id', $competencia->id)
                                        ->where('alumno_id', $data->alumno_id)
                                        ->where('periodo', 4)
                                        ->where('activo', 1)
                                        ->where('borrado', 0)
                                        ->first();

                    $competencia->notaCuartoPeriodo = $notaCuartoPeriodo;
                }  

                //Notas Indicadores
                foreach ($competencia->indicadores as $keyInd => $indicador) {

                    //Nota Final
                    $notaFinal = Nota::where('matricula_id', $data->id)
                        ->where('tipo', 1)
                        ->where('ciclo_curso_id', $curso->id)
                        ->where('ciclo_competencia_id', $competencia->id)
                        ->where('ciclo_indicador_id', $indicador->id)
                        ->where('alumno_id', $data->alumno_id)
                        ->where('periodo', 0)
                        ->where('activo', 1)
                        ->where('borrado', 0)
                        ->first();

                    $indicador->notaFinal = $notaFinal;


                    //Primer Bimestre/Trimestre
                    $notaPrimerPeriodo = Nota::where('matricula_id', $data->id)
                    ->where('tipo', 1)
                    ->where('ciclo_curso_id', $curso->id)
                    ->where('ciclo_competencia_id', $competencia->id)
                    ->where('ciclo_indicador_id', $indicador->id)
                    ->where('alumno_id', $data->alumno_id)
                    ->where('periodo', 1)
                    ->where('activo', 1)
                    ->where('borrado', 0)
                    ->first();

                    $indicador->notaPrimerPeriodo = $notaPrimerPeriodo;

                    //Segundo Bimestre/Trimestre
                    $notaSegundoPeriodo = Nota::where('matricula_id', $data->id)
                                            ->where('tipo', 1)
                                            ->where('ciclo_curso_id', $curso->id)
                                            ->where('ciclo_competencia_id', $competencia->id)
                                            ->where('ciclo_indicador_id', $indicador->id)
                                            ->where('alumno_id', $data->alumno_id)
                                            ->where('periodo', 2)
                                            ->where('activo', 1)
                                            ->where('borrado', 0)
                                            ->first();

                    $indicador->notaSegundoPeriodo = $notaSegundoPeriodo;

                    //Tercer Bimestre/Trimestre
                    $notaTercerPeriodo = Nota::where('matricula_id', $data->id)
                                            ->where('tipo', 1)
                                            ->where('ciclo_curso_id', $curso->id)
                                            ->where('ciclo_competencia_id', $competencia->id)
                                            ->where('ciclo_indicador_id', $indicador->id)
                                            ->where('alumno_id', $data->alumno_id)
                                            ->where('periodo', 3)
                                            ->where('activo', 1)
                                            ->where('borrado', 0)
                                            ->first();

                    $indicador->notaTercerPeriodo = $notaTercerPeriodo;

                    if($ciclo->opcion == 2){
                        //Cuarto Bimestre solo si aplica
                        $notaCuartoPeriodo = Nota::where('matricula_id', $curso->id)
                                            ->where('tipo', 1)
                                            ->where('ciclo_curso_id', $curso->id)
                                            ->where('ciclo_competencia_id', $competencia->id)
                                            ->where('ciclo_indicador_id', $indicador->id)
                                            ->where('alumno_id', $curso->alumno_id)
                                            ->where('periodo', 4)
                                            ->where('activo', 1)
                                            ->where('borrado', 0)
                                            ->first();

                        $indicador->notaCuartoPeriodo = $notaCuartoPeriodo;
                    }  
                }
            }

            $curso->competencias = $competencias;
        }

        $data->ciclo_cursos = $ciclo_cursos;

        return $data;


    }

    public static function GetByDocIdentidad($tipo_documento_id, $num_documento){
        $data = Alumno::where('tipo_documento_id', $tipo_documento_id)
                    ->where('num_documento', $num_documento)
                    ->first();
                    

        if($data){
            $tipoDocumento = TipoDocumento::find($data->tipo_documento_id);
            $data->tipoDocumento = $tipoDocumento;

            $apoderados = Apoderado::where('alumno_id', $data->id)
                                ->where('activo', 1)
                                ->where('borrado', 0)
                                ->get();

                                foreach ($apoderados as $key => $apoderado) {
                                    $tipoApoderado = Tipoapoderado::find($apoderado->tipo_apoderado_id);
                                    $apoderado->tipoApoderado = $tipoApoderado;
                                }
            $data->apoderados = $apoderados;

            $traslados = Traslado::where('alumno_id', $data->id)
                                ->where('activo', 1)
                                ->where('borrado', 0)
                                ->orderByDesc('id')
                                ->get();
            $data->traslados = $traslados;

            $situacionLaboral = SituacionLaboral::where('alumno_id', $data->id)
                                ->where('activo', 1)
                                ->where('borrado', 0)
                                ->orderByDesc('id')
                                ->first();
            $data->situacionLaboral = $situacionLaboral;

            $registroSalud = RegistroSalud::where('alumno_id', $data->id)
                                ->where('activo', 1)
                                ->where('borrado', 0)
                                ->orderByDesc('id')
                                ->first();
            $data->registroSalud = $registroSalud;

            $controles = Controles::where('alumno_id', $data->id)
                                ->where('activo', 1)
                                ->where('borrado', 0)
                                ->orderByDesc('id')
                                ->get();
            $data->controles = $controles;

            $domicilios = Domicilio::where('alumno_id', $data->id)
                                ->where('activo', 1)
                                ->where('borrado', 0)
                                ->orderByDesc('id')
                                ->get();
            $data->domicilios = $domicilios;

            $data->fullNombre = $data->apellido_paterno . ' ' . $data->apellido_materno . ' ' . $data->nombres;
        }
        

        return $data;
    }

    public static function GetById($alumno_id){
        $data = Alumno::findOrFail($alumno_id);
                    

        if($data){
            $tipoDocumento = TipoDocumento::find($data->tipo_documento_id);
            $data->tipoDocumento = $tipoDocumento;

            $apoderados = Apoderado::where('alumno_id', $data->id)
                                ->where('activo', 1)
                                ->where('borrado', 0)
                                ->get();

                                foreach ($apoderados as $key => $apoderado) {
                                    $tipoApoderado = Tipoapoderado::find($apoderado->tipo_apoderado_id);
                                    $apoderado->tipoApoderado = $tipoApoderado;
                                }
            $data->apoderados = $apoderados;

            $traslados = Traslado::where('alumno_id', $data->id)
                                ->where('activo', 1)
                                ->where('borrado', 0)
                                ->orderBy('id')
                                ->get();
            $data->traslados = $traslados;

            $situacionLaborales = SituacionLaboral::where('alumno_id', $data->id)
                                ->where('activo', 1)
                                ->where('borrado', 0)
                                ->orderBy('id')
                                ->get();
            $data->situacionLaborales = $situacionLaborales;

            $registroSaludEnfermedads = RegistroSalud::where('alumno_id', $data->id)
                                ->where('activo', 1)
                                ->where('borrado', 0)
                                ->where('tipo', 1)
                                ->orderBy('id')
                                ->get();
            $data->registroSaludEnfermedads = $registroSaludEnfermedads;

            $registroSaludVacunas = RegistroSalud::where('alumno_id', $data->id)
                                ->where('activo', 1)
                                ->where('borrado', 0)
                                ->where('tipo', 2)
                                ->orderBy('id')
                                ->get();
            $data->registroSaludVacunas = $registroSaludVacunas;

            $registroSaludAlergias = RegistroSalud::where('alumno_id', $data->id)
                                ->where('activo', 1)
                                ->where('borrado', 0)
                                ->where('tipo', 3)
                                ->orderBy('id')
                                ->get();
            $data->registroSaludAlergias = $registroSaludAlergias;

            $registroSaludExperienciasT = RegistroSalud::where('alumno_id', $data->id)
                                ->where('activo', 1)
                                ->where('borrado', 0)
                                ->where('tipo', 4)
                                ->orderBy('id')
                                ->get();
            $data->registroSaludExperienciasT = $registroSaludExperienciasT;

            $controlesPesoTalla = Controles::where('alumno_id', $data->id)
                                ->where('activo', 1)
                                ->where('borrado', 0)
                                ->where('tipo_control', 1)
                                ->orderBy('id')
                                ->get();
            $data->controlesPesoTalla = $controlesPesoTalla;

            $controlesOtros = Controles::where('alumno_id', $data->id)
                                ->where('activo', 1)
                                ->where('borrado', 0)
                                ->where('tipo_control', 2)
                                ->orderBy('id')
                                ->get();
            $data->controlesOtros = $controlesOtros;

            $domicilios = Domicilio::where('alumno_id', $data->id)
                                ->where('activo', 1)
                                ->where('borrado', 0)
                                ->orderBy('id')
                                ->get();
            $data->domicilios = $domicilios;

            $matriculas = Matricula::where('alumno_id', $data->id)
                                ->where('activo', 1)
                                ->where('borrado', 0)
                                ->orderBy('id')
                                ->get();

                                foreach ($matriculas as $keyC => $matricula) {
                                    $ciclo = CicloEscolar::find($matricula->ciclo_escolar_id);
                                    $matricula->ciclo = $ciclo;

                                    $cicloSeccion = CicloSeccion::find($matricula->ciclo_seccion_id);
                                    $matricula->cicloSeccion = $cicloSeccion;

                                    $turno = Turno::find($cicloSeccion->turno_id);
                                    $matricula->turno = $turno;

                                    $cicloGrado = CicloGrado::find($cicloSeccion->ciclo_grados_id);
                                    $matricula->cicloGrado = $cicloGrado;

                                    $cicloNivel = CicloNivel::find($cicloGrado->ciclo_niveles_id);
                                    $matricula->cicloNivel = $cicloNivel;

                                    $apoderadoMatricula = ApoderadoMatricula::where('alumno_id', $data->id)
                                                                            ->where('matricula_id', $matricula->id)
                                                                            ->where('activo', 1)
                                                                            ->where('borrado', 0)
                                                                            ->first();
                                    $matricula->apoderadoMatricula = $apoderadoMatricula;
                                }

            $data->matriculas = $matriculas;

            $data->fullNombre = $data->apellido_paterno . ' ' . $data->apellido_materno . ' ' . $data->nombres;
        }
        

        return $data;
    }

    public static function GetDataById($alumno_id){

        $data = Alumno::findOrFail($alumno_id);

        $matriculas = Matricula::where('alumno_id', $data->id)
                                ->where('activo', 1)
                                ->where('borrado', 0)
                                ->orderBy('id')
                                ->get();

        foreach ($matriculas as $keyC => $matricula) {
            $ciclo = CicloEscolar::find($matricula->ciclo_escolar_id);
            $matricula->ciclo = $ciclo;

            $cicloSeccion = CicloSeccion::find($matricula->ciclo_seccion_id);
            $matricula->cicloSeccion = $cicloSeccion;

            $turno = Turno::find($cicloSeccion->turno_id);
            $matricula->turno = $turno;

            $cicloGrado = CicloGrado::find($cicloSeccion->ciclo_grados_id);
            $matricula->cicloGrado = $cicloGrado;

            $cicloNivel = CicloNivel::find($cicloGrado->ciclo_niveles_id);
            $matricula->cicloNivel = $cicloNivel;

            $apoderadoMatricula = ApoderadoMatricula::where('alumno_id', $data->id)
                                                    ->where('matricula_id', $matricula->id)
                                                    ->where('activo', 1)
                                                    ->where('borrado', 0)
                                                    ->first();
            $matricula->apoderadoMatricula = $apoderadoMatricula;

            $asignacionCursos = DB::table('asignacion_cursos')
                                ->join('ciclo_seccion', 'ciclo_seccion.id', '=', 'asignacion_cursos.ciclo_seccion_id')
                                ->join('ciclo_cursos', 'ciclo_cursos.id', '=', 'asignacion_cursos.ciclo_cursos_id')
                                ->where('ciclo_seccion.id', $cicloSeccion->id)
                                ->select('asignacion_cursos.id',
                                            'ciclo_cursos.id as idCicloCurso',
                                            'ciclo_cursos.nombre as curso',
                                            'ciclo_cursos.orden as ordenCurso')
                                            ->get();

            $matricula->cursos = $asignacionCursos;
        }

        $data->matriculas = $matriculas;

        return $data;

    }

    public static function GetHorario($alumno_id, $ciclo_id){


        $data = Matricula::where('ciclo_escolar_id', $ciclo_id)
                                ->where('alumno_id', $alumno_id)
                                ->where('activo', 1)
                                ->where('borrado', 0)
                                ->first();

        $alumno = Alumno::find($alumno_id);
        $tipoDocumento = TipoDocumento::find($alumno->tipo_documento_id);
        $alumno->tipoDocumento = $tipoDocumento;

        $ciclo = CicloEscolar::find($ciclo_id);

        if(!$data){
            return null;
        }

        $ciclo_seccion = CicloSeccion::find($data->ciclo_seccion_id);

        if(!$ciclo_seccion){
            return null;
        }

        $grado = CicloGrado::find($ciclo_seccion->ciclo_grados_id);
        $nivel = CicloNivel::find($grado->ciclo_niveles_id);

        $data->alumno = $alumno;
        $data->cicloSeccion = $ciclo_seccion;
        $data->grado = $grado;
        $data->nivel = $nivel;

        $horarios = Horario::where('borrado','0')
                                    ->where('activo','1')
                                    ->where('ciclo_seccion_id', $ciclo_seccion->id)
                                    ->where('ciclo_escolar_id', $ciclo->id)
                                    ->orderBy('dia_semana')
                                    ->orderBy('hora_ini')
                                    ->get();

        $cursos = CicloCurso::where('borrado','0')
                                    ->where('activo','1')
                                    ->where('ciclo_grado_id', $ciclo_seccion->ciclo_grados_id)
                                    ->where('ciclo_escolar_id', $ciclo->id)
                                    ->orderBy('orden')
                                    ->orderBy('nombre')
                                    ->get();

        $data->horarios = $horarios;
        $data->cursos = $cursos;        

        return $data;
    }

    public static function GetAsistencia($alumno_id, $ciclo_id, $fecha){


        $data = Matricula::where('ciclo_escolar_id', $ciclo_id)
                                ->where('alumno_id', $alumno_id)
                                ->where('activo', 1)
                                ->where('borrado', 0)
                                ->first();

        $alumno = Alumno::find($alumno_id);
        $tipoDocumento = TipoDocumento::find($alumno->tipo_documento_id);
        $alumno->tipoDocumento = $tipoDocumento;

        $ciclo = CicloEscolar::find($ciclo_id);

        if(!$data){
            return null;
        }

        $ciclo_seccion = CicloSeccion::find($data->ciclo_seccion_id);

        if(!$ciclo_seccion){
            return null;
        }

        $grado = CicloGrado::find($ciclo_seccion->ciclo_grados_id);
        $nivel = CicloNivel::find($grado->ciclo_niveles_id);

        $data->alumno = $alumno;
        $data->cicloSeccion = $ciclo_seccion;
        $data->grado = $grado;
        $data->nivel = $nivel;
        $data->ciclo = $ciclo;

        $date1 = new DateTime($fecha);
        $date2 = new DateTime($fecha);
        $date3 = new DateTime($fecha);
        $date4 = new DateTime($fecha);
        $date5 = new DateTime($fecha);

        $tipodia=date("N",$date1->getTimestamp());

        $dia1 =$fecha;
        $dia2 =$fecha;
        $dia3 =$fecha;
        $dia4 =$fecha;
        $dia5 =$fecha;

        switch ($tipodia) {
            case '1':
                $dia1 = date_format($date1, 'Y-m-d');
                $date2->add(new DateInterval('P1D'));
                $dia2 = date_format($date2, 'Y-m-d');
                $date3->add(new DateInterval('P2D'));
                $dia3 = date_format($date3, 'Y-m-d');
                $date4->add(new DateInterval('P3D'));
                $dia4 = date_format($date4, 'Y-m-d');
                $date5->add(new DateInterval('P4D'));
                $dia5 = date_format($date5, 'Y-m-d');
            break;
            case '2':
                $date1->sub(new DateInterval('P1D'));
                $dia1 = date_format($date1, 'Y-m-d');
                $dia2 = date_format($date2, 'Y-m-d');
                $date3->add(new DateInterval('P1D'));
                $dia3 = date_format($date3, 'Y-m-d');
                $date4->add(new DateInterval('P2D'));
                $dia4 = date_format($date4, 'Y-m-d');
                $date5->add(new DateInterval('P3D'));
                $dia5 = date_format($date5, 'Y-m-d');
            break;
            case '3':
                $date1->sub(new DateInterval('P2D'));
                $dia1 = date_format($date1, 'Y-m-d');
                $date2->sub(new DateInterval('P1D'));
                $dia2 = date_format($date2, 'Y-m-d');
                $dia3 = date_format($date3, 'Y-m-d');
                $date4->add(new DateInterval('P1D'));
                $dia4 = date_format($date4, 'Y-m-d');
                $date5->add(new DateInterval('P2D'));
                $dia5 = date_format($date5, 'Y-m-d');
            break;
            case '4':
                $date1->sub(new DateInterval('P3D'));
                $dia1 = date_format($date1, 'Y-m-d');
                $date2->sub(new DateInterval('P2D'));
                $dia2 = date_format($date2, 'Y-m-d');
                $date3->sub(new DateInterval('P1D'));
                $dia3 = date_format($date3, 'Y-m-d');
                $dia4 = date_format($date4, 'Y-m-d');
                $date5->add(new DateInterval('P1D'));
                $dia5 = date_format($date5, 'Y-m-d');
            break;
            case '5':
                $date1->sub(new DateInterval('P4D'));
                $dia1 = date_format($date1, 'Y-m-d');
                $date2->sub(new DateInterval('P3D'));
                $dia2 = date_format($date2, 'Y-m-d');
                $date3->sub(new DateInterval('P2D'));
                $dia3 = date_format($date3, 'Y-m-d');
                $date4->sub(new DateInterval('P1D'));
                $dia4 = date_format($date4, 'Y-m-d');
                $dia5 = date_format($date5, 'Y-m-d');
            break;
            case '6':
                $date1->sub(new DateInterval('P5D'));
                $dia1 = date_format($date1, 'Y-m-d');
                $date2->sub(new DateInterval('P4D'));
                $dia2 = date_format($date2, 'Y-m-d');
                $date3->sub(new DateInterval('P3D'));
                $dia3 = date_format($date3, 'Y-m-d');
                $date4->sub(new DateInterval('P2D'));
                $dia4 = date_format($date4, 'Y-m-d');
                $date5->sub(new DateInterval('P1D'));
                $dia5 = date_format($date5, 'Y-m-d');
            break;
            case '7':
                $date1->sub(new DateInterval('P6D'));
                $dia1 = date_format($date1, 'Y-m-d');
                $date2->sub(new DateInterval('P5D'));
                $dia2 = date_format($date2, 'Y-m-d');
                $date3->sub(new DateInterval('P4D'));
                $dia3 = date_format($date3, 'Y-m-d');
                $date4->sub(new DateInterval('P3D'));
                $dia4 = date_format($date4, 'Y-m-d');
                $date5->sub(new DateInterval('P2D'));
                $dia5 = date_format($date5, 'Y-m-d');
            break;
            
            default:
                # code...
                break;
        }

        $data->dia1 = $dia1;
        $data->dia2 = $dia2;
        $data->dia3 = $dia3;
        $data->dia4 = $dia4;
        $data->dia5 = $dia5;     
        
        $horarios = Horario::where('borrado','0')
                        ->where('activo','1')
                        ->where('ciclo_seccion_id', $ciclo_seccion->id)
                        ->where('ciclo_escolar_id', $ciclo_id)
                        ->orderBy('dia_semana')
                        ->orderBy('hora_ini')
                        ->get();

        foreach ($horarios as $keyH => $valueH) {
            $curso = CicloCurso::find($valueH->ciclo_curso_id);

            if(isset($curso)){
                $asignacion = AsignacionCurso::where('borrado','0')
                    ->where('activo','1')
                    ->where('ciclo_seccion_id', $ciclo_seccion->id)
                    ->where('ciclo_cursos_id', $curso->id)
                    ->first();

                if($asignacion){
                    $docente = Docente::find($asignacion->docente_id);
                    $asignacion->docente = $docente;
                }
                $curso->asignacion = $asignacion;
            }

            $valueH->curso = $curso;

            $fechaBuscar = $fecha;
            switch ($valueH->dia_semana) {
                case '1':
                    $fechaBuscar = $dia1;
                break;
                case '2':
                    $fechaBuscar = $dia2;
                break;
                case '3':
                    $fechaBuscar = $dia3;
                break;
                case '4':
                    $fechaBuscar = $dia4;
                break;
                case '5':
                    $fechaBuscar = $dia5;
                break;
            
            }

            $asistencia = Asistencia::where('horario_id', $valueH->id)
                                    ->where('fecha', $fechaBuscar)
                                    ->first();
            
            if($asistencia){
                $asistenciaAlumno = AsistenciaAlumno::where('asistencia_id', $asistencia->id)->where('activo','1')->where('borrado','0')->where('alumno_id', $alumno_id)->first();
                $asistencia->asistenciaAlumno = $asistenciaAlumno;
            }

            $valueH->asistencia = $asistencia;
        }
        
        $data->horarios = $horarios;

        return $data;
    }

    public static function GetLastConstanciaById($alumno_id){
        $data = Alumno::findOrFail($alumno_id);
                    

        if($data){
            $tipoDocumento = TipoDocumento::find($data->tipo_documento_id);
            $data->tipoDocumento = $tipoDocumento;

            $apoderados = Apoderado::where('alumno_id', $data->id)
                                ->where('activo', 1)
                                ->where('borrado', 0)
                                ->get();

                                foreach ($apoderados as $key => $apoderado) {
                                    $tipoApoderado = Tipoapoderado::find($apoderado->tipo_apoderado_id);
                                    $apoderado->tipoApoderado = $tipoApoderado;
                                }
            $data->apoderados = $apoderados;

            $cicloActivo = CicloEscolar::GetCicloActivo();

            $matricula = Matricula::where('alumno_id', $data->id)
                                ->where('ciclo_escolar_id', $cicloActivo->id)
                                ->where('activo', 1)
                                ->where('borrado', 0)
                                ->first();


            $ciclo = CicloEscolar::find($matricula->ciclo_escolar_id);
            $matricula->ciclo = $ciclo;

            $cicloSeccion = CicloSeccion::find($matricula->ciclo_seccion_id);
            $matricula->cicloSeccion = $cicloSeccion;

            $turno = Turno::find($cicloSeccion->turno_id);
            $matricula->turno = $turno;

            $cicloGrado = CicloGrado::find($cicloSeccion->ciclo_grados_id);
            $matricula->cicloGrado = $cicloGrado;

            $cicloNivel = CicloNivel::find($cicloGrado->ciclo_niveles_id);
            $matricula->cicloNivel = $cicloNivel;

            $apoderadoMatricula = ApoderadoMatricula::where('alumno_id', $data->id)
                                                    ->where('matricula_id', $matricula->id)
                                                    ->where('activo', 1)
                                                    ->where('borrado', 0)
                                                    ->first();
            $matricula->apoderadoMatricula = $apoderadoMatricula;


            $data->matricula = $matricula;

            $data->fullNombre = $data->apellido_paterno . ' ' . $data->apellido_materno . ' ' . $data->nombres;
        }
        

        return $data;
    }


}
