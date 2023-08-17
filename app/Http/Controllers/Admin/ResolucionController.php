<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use App\Models\Resolucion;
use App\Models\Mensaje;

use stdClass;
use DB;
use Storage;
use PDF;
use Validator;
use Auth;


class ResolucionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function index1()
    {
        $isAdmin = false;

        if (Gate::allows('admin') || Gate::allows('director')) {
            $isAdmin = true;
        }

        $mensajes = Mensaje::GetNotificaciones();

        return view('admin.resolucion.index',compact('isAdmin', 'mensajes'));
    }

    public function indexGetData1(Request $request)
    {

        $registros = Resolucion::GetCrudData1($request);
        
        return $registros;
    }

    public function indexGetData2(Request $request)
    {

        $registros = Resolucion::GetCrudData2($request);
        
        return $registros;
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

        $tipo=$request->tipo;
        $nombre=$request->nombre;
        $year=$request->year;

        $archivo="";
        $file = $request->archivo;
        $segureFile=0;

        $result='1';
        $msj='';
        $selector='';

        $input1  = array('tipo' => $tipo);
        $reglas1 = array('tipo' => 'required');

        $input2  = array('nombre' => $nombre);
        $reglas2 = array('nombre' => 'required');

        $input3  = array('year' => $year);
        $reglas3 = array('year' => 'required');


        $validator1 = Validator::make($input1, $reglas1);
        $validator2 = Validator::make($input2, $reglas2);
        $validator3 = Validator::make($input3, $reglas3);

        if ($validator1->fails())
        {
            $result='0';
            $msj='Debe ingresar el Tipo de Resolución';
            $selector='txttipo';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if (intval($tipo) <= 0)
        {
            $result='0';
            $msj='Debe seleccionar el Tipo de Resolución';
            $selector='txttipo';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if ($validator2->fails())
        {
            $result='0';
            $msj='Debe ingresar el Nombre de la Resolución';
            $selector='txtnombre';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if ($validator3->fails())
        {
            $result='0';
            $msj='Debe ingresar el Año de la Resolución';
            $selector='txtyear';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if (intval($year) <= 0)
        {
            $result='0';
            $msj='Debe ingresar un Año de la Resolución Válido';
            $selector='txtyear';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        $year = intval($year);
        $tipo = intval($tipo);

        if($request->hasFile('archivo')){

            $nombreArchivo=$request->nombrefile;

            $aux2='res_'.date('d-m-Y').'-'.date('H-i-s');
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
                    $subir2=Storage::disk('resolucion')->put($nuevoNombre2, \File::get($file));

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

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }  

        if($segureFile==1){
            Storage::disk('resolucion')->delete($archivo);
            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }
      

            $registro = new Resolucion;

            $registro->tipo=$tipo;
            $registro->nombre=$nombre;
            $registro->year=$year;
            $registro->archivo=$archivo;
            $registro->activo='1';
            $registro->borrado='0';

            $registro->save();

            $msj='Nueva Resolución Registrada con Éxito';

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

        $tipo=$request->tipo;
        $nombre=$request->nombre;
        $year=$request->year;

        $archivo="";
        $file = $request->archivo;
        $segureFile=0;

        $result='1';
        $msj='';
        $selector='';

        $input1  = array('tipo' => $tipo);
        $reglas1 = array('tipo' => 'required');

        $input2  = array('nombre' => $nombre);
        $reglas2 = array('nombre' => 'required');

        $input3  = array('year' => $year);
        $reglas3 = array('year' => 'required');


        $validator1 = Validator::make($input1, $reglas1);
        $validator2 = Validator::make($input2, $reglas2);
        $validator3 = Validator::make($input3, $reglas3);

        if ($validator1->fails())
        {
            $result='0';
            $msj='Debe ingresar el Tipo de Resolución';
            $selector='txttipo';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if (intval($tipo) <= 0)
        {
            $result='0';
            $msj='Debe seleccionar el Tipo de Resolución';
            $selector='txttipo';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if ($validator2->fails())
        {
            $result='0';
            $msj='Debe ingresar el Nombre de la Resolución';
            $selector='txtnombre';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if ($validator3->fails())
        {
            $result='0';
            $msj='Debe ingresar el Año de la Resolución';
            $selector='txtyear';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if (intval($year) <= 0)
        {
            $result='0';
            $msj='Debe ingresar unn Año de la Resolución Válido';
            $selector='txtyear';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        $year = intval($year);
        $tipo = intval($tipo);

        if($request->hasFile('archivo')){

            $nombreArchivo=$request->nombrefile;

            $aux2='res_'.date('d-m-Y').'-'.date('H-i-s');
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
                    $subir2=Storage::disk('resolucion')->put($nuevoNombre2, \File::get($file));

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
            $segureFile=2;
        }  

        if($segureFile==1){
            Storage::disk('resolucion')->delete($archivo);
            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }
      

            $registro = Resolucion::find($id);

            if($segureFile == 0){
                Storage::disk('resolucion')->delete($archivo);
            }
            if($segureFile == 2){
                $archivo = $registro->archivo;
            }

            $registro->tipo=$tipo;
            $registro->nombre=$nombre;
            $registro->year=$year;
            $registro->archivo=$archivo;
            $registro->activo='1';
            $registro->borrado='0';

            $registro->save();

            $msj='Resolución Modificada con Éxito';

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

        $registro = Resolucion::find($id);
        $registro->borrado='1';
        $registro->save();
     
        $msj='Resolución eliminada exitosamente';

        return response()->json(["result"=>$result,'msj'=>$msj]);
    }
}
