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
}
