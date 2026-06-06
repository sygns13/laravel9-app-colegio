<?php

namespace App\Http\Controllers\cotizacion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use App\Models\Cotizacion;
use App\Models\TipoDocumento;
use App\Models\Config;
use App\Models\Cliente;

use stdClass;
use DB;
use Storage;
use PDF;
use Validator;
use Auth;


class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function buscarCliente($tipo_documento_id, $num_documento){

        $result='1';
        $msj='';
        $selector='';

        $input1  = array('tipo_documento_id' => $tipo_documento_id);
        $reglas1 = array('tipo_documento_id' => 'required');

        $input2  = array('num_documento' => $num_documento);
        $reglas2 = array('num_documento' => 'required');

        $validator1 = Validator::make($input1, $reglas1);
        $validator2 = Validator::make($input2, $reglas2);

        if ($validator1->fails() || intval($tipo_documento_id) == 0)
        {
            $result='0';
            $msj='Debe de seleccionar un tipo de Documento Válido';
            $selector='cbutipo_documento_id';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        $tipoDocumento = TipoDocumento::find($tipo_documento_id);

        if ($validator2->fails())
        {
            $result='0';
            $msj='Debe de ingresar el Número de '.$tipoDocumento->nombre.' del Cliente';
            $selector='txtnum_documento';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        /* if (strlen($num_documento) < $tipoDocumento->digitos)
        {
            $result='0';
            $msj='El Número de '.$tipoDocumento->nombre.' del Cliente debe tener '.$tipoDocumento->digitos.' dígitos';
            $selector='txtnum_documento';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        } */

        $data = Cliente::GetByDocIdentidad($tipo_documento_id, $num_documento);
        $resultFound = false;
        if($data){
            $resultFound = true;
            $msj='Alumno encontrado en el Sistema';
        }

        return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector ,'cliente'=>$data, 'resultFound' => $resultFound]);

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
