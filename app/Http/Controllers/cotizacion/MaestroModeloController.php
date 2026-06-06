<?php

namespace App\Http\Controllers\cotizacion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use App\Models\Cotizacion;
use App\Models\TipoDocumento;
use App\Models\Config;
use App\Models\MaestroModelo;

use stdClass;
use DB;
use Storage;
use PDF;
use Validator;
use Auth;


class MaestroModeloController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function buscarModelo($maestro_modelo_id){

        $result='1';
        $msj='';
        $selector='';

        $input1  = array('maestro_modelo_id' => $maestro_modelo_id);
        $reglas1 = array('maestro_modelo_id' => 'required');

        $validator1 = Validator::make($input1, $reglas1);

        if ($validator1->fails() || intval($maestro_modelo_id) == 0)
        {
            $result='0';
            $msj='Debe de seleccionar un Modelo Válido';
            $selector='cbucolor';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        $maestroModelo = MaestroModelo::find($maestro_modelo_id);

        $resultFound = false;
        if($maestroModelo){
            $resultFound = true;
            $msj='Modelo encontrado en el Sistema';

            $maestroModelo->precioIni = number_format($maestroModelo->precio_usd, 2, '.', '');
            $maestroModelo->precioDto = number_format($maestroModelo->descuento_usd, 2, '.', '');
            $maestroModelo->precioFin = number_format($maestroModelo->precio_final_usd, 2, '.', '');
        }

        return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector ,'maestroModelo'=>$maestroModelo, 'resultFound' => $resultFound]);

    }


    public function index()
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
