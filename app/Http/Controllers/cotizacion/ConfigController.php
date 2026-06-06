<?php

namespace App\Http\Controllers\cotizacion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Validator;
use Auth;

use App\Models\Config;

use stdClass;

class ConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function index1()
    {

        return view('yamaha.config.index');
    }

    public function index()
    {
        $tipoCambio = Config::first();
        $tipoCambio->tipoCambioFormat = number_format($tipoCambio->tipo_cambio, 2, '.', '');

        return [ 
        'tipoCambio' => $tipoCambio 
        ];
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        $result='1';
        $msj='';
        $selector='';

        $tipo_cambio=$request->tipoCambioFormat;

        $input1  = array('tipo_cambio' => $tipo_cambio);
        $reglas1 = array('tipo_cambio' => 'required');

        $validator1 = Validator::make($input1, $reglas1);

        if ($validator1->fails())
        {
            $result='0';
            $msj='Debe ingresar el Tipo de Cambio';
            $selector='txttipoCambioFormat';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if(floatval($tipo_cambio)<=0)
        {
            $result='0';
            $msj='El Tipo de Cambio debe ser mayor a 0';
            $selector='txttipoCambioFormat';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        $tipoCambio = Config::first();

        $tipoCambio->tipo_cambio = $tipo_cambio;

        $tipoCambio->save();

        $msj='El Tipo de Cambio se actualizó correctamente';

        return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
