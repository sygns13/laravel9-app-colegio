<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Validator;
use Auth;

use App\Models\AsignacionCurso;
use App\Models\Curso;
use App\Models\Grado;
use App\Models\CicloEscolar;
use App\Models\Asistencia;
use App\Models\AsistenciaAlumno;
use App\Models\CicloCurso;
use App\Models\CicloGrado;
use App\Models\Docente;
use App\Models\Turno;
use App\Models\Hora;
use App\Models\Nota;

use DateTime;
use stdClass;

class NotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index1()
    {
        $cicloActivo = CicloEscolar::GetCicloActivo();
        $hoy = date('Y-m-d');

        return view('docente.notas.index',compact('cicloActivo', 'hoy'));
    }

    public function index(Request $request)
    {

        $cicloActivo = CicloEscolar::GetCicloActivo();
        $iduser =Auth::user()->id;
        $response = Docente::GetItemsNotasAlumnos($iduser, $cicloActivo->id);
    

        return $response;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result='1';
        $msj='';
        $selector='';

        $matricula_id=$request->matricula_id;
        $tipo=$request->tipo;
        $ciclo_indicador_id=$request->ciclo_indicador_id;
        $ciclo_competencia_id=$request->ciclo_competencia_id;
        $ciclo_curso_id=$request->ciclo_curso_id;
        $alumno_id=$request->alumno_id;
        $nota_num=$request->nota_num;
        $nota_letra=$request->nota_letra;
        $periodo=$request->periodo;
        $activo=$request->activo;

        $input1  = array('matricula_id' => $matricula_id);
        $reglas1 = array('matricula_id' => 'required');

        $input2  = array('tipo' => $tipo);
        $reglas2 = array('tipo' => 'required');

        $input3  = array('ciclo_indicador_id' => $ciclo_indicador_id);
        $reglas3 = array('ciclo_indicador_id' => 'required');

        $input4  = array('ciclo_competencia_id' => $ciclo_competencia_id);
        $reglas4 = array('ciclo_competencia_id' => 'required');

        $input5  = array('ciclo_curso_id' => $ciclo_curso_id);
        $reglas5 = array('ciclo_curso_id' => 'required');

        $input6  = array('alumno_id' => $alumno_id);
        $reglas6 = array('alumno_id' => 'required');

        $input7  = array('nota_num' => $nota_num);
        $reglas7 = array('nota_num' => 'required');

        $input8  = array('periodo' => $periodo);
        $reglas8 = array('periodo' => 'required');

        $validator1 = Validator::make($input1, $reglas1);
        $validator2 = Validator::make($input2, $reglas2);
        $validator3 = Validator::make($input3, $reglas3);
        $validator4 = Validator::make($input4, $reglas4);
        $validator5 = Validator::make($input5, $reglas5);
        $validator6 = Validator::make($input6, $reglas6);
        $validator7 = Validator::make($input7, $reglas7);
        $validator8 = Validator::make($input8, $reglas8);

        if ($validator1->fails() || intval($matricula_id) <= 0)
        {
            $result='0';
            $msj='Debe remitir la matrícula del alumno';
            $selector='cbumatricula_id';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if ($validator2->fails() || intval($tipo) <= 0)
        {
            $result='0';
            $msj='Debe remitir correctamente el Tipo de la Calificación';
            $selector='cbutipo';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if ($validator3->fails() || intval($ciclo_indicador_id) <= 0)
        {
            $result='0';
            $msj='Debe remitir el Indicador de la Competencia del Curso';
            $selector='cbuciclo_indicador_id';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if ($validator4->fails() || intval($ciclo_competencia_id) <= 0)
        {
            $result='0';
            $msj='Debe remitir la Competencia del Curso';
            $selector='cbuciclo_competencia_id';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if ($validator5->fails() || intval($ciclo_curso_id) <= 0)
        {
            $result='0';
            $msj='Debe remitir el Curso';
            $selector='cbuciclo_curso_id';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if ($validator6->fails() || intval($alumno_id) <= 0)
        {
            $result='0';
            $msj='Debe remitir el Alumno';
            $selector='cbualumno_id';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }
        if ($validator7->fails() || floatval($nota_num) < 0)
        {
            $result='0';
            $msj='Debe remitir la Nota de la Calificación';
            $selector='txtnota_num';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if(floatval($nota_num) > 20)
        {
            $result='0';
            $msj='No puede remitir una Nota de Calificación mayor a 20';
            $selector='txtnota_num';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if ($validator8->fails() || floatval($periodo) < 0)
        {
            $result='0';
            $msj='Debe remitir el Periodo de Calificación';
            $selector='cbuperiodo';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        $nota_num = round(floatval($nota_num), 2);


        $registro = new Nota;

        $registro->matricula_id=$matricula_id;
        $registro->tipo=$tipo;
        $registro->ciclo_indicador_id=$ciclo_indicador_id;
        $registro->ciclo_competencia_id=$ciclo_competencia_id;
        $registro->ciclo_curso_id=$ciclo_curso_id;
        $registro->alumno_id=$alumno_id;
        $registro->nota_num=$nota_num;
        $registro->nota_letra=$nota_letra;
        $registro->periodo=$periodo;
        $registro->activo='1';
        $registro->borrado='0';

        $registro->save();

        Nota::CalculoNotasIndicadores($registro);




        $msj='La Nota se ha registrado con éxito';

        return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $result='1';
        $msj='';
        $selector='';

        $matricula_id=$request->matricula_id;
        $tipo=$request->tipo;
        $ciclo_indicador_id=$request->ciclo_indicador_id;
        $ciclo_competencia_id=$request->ciclo_competencia_id;
        $ciclo_curso_id=$request->ciclo_curso_id;
        $alumno_id=$request->alumno_id;
        $nota_num=$request->nota_num;
        $nota_letra=$request->nota_letra;
        $periodo=$request->periodo;
        $activo=$request->activo;

        $input1  = array('matricula_id' => $matricula_id);
        $reglas1 = array('matricula_id' => 'required');

        $input2  = array('tipo' => $tipo);
        $reglas2 = array('tipo' => 'required');

        $input3  = array('ciclo_indicador_id' => $ciclo_indicador_id);
        $reglas3 = array('ciclo_indicador_id' => 'required');

        $input4  = array('ciclo_competencia_id' => $ciclo_competencia_id);
        $reglas4 = array('ciclo_competencia_id' => 'required');

        $input5  = array('ciclo_curso_id' => $ciclo_curso_id);
        $reglas5 = array('ciclo_curso_id' => 'required');

        $input6  = array('alumno_id' => $alumno_id);
        $reglas6 = array('alumno_id' => 'required');

        $input7  = array('nota_num' => $nota_num);
        $reglas7 = array('nota_num' => 'required');

        $input8  = array('periodo' => $periodo);
        $reglas8 = array('periodo' => 'required');

        $validator1 = Validator::make($input1, $reglas1);
        $validator2 = Validator::make($input2, $reglas2);
        $validator3 = Validator::make($input3, $reglas3);
        $validator4 = Validator::make($input4, $reglas4);
        $validator5 = Validator::make($input5, $reglas5);
        $validator6 = Validator::make($input6, $reglas6);
        $validator7 = Validator::make($input7, $reglas7);
        $validator8 = Validator::make($input8, $reglas8);

        if ($validator1->fails() || intval($matricula_id) <= 0)
        {
            $result='0';
            $msj='Debe remitir la matrícula del alumno';
            $selector='cbumatricula_id';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if ($validator2->fails() || intval($tipo) <= 0)
        {
            $result='0';
            $msj='Debe remitir correctamente el Tipo de la Calificación';
            $selector='cbutipo';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if ($validator3->fails() || intval($ciclo_indicador_id) <= 0)
        {
            $result='0';
            $msj='Debe remitir el Indicador de la Competencia del Curso';
            $selector='cbuciclo_indicador_id';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if ($validator4->fails() || intval($ciclo_competencia_id) <= 0)
        {
            $result='0';
            $msj='Debe remitir la Competencia del Curso';
            $selector='cbuciclo_competencia_id';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if ($validator5->fails() || intval($ciclo_curso_id) <= 0)
        {
            $result='0';
            $msj='Debe remitir el Curso';
            $selector='cbuciclo_curso_id';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if ($validator6->fails() || intval($alumno_id) <= 0)
        {
            $result='0';
            $msj='Debe remitir el Alumno';
            $selector='cbualumno_id';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }
        if ($validator7->fails() || floatval($nota_num) < 0)
        {
            $result='0';
            $msj='Debe remitir la Nota de la Calificación';
            $selector='txtnota_num';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if(floatval($nota_num) > 20)
        {
            $result='0';
            $msj='No puede remitir una Nota de Calificación mayor a 20';
            $selector='txtnota_num';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if ($validator8->fails() || intval($periodo) < 0)
        {
            $result='0';
            $msj='Debe remitir el Periodo de Calificación';
            $selector='cbuperiodo';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        $nota_num = round(floatval($nota_num), 2);


        $registro = Nota::find($id);
        $registro->nota_num=$nota_num;

        $registro->save();


        Nota::CalculoNotasIndicadores($registro);



        $msj='La Nota se ha modificado con éxito';

        return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
