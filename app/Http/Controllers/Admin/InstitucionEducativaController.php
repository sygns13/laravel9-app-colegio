<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Validator;
use Auth;

use App\Models\InstitucionEducativa;
use App\Models\Mensaje;

use stdClass;

class InstitucionEducativaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index1()
    {
        $mensajes = Mensaje::GetNotificaciones();

        return view('admin.ie.index', compact('mensajes'));
    }

    public function index()
    {

        $registro = InstitucionEducativa::where('borrado','0')
                                            ->where('activo','1')
                                            ->first();
        
        return [ 
                'registro' => $registro 
               ];
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
        $result='1';
        $msj='';
        $selector='';

        $codigo_modular=$request->codigo_modular;
        $nombre=$request->nombre;
        $resolucion_creacion=$request->resolucion_creacion;
        $departamento=$request->departamento;
        $nombre_ugel=$request->nombre_ugel;
        $distrito=$request->distrito;
        $provincia=$request->provincia;
        
        $centro_poblado=$request->centro_poblado;
        $direccion=$request->direccion;
        $email=$request->email;
        $telefono=$request->telefono;
        $gestion=$request->gestion;
        $genero=$request->genero;
        $forma=$request->forma;
        $turno=$request->turno;

        $input1  = array('codigo_modular' => $codigo_modular);
        $reglas1 = array('codigo_modular' => 'required');

        $input2  = array('nombre' => $nombre);
        $reglas2 = array('nombre' => 'required');

        $input3  = array('resolucion_creacion' => $resolucion_creacion);
        $reglas3 = array('resolucion_creacion' => 'required');

        $input4  = array('departamento' => $departamento);
        $reglas4 = array('departamento' => 'required');

        $input5  = array('nombre_ugel' => $nombre_ugel);
        $reglas5 = array('nombre_ugel' => 'required');

        $input6  = array('distrito' => $distrito);
        $reglas6 = array('distrito' => 'required');

        $input7  = array('provincia' => $provincia);
        $reglas7 = array('provincia' => 'required');

        $input8  = array('centro_poblado' => $centro_poblado);
        $reglas8 = array('centro_poblado' => 'required');

        $input9  = array('direccion' => $direccion);
        $reglas9 = array('direccion' => 'required');

        $input10  = array('email' => $email);
        $reglas10 = array('email' => 'required');

        $input11  = array('telefono' => $telefono);
        $reglas11 = array('telefono' => 'required');

        $input12  = array('gestion' => $gestion);
        $reglas12 = array('gestion' => 'required');

        $input13  = array('genero' => $genero);
        $reglas13 = array('genero' => 'required');

        $input14  = array('forma' => $forma);
        $reglas14 = array('forma' => 'required');

        $input15  = array('turno' => $turno);
        $reglas15 = array('turno' => 'required');


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

        if ($validator1->fails())
        {
            $result='0';
            $msj='Debe ingresar el Código Modular de la Institución Educativa';
            $selector='txtcodigo_modular';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if ($validator2->fails())
        {
            $result='0';
            $msj='Debe ingresar el nombre de la Institución Educativa';
            $selector='txtnombre';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if ($validator3->fails())
        {
            $result='0';
            $msj='Debe ingresar la Resolución de Creación de la Institución Educativa';
            $selector='txtresolucion_creacion';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        $registro = InstitucionEducativa::find($id);

        $registro->codigo_modular=$codigo_modular;
        $registro->nombre=$nombre;
        $registro->resolucion_creacion=$resolucion_creacion;
        $registro->nombre_ugel=$nombre_ugel;
        $registro->distrito=$distrito;
        $registro->provincia=$provincia;
        $registro->departamento=$departamento;
        $registro->centro_poblado=$centro_poblado;
        $registro->direccion=$direccion;
        $registro->email=$email;
        $registro->telefono=$telefono;
        $registro->gestion=$gestion;
        $registro->genero=$genero;
        $registro->forma=$forma;
        $registro->turno=$turno;

        $registro->save();



        $msj='La Institución Educativa se ha modificado con éxito';

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
