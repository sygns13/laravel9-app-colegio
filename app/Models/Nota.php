<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use DB;

class Nota extends Model
{
    use HasFactory;

    protected $table = 'notas';
    protected $fillable = ['matricula_id',
                            'tipo',
                            'ciclo_indicador_id',
                            'ciclo_competencia_id',
                            'ciclo_curso_id',
                            'alumno_id',
                            'nota_num',
                            'nota_letra',
                            'periodo',
                            'activo',
                            'borrado',
                            'fecha_programada',
                            'hora_programada',
                        ];
	protected $guarded = ['id'];

    public static function CalculoNotasIndicadores($notaIndicadorBD){

        $curso = CicloCurso::find($notaIndicadorBD->ciclo_curso_id);
        $ciclo = CicloEscolar::find($curso->ciclo_escolar_id);


        //Calculo Indicadores Para Obtener Nota de Competencia    
        $indicadores = CicloIndicador::where('ciclo_competencia_id', $notaIndicadorBD->ciclo_competencia_id)
                                        ->where('borrado','0')
                                        ->where('activo','1')
                                        ->orderBy('orden')
                                        ->orderBy('nombre')
                                        ->get();
                         
        $hayCalcIndicadores = true;

        $cont = 0;
        $notaFinal = 0;
        foreach ($indicadores as $key => $indicador) {
            $cont++;
            $notaIndicador = Nota::where('matricula_id', $notaIndicadorBD->matricula_id)
                        ->where('tipo', 1)
                        ->where('ciclo_curso_id', $notaIndicadorBD->ciclo_curso_id)
                        ->where('ciclo_competencia_id', $notaIndicadorBD->ciclo_competencia_id)
                        ->where('ciclo_indicador_id', $indicador->id)
                        ->where('alumno_id', $notaIndicadorBD->alumno_id)
                        ->where('periodo', $notaIndicadorBD->periodo)
                        ->where('activo', 1)
                        ->where('borrado', 0)
                        ->first();

            if($notaIndicador){
                $notaFinal = $notaFinal + floatval($notaIndicador->nota_num);
            }
            else{
                $hayCalcIndicadores = false;
                break;
            }
        }
        
        if($hayCalcIndicadores){
            $notaFinal = $notaFinal / $cont;
            $notaReg = round(floatval($notaFinal), 2);

            $notaCompetencia = Nota::where('matricula_id', $notaIndicadorBD->matricula_id)
                                            ->where('tipo', 2)
                                            ->where('ciclo_curso_id', $notaIndicadorBD->ciclo_curso_id)
                                            ->where('ciclo_competencia_id', $notaIndicadorBD->ciclo_competencia_id)
                                            ->where('alumno_id', $notaIndicadorBD->alumno_id)
                                            ->where('periodo', $notaIndicadorBD->periodo)
                                            ->where('activo', 1)
                                            ->where('borrado', 0)
                                            ->first();

            if($notaCompetencia){
                $notaCompetencia->nota_num = $notaReg;
                $notaCompetencia->save();

                Nota::CalculoNotasCompetencias($notaCompetencia);
            }
            else{
                $registro = new Nota;

                $registro->matricula_id=$notaIndicadorBD->matricula_id;
                $registro->tipo=2;
                $registro->ciclo_competencia_id= $notaIndicadorBD->ciclo_competencia_id;
                $registro->ciclo_curso_id= $notaIndicadorBD->ciclo_curso_id;
                $registro->alumno_id= $notaIndicadorBD->alumno_id;
                $registro->nota_num = $notaReg;
                $registro->nota_letra='';
                $registro->periodo=$notaIndicadorBD->periodo;
                $registro->activo='1';
                $registro->borrado='0';

                $registro->save();

                Nota::CalculoNotasCompetencias($registro);
            }
        }

        //Calculo Indicadores Para Obtener Nota Final de Indicador 

        $hayCalcIndicadores = true;
        $notaFinal = 0;
        $cont = 0;

        //Primer Bimestre/Trimestre
        $notaPrimerPeriodo = Nota::where('matricula_id', $notaIndicadorBD->matricula_id)
        ->where('tipo', 1)
        ->where('ciclo_curso_id', $notaIndicadorBD->ciclo_curso_id)
        ->where('ciclo_competencia_id', $notaIndicadorBD->ciclo_competencia_id)
        ->where('ciclo_indicador_id', $notaIndicadorBD->ciclo_indicador_id)
        ->where('alumno_id', $notaIndicadorBD->alumno_id)
        ->where('periodo', 1)
        ->where('activo', 1)
        ->where('borrado', 0)
        ->first();

        if($notaPrimerPeriodo){
            $cont++;
            $notaFinal = $notaFinal + $notaPrimerPeriodo->nota_num;
        }else{
            $hayCalcIndicadores = false;
        }

        //Segundo Bimestre/Trimestre
        $notaSegundoPeriodo = Nota::where('matricula_id', $notaIndicadorBD->matricula_id)
                                ->where('tipo', 1)
                                ->where('ciclo_curso_id', $notaIndicadorBD->ciclo_curso_id)
                                ->where('ciclo_competencia_id', $notaIndicadorBD->ciclo_competencia_id)
                                ->where('ciclo_indicador_id', $notaIndicadorBD->ciclo_indicador_id)
                                ->where('alumno_id', $notaIndicadorBD->alumno_id)
                                ->where('periodo', 2)
                                ->where('activo', 1)
                                ->where('borrado', 0)
                                ->first();

        if($notaSegundoPeriodo){
            $cont++;
            $notaFinal = $notaFinal + $notaSegundoPeriodo->nota_num;
        }else{
            $hayCalcIndicadores = false;
        }

        //Tercer Bimestre/Trimestre
        $notaTercerPeriodo = Nota::where('matricula_id', $notaIndicadorBD->matricula_id)
                                ->where('tipo', 1)
                                ->where('ciclo_curso_id', $notaIndicadorBD->ciclo_curso_id)
                                ->where('ciclo_competencia_id', $notaIndicadorBD->ciclo_competencia_id)
                                ->where('ciclo_indicador_id', $notaIndicadorBD->ciclo_indicador_id)
                                ->where('alumno_id', $notaIndicadorBD->alumno_id)
                                ->where('periodo', 3)
                                ->where('activo', 1)
                                ->where('borrado', 0)
                                ->first();

        if($notaTercerPeriodo){
            $cont++;
            $notaFinal = $notaFinal + $notaTercerPeriodo->nota_num;
        }else{
            $hayCalcIndicadores = false;
        }

        if($ciclo->opcion == 2){
            //Cuarto Bimestre solo si aplica
            $notaCuartoPeriodo = Nota::where('matricula_id', $notaIndicadorBD->matricula_id)
                                ->where('tipo', 1)
                                ->where('ciclo_curso_id', $notaIndicadorBD->ciclo_curso_id)
                                ->where('ciclo_competencia_id', $notaIndicadorBD->ciclo_competencia_id)
                                ->where('ciclo_indicador_id', $notaIndicadorBD->ciclo_indicador_id)
                                ->where('alumno_id', $notaIndicadorBD->alumno_id)
                                ->where('periodo', 4)
                                ->where('activo', 1)
                                ->where('borrado', 0)
                                ->first();

            if($notaCuartoPeriodo){
                $cont++;
                $notaFinal = $notaFinal + $notaCuartoPeriodo->nota_num;
            }else{
                $hayCalcIndicadores = false;
            }
        }  

        if($hayCalcIndicadores){
            $notaFinal = $notaFinal / $cont;
            $notaReg = round(floatval($notaFinal), 2);

            $notaFinalIndicador = Nota::where('matricula_id', $notaIndicadorBD->matricula_id)
                        ->where('tipo', 1)
                        ->where('ciclo_curso_id', $notaIndicadorBD->ciclo_curso_id)
                        ->where('ciclo_competencia_id', $notaIndicadorBD->ciclo_competencia_id)
                        ->where('ciclo_indicador_id', $notaIndicadorBD->ciclo_indicador_id)
                        ->where('alumno_id', $notaIndicadorBD->alumno_id)
                        ->where('periodo', 0)
                        ->where('activo', 1)
                        ->where('borrado', 0)
                        ->first();

            if($notaFinalIndicador){
                $notaFinalIndicador->nota_num = $notaReg;
                $notaFinalIndicador->save();
            }
            else{
                $registro = new Nota;

                $registro->matricula_id=$notaIndicadorBD->matricula_id;
                $registro->tipo=1;
                $registro->ciclo_indicador_id= $notaIndicadorBD->ciclo_indicador_id;
                $registro->ciclo_competencia_id= $notaIndicadorBD->ciclo_competencia_id;
                $registro->ciclo_curso_id= $notaIndicadorBD->ciclo_curso_id;
                $registro->alumno_id= $notaIndicadorBD->alumno_id;
                $registro->nota_num = $notaReg;
                $registro->nota_letra='';
                $registro->periodo=0;
                $registro->activo='1';
                $registro->borrado='0';

                $registro->save();
            }

            /* $notaCompetencia = Nota::where('matricula_id', $notaIndicadorBD->matricula_id)
                                    ->where('tipo', 2)
                                    ->where('ciclo_curso_id', $notaIndicadorBD->ciclo_curso_id)
                                    ->where('ciclo_competencia_id', $notaIndicadorBD->ciclo_competencia_id)
                                    ->where('alumno_id', $notaIndicadorBD->alumno_id)
                                    ->where('periodo', $notaIndicadorBD->periodo)
                                    ->where('activo', 1)
                                    ->where('borrado', 0)
                                    ->first();

            if($notaCompetencia){
                Nota::CalculoNotasCompetencias($notaCompetencia);
            } */
        }
    }

