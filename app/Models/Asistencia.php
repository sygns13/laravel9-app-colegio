<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\InstitucionEducativa;
use App\Models\CicloEscolar;
use App\Models\CicloNivel;
use App\Models\CicloGrado;
use App\Models\CicloSeccion;
use App\Models\CicloCurso;
use App\Models\Niveles;
use App\Models\AsistenciaAlumno;
use App\Models\Horario;

use DateTime;
use DateInterval;

class Asistencia extends Model
{
    use HasFactory;

    protected $table = 'asistencias';
    protected $fillable = ['fecha',
                            'ciclo_seccion_id',
                            'ciclo_escolar_id',
                            'ciclo_curso_id',
                            'activo',
                            'borrado',
                            'horario_id',
                            'tema',
                        ];
	protected $guarded = ['id'];

    public static function GetDataAsistenciaByCicloAndFecha($ciclo_seccion_id, $fecha){

        $cicloActivo = CicloEscolar::find($ciclo_seccion_id);

        $data = InstitucionEducativa::where('borrado','0')
                                    ->where('activo','1')
                                    ->first();

        //$date = DateTimeImmutable::createFromFormat('Y-m-d', $fecha);
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

        if($cicloActivo){
            $niveles = CicloNivel::where('borrado','0')
            ->where('activo','1')
            ->where('institucion_educativa_id', $data->id)
            ->where('ciclo_escolar_id', $cicloActivo->id)
            ->orderBy('nivel_id')
            ->get();

            foreach ($niveles as $key => $value) {
            $grados = CicloGrado::where('borrado','0')
                            ->where('activo','1')
                            ->where('ciclo_niveles_id', $value->id)
                            ->where('ciclo_escolar_id', $cicloActivo->id)
                            ->orderBy('orden')
                            ->get();

            $nivel = Niveles::find($value->nivel_id);

            $value->siglas = $nivel->siglas;

            foreach ($grados as $keyG => $valueG) {
                $seccions = CicloSeccion::where('borrado','0')
                                    ->where('activo','1')
                                    ->where('ciclo_grados_id', $valueG->id)
                                    ->where('ciclo_escolar_id', $cicloActivo->id)
                                    ->orderBy('sigla')
                                    ->orderBy('nombre')
                                    ->get();
                
                foreach ($seccions as $keyS => $valueS) {
                    $horarios = Horario::where('borrado','0')
                                    ->where('activo','1')
                                    ->where('ciclo_seccion_id', $valueS->id)
                                    ->where('ciclo_escolar_id', $cicloActivo->id)
                                    ->orderBy('dia_semana')
                                    ->orderBy('hora_ini')
                                    ->get();

                    foreach ($horarios as $key => $valueH) {
                        $curso = CicloCurso::find($valueH->ciclo_curso_id);

                        if(isset($curso)){
                            $asignacion = AsignacionCurso::where('borrado','0')
                                ->where('activo','1')
                                ->where('ciclo_seccion_id', $valueS->id)
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
                            $cantAsistencia = AsistenciaAlumno::where('asistencia_id', $asistencia->id)->where('activo','1')->where('borrado','0')->where('estado', '!=','0')->count();
                            $asistencia->cantAsistencia = $cantAsistencia;
                        }

                        $valueH->asistencia = $asistencia;
                    }
                    
                    $valueS->horarios = $horarios;
                }

                $valueG->seccions = $seccions;
            }

            $value->grados = $grados;
            }

            $data->niveles = $niveles;
        }
        

        return $data;
    }

    public static function GetAsistenciaSesionBySeccionAndFecha($ciclo_seccion_id, $fecha){

        $ciclo_seccion = CicloSeccion::findOrFail($ciclo_seccion_id);

        $ciclo = CicloEscolar::find($ciclo_seccion->ciclo_escolar_id);
        $ciclo_grado = CicloGrado::find($ciclo_seccion->ciclo_grados_id);
        $ciclo_nivel = CicloNivel::find($ciclo_grado->ciclo_niveles_id);

        $ciclo_seccion->ciclo = $ciclo;
        $ciclo_seccion->ciclo_grado = $ciclo_grado;
        $ciclo_seccion->ciclo_nivel = $ciclo_nivel;

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

        $ciclo_seccion->dia1 = $dia1;
        $ciclo_seccion->dia2 = $dia2;
        $ciclo_seccion->dia3 = $dia3;
        $ciclo_seccion->dia4 = $dia4;
        $ciclo_seccion->dia5 = $dia5;



        $horarios = Horario::where('borrado','0')
                                    ->where('activo','1')
                                    ->where('ciclo_seccion_id', $ciclo_seccion_id)
                                    ->where('ciclo_escolar_id', $ciclo->id)
                                    ->orderBy('dia_semana')
                                    ->orderBy('hora_ini')
                                    ->get();

        foreach ($horarios as $key => $horario) {
            $curso = CicloCurso::find($horario->ciclo_curso_id);

            if(isset($curso)){
                $asignacion = AsignacionCurso::where('borrado','0')
                    ->where('activo','1')
                    ->where('ciclo_seccion_id', $ciclo_seccion_id)
                    ->where('ciclo_cursos_id', $curso->id)
                    ->first();

            if($asignacion){
                $docente = Docente::find($asignacion->docente_id);
                $asignacion->docente = $docente;
            }
                $curso->asignacion = $asignacion;
            }

            $horario->curso = $curso;

            $fechaBuscar = $fecha;
            switch ($horario->dia_semana) {
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
            

            $asistencia = Asistencia::where('horario_id', $horario->id)
                                                ->where('fecha', $fechaBuscar)
                                                ->first();
                        
            if($asistencia){
                $cantAsistencia = AsistenciaAlumno::where('asistencia_id', $asistencia->id)->where('activo','1')->where('borrado','0')->where('estado', '!=','0')->count();
                $asistencia->cantAsistencia = $cantAsistencia;
            }

            $horario->asistencia = $asistencia;
        }

        $ciclo_seccion->horarios = $horarios;

        return $ciclo_seccion;
    }
}
