<?php

namespace App\Http\Controllers\cotizacion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Auth;

use App\Models\Personal;
use App\Models\TipoDocumento;
use App\Models\TipoUser;
use App\Models\User;

use stdClass;
use Illuminate\Support\Facades\Hash;
use Storage;

class PersonalController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function index1()
    {
        $tipoDocumentos = TipoDocumento::where('activo', 1)->where('borrado', 0)->orderBy('id','asc')->get();
        $tipoUsers = TipoUser::where('activo', 1)->where('borrado', 0)->orderBy('id','asc')->get();

        return view('yamaha.personal.index', compact('tipoDocumentos', 'tipoUsers'));
    }

    public function index(Request $request)
    {
        $response = Personal::GetPersonal($request);

        $tipoDocumentos = TipoDocumento::all();
        $response["tipoDocumentos"] = $tipoDocumentos;


        return $response;
    }

    /**
     * Show the form for creating a new resource.
     */


     public function updatefotoperfil(Request $request)
    {
        ini_set('memory_limit','256M');

        $result='1';
        $msj='';
        $selector='';

        $iduser=Auth::user()->id;
        $user = User::find($iduser);


        $imagen="";
        $file = $request->imagen;
        $segureFile=0;

        if($request->hasFile('imagen')){

            $nombreArchivo=$request->nombrefile;

            $aux2='perfil_'.date('d-m-Y').'-'.date('H-i-s');
            $input2  = array('imagen' => $file) ;
            $reglas2 = array('imagen' => 'required|file:1,10000');
            $validatorF = Validator::make($input2, $reglas2);     

            if ($validatorF->fails())
            {
                $segureFile=1;
                $msj="La imagen adjunta ingresada tiene un tamaño superior a 10 MB, ingrese otro imagen o limpie el formulario";
                $result='0';
                $selector='imagen';
            }
            else
            {
                $nombre2=$file->getClientOriginalName();
                $extension2=$file->getClientOriginalExtension();
                $nuevoNombre2=$aux2.".".$extension2;
                //$subir2=Storage::disk('infoFile')->put($nuevoNombre2, \File::get($file));

                if($extension2=="png"|| $extension2=="jpg"|| $extension2=="jpeg"|| $extension2=="gif"|| $extension2=="jpe"|| $extension2=="PNG"|| $extension2=="JPG"|| $extension2=="JPEG"|| $extension2=="GIF"|| $extension2=="JPE")
                {

                    $subir2=false;
                    $subir2=Storage::disk('fotoPerfil')->put($nuevoNombre2, \File::get($file));

                if($subir2){
                    $imagen=$nuevoNombre2;
                }
                else{
                    $msj="Error al subir la imagen adjunta, intentelo nuevamente luego";
                    $segureFile=1;
                    $result='0';
                    $selector='imagen';
                }
                }
                else {
                    $segureFile=1;
                    $msj="La imagen adjunta ingresada tiene una extensión no válida, ingrese otro imagen o limpie el formulario";
                    $result='0';
                    $selector='imagen';
                }
            }

        }
        else{
            $msj="Debe de adjuntar un imagen adjunta válida, ingrese un imagen";
            $segureFile=1;
            $result='0';
            $selector='imagen';
        }     

        if($segureFile==1){
            Storage::disk('fotoPerfil')->delete($imagen);
            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }
        else{
            if($user->profile_photo_path != null){
                Storage::disk('fotoPerfil')->delete($user->profile_photo_path);
            }

            $user->profile_photo_path = $imagen;
            $user->save();
           
            $msj='Imagen de Perfil Actualizada Exitosamente';
        }

        return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        
    }

    

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        ini_set('memory_limit','256M');
        ini_set('upload_max_filesize','20M');

        $tipo_documento_id=$request->tipo_documento_id;
        $documento=$request->documento;
        $apellidos=$request->apellidos;
        $nombres=$request->nombres;
        $empresa=$request->empresa;
        $celular=$request->celular;
        $correo=$request->email;

        $tipo_user_id=$request->tipo_user_id;
        $name=$request->name;
        $email=$request->email;
        $password=$request->password;
        $activo=$request->activo;

        $result='1';
        $msj='';
        $selector='';


        $input1  = array('tipo_documento_id' => $tipo_documento_id);
        $reglas1 = array('tipo_documento_id' => 'required');

        $input2  = array('documento' => $documento);
        $reglas2 = array('documento' => 'required');

        $input3  = array('apellidos' => $apellidos);
        $reglas3 = array('apellidos' => 'required');

        $input4  = array('nombres' => $nombres);
        $reglas4 = array('nombres' => 'required');

        /* $input2  = array('nombres' => $nombres);
        $reglas2 = array('nombres' => 'unique:zonas,nombres'.',1,borrado'); */

        $input5  = array('empresa' => $empresa);
        $reglas5 = array('empresa' => 'required');

        $input6  = array('celular' => $celular);
        $reglas6 = array('celular' => 'required');

        $input7  = array('correo' => $correo);
        $reglas7 = array('correo' => 'required');

        $input8  = array('tipo_user_id' => $tipo_user_id);
        $reglas8 = array('tipo_user_id' => 'required');

        $input9  = array('password' => $password);
        $reglas9 = array('password' => 'required');

        $input10  = array('activo' => $activo);
        $reglas10 = array('activo' => 'required');

        $input11  = array('name' => $name);
        $reglas11 = array('name' => 'required');



        $validator1 = Validator::make($input1, $reglas1);
        $validator2 = Validator::make($input2, $reglas2);
        $validator3 = Validator::make($input3, $reglas3);
        $validator4 = Validator::make($input4, $reglas4);
        $validator5 = Validator::make($input5, $reglas5);
        $validator6 = Validator::make($input6, $reglas6);
        $validator7 = Validator::make($input7, $reglas7);
        $validator8 = Validator::make($input8, $reglas8);
        $validator9 = Validator::make($input9, $reglas9);
        $validator10 = Validator::make($input10, $reglas10);
        $validator11 = Validator::make($input11, $reglas11);


        if ($validator1->fails() || intval($tipo_documento_id) == 0)
        {
            $result='0';
            $msj='Debe ingresar el Tipo de Documento de Identidad del Usuario';
            $selector='cbutipo_documento_id';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        $tipoDocumento = TipoDocumento::find($tipo_documento_id);

        if ($validator2->fails())
        {
            $result='0';
            $msj='Debe de ingresar el Número de '.$tipoDocumento->nombre.' del Usuario';
            $selector='txtdocumento';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        /* if (strlen($documento)!=$tipoDocumento->digitos)
        {
            $result='0';
            $msj='El Número de '.$tipoDocumento->nombre.' del Usuario debe tener '.$tipoDocumento->digitos.' dígitos';
            $selector='txtdocumento';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        } */

        if ($validator3->fails())
        {
            $result='0';
            $msj='Debe ingresar los Apellidos del Usuario';
            $selector='txtapellidos';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }
        if ($validator4->fails())
        {
            $result='0';
            $msj='Debe ingresar los Nombres del Usuario';
            $selector='txtnombres';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }
        if ($validator5->fails())
        {
            $result='0';
            $msj='Debe ingresar la Empresa del Usuario';
            $selector='txtempresa';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }
        if ($validator6->fails())
        {
            $result='0';
            $msj='Debe ingresar el Celular del Usuario';
            $selector='txtcelular';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }
        if ($validator8->fails())
        {
            $result='0';
            $msj='Debe de seleccionar un Tipo de Usuario Válido';
            $selector='cbutipo_user_id';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }
        if ($validator11->fails())
        {
            $result='0';
            $msj='Debe ingresar el Username del Usuario';
            $selector='txtname';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }
        if ($validator7->fails())
        {
            $result='0';
            $msj='Debe ingresar el Correo Electrónico del Usuario';
            $selector='txtemail';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }
        if ($validator9->fails())
        {
            $result='0';
            $msj='Debe ingresar el Password del Usuario';
            $selector='txtpassword';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }
        if ($validator10->fails())
        {
            $result='0';
            $msj='Debe ingresar si el usuario está activo o no';
            $selector='cbuactivo';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }
        

      /*   if (strlen($celular)< 9 || strlen($celular)> 9)
        {
            $result='0';
            $msj='El celular debe de tener un mínimo de 9 dígitos y un máximo de 11';
            $selector='txtcelular';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        } */


            $registroA = new User;

            $registroA->name=$name;
            $registroA->email=$email;
            $registroA->password=bcrypt($password);
            $registroA->tipo_user_id=$tipo_user_id;
            $registroA->activo=$activo;
            $registroA->borrado='0';
            $registroA->profile_photo_path='user_image.png';

            $registroA->save();

            $registro = new Personal;

            $registro->user_id=$registroA->id;
            $registro->nombres=$nombres;
            $registro->apellidos=$apellidos;
            $registro->celular=$celular;
            $registro->correo=$correo;
            $registro->tipo_documento_id=$tipo_documento_id;
            $registro->documento=$documento;
            $registro->empresa=$empresa;
            $registro->activo=$activo;
            $registro->borrado='0';

            $registro->save();

            $msj='Nuevo Usuario Registrado con Éxito';

        return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        ini_set('memory_limit','256M');
        ini_set('upload_max_filesize','20M');

        $tipo_documento_id=$request->tipo_documento_id;
        $documento=$request->documento;
        $apellidos=$request->apellidos;
        $nombres=$request->nombres;
        $empresa=$request->empresa;
        $celular=$request->celular;
        $correo=$request->email;

        $tipo_user_id=$request->tipo_user_id;
        $name=$request->name;
        $email=$request->email;
        $password=$request->password;
        $activo=$request->activo;
        $modifPsw = $request->modifPsw;

        $result='1';
        $msj='';
        $selector='';


        $input1  = array('tipo_documento_id' => $tipo_documento_id);
        $reglas1 = array('tipo_documento_id' => 'required');

        $input2  = array('documento' => $documento);
        $reglas2 = array('documento' => 'required');

        $input3  = array('apellidos' => $apellidos);
        $reglas3 = array('apellidos' => 'required');

        $input4  = array('nombres' => $nombres);
        $reglas4 = array('nombres' => 'required');

        /* $input2  = array('nombres' => $nombres);
        $reglas2 = array('nombres' => 'unique:zonas,nombres'.',1,borrado'); */

        $input5  = array('empresa' => $empresa);
        $reglas5 = array('empresa' => 'required');

        $input6  = array('celular' => $celular);
        $reglas6 = array('celular' => 'required');

        $input7  = array('correo' => $correo);
        $reglas7 = array('correo' => 'required');

        $input8  = array('tipo_user_id' => $tipo_user_id);
        $reglas8 = array('tipo_user_id' => 'required');

        $input9  = array('password' => $password);
        $reglas9 = array('password' => 'required');

        $input10  = array('activo' => $activo);
        $reglas10 = array('activo' => 'required');

        $input11  = array('name' => $name);
        $reglas11 = array('name' => 'required');



        $validator1 = Validator::make($input1, $reglas1);
        $validator2 = Validator::make($input2, $reglas2);
        $validator3 = Validator::make($input3, $reglas3);
        $validator4 = Validator::make($input4, $reglas4);
        $validator5 = Validator::make($input5, $reglas5);
        $validator6 = Validator::make($input6, $reglas6);
        $validator7 = Validator::make($input7, $reglas7);
        $validator8 = Validator::make($input8, $reglas8);
        $validator9 = Validator::make($input9, $reglas9);
        $validator10 = Validator::make($input10, $reglas10);
        $validator11 = Validator::make($input11, $reglas11);


        if ($validator1->fails() || intval($tipo_documento_id) == 0)
        {
            $result='0';
            $msj='Debe ingresar el Tipo de Documento de Identidad del Usuario';
            $selector='cbutipo_documento_id';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        $tipoDocumento = TipoDocumento::find($tipo_documento_id);

        if ($validator2->fails())
        {
            $result='0';
            $msj='Debe de ingresar el Número de '.$tipoDocumento->nombre.' del Usuario';
            $selector='txtdocumento';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        /* if (strlen($documento)!=$tipoDocumento->digitos)
        {
            $result='0';
            $msj='El Número de '.$tipoDocumento->nombre.' del Usuario debe tener '.$tipoDocumento->digitos.' dígitos';
            $selector='txtdocumento';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        } */

        if ($validator3->fails())
        {
            $result='0';
            $msj='Debe ingresar los Apellidos del Usuario';
            $selector='txtapellidos';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }
        if ($validator4->fails())
        {
            $result='0';
            $msj='Debe ingresar los Nombres del Usuario';
            $selector='txtnombres';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }
        if ($validator5->fails())
        {
            $result='0';
            $msj='Debe ingresar la Empresa del Usuario';
            $selector='txtempresa';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }
        if ($validator6->fails())
        {
            $result='0';
            $msj='Debe ingresar el Celular del Usuario';
            $selector='txtcelular';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }
        if ($validator8->fails())
        {
            $result='0';
            $msj='Debe de seleccionar un Tipo de Usuario Válido';
            $selector='cbutipo_user_id';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }
        if ($validator11->fails())
        {
            $result='0';
            $msj='Debe ingresar el Username del Usuario';
            $selector='txtname';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }
        if ($validator7->fails())
        {
            $result='0';
            $msj='Debe ingresar el Correo Electrónico del Usuario';
            $selector='txtemail';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }
        if ($validator9->fails() && intval($modifPsw) == 1)
        {
            $result='0';
            $msj='Debe ingresar el Password del Usuario';
            $selector='txtpassword';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }
        if ($validator10->fails())
        {
            $result='0';
            $msj='Debe ingresar si el usuario está activo o no';
            $selector='cbuactivo';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }
        

      /*   if (strlen($celular)< 9 || strlen($celular)> 9)
        {
            $result='0';
            $msj='El celular debe de tener un mínimo de 9 dígitos y un máximo de 11';
            $selector='txtcelular';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        } */




            $registro = Personal::find($id);

            $registro->nombres=$nombres;
            $registro->apellidos=$apellidos;
            $registro->celular=$celular;
            $registro->correo=$correo;
            $registro->tipo_documento_id=$tipo_documento_id;
            $registro->documento=$documento;
            $registro->empresa=$empresa;
            $registro->activo=$activo;

            $registro->save();

            $registroA = User::find($registro->user_id);

            $registroA->tipo_user_id=$tipo_user_id;
            $registroA->name=$name;
            $registroA->email=$email;
            $registroA->activo=$activo;

            if(intval($modifPsw) == 1)
            {
                $registroA->password=bcrypt($password);
            }

            $registroA->save();

            $msj='Usuario Modificado con Éxito';

        return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $result='1';
        $msj='1';

        $registro = Personal::find($id);
        $registro->borrado='1';
        $registro->save();

        $registroA = User::find($registro->user_id);
        //$task->delete();
        $registroA->borrado='1';
        $registroA->activo='0';
        $registroA->save();

        

        $msj='Usuario eliminado exitosamente';

        return response()->json(["result"=>$result,'msj'=>$msj]);
    }

    public function altabaja($id,$estado)
    {
        $result='1';
        $msj='';
        $selector='';

        $registro = Personal::find($id);
        $registro->activo=$estado;
        $registro->save();

        $updateUsuario = User::findOrFail($registro->user_id);
        $updateUsuario->activo=$estado;
        $updateUsuario->save();

        if(strval($estado)=="0"){
            $msj='El Usuario fue Desactivado exitosamente';
        }elseif(strval($estado)=="1"){
            $msj='El Usuario fue Activado exitosamente';
        }

        return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);

    }

    public function generateusername(Request $request)
    {
        $result='1';
        $msj='';
        $selector='';

        $_username = $request->_username;

        $username = User::GenerateUsername($_username);

        return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector ,'username'=>$username]);

    }
}