    public static function CalculoNotasCompetencias($notaCompetenciaBD){

        $curso = CicloCurso::find($notaCompetenciaBD->ciclo_curso_id);
        $ciclo = CicloEscolar::find($curso->ciclo_escolar_id);


        //Calculo Competencias Para Obtener Nota de Curso    
        $competencias = CicloCompetencia::where('ciclo_cursos_id', $notaCompetenciaBD->ciclo_curso_id)
                                    ->where('ciclo_escolar_id', $ciclo->id)
                                    ->where('borrado','0')
                                    ->where('activo','1')
                                    ->orderBy('orden')
                                    ->orderBy('nombre')
                                    ->get();

        $hayCalcCompetencias = true;

        $cont = 0;
        $notaFinal = 0;
        foreach ($competencias as $key => $competencia) {
            $cont++;
            $notaCompetencia = Nota::where('matricula_id', $notaCompetenciaBD->matricula_id)
                        ->where('tipo', 2)
                        ->where('ciclo_curso_id', $notaCompetenciaBD->ciclo_curso_id)
                        ->where('ciclo_competencia_id', $competencia->id)
                        ->where('alumno_id', $notaCompetenciaBD->alumno_id)
                        ->where('periodo', $notaCompetenciaBD->periodo)
                        ->where('activo', 1)
                        ->where('borrado', 0)
                        ->first();

            if($notaCompetencia){
                $notaFinal = $notaFinal + floatval($notaCompetencia->nota_num);
            }
            else{
                $hayCalcCompetencias = false;
                break;
            }
        }
        
        if($hayCalcCompetencias){
            $notaFinal = $notaFinal / $cont;
            $notaReg = round(floatval($notaFinal), 2);

            $notaCurso = Nota::where('matricula_id', $notaCompetenciaBD->matricula_id)
                                            ->where('tipo', 3)
                                            ->where('ciclo_curso_id', $notaCompetenciaBD->ciclo_curso_id)
                                            ->where('alumno_id', $notaCompetenciaBD->alumno_id)
                                            ->where('periodo', $notaCompetenciaBD->periodo)
                                            ->where('activo', 1)
                                            ->where('borrado', 0)
                                            ->first();

            if($notaCurso){
                $notaCurso->nota_num = $notaReg;
                $notaCurso->save();

                Nota::CalculoNotasCurso($notaCurso);
            }
            else{
                $registro = new Nota;

                $registro->matricula_id=$notaCompetenciaBD->matricula_id;
                $registro->tipo=3;
                $registro->ciclo_curso_id= $notaCompetenciaBD->ciclo_curso_id;
                $registro->alumno_id= $notaCompetenciaBD->alumno_id;
                $registro->nota_num = $notaReg;
                $registro->nota_letra='';
                $registro->periodo=$notaCompetenciaBD->periodo;
                $registro->activo='1';
                $registro->borrado='0';

                $registro->save();

                Nota::CalculoNotasCurso($registro);
            }
        }

        //Calculo Competencias Para Obtener Nota Final de Competencia 

        $hayCalcCompetencias = true;
        $notaFinal = 0;
        $cont = 0;

        //Primer Bimestre/Trimestre
        $notaPrimerPeriodo = Nota::where('matricula_id', $notaCompetenciaBD->matricula_id)
        ->where('tipo', 2)
        ->where('ciclo_curso_id', $notaCompetenciaBD->ciclo_curso_id)
        ->where('ciclo_competencia_id', $notaCompetenciaBD->ciclo_competencia_id)
        ->where('alumno_id', $notaCompetenciaBD->alumno_id)
        ->where('periodo', 1)
        ->where('activo', 1)
        ->where('borrado', 0)
        ->first();

        if($notaPrimerPeriodo){
            $cont++;
            $notaFinal = $notaFinal + $notaPrimerPeriodo->nota_num;
        }else{
            $hayCalcCompetencias = false;
        }

        //Segundo Bimestre/Trimestre
        $notaSegundoPeriodo = Nota::where('matricula_id', $notaCompetenciaBD->matricula_id)
                                ->where('tipo', 2)
                                ->where('ciclo_curso_id', $notaCompetenciaBD->ciclo_curso_id)
                                ->where('ciclo_competencia_id', $notaCompetenciaBD->ciclo_competencia_id)
                                ->where('alumno_id', $notaCompetenciaBD->alumno_id)
                                ->where('periodo', 2)
                                ->where('activo', 1)
                                ->where('borrado', 0)
                                ->first();

        if($notaSegundoPeriodo){
            $cont++;
            $notaFinal = $notaFinal + $notaSegundoPeriodo->nota_num;
        }else{
            $hayCalcCompetencias = false;
        }

        //Tercer Bimestre/Trimestre
        $notaTercerPeriodo = Nota::where('matricula_id', $notaCompetenciaBD->matricula_id)
                                ->where('tipo', 2)
                                ->where('ciclo_curso_id', $notaCompetenciaBD->ciclo_curso_id)
                                ->where('ciclo_competencia_id', $notaCompetenciaBD->ciclo_competencia_id)
                                ->where('alumno_id', $notaCompetenciaBD->alumno_id)
                                ->where('periodo', 3)
                                ->where('activo', 1)
                                ->where('borrado', 0)
                                ->first();

        if($notaTercerPeriodo){
            $cont++;
            $notaFinal = $notaFinal + $notaTercerPeriodo->nota_num;
        }else{
            $hayCalcCompetencias = false;
        }

        if($ciclo->opcion == 2){
            //Cuarto Bimestre solo si aplica
            $notaCuartoPeriodo = Nota::where('matricula_id', $notaCompetenciaBD->matricula_id)
                                ->where('tipo', 2)
                                ->where('ciclo_curso_id', $notaCompetenciaBD->ciclo_curso_id)
                                ->where('ciclo_competencia_id', $notaCompetenciaBD->ciclo_competencia_id)
                                ->where('alumno_id', $notaCompetenciaBD->alumno_id)
                                ->where('periodo', 4)
                                ->where('activo', 1)
                                ->where('borrado', 0)
                                ->first();

            if($notaCuartoPeriodo){
                $cont++;
                $notaFinal = $notaFinal + $notaCuartoPeriodo->nota_num;
            }else{
                $hayCalcCompetencias = false;
            }
        }  

        if($hayCalcCompetencias){
            $notaFinal = $notaFinal / $cont;
            $notaReg = round(floatval($notaFinal), 2);

            $notaFinalCompetencia = Nota::where('matricula_id', $notaCompetenciaBD->matricula_id)
                        ->where('tipo', 2)
                        ->where('ciclo_curso_id', $notaCompetenciaBD->ciclo_curso_id)
                        ->where('ciclo_competencia_id', $notaCompetenciaBD->ciclo_competencia_id)
                        ->where('alumno_id', $notaCompetenciaBD->alumno_id)
                        ->where('periodo', 0)
                        ->where('activo', 1)
                        ->where('borrado', 0)
                        ->first();

            if($notaFinalCompetencia){
                $notaFinalCompetencia->nota_num = $notaReg;
                $notaFinalCompetencia->save();
            }
            else{
                $registro = new Nota;

                $registro->matricula_id=$notaCompetenciaBD->matricula_id;
                $registro->tipo=2;
                $registro->ciclo_competencia_id= $notaCompetenciaBD->ciclo_competencia_id;
                $registro->ciclo_curso_id= $notaCompetenciaBD->ciclo_curso_id;
                $registro->alumno_id= $notaCompetenciaBD->alumno_id;
                $registro->nota_num = $notaReg;
                $registro->nota_letra='';
                $registro->periodo=0;
                $registro->activo='1';
                $registro->borrado='0';

                $registro->save();
            }

            /* $notaCurso = Nota::where('matricula_id', $notaCompetenciaBD->matricula_id)
                                            ->where('tipo', 3)
                                            ->where('ciclo_curso_id', $notaCompetenciaBD->ciclo_curso_id)
                                            ->where('alumno_id', $notaCompetenciaBD->alumno_id)
                                            ->where('periodo', $notaCompetenciaBD->periodo)
                                            ->where('activo', 1)
                                            ->where('borrado', 0)
                                            ->first();

            if($notaCurso){
                Nota::CalculoNotasCurso($notaCurso);
            } */
        }
    }


