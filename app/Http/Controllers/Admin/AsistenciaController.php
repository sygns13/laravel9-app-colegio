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
use App\Models\Alumno;
use App\Models\User;

use DateTime;
use stdClass;

use Illuminate\Support\Facades\Hash;

class AsistenciaController extends Controller
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

        return view('docente.asistencia-alumnos.index',compact('cicloActivo', 'hoy'));
    }

    public function index2()
    {
        $cicloActivo = CicloEscolar::GetCicloActivo();
        $ciclos = CicloEscolar::GetAllCiclos();
        return view('reporte.asistenciasesion.index',compact('cicloActivo', 'ciclos'));
    }

    public function index3()
    {
        $cicloActivo = CicloEscolar::GetCicloActivo();
        $ciclos = CicloEscolar::GetAllCiclos();
        return view('docente.asistenciasesion.index',compact('cicloActivo', 'ciclos'));
    }


    public function index(Request $request)
    {

        $fecha = $request->fecha;

        $response = ['error' =>true , 'msg' => 'Fecha No Válida'];

        if ($this->validaFecha($fecha)){
            $fechaDateTime = new DateTime($fecha);
            $tipodia=date("N",$fechaDateTime->getTimestamp());
        
            $cicloActivo = CicloEscolar::GetCicloActivo();
            $iduser =Auth::user()->id;
    
            $response = Docente::GetItemsAsistenciaAlumnos($iduser, $cicloActivo->id, $tipodia, $fecha);
        }
        

        return $response;
    }

    public function indexAsistenciaSesion(Request $request)
    {

        $ciclo_id = $request->ciclo_id;
        $fecha = $request->fecha;

        $registros = Asistencia::GetDataAsistenciaByCicloAndFecha($ciclo_id, $fecha);

        $turnos = Turno::all();
        $horas = Hora::where('borrado','0')->where('activo','1')->get();
        
        return [ 
                'registros' => $registros,
                'turnos' => $turnos,
                'horas' => $horas,
               ];
    }

    public function indexDocAsistenciaSesion(Request $request)
    {

        $iduser =Auth::user()->id;
        $ciclo_id = $request->ciclo_id;
        $fecha = $request->fecha;

        $registros = Asistencia::GetDataAsistenciaDocByCicloAndFecha($ciclo_id, $fecha, $iduser);

        $turnos = Turno::all();
        $horas = Hora::where('borrado','0')->where('activo','1')->get();
        
        return [ 
                'registros' => $registros,
                'turnos' => $turnos,
                'horas' => $horas,
               ];
    }

    private function validaFecha($fecha){
        $valores = explode('-', $fecha);
        if(count($valores) == 3 && checkdate($valores[1], $valores[2], $valores[0]) && strlen($fecha)==10){
            return true;
    
        }
        //var_dump($valores);
        return false;
    
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
        $fecha=$request->fecha;
        $ciclo_escolar_id=$request->ciclo_escolar_id;
        $ciclo_seccion_id=$request->ciclo_seccion_id;
        $ciclo_curso_id=$request->ciclo_curso_id;
        $horario_id=$request->horario_id;
        $tema=$request->tema;

        $result='1';
        $msj='';
        $selector='';


        $input1  = array('fecha' => $fecha);
        $reglas1 = array('fecha' => 'required');

        $input2  = array('ciclo_escolar_id' => $ciclo_escolar_id);
        $reglas2 = array('ciclo_escolar_id' => 'required');

        $input3  = array('ciclo_seccion_id' => $ciclo_seccion_id);
        $reglas3 = array('ciclo_seccion_id' => 'required');

        $input4  = array('ciclo_curso_id' => $ciclo_curso_id);
        $reglas4 = array('ciclo_curso_id' => 'required');

        $input5  = array('horario_id' => $horario_id);
        $reglas5 = array('horario_id' => 'required');

        $input6  = array('tema' => $tema);
        $reglas6 = array('tema' => 'required');

        $validator1 = Validator::make($input1, $reglas1);
        $validator2 = Validator::make($input2, $reglas2);
        $validator3 = Validator::make($input3, $reglas3);
        $validator4 = Validator::make($input4, $reglas4);
        $validator5 = Validator::make($input5, $reglas5);
        $validator6 = Validator::make($input6, $reglas6);

        if ($validator1->fails())
        {
            $result='0';
            $msj='Debe ingresar la Fecha de Asistencia';
            $selector='txtfecha';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if ($validator2->fails())
        {
            $result='0';
            $msj='Debe de existir un Año Escolar Vigente';
            $selector='ciclo_escolar_id';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if ($validator3->fails())
        {
            $result='0';
            $msj='Debe de remitir la sección del Alumno';
            $selector='ciclo_seccion_id';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if ($validator4->fails())
        {
            $result='0';
            $msj='Debe de remitir el Curo del Alumno';
            $selector='ciclo_curso_id';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if ($validator5->fails())
        {
            $result='0';
            $msj='Debe de remitir el Horario del Alumno';
            $selector='horario_id';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if ($validator6->fails())
        {
            $tema = "";
        }

            $registro = new Asistencia;

            $registro->fecha=$fecha;
            $registro->ciclo_seccion_id=$ciclo_seccion_id;
            $registro->ciclo_escolar_id=$ciclo_escolar_id;
            $registro->ciclo_curso_id=$ciclo_curso_id;
            $registro->activo='1';
            $registro->estado='0';
            $registro->borrado='0';
            $registro->horario_id=$horario_id;
            $registro->alumno_id='0';
            $registro->tema=$tema;

            $registro->save();

            $msj='Tema de Día de Asistencia Registrado Exitosamente';

        return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector, 'asistencia_id' => $registro->id]);
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
        $fecha=$request->fecha;
        $ciclo_escolar_id=$request->ciclo_escolar_id;
        $ciclo_seccion_id=$request->ciclo_seccion_id;
        $ciclo_curso_id=$request->ciclo_curso_id;
        $horario_id=$request->horario_id;
        $tema=$request->tema;

        $result='1';
        $msj='';
        $selector='';


        $input1  = array('fecha' => $fecha);
        $reglas1 = array('fecha' => 'required');

        $input2  = array('ciclo_escolar_id' => $ciclo_escolar_id);
        $reglas2 = array('ciclo_escolar_id' => 'required');

        $input3  = array('ciclo_seccion_id' => $ciclo_seccion_id);
        $reglas3 = array('ciclo_seccion_id' => 'required');

        $input4  = array('ciclo_curso_id' => $ciclo_curso_id);
        $reglas4 = array('ciclo_curso_id' => 'required');

        $input5  = array('horario_id' => $horario_id);
        $reglas5 = array('horario_id' => 'required');

        $input6  = array('tema' => $tema);
        $reglas6 = array('tema' => 'required');

        $validator1 = Validator::make($input1, $reglas1);
        $validator2 = Validator::make($input2, $reglas2);
        $validator3 = Validator::make($input3, $reglas3);
        $validator4 = Validator::make($input4, $reglas4);
        $validator5 = Validator::make($input5, $reglas5);
        $validator6 = Validator::make($input6, $reglas6);

        if ($validator1->fails())
        {
            $result='0';
            $msj='Debe ingresar la Fecha de Asistencia';
            $selector='txtfecha';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if ($validator2->fails())
        {
            $result='0';
            $msj='Debe de existir un Año Escolar Vigente';
            $selector='ciclo_escolar_id';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if ($validator3->fails())
        {
            $result='0';
            $msj='Debe de remitir la sección del Alumno';
            $selector='ciclo_seccion_id';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if ($validator4->fails())
        {
            $result='0';
            $msj='Debe de remitir el Curo del Alumno';
            $selector='ciclo_curso_id';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if ($validator5->fails())
        {
            $result='0';
            $msj='Debe de remitir el Horario del Alumno';
            $selector='horario_id';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if ($validator6->fails())
        {
            $tema = "";
        }

            $registro = Asistencia::find($id);
            $registro->horario_id=$horario_id;
            $registro->tema=$tema;

            $registro->save();

            $msj='Tema de Día de Asistencia Registrado Exitosamente';

        return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector, 'asistencia_id' => $registro->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result='1';
        $msj='1';

        $registroAsistencias = AsistenciaAlumno::where('asistencia_id', $id)->delete();

        $registro = Asistencia::find($id);
        $registro->delete();      

        $msj='Día de Asistencia eliminado exitosamente';

        return response()->json(["result"=>$result,'msj'=>$msj]);
    }

    public function validarAsistencia(Request $request, $id)
    {

        $alumno_id=$request->alumno_id;
        $name=$request->name;
        $password=$request->password;

        $result='1';
        $msj='';
        $selector='';


        $input1  = array('alumno_id' => $alumno_id);
        $reglas1 = array('alumno_id' => 'required');

        $input2  = array('name' => $name);
        $reglas2 = array('name' => 'required');

        $input3  = array('password' => $password);
        $reglas3 = array('password' => 'required');


        $validator1 = Validator::make($input1, $reglas1);
        $validator2 = Validator::make($input2, $reglas2);
        $validator3 = Validator::make($input3, $reglas3);


        if ($validator1->fails())
        {
            $result='0';
            $msj='Seleccione el Brigradier';
            $selector='cbualumno_id';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if ($validator2->fails())
        {
            $result='0';
            $msj='Debe de Ingresar el Username';
            $selector='txtname';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if ($validator3->fails())
        {
            $result='0';
            $msj='Debe de Ingresar el Password';
            $selector='txtpassword';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        $alumno = Alumno::find($alumno_id);

        if(!$alumno){
            $result='0';
            $msj='El Alumno enviado no es Correcto';
            $selector='cbualumno_id';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        $user = User::find($alumno->user_id);

        if(!$user){
            $result='0';
            $msj='El Alumno no cuenta con un usario customizado';
            $selector='user';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if (
            $user->name != $name ||
            !Hash::check($password, $user->password)
        ) {
            $result='0';
            $msj='El Usuario y/o Contraseña ingresado no son válidos';
            $selector='txtname';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }
                    

            $registro = Asistencia::find($id);
            $registro->alumno_id=$alumno_id;
            $registro->estado='1';

            $registro->save();

            $msj='Asistencia Validada Exitosamente';

        return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector, 'asistencia_id' => $registro->id]);
    }

}
