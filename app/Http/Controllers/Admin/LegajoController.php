<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Validator;
use Auth;

use App\Models\InstitucionEducativa;
use App\Models\User;
use App\Models\Director;
use App\Models\TipoDocumento;

use stdClass;
use Storage;

class LegajoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $ie = InstitucionEducativa::where('borrado','0')
                                            ->where('activo','1')
                                            ->first();
        
        $iduser=Auth::user()->id;
        $user = User::find($iduser);

        $director = Director::where('borrado','0')
        ->where('user_id',$iduser)
        ->where('activo','1')
        ->first();

        $tipoDocumentos = TipoDocumento::all();
        
        return [ 
                'ie' => $ie,
                'user' => $user,
                'director' => $director,
                'tipoDocumentos' => $tipoDocumentos,
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
                    $subir2=Storage::disk('fotoPerfil')->put($nuevoNombre2, \File::get($file));

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

    public function updatefotomision(Request $request)
    {
        ini_set('memory_limit','256M');

        $result='1';
        $msj='';
        $selector='';

        $ie = InstitucionEducativa::where('borrado','0')
                                            ->where('activo','1')
                                            ->first();


        $imagen="";
        $file = $request->imagen;
        $segureFile=0;

        if($request->hasFile('imagen')){

            $nombreArchivo=$request->nombrefile;

            $aux2='mision_'.date('d-m-Y').'-'.date('H-i-s');
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
                    $subir2=Storage::disk('imgMision')->put($nuevoNombre2, \File::get($file));

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
            Storage::disk('imgMision')->delete($imagen);
            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }
        else{
            Storage::disk('imgMision')->delete($ie->path_mision);

            $ie->path_mision = $imagen;
            $ie->save();
           
            $msj='Imagen de Misión Actualizada Exitosamente';
        }

        return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        
    }

    public function updatefotovision(Request $request)
    {
        ini_set('memory_limit','256M');

        $result='1';
        $msj='';
        $selector='';

        $ie = InstitucionEducativa::where('borrado','0')
                                            ->where('activo','1')
                                            ->first();


        $imagen="";
        $file = $request->imagen;
        $segureFile=0;

        if($request->hasFile('imagen')){

            $nombreArchivo=$request->nombrefile;

            $aux2='vision_'.date('d-m-Y').'-'.date('H-i-s');
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
                    $subir2=Storage::disk('imgVision')->put($nuevoNombre2, \File::get($file));

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
            Storage::disk('imgVision')->delete($imagen);
            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }
        else{
            Storage::disk('imgVision')->delete($ie->path_vision);

            $ie->path_vision = $imagen;
            $ie->save();
           
            $msj='Imagen de Visión Actualizada Exitosamente';
        }

        return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        
    }

    public function updateDirector(Request $request, $id){

        ini_set('memory_limit','256M');
        ini_set('upload_max_filesize','20M');

        $tipo_documento_id=$request->tipo_documento_id;
        $num_documento=$request->num_documento;
        $apellidos=$request->apellidos;
        $nombre=$request->nombre;
        
        $genero=$request->genero;
        $cargo=$request->cargo;
        $telefono=$request->telefono;
        
        
        $condicion=$request->condicion;
        $dedicacion=$request->dedicacion;
        $celular=$request->celular;
        $email=$request->email;

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

        $input5  = array('genero' => $genero);
        $reglas5 = array('genero' => 'required');

        $input6  = array('cargo' => $cargo);
        $reglas6 = array('cargo' => 'required');

        $input7  = array('condicion' => $condicion);
        $reglas7 = array('condicion' => 'required');

        $input8  = array('dedicacion' => $dedicacion);
        $reglas8 = array('dedicacion' => 'required');

        $input9  = array('email' => $email);
        $reglas9 = array('email' => 'required');
        
        $validator1 = Validator::make($input1, $reglas1);
        $validator2 = Validator::make($input2, $reglas2);
        $validator3 = Validator::make($input3, $reglas3);
        $validator4 = Validator::make($input4, $reglas4);
        $validator5 = Validator::make($input5, $reglas5);
        $validator6 = Validator::make($input6, $reglas6);
        $validator7 = Validator::make($input7, $reglas7);
        $validator8 = Validator::make($input8, $reglas8);
        $validator9 = Validator::make($input9, $reglas9);
        
        if ($validator1->fails())
        {
            $result='0';
            $msj='Debe ingresar el Tipo de Documento de Identidad del Director';
            $selector='cbutipo_documento_id';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        $tipoDocumento = TipoDocumento::find($tipo_documento_id);

        if ($validator2->fails())
        {
            $result='0';
            $msj='Debe de ingresar el Número de '.$tipoDocumento->nombre.' del Director';
            $selector='txtnum_documento';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if (strlen($num_documento)!=$tipoDocumento->digitos)
        {
            $result='0';
            $msj='El Número de '.$tipoDocumento->nombre.' del Director debe tener '.$tipoDocumento->digitos.' dígitos';
            $selector='txtnum_documento';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if ($validator3->fails())
        {
            $result='0';
            $msj='Debe ingresar los Apellidos del Director';
            $selector='txtapellidos';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }
        if ($validator4->fails())
        {
            $result='0';
            $msj='Debe ingresar los Nombres del Director';
            $selector='txtnombre';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }
        if ($validator5->fails())
        {
            $result='0';
            $msj='Debe ingresar el género del Director';
            $selector='cbugenero';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }
        if ($validator6->fails())
        {
            $result='0';
            $msj='Debe ingresar el Cargo de Plaza del Director';
            $selector='txtcargo';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }
        if ($validator7->fails())
        {
            $result='0';
            $msj='Debe ingresar la Condición del Director';
            $selector='txtcondicion';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }
        if ($validator8->fails())
        {
            $result='0';
            $msj='Debe ingresar la Dedicación del Director';
            $selector='txtdedicacion';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }
        if ($validator9->fails())
        {
            $result='0';
            $msj='Debe ingresar el Email del Director';
            $selector='txtemail';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        $registro = Director::find($id);

        $registro->tipo_documento_id=$tipo_documento_id;
        $registro->num_documento=$num_documento;
        $registro->apellidos=$apellidos;
        $registro->nombre=$nombre;
        $registro->genero=$genero;
        $registro->cargo=$cargo;
        $registro->condicion=$condicion;
        $registro->dedicacion=$dedicacion;
        $registro->celular=$celular;
        $registro->email=$email;
        $registro->telefono=$telefono;

        $registro->save();

        $registroA = User::find($registro->user_id);

        $registroA->email=$email;

        $registroA->save();

        $msj='Datos del Director Actualizados con Éxito';

        return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);

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