    public static function CalculoNotasCurso($notaCursoBD){

        $curso = CicloCurso::find($notaCursoBD->ciclo_curso_id);
        $ciclo = CicloEscolar::find($curso->ciclo_escolar_id);

        //Calculo Cursos Para Obtener Nota Final de Curso 

        $hayCalcCursos = true;
        $notaFinal = 0;
        $cont = 0;

        //Primer Bimestre/Trimestre
        $notaPrimerPeriodo = Nota::where('matricula_id', $notaCursoBD->matricula_id)
        ->where('tipo', 3)
        ->where('ciclo_curso_id', $notaCursoBD->ciclo_curso_id)
        ->where('alumno_id', $notaCursoBD->alumno_id)
        ->where('periodo', 1)
        ->where('activo', 1)
        ->where('borrado', 0)
        ->first();

        if($notaPrimerPeriodo){
            $cont++;
            $notaFinal = $notaFinal + $notaPrimerPeriodo->nota_num;
        }else{
            $hayCalcCursos = false;
        }

        //Segundo Bimestre/Trimestre
        $notaSegundoPeriodo = Nota::where('matricula_id', $notaCursoBD->matricula_id)
                                ->where('tipo', 3)
                                ->where('ciclo_curso_id', $notaCursoBD->ciclo_curso_id)
                                ->where('alumno_id', $notaCursoBD->alumno_id)
                                ->where('periodo', 2)
                                ->where('activo', 1)
                                ->where('borrado', 0)
                                ->first();

        if($notaSegundoPeriodo){
            $cont++;
            $notaFinal = $notaFinal + $notaSegundoPeriodo->nota_num;
        }else{
            $hayCalcCursos = false;
        }

        //Tercer Bimestre/Trimestre
        $notaTercerPeriodo = Nota::where('matricula_id', $notaCursoBD->matricula_id)
                                ->where('tipo', 3)
                                ->where('ciclo_curso_id', $notaCursoBD->ciclo_curso_id)
                                ->where('alumno_id', $notaCursoBD->alumno_id)
                                ->where('periodo', 3)
                                ->where('activo', 1)
                                ->where('borrado', 0)
                                ->first();

        if($notaTercerPeriodo){
            $cont++;
            $notaFinal = $notaFinal + $notaTercerPeriodo->nota_num;
        }else{
            $hayCalcCursos = false;
        }

        if($ciclo->opcion == 2){
            //Cuarto Bimestre solo si aplica
            $notaCuartoPeriodo = Nota::where('matricula_id', $notaCursoBD->matricula_id)
                                ->where('tipo', 3)
                                ->where('ciclo_curso_id', $notaCursoBD->ciclo_curso_id)
                                ->where('alumno_id', $notaCursoBD->alumno_id)
                                ->where('periodo', 4)
                                ->where('activo', 1)
                                ->where('borrado', 0)
                                ->first();

            if($notaCuartoPeriodo){
                $cont++;
                $notaFinal = $notaFinal + $notaCuartoPeriodo->nota_num;
            }else{
                $hayCalcCursos = false;
            }
        }  

        if($hayCalcCursos){
            $notaFinal = $notaFinal / $cont;
            $notaReg = round(floatval($notaFinal), 2);

            $notaFinalCurso = Nota::where('matricula_id', $notaCursoBD->matricula_id)
                        ->where('tipo', 3)
                        ->where('ciclo_curso_id', $notaCursoBD->ciclo_curso_id)
                        ->where('alumno_id', $notaCursoBD->alumno_id)
                        ->where('periodo', 0)
                        ->where('activo', 1)
                        ->where('borrado', 0)
                        ->first();

            if($notaFinalCurso){
                $notaFinalCurso->nota_num = $notaReg;
                $notaFinalCurso->save();
            }
            else{
                $registro = new Nota;

                $registro->matricula_id=$notaCursoBD->matricula_id;
                $registro->tipo=3;
                $registro->ciclo_competencia_id= $notaCursoBD->ciclo_competencia_id;
                $registro->ciclo_curso_id= $notaCursoBD->ciclo_curso_id;
                $registro->alumno_id= $notaCursoBD->alumno_id;
                $registro->nota_num = $notaReg;
                $registro->nota_letra='';
                $registro->periodo=0;
                $registro->activo='1';
                $registro->borrado='0';

                $registro->save();
            }
        }
    }



