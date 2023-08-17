<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Auth;

use App\Models\TipoUser;
use App\Models\User;
use App\Models\Mensaje;

use stdClass;
use DB;
use Storage;
use PDF;

use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index1()
    {
        /* $cicloActivo = CicloEscolar::GetCicloActivo();

        $estados = Estado::where('activo',1)->where('borrado',0)->orderBy('nombre','asc')->get();
        $departamentos = Departamento::where('activo',1)->where('borrado',0)->orderBy('nombre','asc')->get();
        $provincias = Provincia::where('activo',1)->where('borrado',0)->orderBy('nombre','asc')->get();
        $distritos = Distrito::where('activo',1)->where('borrado',0)->orderBy('nombre','asc')->get();

        $niveles = Niveles::where('activo',1)->where('borrado',0)->orderBy('id','asc')->get();
        $grados = Grado::where('activo',1)->where('borrado',0)->orderBy('orden','asc')->get(); */
        $tipoUsers = TipoUser::where('activo',1)->where('borrado',0)->orderBy('id','asc')->get();
        $mensajes = Mensaje::GetNotificaciones();

        return view('admin.password.index',compact('tipoUsers', 'mensajes'));
    }

    public function indexGetUser(){

        $iduser= Auth::user()->id;
        $user = User::find($iduser);

        $tipouser = TipoUser::find($user->tipo_user_id);

        $user->tipouser = $tipouser;

        return [
            'user'=>$user
        ];

    }

    public function index()
    {
        //
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
        //
    }

    public function UpdatePassword(Request $request)
    {
        $result='1';
        $msj='';
        $selector='';

        $id=$request->id;
        $tipo_user=$request->tipo_user;
        $name=$request->name;
        $email=$request->email;
        $password_old=$request->password_old;
        $password_new1=$request->password_new1;
        $password_new2=$request->password_new2;

        $input1  = array('id' => $id);
        $reglas1 = array('id' => 'required');

        $input2  = array('password_old' => $password_old);
        $reglas2 = array('password_old' => 'required');

        $input3  = array('password_new1' => $password_new1);
        $reglas3 = array('password_new1' => 'required');

        $input4  = array('password_new2' => $password_new2);
        $reglas4 = array('password_new2' => 'required');

        $validator1 = Validator::make($input1, $reglas1);
        $validator2 = Validator::make($input2, $reglas2);
        $validator3 = Validator::make($input3, $reglas3);
        $validator4 = Validator::make($input4, $reglas4);

        if ($validator1->fails() || intval($id) <= 0)
        {
            $result='0';
            $msj='Envíe los datos correctamente';
            $selector='cbuid';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if ($validator2->fails())
        {
            $result='0';
            $msj='Ingrese la Contraseña Anterior';
            $selector='txtpassword';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if ($validator3->fails())
        {
            $result='0';
            $msj='Ingrese la Nueva Contraseña';
            $selector='txtpasswordN1';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if ($validator4->fails())
        {
            $result='0';
            $msj='Ingrese la Nueva Contraseña en el segundo cajon de texto';
            $selector='txtpasswordN2';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if ($password_new1 != $password_new2)
        {
            $result='0';
            $msj='Las Nuevas Contraseñas Indicadas son Diferentes, Por favor Ingrese Correctamente las Contraseñas';
            $selector='txtpasswordN1';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        $userE = User::find($id);

        if (!Hash::check($password_old, $userE->password))
        {
            $result='0';
            $msj='La Contraseña Actual Ingresada No es Correcta, Ingrése una Contraseña Correcta';
            $selector='txtpasswordN1';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        $userE->password=bcrypt($password_new1);          
        $userE->save();


        $msj='Contraseña de Usuario modificado con éxito';

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
        //
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
