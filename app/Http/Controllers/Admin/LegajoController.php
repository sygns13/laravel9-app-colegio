<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Validator;
use Auth;

use App\Models\InstitucionEducativa;
use App\Models\User;
use App\Models\Director;

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
        
        return [ 
                'ie' => $ie,
                'user' => $user,
                'director' => $director,
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
            Storage::disk('fotoPerfil')->delete($user->profile_photo_path);

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