    public static function GetItemsNotasAlumnos($ciclo_id){

        $ciclo = CicloEscolar::find($ciclo_id);

        $data = InstitucionEducativa::where('borrado','0')
                                    ->where('activo','1')
                                    ->first();

        $data->error = false;
        $data->ciclo = $ciclo;

        if($ciclo){
            $niveles = CicloNivel::where('borrado','0')
            ->where('activo','1')
            ->where('institucion_educativa_id', $data->id)
            ->where('ciclo_escolar_id', $ciclo_id)
            ->orderBy('nivel_id')
            ->get();

            foreach ($niveles as $key => $nivel) {

                $nivelMaster = Niveles::find($nivel->nivel_id);
                $nivel->siglas = $nivelMaster->siglas;

                $grados = CicloGrado::where('borrado','0')
                            ->where('activo','1')
                            ->where('ciclo_niveles_id', $nivel->id)
                            ->where('ciclo_escolar_id', $ciclo->id)
                            ->orderBy('orden')
                            ->get();

                $cantCursos = 0;
                foreach ($grados as $keyG => $valueG) {
                    $seccions = CicloSeccion::where('borrado','0')
                                    ->where('activo','1')
                                    ->where('ciclo_grados_id', $valueG->id)
                                    ->where('ciclo_escolar_id', $ciclo->id)
                                    ->orderBy('sigla')
                                    ->orderBy('nombre')
                                    ->get();

                    $cantCursos = CicloCurso::where('borrado','0')
                                ->where('activo','1')
                                ->where('ciclo_grado_id', $valueG->id)
                                ->where('ciclo_escolar_id', $ciclo->id)
                                ->count();

                    foreach ($seccions as $keyS => $valueS) {

                        $matriculas =DB::table('matriculas')
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
                                    DB::Raw("IFNULL( `traslado`.`res_traslado` , '' ) as res_traslado_traslado"),
            
                                    );

                            $matriculas = $matriculas->get();
                            $cantAlumnos = $matriculas->count();

                            foreach ($matriculas as $keyMat => $matricula) {

                                $cursos = DB::select("select cur.id as idcurso, cur.nombre as curso, sec.id as ciclo_seccion_id, sec.nombre as seccion, sec.sigla, sec.ciclo_grados_id, 
                                            t.nombre as turno , asig.id as idasignacion, doc.apellidos as apeDocente, doc.nombre as nomDocente, asig.docente_id,
                                            gra.nombre as grado
                                            from ciclo_cursos cur 
                                            inner join asignacion_cursos asig on cur.id = asig.ciclo_cursos_id and asig.activo='1' and asig.borrado='0' 
                                            inner join ciclo_seccion sec on sec.id = asig.ciclo_seccion_id and sec.activo='1' and sec.borrado='0' 
                                            inner join ciclo_grados gra on gra.id = sec.ciclo_grados_id and gra.activo='1' and gra.borrado='0' 
                                            inner join turnos t on t.id = sec.turno_id 
                                            inner join docentes doc on doc.id = asig.docente_id
                                            where 
                                            cur.activo='1' and cur.borrado='0' 
                                and 
                                sec.ciclo_escolar_id = ?
                                and 
                                sec.ciclo_grados_id = ?
                                and 
                                sec.id = ?
                                order by sec.id, cur.orden;", [$ciclo_id, $valueG->id, $valueS->id]);

                                foreach ($cursos as $keyC => $curso) {
                                    //Nota Final
                                    $notaFinal = Nota::where('matricula_id', $matricula->id)
                                    ->where('tipo', 3)
                                    ->where('ciclo_curso_id', $curso->idcurso)
                                    ->where('alumno_id', $matricula->id_alu)
                                    ->where('periodo', 0)
                                    ->where('activo', 1)
                                    ->where('borrado', 0)
                                    ->first();
                                    

                                     $curso->notaFinal = $notaFinal;

                                    //Primer Bimestre/Trimestre
                                    $notaPrimerPeriodo = Nota::where('matricula_id', $matricula->id)
                                                            ->where('tipo', 3)
                                                            ->where('ciclo_curso_id', $curso->idcurso)
                                                            ->where('alumno_id', $matricula->id_alu)
                                                            ->where('periodo', 1)
                                                            ->where('activo', 1)
                                                            ->where('borrado', 0)
                                                            ->first();

                                    $curso->notaPrimerPeriodo = $notaPrimerPeriodo;

                                    //Segundo Bimestre/Trimestre
                                    $notaSegundoPeriodo = Nota::where('matricula_id', $matricula->id)
                                                            ->where('tipo', 3)
                                                            ->where('ciclo_curso_id', $curso->idcurso)
                                                            ->where('alumno_id', $matricula->id_alu)
                                                            ->where('periodo', 2)
                                                            ->where('activo', 1)
                                                            ->where('borrado', 0)
                                                            ->first();

                                    $curso->notaSegundoPeriodo = $notaSegundoPeriodo;

                                    //Tercer Bimestre/Trimestre
                                    $notaTercerPeriodo = Nota::where('matricula_id', $matricula->id)
                                                            ->where('tipo', 3)
                                                            ->where('ciclo_curso_id', $curso->idcurso)
                                                            ->where('alumno_id', $matricula->id_alu)
                                                            ->where('periodo', 3)
                                                            ->where('activo', 1)
                                                            ->where('borrado', 0)
                                                            ->first();

                                    $curso->notaTercerPeriodo = $notaTercerPeriodo;


                        

                                    if($ciclo->opcion == 2){
                                        //Cuarto Bimestre solo si aplica
                                        $notaCuartoPeriodo = Nota::where('matricula_id', $matricula->id)
                                                            ->where('tipo', 3)
                                                            ->where('ciclo_curso_id', $curso->idcurso)
                                                            ->where('alumno_id', $matricula->id_alu)
                                                            ->where('periodo', 4)
                                                            ->where('activo', 1)
                                                            ->where('borrado', 0)
                                                            ->first();

                                        $curso->notaCuartoPeriodo = $notaCuartoPeriodo;
                                    }

                                    $competencias = CicloCompetencia::where('ciclo_cursos_id', $curso->idcurso)
                                                                ->where('ciclo_escolar_id', $ciclo->id)
                                                                ->orderBy('orden')
                                                                ->orderBy('nombre')
                                                                ->get();

                                    foreach ($competencias as $keyCom => $competencia) {
                                        $indicadores = CicloIndicador::where('ciclo_competencia_id', $competencia->id)
                                                                ->where('ciclo_escolar_id', $ciclo->id)
                                                                ->orderBy('orden')
                                                                ->orderBy('nombre')
                                                                ->get();

                                        $competencia->indicadores = $indicadores;
                                    }

                                    //Notas Competencias
                                    foreach ($competencias as $keyCom => $competencia) {

                                        //Nota Final
                                        $notaFinal = Nota::where('matricula_id', $matricula->id)
                                            ->where('tipo', 2)
                                            ->where('ciclo_curso_id', $curso->idcurso)
                                            ->where('ciclo_competencia_id', $competencia->id)
                                            ->where('alumno_id', $matricula->id_alu)
                                            ->where('periodo', 0)
                                            ->where('activo', 1)
                                            ->where('borrado', 0)
                                            ->first();

                                        $competencia->notaFinal = $notaFinal;

                                        //Primer Bimestre/Trimestre
                                        $notaPrimerPeriodo = Nota::where('matricula_id', $matricula->id)
                                        ->where('tipo', 2)
                                        ->where('ciclo_curso_id', $curso->idcurso)
                                        ->where('ciclo_competencia_id', $competencia->id)
                                        ->where('alumno_id', $matricula->id_alu)
                                        ->where('periodo', 1)
                                        ->where('activo', 1)
                                        ->where('borrado', 0)
                                        ->first();

                                        $competencia->notaPrimerPeriodo = $notaPrimerPeriodo;

                                        //Segundo Bimestre/Trimestre
                                        $notaSegundoPeriodo = Nota::where('matricula_id', $matricula->id)
                                                                ->where('tipo', 2)
                                                                ->where('ciclo_curso_id', $curso->idcurso)
                                                                ->where('ciclo_competencia_id', $competencia->id)
                                                                ->where('alumno_id', $matricula->id_alu)
                                                                ->where('periodo', 2)
                                                                ->where('activo', 1)
                                                                ->where('borrado', 0)
                                                                ->first();

                                        $competencia->notaSegundoPeriodo = $notaSegundoPeriodo;

                                        //Tercer Bimestre/Trimestre
                                        $notaTercerPeriodo = Nota::where('matricula_id', $matricula->id)
                                                                ->where('tipo', 2)
                                                                ->where('ciclo_curso_id', $curso->idcurso)
                                                                ->where('ciclo_competencia_id', $competencia->id)
                                                                ->where('alumno_id', $matricula->id_alu)
                                                                ->where('periodo', 3)
                                                                ->where('activo', 1)
                                                                ->where('borrado', 0)
                                                                ->first();

                                        $competencia->notaTercerPeriodo = $notaTercerPeriodo;

                                        if($ciclo->opcion == 2){
                                            //Cuarto Bimestre solo si aplica
                                            $notaCuartoPeriodo = Nota::where('matricula_id', $matricula->id)
                                                                ->where('tipo', 2)
                                                                ->where('ciclo_curso_id', $curso->idcurso)
                                                                ->where('ciclo_competencia_id', $competencia->id)
                                                                ->where('alumno_id', $matricula->id_alu)
                                                                ->where('periodo', 4)
                                                                ->where('activo', 1)
                                                                ->where('borrado', 0)
                                                                ->first();

                                            $competencia->notaCuartoPeriodo = $notaCuartoPeriodo;
                                        }  

                                        //Notas Indicadores
                                        foreach ($competencia->indicadores as $keyInd => $indicador) {

                                            //Nota Final
                                            $notaFinal = Nota::where('matricula_id', $matricula->id)
                                                ->where('tipo', 1)
                                                ->where('ciclo_curso_id', $curso->idcurso)
                                                ->where('ciclo_competencia_id', $competencia->id)
                                                ->where('ciclo_indicador_id', $indicador->id)
                                                ->where('alumno_id', $matricula->id_alu)
                                                ->where('periodo', 0)
                                                ->where('activo', 1)
                                                ->where('borrado', 0)
                                                ->first();

                                            $indicador->notaFinal = $notaFinal;


                                            //Primer Bimestre/Trimestre
                                            $notaPrimerPeriodo = Nota::where('matricula_id', $matricula->id)
                                            ->where('tipo', 1)
                                            ->where('ciclo_curso_id', $curso->idcurso)
                                            ->where('ciclo_competencia_id', $competencia->id)
                                            ->where('ciclo_indicador_id', $indicador->id)
                                            ->where('alumno_id', $matricula->id_alu)
                                            ->where('periodo', 1)
                                            ->where('activo', 1)
                                            ->where('borrado', 0)
                                            ->first();

                                            $indicador->notaPrimerPeriodo = $notaPrimerPeriodo;

                                            //Segundo Bimestre/Trimestre
                                            $notaSegundoPeriodo = Nota::where('matricula_id', $matricula->id)
                                                                    ->where('tipo', 1)
                                                                    ->where('ciclo_curso_id', $curso->idcurso)
                                                                    ->where('ciclo_competencia_id', $competencia->id)
                                                                    ->where('ciclo_indicador_id', $indicador->id)
                                                                    ->where('alumno_id', $matricula->id_alu)
                                                                    ->where('periodo', 2)
                                                                    ->where('activo', 1)
                                                                    ->where('borrado', 0)
                                                                    ->first();

                                            $indicador->notaSegundoPeriodo = $notaSegundoPeriodo;

                                            //Tercer Bimestre/Trimestre
                                            $notaTercerPeriodo = Nota::where('matricula_id', $matricula->id)
                                                                    ->where('tipo', 1)
                                                                    ->where('ciclo_curso_id', $curso->idcurso)
                                                                    ->where('ciclo_competencia_id', $competencia->id)
                                                                    ->where('ciclo_indicador_id', $indicador->id)
                                                                    ->where('alumno_id', $matricula->id_alu)
                                                                    ->where('periodo', 3)
                                                                    ->where('activo', 1)
                                                                    ->where('borrado', 0)
                                                                    ->first();

                                            $indicador->notaTercerPeriodo = $notaTercerPeriodo;

                                            if($ciclo->opcion == 2){
                                                //Cuarto Bimestre solo si aplica
                                                $notaCuartoPeriodo = Nota::where('matricula_id', $matricula->id)
                                                                    ->where('tipo', 1)
                                                                    ->where('ciclo_curso_id', $curso->idcurso)
                                                                    ->where('ciclo_competencia_id', $competencia->id)
                                                                    ->where('ciclo_indicador_id', $indicador->id)
                                                                    ->where('alumno_id', $matricula->id_alu)
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

                                $matricula->cursos = $cursos;

                            }

                    $valueS->cantCursos = $cantCursos;
                    $valueS->cantAlumnos = $cantAlumnos;
                    $valueS->alumnos = $matriculas;
                    }
                    $valueG->seccions = $seccions;
                }
                $nivel->cantCursos = $cantCursos;
                $nivel->grados = $grados;
            }

            $data->niveles = $niveles;
        }
        else{
            $data->niveles = [];
        }
        return $data;
    }



    public static function GetCalificacionesSeccion($ciclo_seccion_id){

        $seccion = CicloSeccion::find($ciclo_seccion_id);

        $ciclo = CicloEscolar::find($seccion->ciclo_escolar_id);

        $data = InstitucionEducativa::where('borrado','0')
                                    ->where('activo','1')
                                    ->first();

        $data->error = false;
        $data->ciclo = $ciclo;

        if($ciclo){

            
            $grado = CicloGrado::find($seccion->ciclo_grados_id);
            $nivel = CicloNivel::find($grado->ciclo_niveles_id);

            $data->seccion = $seccion;
            $data->grado = $grado;
            $data->nivel = $nivel;

            $cantCursos = CicloCurso::where('borrado','0')
                                ->where('activo','1')
                                ->where('ciclo_grado_id', $grado->id)
                                ->where('ciclo_escolar_id', $ciclo->id)
                                ->count();
            $data->cantCursos = $cantCursos;


            $matriculas =DB::table('matriculas')
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

                                ->where('matriculas.ciclo_seccion_id', $ciclo_seccion_id)
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
            
                                );

                                $matriculas = $matriculas->get();
                                $cantAlumnos = $matriculas->count();

            foreach ($matriculas as $keyMat => $matricula) {

            $cursos = DB::select("select cur.id as idcurso, cur.nombre as curso, sec.id as ciclo_seccion_id, sec.nombre as seccion, sec.sigla, sec.ciclo_grados_id, 
            t.nombre as turno , asig.id as idasignacion, doc.apellidos as apeDocente, doc.nombre as nomDocente, asig.docente_id,
            gra.nombre as grado
            from ciclo_cursos cur 
            inner join asignacion_cursos asig on cur.id = asig.ciclo_cursos_id and asig.activo='1' and asig.borrado='0' 
            inner join ciclo_seccion sec on sec.id = asig.ciclo_seccion_id and sec.activo='1' and sec.borrado='0' 
            inner join ciclo_grados gra on gra.id = sec.ciclo_grados_id and gra.activo='1' and gra.borrado='0' 
            inner join turnos t on t.id = sec.turno_id 
            inner join docentes doc on doc.id = asig.docente_id
            where 
            cur.activo='1' and cur.borrado='0' 
            and 
            sec.ciclo_escolar_id = ?
            and 
            sec.ciclo_grados_id = ?
            and 
            sec.id = ?
            order by sec.id, cur.orden;", [$ciclo->id, $grado->id, $seccion->id]);

            foreach ($cursos as $keyC => $curso) {
                //Nota Final
                $notaFinal = Nota::where('matricula_id', $matricula->id)
                ->where('tipo', 3)
                ->where('ciclo_curso_id', $curso->idcurso)
                ->where('alumno_id', $matricula->id_alu)
                ->where('periodo', 0)
                ->where('activo', 1)
                ->where('borrado', 0)
                ->first();
                

                 $curso->notaFinal = $notaFinal;

                //Primer Bimestre/Trimestre
                $notaPrimerPeriodo = Nota::where('matricula_id', $matricula->id)
                                        ->where('tipo', 3)
                                        ->where('ciclo_curso_id', $curso->idcurso)
                                        ->where('alumno_id', $matricula->id_alu)
                                        ->where('periodo', 1)
                                        ->where('activo', 1)
                                        ->where('borrado', 0)
                                        ->first();

                $curso->notaPrimerPeriodo = $notaPrimerPeriodo;

                //Segundo Bimestre/Trimestre
                $notaSegundoPeriodo = Nota::where('matricula_id', $matricula->id)
                                        ->where('tipo', 3)
                                        ->where('ciclo_curso_id', $curso->idcurso)
                                        ->where('alumno_id', $matricula->id_alu)
                                        ->where('periodo', 2)
                                        ->where('activo', 1)
                                        ->where('borrado', 0)
                                        ->first();

                $curso->notaSegundoPeriodo = $notaSegundoPeriodo;

                //Tercer Bimestre/Trimestre
                $notaTercerPeriodo = Nota::where('matricula_id', $matricula->id)
                                        ->where('tipo', 3)
                                        ->where('ciclo_curso_id', $curso->idcurso)
                                        ->where('alumno_id', $matricula->id_alu)
                                        ->where('periodo', 3)
                                        ->where('activo', 1)
                                        ->where('borrado', 0)
                                        ->first();

                $curso->notaTercerPeriodo = $notaTercerPeriodo;


    

                if($ciclo->opcion == 2){
                    //Cuarto Bimestre solo si aplica
                    $notaCuartoPeriodo = Nota::where('matricula_id', $matricula->id)
                                        ->where('tipo', 3)
                                        ->where('ciclo_curso_id', $curso->idcurso)
                                        ->where('alumno_id', $matricula->id_alu)
                                        ->where('periodo', 4)
                                        ->where('activo', 1)
                                        ->where('borrado', 0)
                                        ->first();

                    $curso->notaCuartoPeriodo = $notaCuartoPeriodo;
                }

                $competencias = CicloCompetencia::where('ciclo_cursos_id', $curso->idcurso)
                                            ->where('ciclo_escolar_id', $ciclo->id)
                                            ->orderBy('orden')
                                            ->orderBy('nombre')
                                            ->get();

                foreach ($competencias as $keyCom => $competencia) {
                    $indicadores = CicloIndicador::where('ciclo_competencia_id', $competencia->id)
                                            ->where('ciclo_escolar_id', $ciclo->id)
                                            ->orderBy('orden')
                                            ->orderBy('nombre')
                                            ->get();

                    $competencia->indicadores = $indicadores;
                }

                //Notas Competencias
                foreach ($competencias as $keyCom => $competencia) {

                    //Nota Final
                    $notaFinal = Nota::where('matricula_id', $matricula->id)
                        ->where('tipo', 2)
                        ->where('ciclo_curso_id', $curso->idcurso)
                        ->where('ciclo_competencia_id', $competencia->id)
                        ->where('alumno_id', $matricula->id_alu)
                        ->where('periodo', 0)
                        ->where('activo', 1)
                        ->where('borrado', 0)
                        ->first();

                    $competencia->notaFinal = $notaFinal;

                    //Primer Bimestre/Trimestre
                    $notaPrimerPeriodo = Nota::where('matricula_id', $matricula->id)
                    ->where('tipo', 2)
                    ->where('ciclo_curso_id', $curso->idcurso)
                    ->where('ciclo_competencia_id', $competencia->id)
                    ->where('alumno_id', $matricula->id_alu)
                    ->where('periodo', 1)
                    ->where('activo', 1)
                    ->where('borrado', 0)
                    ->first();

                    $competencia->notaPrimerPeriodo = $notaPrimerPeriodo;

                    //Segundo Bimestre/Trimestre
                    $notaSegundoPeriodo = Nota::where('matricula_id', $matricula->id)
                                            ->where('tipo', 2)
                                            ->where('ciclo_curso_id', $curso->idcurso)
                                            ->where('ciclo_competencia_id', $competencia->id)
                                            ->where('alumno_id', $matricula->id_alu)
                                            ->where('periodo', 2)
                                            ->where('activo', 1)
                                            ->where('borrado', 0)
                                            ->first();

                    $competencia->notaSegundoPeriodo = $notaSegundoPeriodo;

                    //Tercer Bimestre/Trimestre
                    $notaTercerPeriodo = Nota::where('matricula_id', $matricula->id)
                                            ->where('tipo', 2)
                                            ->where('ciclo_curso_id', $curso->idcurso)
                                            ->where('ciclo_competencia_id', $competencia->id)
                                            ->where('alumno_id', $matricula->id_alu)
                                            ->where('periodo', 3)
                                            ->where('activo', 1)
                                            ->where('borrado', 0)
                                            ->first();

                    $competencia->notaTercerPeriodo = $notaTercerPeriodo;

                    if($ciclo->opcion == 2){
                        //Cuarto Bimestre solo si aplica
                        $notaCuartoPeriodo = Nota::where('matricula_id', $matricula->id)
                                            ->where('tipo', 2)
                                            ->where('ciclo_curso_id', $curso->idcurso)
                                            ->where('ciclo_competencia_id', $competencia->id)
                                            ->where('alumno_id', $matricula->id_alu)
                                            ->where('periodo', 4)
                                            ->where('activo', 1)
                                            ->where('borrado', 0)
                                            ->first();

                        $competencia->notaCuartoPeriodo = $notaCuartoPeriodo;
                    }  

                    //Notas Indicadores
                    foreach ($competencia->indicadores as $keyInd => $indicador) {

                        //Nota Final
                        $notaFinal = Nota::where('matricula_id', $matricula->id)
                            ->where('tipo', 1)
                            ->where('ciclo_curso_id', $curso->idcurso)
                            ->where('ciclo_competencia_id', $competencia->id)
                            ->where('ciclo_indicador_id', $indicador->id)
                            ->where('alumno_id', $matricula->id_alu)
                            ->where('periodo', 0)
                            ->where('activo', 1)
                            ->where('borrado', 0)
                            ->first();

                        $indicador->notaFinal = $notaFinal;


                        //Primer Bimestre/Trimestre
                        $notaPrimerPeriodo = Nota::where('matricula_id', $matricula->id)
                        ->where('tipo', 1)
                        ->where('ciclo_curso_id', $curso->idcurso)
                        ->where('ciclo_competencia_id', $competencia->id)
                        ->where('ciclo_indicador_id', $indicador->id)
                        ->where('alumno_id', $matricula->id_alu)
                        ->where('periodo', 1)
                        ->where('activo', 1)
                        ->where('borrado', 0)
                        ->first();

                        $indicador->notaPrimerPeriodo = $notaPrimerPeriodo;

                        //Segundo Bimestre/Trimestre
                        $notaSegundoPeriodo = Nota::where('matricula_id', $matricula->id)
                                                ->where('tipo', 1)
                                                ->where('ciclo_curso_id', $curso->idcurso)
                                                ->where('ciclo_competencia_id', $competencia->id)
                                                ->where('ciclo_indicador_id', $indicador->id)
                                                ->where('alumno_id', $matricula->id_alu)
                                                ->where('periodo', 2)
                                                ->where('activo', 1)
                                                ->where('borrado', 0)
                                                ->first();

                        $indicador->notaSegundoPeriodo = $notaSegundoPeriodo;

                        //Tercer Bimestre/Trimestre
                        $notaTercerPeriodo = Nota::where('matricula_id', $matricula->id)
                                                ->where('tipo', 1)
                                                ->where('ciclo_curso_id', $curso->idcurso)
                                                ->where('ciclo_competencia_id', $competencia->id)
                                                ->where('ciclo_indicador_id', $indicador->id)
                                                ->where('alumno_id', $matricula->id_alu)
                                                ->where('periodo', 3)
                                                ->where('activo', 1)
                                                ->where('borrado', 0)
                                                ->first();

                        $indicador->notaTercerPeriodo = $notaTercerPeriodo;

                        if($ciclo->opcion == 2){
                            //Cuarto Bimestre solo si aplica
                            $notaCuartoPeriodo = Nota::where('matricula_id', $matricula->id)
                                                ->where('tipo', 1)
                                                ->where('ciclo_curso_id', $curso->idcurso)
                                                ->where('ciclo_competencia_id', $competencia->id)
                                                ->where('ciclo_indicador_id', $indicador->id)
                                                ->where('alumno_id', $matricula->id_alu)
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

            $matricula->cursos = $cursos;
        }

            $data->cantAlumnos = $cantAlumnos;
            $data->alumnos = $matriculas;
        
        }
        else{
            $data->cantCursos = null;
            $data->cantAlumnos = null;
            $data->alumnos = null;
            $data->seccion = null;
            $data->grado = null;
            $data->nivel = null;

            $data->error = true;
        }
        return $data;

    }




    public static function GetCalificacionesAlumno($matricula_id){

        $matricula = Matricula::find($matricula_id);

        $ciclo = CicloEscolar::find($matricula->ciclo_escolar_id);

        $data = InstitucionEducativa::where('borrado','0')
                                    ->where('activo','1')
                                    ->first();

        $data->error = false;
        $data->ciclo = $ciclo;

        if($ciclo){

            $seccion = CicloSeccion::find($matricula->ciclo_seccion_id);
            $grado = CicloGrado::find($seccion->ciclo_grados_id);
            $nivel = CicloNivel::find($grado->ciclo_niveles_id);

            $data->seccion = $seccion;
            $data->grado = $grado;
            $data->nivel = $nivel;

            $matricula =DB::table('matriculas')
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

                                ->where('matriculas.id', $matricula_id)

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
            
                                    )->first();

            $cursos = DB::select("select cur.id as idcurso, cur.nombre as curso, sec.id as ciclo_seccion_id, sec.nombre as seccion, sec.sigla, sec.ciclo_grados_id, 
            t.nombre as turno , asig.id as idasignacion, doc.apellidos as apeDocente, doc.nombre as nomDocente, asig.docente_id,
            gra.nombre as grado
            from ciclo_cursos cur 
            inner join asignacion_cursos asig on cur.id = asig.ciclo_cursos_id and asig.activo='1' and asig.borrado='0' 
            inner join ciclo_seccion sec on sec.id = asig.ciclo_seccion_id and sec.activo='1' and sec.borrado='0' 
            inner join ciclo_grados gra on gra.id = sec.ciclo_grados_id and gra.activo='1' and gra.borrado='0' 
            inner join turnos t on t.id = sec.turno_id 
            inner join docentes doc on doc.id = asig.docente_id
            where 
            cur.activo='1' and cur.borrado='0' 
            and 
            sec.ciclo_escolar_id = ?
            and 
            sec.ciclo_grados_id = ?
            and 
            sec.id = ?
            order by sec.id, cur.orden;", [$ciclo->id, $grado->id, $seccion->id]);

            foreach ($cursos as $keyC => $curso) {
                //Nota Final
                $notaFinal = Nota::where('matricula_id', $matricula->id)
                ->where('tipo', 3)
                ->where('ciclo_curso_id', $curso->idcurso)
                ->where('alumno_id', $matricula->id_alu)
                ->where('periodo', 0)
                ->where('activo', 1)
                ->where('borrado', 0)
                ->first();
                

                 $curso->notaFinal = $notaFinal;

                //Primer Bimestre/Trimestre
                $notaPrimerPeriodo = Nota::where('matricula_id', $matricula->id)
                                        ->where('tipo', 3)
                                        ->where('ciclo_curso_id', $curso->idcurso)
                                        ->where('alumno_id', $matricula->id_alu)
                                        ->where('periodo', 1)
                                        ->where('activo', 1)
                                        ->where('borrado', 0)
                                        ->first();

                $curso->notaPrimerPeriodo = $notaPrimerPeriodo;

                //Segundo Bimestre/Trimestre
                $notaSegundoPeriodo = Nota::where('matricula_id', $matricula->id)
                                        ->where('tipo', 3)
                                        ->where('ciclo_curso_id', $curso->idcurso)
                                        ->where('alumno_id', $matricula->id_alu)
                                        ->where('periodo', 2)
                                        ->where('activo', 1)
                                        ->where('borrado', 0)
                                        ->first();

                $curso->notaSegundoPeriodo = $notaSegundoPeriodo;

                //Tercer Bimestre/Trimestre
                $notaTercerPeriodo = Nota::where('matricula_id', $matricula->id)
                                        ->where('tipo', 3)
                                        ->where('ciclo_curso_id', $curso->idcurso)
                                        ->where('alumno_id', $matricula->id_alu)
                                        ->where('periodo', 3)
                                        ->where('activo', 1)
                                        ->where('borrado', 0)
                                        ->first();

                $curso->notaTercerPeriodo = $notaTercerPeriodo;


    

                if($ciclo->opcion == 2){
                    //Cuarto Bimestre solo si aplica
                    $notaCuartoPeriodo = Nota::where('matricula_id', $matricula->id)
                                        ->where('tipo', 3)
                                        ->where('ciclo_curso_id', $curso->idcurso)
                                        ->where('alumno_id', $matricula->id_alu)
                                        ->where('periodo', 4)
                                        ->where('activo', 1)
                                        ->where('borrado', 0)
                                        ->first();

                    $curso->notaCuartoPeriodo = $notaCuartoPeriodo;
                }

                $competencias = CicloCompetencia::where('ciclo_cursos_id', $curso->idcurso)
                                            ->where('ciclo_escolar_id', $ciclo->id)
                                            ->orderBy('orden')
                                            ->orderBy('nombre')
                                            ->get();

                foreach ($competencias as $keyCom => $competencia) {
                    $indicadores = CicloIndicador::where('ciclo_competencia_id', $competencia->id)
                                            ->where('ciclo_escolar_id', $ciclo->id)
                                            ->orderBy('orden')
                                            ->orderBy('nombre')
                                            ->get();

                    $competencia->indicadores = $indicadores;
                }

                //Notas Competencias
                foreach ($competencias as $keyCom => $competencia) {

                    //Nota Final
                    $notaFinal = Nota::where('matricula_id', $matricula->id)
                        ->where('tipo', 2)
                        ->where('ciclo_curso_id', $curso->idcurso)
                        ->where('ciclo_competencia_id', $competencia->id)
                        ->where('alumno_id', $matricula->id_alu)
                        ->where('periodo', 0)
                        ->where('activo', 1)
                        ->where('borrado', 0)
                        ->first();

                    $competencia->notaFinal = $notaFinal;

                    //Primer Bimestre/Trimestre
                    $notaPrimerPeriodo = Nota::where('matricula_id', $matricula->id)
                    ->where('tipo', 2)
                    ->where('ciclo_curso_id', $curso->idcurso)
                    ->where('ciclo_competencia_id', $competencia->id)
                    ->where('alumno_id', $matricula->id_alu)
                    ->where('periodo', 1)
                    ->where('activo', 1)
                    ->where('borrado', 0)
                    ->first();

                    $competencia->notaPrimerPeriodo = $notaPrimerPeriodo;

                    //Segundo Bimestre/Trimestre
                    $notaSegundoPeriodo = Nota::where('matricula_id', $matricula->id)
                                            ->where('tipo', 2)
                                            ->where('ciclo_curso_id', $curso->idcurso)
                                            ->where('ciclo_competencia_id', $competencia->id)
                                            ->where('alumno_id', $matricula->id_alu)
                                            ->where('periodo', 2)
                                            ->where('activo', 1)
                                            ->where('borrado', 0)
                                            ->first();

                    $competencia->notaSegundoPeriodo = $notaSegundoPeriodo;

                    //Tercer Bimestre/Trimestre
                    $notaTercerPeriodo = Nota::where('matricula_id', $matricula->id)
                                            ->where('tipo', 2)
                                            ->where('ciclo_curso_id', $curso->idcurso)
                                            ->where('ciclo_competencia_id', $competencia->id)
                                            ->where('alumno_id', $matricula->id_alu)
                                            ->where('periodo', 3)
                                            ->where('activo', 1)
                                            ->where('borrado', 0)
                                            ->first();

                    $competencia->notaTercerPeriodo = $notaTercerPeriodo;

                    if($ciclo->opcion == 2){
                        //Cuarto Bimestre solo si aplica
                        $notaCuartoPeriodo = Nota::where('matricula_id', $matricula->id)
                                            ->where('tipo', 2)
                                            ->where('ciclo_curso_id', $curso->idcurso)
                                            ->where('ciclo_competencia_id', $competencia->id)
                                            ->where('alumno_id', $matricula->id_alu)
                                            ->where('periodo', 4)
                                            ->where('activo', 1)
                                            ->where('borrado', 0)
                                            ->first();

                        $competencia->notaCuartoPeriodo = $notaCuartoPeriodo;
                    }  

                    //Notas Indicadores
                    foreach ($competencia->indicadores as $keyInd => $indicador) {

                        //Nota Final
                        $notaFinal = Nota::where('matricula_id', $matricula->id)
                            ->where('tipo', 1)
                            ->where('ciclo_curso_id', $curso->idcurso)
                            ->where('ciclo_competencia_id', $competencia->id)
                            ->where('ciclo_indicador_id', $indicador->id)
                            ->where('alumno_id', $matricula->id_alu)
                            ->where('periodo', 0)
                            ->where('activo', 1)
                            ->where('borrado', 0)
                            ->first();

                        $indicador->notaFinal = $notaFinal;


                        //Primer Bimestre/Trimestre
                        $notaPrimerPeriodo = Nota::where('matricula_id', $matricula->id)
                        ->where('tipo', 1)
                        ->where('ciclo_curso_id', $curso->idcurso)
                        ->where('ciclo_competencia_id', $competencia->id)
                        ->where('ciclo_indicador_id', $indicador->id)
                        ->where('alumno_id', $matricula->id_alu)
                        ->where('periodo', 1)
                        ->where('activo', 1)
                        ->where('borrado', 0)
                        ->first();

                        $indicador->notaPrimerPeriodo = $notaPrimerPeriodo;

                        //Segundo Bimestre/Trimestre
                        $notaSegundoPeriodo = Nota::where('matricula_id', $matricula->id)
                                                ->where('tipo', 1)
                                                ->where('ciclo_curso_id', $curso->idcurso)
                                                ->where('ciclo_competencia_id', $competencia->id)
                                                ->where('ciclo_indicador_id', $indicador->id)
                                                ->where('alumno_id', $matricula->id_alu)
                                                ->where('periodo', 2)
                                                ->where('activo', 1)
                                                ->where('borrado', 0)
                                                ->first();

                        $indicador->notaSegundoPeriodo = $notaSegundoPeriodo;

                        //Tercer Bimestre/Trimestre
                        $notaTercerPeriodo = Nota::where('matricula_id', $matricula->id)
                                                ->where('tipo', 1)
                                                ->where('ciclo_curso_id', $curso->idcurso)
                                                ->where('ciclo_competencia_id', $competencia->id)
                                                ->where('ciclo_indicador_id', $indicador->id)
                                                ->where('alumno_id', $matricula->id_alu)
                                                ->where('periodo', 3)
                                                ->where('activo', 1)
                                                ->where('borrado', 0)
                                                ->first();

                        $indicador->notaTercerPeriodo = $notaTercerPeriodo;

                        if($ciclo->opcion == 2){
                            //Cuarto Bimestre solo si aplica
                            $notaCuartoPeriodo = Nota::where('matricula_id', $matricula->id)
                                                ->where('tipo', 1)
                                                ->where('ciclo_curso_id', $curso->idcurso)
                                                ->where('ciclo_competencia_id', $competencia->id)
                                                ->where('ciclo_indicador_id', $indicador->id)
                                                ->where('alumno_id', $matricula->id_alu)
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

            $matricula->cursos = $cursos;

            $data->matricula = $matricula;
        
        }
        else{
            $data->matricula = null;
            $data->seccion = null;
            $data->grado = null;
            $data->nivel = null;

            $data->error = true;
        }
        return $data;

    }

    public static function GetCalificacionesAlumnoCurso($matricula_id, $ciclo_curso_id){

        $matricula = Matricula::find($matricula_id);

        $ciclo = CicloEscolar::find($matricula->ciclo_escolar_id);

        $data = InstitucionEducativa::where('borrado','0')
                                    ->where('activo','1')
                                    ->first();

        $data->error = false;
        $data->ciclo = $ciclo;

        if($ciclo){

            $seccion = CicloSeccion::find($matricula->ciclo_seccion_id);
            $grado = CicloGrado::find($seccion->ciclo_grados_id);
            $nivel = CicloNivel::find($grado->ciclo_niveles_id);

            $data->seccion = $seccion;
            $data->grado = $grado;
            $data->nivel = $nivel;

            $matricula =DB::table('matriculas')
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

                                ->where('matriculas.id', $matricula_id)

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
            
                                    )->first();

            $cursos = DB::select("select cur.id as idcurso, cur.nombre as curso, sec.id as ciclo_seccion_id, sec.nombre as seccion, sec.sigla, sec.ciclo_grados_id, 
            t.nombre as turno , asig.id as idasignacion, doc.apellidos as apeDocente, doc.nombre as nomDocente, asig.docente_id,
            gra.nombre as grado
            from ciclo_cursos cur 
            inner join asignacion_cursos asig on cur.id = asig.ciclo_cursos_id and asig.activo='1' and asig.borrado='0' 
            inner join ciclo_seccion sec on sec.id = asig.ciclo_seccion_id and sec.activo='1' and sec.borrado='0' 
            inner join ciclo_grados gra on gra.id = sec.ciclo_grados_id and gra.activo='1' and gra.borrado='0' 
            inner join turnos t on t.id = sec.turno_id 
            inner join docentes doc on doc.id = asig.docente_id
            where 
            cur.activo='1' and cur.borrado='0' 
            and 
            sec.ciclo_escolar_id = ?
            and 
            sec.ciclo_grados_id = ?
            and 
            sec.id = ?
            and 
            cur.id = ?
            order by sec.id, cur.orden;", [$ciclo->id, $grado->id, $seccion->id, $ciclo_curso_id]);

            $curso = null;
            if(count($cursos) > 0){

                $curso = $cursos[0];
                //Nota Final
                $notaFinal = Nota::where('matricula_id', $matricula->id)
                ->where('tipo', 3)
                ->where('ciclo_curso_id', $curso->idcurso)
                ->where('alumno_id', $matricula->id_alu)
                ->where('periodo', 0)
                ->where('activo', 1)
                ->where('borrado', 0)
                ->first();
                

                 $curso->notaFinal = $notaFinal;

                //Primer Bimestre/Trimestre
                $notaPrimerPeriodo = Nota::where('matricula_id', $matricula->id)
                                        ->where('tipo', 3)
                                        ->where('ciclo_curso_id', $curso->idcurso)
                                        ->where('alumno_id', $matricula->id_alu)
                                        ->where('periodo', 1)
                                        ->where('activo', 1)
                                        ->where('borrado', 0)
                                        ->first();

                $curso->notaPrimerPeriodo = $notaPrimerPeriodo;

                //Segundo Bimestre/Trimestre
                $notaSegundoPeriodo = Nota::where('matricula_id', $matricula->id)
                                        ->where('tipo', 3)
                                        ->where('ciclo_curso_id', $curso->idcurso)
                                        ->where('alumno_id', $matricula->id_alu)
                                        ->where('periodo', 2)
                                        ->where('activo', 1)
                                        ->where('borrado', 0)
                                        ->first();

                $curso->notaSegundoPeriodo = $notaSegundoPeriodo;

                //Tercer Bimestre/Trimestre
                $notaTercerPeriodo = Nota::where('matricula_id', $matricula->id)
                                        ->where('tipo', 3)
                                        ->where('ciclo_curso_id', $curso->idcurso)
                                        ->where('alumno_id', $matricula->id_alu)
                                        ->where('periodo', 3)
                                        ->where('activo', 1)
                                        ->where('borrado', 0)
                                        ->first();

                $curso->notaTercerPeriodo = $notaTercerPeriodo;


    

                if($ciclo->opcion == 2){
                    //Cuarto Bimestre solo si aplica
                    $notaCuartoPeriodo = Nota::where('matricula_id', $matricula->id)
                                        ->where('tipo', 3)
                                        ->where('ciclo_curso_id', $curso->idcurso)
                                        ->where('alumno_id', $matricula->id_alu)
                                        ->where('periodo', 4)
                                        ->where('activo', 1)
                                        ->where('borrado', 0)
                                        ->first();

                    $curso->notaCuartoPeriodo = $notaCuartoPeriodo;
                }

                $competencias = CicloCompetencia::where('ciclo_cursos_id', $curso->idcurso)
                                            ->where('ciclo_escolar_id', $ciclo->id)
                                            ->orderBy('orden')
                                            ->orderBy('nombre')
                                            ->get();

                foreach ($competencias as $keyCom => $competencia) {
                    $indicadores = CicloIndicador::where('ciclo_competencia_id', $competencia->id)
                                            ->where('ciclo_escolar_id', $ciclo->id)
                                            ->orderBy('orden')
                                            ->orderBy('nombre')
                                            ->get();

                    $competencia->indicadores = $indicadores;
                }

                //Notas Competencias
                foreach ($competencias as $keyCom => $competencia) {

                    //Nota Final
                    $notaFinal = Nota::where('matricula_id', $matricula->id)
                        ->where('tipo', 2)
                        ->where('ciclo_curso_id', $curso->idcurso)
                        ->where('ciclo_competencia_id', $competencia->id)
                        ->where('alumno_id', $matricula->id_alu)
                        ->where('periodo', 0)
                        ->where('activo', 1)
                        ->where('borrado', 0)
                        ->first();

                    $competencia->notaFinal = $notaFinal;

                    //Primer Bimestre/Trimestre
                    $notaPrimerPeriodo = Nota::where('matricula_id', $matricula->id)
                    ->where('tipo', 2)
                    ->where('ciclo_curso_id', $curso->idcurso)
                    ->where('ciclo_competencia_id', $competencia->id)
                    ->where('alumno_id', $matricula->id_alu)
                    ->where('periodo', 1)
                    ->where('activo', 1)
                    ->where('borrado', 0)
                    ->first();

                    $competencia->notaPrimerPeriodo = $notaPrimerPeriodo;

                    //Segundo Bimestre/Trimestre
                    $notaSegundoPeriodo = Nota::where('matricula_id', $matricula->id)
                                            ->where('tipo', 2)
                                            ->where('ciclo_curso_id', $curso->idcurso)
                                            ->where('ciclo_competencia_id', $competencia->id)
                                            ->where('alumno_id', $matricula->id_alu)
                                            ->where('periodo', 2)
                                            ->where('activo', 1)
                                            ->where('borrado', 0)
                                            ->first();

                    $competencia->notaSegundoPeriodo = $notaSegundoPeriodo;

                    //Tercer Bimestre/Trimestre
                    $notaTercerPeriodo = Nota::where('matricula_id', $matricula->id)
                                            ->where('tipo', 2)
                                            ->where('ciclo_curso_id', $curso->idcurso)
                                            ->where('ciclo_competencia_id', $competencia->id)
                                            ->where('alumno_id', $matricula->id_alu)
                                            ->where('periodo', 3)
                                            ->where('activo', 1)
                                            ->where('borrado', 0)
                                            ->first();

                    $competencia->notaTercerPeriodo = $notaTercerPeriodo;

                    if($ciclo->opcion == 2){
                        //Cuarto Bimestre solo si aplica
                        $notaCuartoPeriodo = Nota::where('matricula_id', $matricula->id)
                                            ->where('tipo', 2)
                                            ->where('ciclo_curso_id', $curso->idcurso)
                                            ->where('ciclo_competencia_id', $competencia->id)
                                            ->where('alumno_id', $matricula->id_alu)
                                            ->where('periodo', 4)
                                            ->where('activo', 1)
                                            ->where('borrado', 0)
                                            ->first();

                        $competencia->notaCuartoPeriodo = $notaCuartoPeriodo;
                    }  

                    //Notas Indicadores
                    foreach ($competencia->indicadores as $keyInd => $indicador) {

                        //Nota Final
                        $notaFinal = Nota::where('matricula_id', $matricula->id)
                            ->where('tipo', 1)
                            ->where('ciclo_curso_id', $curso->idcurso)
                            ->where('ciclo_competencia_id', $competencia->id)
                            ->where('ciclo_indicador_id', $indicador->id)
                            ->where('alumno_id', $matricula->id_alu)
                            ->where('periodo', 0)
                            ->where('activo', 1)
                            ->where('borrado', 0)
                            ->first();

                        $indicador->notaFinal = $notaFinal;


                        //Primer Bimestre/Trimestre
                        $notaPrimerPeriodo = Nota::where('matricula_id', $matricula->id)
                        ->where('tipo', 1)
                        ->where('ciclo_curso_id', $curso->idcurso)
                        ->where('ciclo_competencia_id', $competencia->id)
                        ->where('ciclo_indicador_id', $indicador->id)
                        ->where('alumno_id', $matricula->id_alu)
                        ->where('periodo', 1)
                        ->where('activo', 1)
                        ->where('borrado', 0)
                        ->first();

                        $indicador->notaPrimerPeriodo = $notaPrimerPeriodo;

                        //Segundo Bimestre/Trimestre
                        $notaSegundoPeriodo = Nota::where('matricula_id', $matricula->id)
                                                ->where('tipo', 1)
                                                ->where('ciclo_curso_id', $curso->idcurso)
                                                ->where('ciclo_competencia_id', $competencia->id)
                                                ->where('ciclo_indicador_id', $indicador->id)
                                                ->where('alumno_id', $matricula->id_alu)
                                                ->where('periodo', 2)
                                                ->where('activo', 1)
                                                ->where('borrado', 0)
                                                ->first();

                        $indicador->notaSegundoPeriodo = $notaSegundoPeriodo;

                        //Tercer Bimestre/Trimestre
                        $notaTercerPeriodo = Nota::where('matricula_id', $matricula->id)
                                                ->where('tipo', 1)
                                                ->where('ciclo_curso_id', $curso->idcurso)
                                                ->where('ciclo_competencia_id', $competencia->id)
                                                ->where('ciclo_indicador_id', $indicador->id)
                                                ->where('alumno_id', $matricula->id_alu)
                                                ->where('periodo', 3)
                                                ->where('activo', 1)
                                                ->where('borrado', 0)
                                                ->first();

                        $indicador->notaTercerPeriodo = $notaTercerPeriodo;

                        if($ciclo->opcion == 2){
                            //Cuarto Bimestre solo si aplica
                            $notaCuartoPeriodo = Nota::where('matricula_id', $matricula->id)
                                                ->where('tipo', 1)
                                                ->where('ciclo_curso_id', $curso->idcurso)
                                                ->where('ciclo_competencia_id', $competencia->id)
                                                ->where('ciclo_indicador_id', $indicador->id)
                                                ->where('alumno_id', $matricula->id_alu)
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

            $data->curso = $curso;
            $data->matricula = $matricula;
        
        }
        else{
            $data->curso = null;
            $data->matricula = null;
            $data->seccion = null;
            $data->grado = null;
            $data->nivel = null;

            $data->error = true;
        }
        return $data;

    }
}
