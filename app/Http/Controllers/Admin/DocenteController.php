<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Auth;

use App\Models\Docente;
use App\Models\TipoDocumento;
use App\Models\User;
use App\Models\CicloEscolar;
use App\Models\AsignacionCurso;

use stdClass;
use Illuminate\Support\Facades\Hash;
use Storage;


class DocenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index1()
    {
        return view('admin.docente.index');
    }

    public function index2()
    {
        $cicloActivo = CicloEscolar::GetCicloActivo();
        $ciclos = CicloEscolar::GetAllCiclos();
        return view('docente.lista-alumnos.index',compact('cicloActivo', 'ciclos'));
    }

    public function index3()
    {
        $cicloActivo = CicloEscolar::GetCicloActivo();
        $ciclos = CicloEscolar::GetAllCiclos();
        return view('docente.lista-cursos.index',compact('cicloActivo', 'ciclos'));
    }

    public function index(Request $request)
    {
        $response = Docente::GetDocentes($request);

        $tipoDocumentos = TipoDocumento::all();
        $response["tipoDocumentos"] = $tipoDocumentos;


        return $response;
    }

    public function indexDocenteMain()
    {

        $iduser=Auth::user()->id;
        $user = User::find($iduser);

        $docente = Docente::where('borrado','0')
        ->where('user_id',$iduser)
        ->where('activo','1')
        ->first();
        
        return [ 
                'user' => $user,
                'docente' => $docente,
               ];
    }

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
                $msj="El imagen adjunto ingresado tiene un tamaño superior a 10 MB, ingrese otro imagen o limpie el formulario";
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
                    $subir2=Storage::disk('fotoPerfilDocente')->put($nuevoNombre2, \File::get($file));

                if($subir2){
                    $imagen=$nuevoNombre2;
                }
                else{
                    $msj="Error al subir el imagen adjunto, intentelo nuevamente luego";
                    $segureFile=1;
                    $result='0';
                    $selector='imagen';
                }
                }
                else {
                    $segureFile=1;
                    $msj="El imagen adjunto ingresado tiene una extensión no válida, ingrese otro imagen o limpie el formulario";
                    $result='0';
                    $selector='imagen';
                }
            }

        }
        else{
            $msj="Debe de adjuntar un imagen adjunto válido, ingrese un imagen";
            $segureFile=1;
            $result='0';
            $selector='imagen';
        }     

        if($segureFile==1){
            Storage::disk('fotoPerfilDocente')->delete($imagen);
            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }
        else{
            if($user->profile_photo_path != null){
                Storage::disk('fotoPerfilDocente')->delete($user->profile_photo_path);
            }

            $user->profile_photo_path = $imagen;
            $user->save();
           
            $msj='Imagen de Perfil Actualizada Exitosamente';
        }

        return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        
    }

    public function getDocumentos(Request $request)
    {
        $iduser =Auth::user()->id;
        $response = Docente::GetDocumentos($iduser);

        return $response;
    }

    public function getListaAlumnos(Request $request)
    {
        $ciclo_id=$request->ciclo_id;
        $iduser =Auth::user()->id;

        $response = Docente::GetListaAlumnos($iduser, $ciclo_id);

        return $response;
    }

    public function getListaCrusos(Request $request)
    {
        $ciclo_id=$request->ciclo_id;
        $iduser =Auth::user()->id;

        $response = Docente::getListaCrusos($iduser, $ciclo_id);

        return $response;
    }

    public function getListaAlumnosAsignacion(Request $request)
    {
        $id=$request->id;
        $response = Docente::GetListaAlumnosAsignacion($id);

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
        ini_set('memory_limit','256M');
        ini_set('upload_max_filesize','20M');

        $tipo_documento_id=$request->tipo_documento_id;
        $num_documento=$request->num_documento;
        $apellidos=$request->apellidos;
        $nombre=$request->nombre;
        $especialidad=$request->especialidad;
        $genero=$request->genero;
        $telefono=$request->telefono;
        $direccion=$request->direccion;
        $codigo_plaza=$request->codigo_plaza;
        $celular=$request->celular;
        $condicion=$request->condicion;
        $dedicacion=$request->dedicacion;
        $cargo=$request->cargo;

        $name=$request->name;
        $email=$request->email;
        $password=$request->password;
        $activo=$request->activo;

        $result='1';
        $msj='';
        $selector='';


        $input1  = array('tipo_documento_id' => $tipo_documento_id);
        $reglas1 = array('tipo_documento_id' => 'required');

        $input2  = array('num_documento' => $num_documento);
        $reglas2 = array('num_documento' => 'required');

        $input3  = array('apellidos' => $apellidos);
        $reglas3 = array('apellidos' => 'required');

        $input4  = array('nombre' => $nombre);
        $reglas4 = array('nombre' => 'required');

        /* $input2  = array('nombre' => $nombre);
        $reglas2 = array('nombre' => 'unique:zonas,nombre'.',1,borrado'); */

        $input5  = array('genero' => $genero);
        $reglas5 = array('genero' => 'required');

        $input6  = array('codigo_plaza' => $codigo_plaza);
        $reglas6 = array('codigo_plaza' => 'required');

        $input7  = array('name' => $name);
        $reglas7 = array('name' => 'required');

        $input8  = array('email' => $email);
        $reglas8 = array('email' => 'required');

        $input9  = array('password' => $password);
        $reglas9 = array('password' => 'required');

        $input10  = array('activo' => $activo);
        $reglas10 = array('activo' => 'required');

        $input11  = array('telefono' => $telefono);
        $reglas11 = array('telefono' => 'required');

        $input12  = array('celular' => $celular);
        $reglas12 = array('celular' => 'required');

        $input13  = array('condicion' => $condicion);
        $reglas13 = array('condicion' => 'required');

        $input14  = array('dedicacion' => $dedicacion);
        $reglas14 = array('dedicacion' => 'required');

        $input15  = array('cargo' => $cargo);
        $reglas15 = array('cargo' => 'required');

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
        $validator12 = Validator::make($input12, $reglas12);
        $validator13 = Validator::make($input13, $reglas13);
        $validator14 = Validator::make($input14, $reglas14);
        $validator15 = Validator::make($input15, $reglas15);

        if ($validator1->fails() || intval($tipo_documento_id) == 0)
        {
            $result='0';
            $msj='Debe ingresar el Tipo de Documento de Identidad del Docente';
            $selector='cbutipo_documento_id';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        $tipoDocumento = TipoDocumento::find($tipo_documento_id);

        if ($validator2->fails())
        {
            $result='0';
            $msj='Debe de ingresar el Número de '.$tipoDocumento->nombre.' del Docente';
            $selector='txtnum_documento';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if (strlen($num_documento)!=$tipoDocumento->digitos)
        {
            $result='0';
            $msj='El Número de '.$tipoDocumento->nombre.' del Docente debe tener '.$tipoDocumento->digitos.' dígitos';
            $selector='txtnum_documento';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if ($validator3->fails())
        {
            $result='0';
            $msj='Debe ingresar los Apellidos del Docente';
            $selector='txtapellidos';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }
        if ($validator4->fails())
        {
            $result='0';
            $msj='Debe ingresar los Nombres del Docente';
            $selector='txtnombre';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }
        if ($validator5->fails())
        {
            $result='0';
            $msj='Debe ingresar el género del Docente';
            $selector='cbugenero';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }
        if ($validator6->fails())
        {
            $result='0';
            $msj='Debe ingresar el Código de Plaza del Docente';
            $selector='txtcodigo_plaza';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }
        if ($validator7->fails())
        {
            $result='0';
            $msj='Debe ingresar el Username del Docente';
            $selector='txtname';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }
        if ($validator8->fails())
        {
            $result='0';
            $msj='Debe ingresar el Email del Docente';
            $selector='txtemail';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }
        if ($validator9->fails())
        {
            $result='0';
            $msj='Debe ingresar el Password del Docente';
            $selector='txtpassword';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }
        if ($validator10->fails())
        {
            $result='0';
            $msj='Debe ingresar si el usuario del docente está activo o no';
            $selector='cbuactivo';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }
        if ($validator11->fails())
        {
            $result='0';
            $msj='Debe ingresar el Teléfono';
            $selector='txttelefono';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }
        if (strlen($telefono)< 9 || strlen($telefono)> 9)
        {
            $result='0';
            $msj='El teléfono debe de tener un mínimo de 9 dígitos y un máximo de 11';
            $selector='txttelefono';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }
        if ($validator12->fails())
        {
            $result='0';
            $msj='Debe ingresar el Celular';
            $selector='txtcelular';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }
        if (strlen($celular)< 9 || strlen($celular)> 9)
        {
            $result='0';
            $msj='El celular debe de tener un mínimo de 9 dígitos y un máximo de 11';
            $selector='txtcelular';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if ($validator13->fails())
        {
            $result='0';
            $msj='Debe ingresar la Condicion del Docente';
            $selector='txtcondicion';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if ($validator14->fails())
        {
            $result='0';
            $msj='Debe ingresar la Dedicación del Docente';
            $selector='txtdedicacion';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if ($validator15->fails())
        {
            $result='0';
            $msj='Debe ingresar el Cargo del Docente';
            $selector='txtcargo';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }


            $registroA = new User;

            $registroA->name=$name;
            $registroA->email=$email;
            $registroA->password=bcrypt($password);
            $registroA->tipo_user_id='3';
            $registroA->activo=$activo;
            $registroA->borrado='0';

            $registroA->save();

            $registro = new Docente;

            $registro->tipo_documento_id=$tipo_documento_id;
            $registro->num_documento=$num_documento;
            $registro->apellidos=$apellidos;
            $registro->nombre=$nombre;
            $registro->especialidad=$especialidad;
            $registro->genero=$genero;
            $registro->telefono=$telefono;
            $registro->direccion=$direccion;
            $registro->codigo_plaza=$codigo_plaza;
            $registro->celular=$celular;
            $registro->user_id=$registroA->id;
            $registro->activo=$activo;
            $registro->condicion=$condicion;
            $registro->dedicacion=$dedicacion;
            $registro->cargo=$cargo;
            $registro->borrado='0';

            $registro->save();

            $msj='Nuevo Docente Registrado con Éxito';

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
        ini_set('memory_limit','256M');
        ini_set('upload_max_filesize','20M');

        $tipo_documento_id=$request->tipo_documento_id;
        $num_documento=$request->num_documento;
        $apellidos=$request->apellidos;
        $nombre=$request->nombre;
        $especialidad=$request->especialidad;
        $genero=$request->genero;
        $telefono=$request->telefono;
        $direccion=$request->direccion;
        $codigo_plaza=$request->codigo_plaza;
        $celular=$request->celular;
        $condicion=$request->condicion;
        $dedicacion=$request->dedicacion;
        $cargo=$request->cargo;

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

        $input2  = array('num_documento' => $num_documento);
        $reglas2 = array('num_documento' => 'required');

        $input3  = array('apellidos' => $apellidos);
        $reglas3 = array('apellidos' => 'required');

        $input4  = array('nombre' => $nombre);
        $reglas4 = array('nombre' => 'required');

        /* $input2  = array('nombre' => $nombre);
        $reglas2 = array('nombre' => 'unique:zonas,nombre'.',1,borrado'); */

        $input5  = array('genero' => $genero);
        $reglas5 = array('genero' => 'required');

        $input6  = array('codigo_plaza' => $codigo_plaza);
        $reglas6 = array('codigo_plaza' => 'required');

        $input7  = array('name' => $name);
        $reglas7 = array('name' => 'required');

        $input8  = array('email' => $email);
        $reglas8 = array('email' => 'required');

        $input9  = array('password' => $password);
        $reglas9 = array('password' => 'required');

        $input10  = array('activo' => $activo);
        $reglas10 = array('activo' => 'required');

        $input11  = array('email' => $email);
        $reglas11 = array('email' => 'email');

        $input12  = array('telefono' => $telefono);
        $reglas12 = array('telefono' => 'required');

        $input13  = array('celular' => $celular);
        $reglas13 = array('celular' => 'required');

        $input14  = array('condicion' => $condicion);
        $reglas14 = array('condicion' => 'required');

        $input15  = array('dedicacion' => $dedicacion);
        $reglas15 = array('dedicacion' => 'required');

        $input16  = array('cargo' => $cargo);
        $reglas16 = array('cargo' => 'required');

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
        $validator12 = Validator::make($input12, $reglas12);
        $validator13 = Validator::make($input13, $reglas13);
        $validator14 = Validator::make($input14, $reglas14);
        $validator15 = Validator::make($input15, $reglas15);
        $validator16 = Validator::make($input16, $reglas16);

        if ($validator1->fails())
        {
            $result='0';
            $msj='Debe ingresar el Tipo de Documento de Identidad del Docente';
            $selector='cbutipo_documento_id';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        $tipoDocumento = TipoDocumento::find($tipo_documento_id);

        if ($validator2->fails())
        {
            $result='0';
            $msj='Debe de ingresar el Número de '.$tipoDocumento->nombre.' del Docente';
            $selector='txtnum_documento';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if (strlen($num_documento)!=$tipoDocumento->digitos)
        {
            $result='0';
            $msj='El Número de '.$tipoDocumento->nombre.' del Docente debe tener '.$tipoDocumento->digitos.' dígitos';
            $selector='txtnum_documento';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if ($validator3->fails())
        {
            $result='0';
            $msj='Debe ingresar los Apellidos del Docente';
            $selector='txtapellidos';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }
        if ($validator4->fails())
        {
            $result='0';
            $msj='Debe ingresar los Nombres del Docente';
            $selector='txtnombre';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }
        if ($validator5->fails())
        {
            $result='0';
            $msj='Debe ingresar el género del Docente';
            $selector='cbugenero';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }
        if ($validator6->fails())
        {
            $result='0';
            $msj='Debe ingresar el Código de Plaza del Docente';
            $selector='txtcodigo_plaza';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }
        if ($validator7->fails())
        {
            $result='0';
            $msj='Debe ingresar el Username del Docente';
            $selector='txtname';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }
        if ($validator8->fails())
        {
            $result='0';
            $msj='Debe ingresar el Email del Docente';
            $selector='txtemail';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }
        if ($validator9->fails() && intval($modifPsw) == 1)
        {
            $result='0';
            $msj='Debe ingresar el Password del Docente';
            $selector='txtpassword';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if ($validator10->fails())
        {
            $result='0';
            $msj='Debe ingresar si el usuario del docente está activo o no';
            $selector='cbucbuactivo';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }
        if ($validator11->fails())
        {
            $result='0';
            $msj='Debe ingresar un Email válido';
            $selector='txtemail';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }
        if ($validator12->fails())
        {
            $result='0';
            $msj='Debe ingresar el Teléfono';
            $selector='txttelefono';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }
        if (strlen($telefono)< 9 || strlen($telefono)> 9)
        {
            $result='0';
            $msj='El teléfono debe de tener un mínimo de 9 dígitos y un máximo de 11';
            $selector='txttelefono';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }
        if ($validator13->fails())
        {
            $result='0';
            $msj='Debe ingresar el Celular';
            $selector='txtcelular';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }
        if (strlen($celular)< 9 || strlen($celular)> 9)
        {
            $result='0';
            $msj='El celular debe de tener un mínimo de 9 dígitos y un máximo de 11';
            $selector='txtcelular';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if ($validator14->fails())
        {
            $result='0';
            $msj='Debe ingresar la Condicion del Docente';
            $selector='txtcondicion';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if ($validator15->fails())
        {
            $result='0';
            $msj='Debe ingresar la Dedicación del Docente';
            $selector='txtdedicacion';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if ($validator16->fails())
        {
            $result='0';
            $msj='Debe ingresar el Cargo del Docente';
            $selector='txtcargo';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }


            $registro = Docente::find($id);

            $registro->tipo_documento_id=$tipo_documento_id;
            $registro->num_documento=$num_documento;
            $registro->apellidos=$apellidos;
            $registro->nombre=$nombre;
            $registro->especialidad=$especialidad;
            $registro->genero=$genero;
            $registro->telefono=$telefono;
            $registro->direccion=$direccion;
            $registro->codigo_plaza=$codigo_plaza;
            $registro->activo=$activo;
            $registro->celular=$celular;
            $registro->condicion=$condicion;
            $registro->dedicacion=$dedicacion;
            $registro->cargo=$cargo;

            $registro->save();

            $registroA = User::find($registro->user_id);

            $registroA->name=$name;
            $registroA->email=$email;

            if(intval($modifPsw) == 1)
            {
                $registroA->password=bcrypt($password);
            }

            $registroA->activo=$activo;

            $registroA->save();

            $msj='Docente Modificado con Éxito';

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
        $result='1';
        $msj='1';

        $registro = Docente::find($id);
        $registro->borrado='1';
        $registro->save();

        $registroA = User::find($registro->user_id);
        //$task->delete();
        $registroA->borrado='1';
        $registroA->activo='0';
        $registroA->save();

        

        $msj='Docente eliminado exitosamente';

        return response()->json(["result"=>$result,'msj'=>$msj]);
    }

    public function altabaja($id,$estado)
    {
        $result='1';
        $msj='';
        $selector='';

        $registro = Docente::find($id);
        $registro->activo=$estado;
        $registro->save();

        $updateUsuario = User::findOrFail($registro->user_id);
        $updateUsuario->activo=$estado;
        $updateUsuario->save();

        if(strval($estado)=="0"){
            $msj='El Docente fue Desactivado exitosamente';
        }elseif(strval($estado)=="1"){
            $msj='El Docente fue Activado exitosamente';
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

    public function deletePlanAnual($id){

        $result='1';
        $msj='1';

        $data = AsignacionCurso::find($id);

        if($data->plan_anual != null && $data->plan_anual != ""){
            Storage::disk('planAnual')->delete($data->plan_anual);
            $data->plan_anual = null;

            $data->save();   
        }

        $msj='Plan Anual del Curso eliminado exitosamente';

        return response()->json(["result"=>$result,'msj'=>$msj]);
    }

    public function AddPlanAnual(Request $request, $id)
    {
        ini_set('memory_limit','256M');
        ini_set('upload_max_filesize','20M');

        $result='1';
        $msj='';
        $selector='';

        $archivo="";
        $file = $request->archivo;
        $segureFile=0;

        if($request->hasFile('archivo')){

            $nombreArchivo=$request->nombrefile;

            $aux2='planAnual_'.date('d-m-Y').'-'.date('H-i-s');
            $input2  = array('archivo' => $file) ;
            $reglas2 = array('archivo' => 'required|file:1,1024000');
            $validatorF = Validator::make($input2, $reglas2);     

            if ($validatorF->fails())
            {
                $segureFile=1;
                $msj="El archivo adjunto ingresado tiene un tamaño superior a 100 MB, ingrese otro archivo o limpie el formulario";
                $result='0';
                $selector='archivo';
            }
            else
            {
                $nombre2=$file->getClientOriginalName();
                $extension2=$file->getClientOriginalExtension();
                $nuevoNombre2=$aux2.".".$extension2;
                //$subir2=Storage::disk('infoFile')->put($nuevoNombre2, \File::get($file));

                if($extension2=="pdf"|| $extension2=="PDF")
                {

                    $subir2=false;
                    $subir2=Storage::disk('planAnual')->put($nuevoNombre2, \File::get($file));

                if($subir2){
                    $archivo=$nuevoNombre2;
                }
                else{
                    $msj="Error al subir el archivo adjunto, intentelo nuevamente luego";
                    $segureFile=1;
                    $result='0';
                    $selector='archivo';
                }
                }
                else {
                    $segureFile=1;
                    $msj="El archivo adjunto ingresado tiene una extensión no válida, ingrese otro archivo o limpie el formulario";
                    $result='0';
                    $selector='archivo';
                }
            }

        }
        else{
            $msj="Debe de adjuntar un archivo adjunto válido, ingrese un archivo";
            $segureFile=1;
            $result='0';
            $selector='archivo';
        }     

        if($segureFile==1){
            Storage::disk('planAnual')->delete($archivo);
        }
        else{

            $data = AsignacionCurso::find($id);

            if($data->plan_anual != null && $data->plan_anual != ""){
                Storage::disk('planAnual')->delete($data->plan_anual);
            }

            $data->plan_anual = $archivo;;
            $data->save(); 

            $msj='Plan Anual del Curso Actualizado con Éxito';
        }

        return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
    }
}
