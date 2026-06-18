<?php

namespace App\Http\Controllers\cotizacion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use App\Models\Cotizacion;
use App\Models\TipoDocumento;
use App\Models\Config;
use App\Models\MaestroModelo;

use App\Models\Cliente;
use App\Models\Personal;
use App\Models\DataCotizacion;

use App\Models\MaestroBeneficio;
use App\Models\Garantia;
use App\Models\Beneficio;
use App\Models\Includes;

use App\Exports\Reporte1Export;
use Maatwebsite\Excel\Facades\Excel;

use stdClass;
use DB;
use Storage;
use PDF;
use Validator;
use Auth;

class CotizacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function pasFechaVista($fecha)
        {	
            $fechadev="";
            if(strlen($fecha)==10)
            {
            $fechadev=substr($fecha, -2).'/'.substr($fecha, -5,2).'/'.substr($fecha, -10,4);
            }
            return $fechadev;
        }

     public function export(Request $request) 
    {
        $fechaIni=$request->fechaIni;
        $fechaFin=$request->fechaFin;
        $year=$request->year;
        $numero=$request->numero;
        $tipo_documento_id=$request->tipo_documento_id;
        $documento=$request->documento;


        $data=[];
        $response = Cotizacion::GetDataExport($request);

        $titulo='REPORTE DE COTIZACIONES';

        array_push($data, array($titulo));
        array_push($data, array(''));

        $cont = 1;

        array_push($data, array('Filtros de Búsqueda:'));

        if(isset($fechaIni) && !empty($fechaIni) && isset($fechaFin) && !empty($fechaFin)){
            array_push($data, array('','Fecha de Inicial: ', $this->pasFechaVista($fechaIni), 'Fecha Final: ', $this->pasFechaVista($fechaIni)));
            $cont++;
        }
        if((isset($year) && !empty($year) && intval($year) > 0) || (isset($numero) && !empty($numero))){
            array_push($data, array('','Año de Cotización: ', $year, 'Número de Cotización: ', $numero));
            $cont++;
        }

        $tipoDocumento = "Todos";
        if(isset($tipo_documento_id) && !empty($tipo_documento_id) && intval($tipo_documento_id) > 0){
            $tipoDocumentoBD = TipoDocumento::find($tipo_documento_id);
            $tipoDocumento = $tipoDocumentoBD->sigla;
        }
        array_push($data, array('','Tipo de Documento Cliente: ', $tipoDocumento, 'Número de Documento Cliente: ', $documento));
        $cont++;

        $cont = $cont + 3;

        array_push($data, array('N°','Empresa', 'Cotizador', 'Documento de Cotizador', 'Número de Cotización','Fecha de Cotización','Código de la Motocicleta','Modelo de la Motocicleta','Año de la Motocicleta','Color de la Motocicleta', 'Precio U$', 'Descuento U$', 'Precio Final U$', 'Tipo de Cambio S/', 'Precio Final S/', 'Cliente', 'Documento de Cliente', 'Celular de Cliente', 'Correo de Cliente'));

        //return response()->json($response);

        foreach ($response["registros"] as $key => $dato) {
            array_push($data, array($key+1,
            $dato->personal_empresa,
            $dato->personal_nombres.' '. $dato->personal_apellidos,
            $dato->tpP_sigla.' '. $dato->personal_documento,
            $dato->year.'-'.$dato->numero,
            $this->pasFechaVista($dato->fecha).' '.$dato->hora,
            $dato->data_cotizacions_codigo,
            $dato->modelo,
            $dato->data_cotizacions_year,
            $dato->data_cotizacions_color_comercial,
            $dato->precioIni,
            $dato->precioDto,
            $dato->precioFin,
            $dato->tipoCambio,
            $dato->precioFinPen,
            $dato->cli_nombres.' '. $dato->cli_apellidos,
            $dato->tpC_sigla.' '. $dato->cli_documento,
            $dato->cli_celular,
            $dato->cli_correo                     
            ));
        }

        $export = new Reporte1Export($data, $cont);

        return Excel::download($export, 'reporte_cotizaciones.xlsx');
    }

     public function index1()
    {
        $isAdmin = false;

        if (Gate::allows('admin')) {
            $isAdmin = true;
        }

        $tipoDocumentos = TipoDocumento::where('activo', 1)->where('borrado', 0)->orderBy('id','asc')->get();

        $tipoCambio = Config::first();

        $modelos = DB::table('maestro_modelos')
                   ->select('maestro_modelos.id', 'maestro_modelos.modelo')
                   ->where('maestro_modelos.borrado','0')
                   ->where('maestro_modelos.activo','1')
                   ->groupBy('maestro_modelos.modelo')
                   ->orderBy('maestro_modelos.modelo')
                   ->get();

        $years = DB::table('maestro_modelos')
                   ->select('maestro_modelos.id', 'maestro_modelos.modelo', 'maestro_modelos.year')
                   ->where('maestro_modelos.borrado','0')
                   ->where('maestro_modelos.activo','1')
                   ->groupBy('maestro_modelos.modelo')
                   ->groupBy('maestro_modelos.year')
                   ->orderBy('maestro_modelos.modelo')
                   ->orderBy('maestro_modelos.year')
                   ->get();

        $colors = DB::table('maestro_modelos')
                   ->select('maestro_modelos.id', 'maestro_modelos.modelo', 'maestro_modelos.year', 'maestro_modelos.color_comercial', 'maestro_modelos.precio_usd', 'maestro_modelos.descuento_usd', 'maestro_modelos.precio_final_usd')
                   ->where('maestro_modelos.borrado','0')
                   ->where('maestro_modelos.activo','1')
                   ->groupBy('maestro_modelos.modelo')
                   ->groupBy('maestro_modelos.year')
                   ->groupBy('maestro_modelos.color_comercial')
                   ->orderBy('maestro_modelos.modelo')
                   ->orderBy('maestro_modelos.year')
                   ->orderBy('maestro_modelos.color_comercial')
                   ->get();

        $hoy = date('Y-m-d');

        //return response()->json(["isAdmin"=>$isAdmin,'modelos'=>$modelos,'years'=>$years,'colors'=>$colors]);

        return view('yamaha.cotizacion.index',compact('isAdmin', 'tipoDocumentos', 'tipoCambio', 'modelos', 'years', 'colors', 'hoy'));
    }

    public function index2()
    {
        $isAdmin = false;

        if (Gate::allows('admin')) {
            $isAdmin = true;
        }

        $tipoDocumentos = TipoDocumento::where('activo', 1)->where('borrado', 0)->orderBy('id','asc')->get();

        $tipoCambio = Config::first();

        $modelos = DB::table('maestro_modelos')
                   ->select('maestro_modelos.id', 'maestro_modelos.modelo')
                   ->where('maestro_modelos.borrado','0')
                   ->where('maestro_modelos.activo','1')
                   ->groupBy('maestro_modelos.modelo')
                   ->orderBy('maestro_modelos.modelo')
                   ->get();

        $years = DB::table('maestro_modelos')
                   ->select('maestro_modelos.id', 'maestro_modelos.modelo', 'maestro_modelos.year')
                   ->where('maestro_modelos.borrado','0')
                   ->where('maestro_modelos.activo','1')
                   ->groupBy('maestro_modelos.modelo')
                   ->groupBy('maestro_modelos.year')
                   ->orderBy('maestro_modelos.modelo')
                   ->orderBy('maestro_modelos.year')
                   ->get();

        $colors = DB::table('maestro_modelos')
                   ->select('maestro_modelos.id', 'maestro_modelos.modelo', 'maestro_modelos.year', 'maestro_modelos.color_comercial', 'maestro_modelos.precio_usd', 'maestro_modelos.descuento_usd', 'maestro_modelos.precio_final_usd')
                   ->where('maestro_modelos.borrado','0')
                   ->where('maestro_modelos.activo','1')
                   ->groupBy('maestro_modelos.modelo')
                   ->groupBy('maestro_modelos.year')
                   ->groupBy('maestro_modelos.color_comercial')
                   ->orderBy('maestro_modelos.modelo')
                   ->orderBy('maestro_modelos.year')
                   ->orderBy('maestro_modelos.color_comercial')
                   ->get();

        $hoy = date('Y-m-d');

        //return response()->json(["isAdmin"=>$isAdmin,'modelos'=>$modelos,'years'=>$years,'colors'=>$colors]);

        return view('yamaha.reportes.index',compact('isAdmin', 'tipoDocumentos', 'tipoCambio', 'modelos', 'years', 'colors', 'hoy'));
    }

    public function index(Request $request)
    {
        $response = Cotizacion::GetData($request);


        return $response;
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
        $cliente_id=$request->cliente_id;
        $tipo_documento_id=$request->tipo_documento_id;
        $documento=$request->documento;
        $nombres=$request->nombres;
        $apellidos="";
        $celular=$request->celular;
        $correo=$request->correo;

        $maestro_modelo_id=$request->maestro_modelo_id;
        $include1=$request->include1;
        $include2=$request->include2;
        $include3=$request->include3;
        $include4=$request->include4;

        $precio_usd=$request->precio_usd;
        $descuento_usd=$request->descuento_usd;
        $activo=$request->activo;

        $result='1';
        $msj='';
        $selector='';


        $input1  = array('cliente_id' => $cliente_id);
        $reglas1 = array('cliente_id' => 'required');

        $input2  = array('tipo_documento_id' => $tipo_documento_id);
        $reglas2 = array('tipo_documento_id' => 'required');

        $input3  = array('documento' => $documento);
        $reglas3 = array('documento' => 'required');

        $input4  = array('nombres' => $nombres);
        $reglas4 = array('nombres' => 'required');

        $input5  = array('celular' => $celular);
        $reglas5 = array('celular' => 'required');

        $input6  = array('correo' => $correo);
        $reglas6 = array('correo' => 'required');

        $input7  = array('maestro_modelo_id' => $maestro_modelo_id);
        $reglas7 = array('maestro_modelo_id' => 'required');

        $input8  = array('precio_usd' => $precio_usd);
        $reglas8 = array('precio_usd' => 'required');

        $input9  = array('descuento_usd' => $descuento_usd);
        $reglas9 = array('descuento_usd' => 'required');

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
            $msj='Debe de enviar el cliente_id';
            $selector='cliente_id';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if ($validator2->fails() || intval($tipo_documento_id) <= 0)
        {
            $result='0';
            $msj='Debe seleccionar el Tipo de Documento de Identidad';
            $selector='cbutipo_documento_id';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        $tipoDocumento = TipoDocumento::find($tipo_documento_id);

        if ($validator3->fails())
        {
            $result='0';
            $msj='Debe de ingresar el Número de '.$tipoDocumento->nombre.' del Cliente';
            $selector='txtdocumento';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

       /*  if (strlen($num_documento)!=$tipoDocumento->digitos)
        {
            $result='0';
            $msj='El Número de '.$tipoDocumento->nombre.' del Docente debe tener '.$tipoDocumento->digitos.' dígitos';
            $selector='txtnum_documento';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        } */

        if ($validator4->fails())
        {
            $result='0';
            $msj='Debe ingresar los Nombres del Cliente';
            $selector='txtnombres';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }
        if ($validator5->fails())
        {
            $result='0';
            $msj='Debe ingresar el Celular del Cliente';
            $selector='txtcelular';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }
        if ($validator6->fails())
        {
            $result='0';
            $msj='Debe ingresar el Correo Electrónico del Cliente';
            $selector='txtcorreo';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }
        if ($validator7->fails() || intval($maestro_modelo_id) <= 0)
        {
            $result='0';
            $msj='Debe de Seleccionar un Modelo Válido';
            $selector='cbucolor';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }
        if ($validator8->fails() || floatval($precio_usd) <= 0)
        {
            $result='0';
            $msj='Debe de Ingresar el Precio de la Mococicleta';
            $selector='txtprecio_usd';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }
        if ($validator9->fails())
        {
            $descuento_usd = 0;
        }

        $maestroModelo = MaestroModelo::find($maestro_modelo_id);
        $tipoCambio = Config::first();
        

        if(!$maestroModelo){
            $result='0';
            $msj='Debe de Seleccionar un Modelo Válido';
            $selector='cbucolor';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        $yearActual = date('Y');
        $fecha = date('Y-m-d');
        $hora = date('H:i:s');

        $numberCotization = Cotizacion::where('year',$yearActual)->count();


        $iduser = Auth::user()->id;
        $personal = Personal::where('user_id',$iduser)->first();

        $numberCotization++;
        $pad_length = 8;
        $numero = str_pad($numberCotization, $pad_length, '0', STR_PAD_LEFT);

        if($cliente_id == 0){

            $clienteNew = new Cliente;

            $clienteNew->nombres = $nombres;
            $clienteNew->apellidos = $apellidos;
            $clienteNew->tipo_documento_id = $tipo_documento_id;
            $clienteNew->documento = $documento;
            $clienteNew->celular = $celular;
            $clienteNew->correo = $correo;
            $clienteNew->activo = 1;
            $clienteNew->borrado = 0;

            $clienteNew->save();

            $cliente_id = $clienteNew->id;
        }

        else{
            $cliente = Cliente::findOrFail($cliente_id);

            $cliente->nombres = $nombres;
            $cliente->apellidos = $apellidos;
            $cliente->tipo_documento_id = $tipo_documento_id;
            $cliente->documento = $documento;
            $cliente->celular = $celular;
            $cliente->correo = $correo;

            $cliente->save();
        }
       


            $registroA = new Cotizacion;

            $registroA->numero = $numero;
            $registroA->modelo = $maestroModelo->modelo;
            $registroA->year = $yearActual;
            $registroA->color = $maestroModelo->color_comercial;
            $registroA->cliente_id = $cliente_id;
            $registroA->pdf_url = '';
            $registroA->fecha = $fecha;
            $registroA->hora = $hora;
            $registroA->precio_usd = floatval($precio_usd);
            $registroA->descuento_usd = floatval($descuento_usd);
            $registroA->precio_final_usd = $registroA->precio_usd - $registroA->descuento_usd;
            $registroA->precio_final_pen = $registroA->precio_final_usd * $tipoCambio->tipo_cambio;
            $registroA->personal_id = $personal->id;
            $registroA->activo = 1;
            $registroA->borrado = 0;
            $registroA->tipo_cambio = $tipoCambio->tipo_cambio;

            $registroA->save();


            $registroB = new DataCotizacion;

            $registroB->codigo = $maestroModelo->codigo;
            $registroB->modelo = $maestroModelo->modelo;
            $registroB->year = $maestroModelo->year;
            $registroB->categoria = $maestroModelo->categoria;
            $registroB->subcategoria = $maestroModelo->subcategoria;
            $registroB->color_fabrica = $maestroModelo->color_fabrica;
            $registroB->color_comercial = $maestroModelo->color_comercial;
            $registroB->nombre_producto = $maestroModelo->nombre_producto;
            $registroB->linea_negocio = $maestroModelo->linea_negocio;
            $registroB->claim = $maestroModelo->claim;
            $registroB->descripcion = $maestroModelo->descripcion;
            $registroB->color1 = $maestroModelo->color1;
            $registroB->color2 = $maestroModelo->color2;
            $registroB->color3 = $maestroModelo->color3;
            $registroB->beneficio1 = $maestroModelo->beneficio1;
            $registroB->beneficio2 = $maestroModelo->beneficio2;
            $registroB->beneficio3 = $maestroModelo->beneficio3;
            $registroB->beneficio4 = $maestroModelo->beneficio4;
            $registroB->tipo_motor = $maestroModelo->tipo_motor;
            $registroB->cilindrada = $maestroModelo->cilindrada;
            $registroB->potencia_max = $maestroModelo->potencia_max;
            $registroB->torque_max = $maestroModelo->torque_max;
            $registroB->sistema_arrranque = $maestroModelo->sistema_arrranque;
            $registroB->sistema_transmision = $maestroModelo->sistema_transmision;
            $registroB->suministro_combustible = $maestroModelo->suministro_combustible;
            $registroB->capacidad_combustible = $maestroModelo->capacidad_combustible;
            $registroB->altura_asiento = $maestroModelo->altura_asiento;
            $registroB->peso_total = $maestroModelo->peso_total;
            $registroB->suspension_delantera = $maestroModelo->suspension_delantera;
            $registroB->suspencion_trasera = $maestroModelo->suspencion_trasera;
            $registroB->freno_delantero = $maestroModelo->freno_delantero;
            $registroB->freno_trasero = $maestroModelo->freno_trasero;
            $registroB->neumatico_delantero = $maestroModelo->neumatico_delantero;
            $registroB->numatico_trasero = $maestroModelo->numatico_trasero;
            $registroB->precio_usd = $registroA->precio_final_usd;
            $registroB->cotizacion_id = $registroA->id;
            $registroB->maestro_modelo_id = $maestroModelo->id;
            $registroB->url_logo = $maestroModelo->url_logo;
            $registroB->url_moto_principal = $maestroModelo->url_moto_principal;
            $registroB->url_color1 = $maestroModelo->url_color1;
            $registroB->url_color2 = $maestroModelo->url_color2;
            $registroB->url_color3 = $maestroModelo->url_color3;
            $registroB->url_beneficio1 = $maestroModelo->url_beneficio1;
            $registroB->url_beneficio2 = $maestroModelo->url_beneficio2;
            $registroB->url_beneficio3 = $maestroModelo->url_beneficio3;
            $registroB->url_beneficio4 = $maestroModelo->url_beneficio4;
            $registroB->activo = 1;
            $registroB->borrado = 0;

            $registroB->save();

            //Garantia y Beneficios Fijos
            $beneficiosFijos = MaestroBeneficio::where('activo', 1)->where('borrado', 0)->where('modelo', $maestroModelo->modelo)->where('year', $maestroModelo->year)->where('color_fabrica', $maestroModelo->color_fabrica)->first();

            if($beneficiosFijos){
                $garantia = Garantia::find($beneficiosFijos->garantia_id);

                if($garantia){
                    $registroC = new Includes;

                    $registroC->nombre = $garantia->garantia;
                    $registroC->urlimage = $garantia->url_imagen;
                    $registroC->activo = 1;
                    $registroC->borrado = 0;
                    $registroC->cotizacion_id = $registroA->id;

                    $registroC->save();
                }

                if(intval($beneficiosFijos->beneficio1_status) == 1){
                    $beneficio1 = Beneficio::find($beneficiosFijos->beneficio1_id);

                    if($beneficio1){
                        $registroC = new Includes;

                        $registroC->nombre = $beneficio1->beneficio;
                        $registroC->urlimage = $beneficio1->url_beneficio;
                        $registroC->activo = 1;
                        $registroC->borrado = 0;
                        $registroC->cotizacion_id = $registroA->id;

                        $registroC->save();
                    }
                }

                if(intval($beneficiosFijos->beneficio2_status) == 1){
                    $beneficio2 = Beneficio::find($beneficiosFijos->beneficio2_id);

                    if($beneficio2){
                        $registroC = new Includes;

                        $registroC->nombre = $beneficio2->beneficio;
                        $registroC->urlimage = $beneficio2->url_beneficio;
                        $registroC->activo = 1;
                        $registroC->borrado = 0;
                        $registroC->cotizacion_id = $registroA->id;

                        $registroC->save();
                    }
                }

                if(intval($beneficiosFijos->beneficio3_status) == 1){
                    $beneficio3 = Beneficio::find($beneficiosFijos->beneficio3_id);

                    if($beneficio3){
                        $registroC = new Includes;

                        $registroC->nombre = $beneficio3->beneficio;
                        $registroC->urlimage = $beneficio3->url_beneficio;
                        $registroC->activo = 1;
                        $registroC->borrado = 0;
                        $registroC->cotizacion_id = $registroA->id;

                        $registroC->save();
                    }
                }

                if(intval($beneficiosFijos->beneficio4_status) == 1){
                    $beneficio4 = Beneficio::find($beneficiosFijos->beneficio4_id);

                    if($beneficio4){
                        $registroC = new Includes;

                        $registroC->nombre = $beneficio4->beneficio;
                        $registroC->urlimage = $beneficio4->url_beneficio;
                        $registroC->activo = 1;
                        $registroC->borrado = 0;
                        $registroC->cotizacion_id = $registroA->id;

                        $registroC->save();
                    }
                }
            }

            
            $beneficiosOpcionales = Beneficio::where('activo', 1)->where('borrado', 0)->where('type', 2)->orderBy('id','asc')->get();


            if(intval($include1) == 1 && count($beneficiosOpcionales) >= 1){
                $registroC = new Includes;

                $registroC->nombre = $beneficiosOpcionales[0]->beneficio;
                $registroC->urlimage = $beneficiosOpcionales[0]->url_beneficio;
                $registroC->activo = 1;
                $registroC->borrado = 0;
                $registroC->cotizacion_id = $registroA->id;

                $registroC->save();
            }

            if(intval($include2) == 1 && count($beneficiosOpcionales) >= 2){
                $registroC = new Includes;

                $registroC->nombre = $beneficiosOpcionales[1]->beneficio;
                $registroC->urlimage = $beneficiosOpcionales[1]->url_beneficio;
                $registroC->activo = 1;
                $registroC->borrado = 0;
                $registroC->cotizacion_id = $registroA->id;

                $registroC->save();
            }

            if(intval($include3) == 1 && count($beneficiosOpcionales) >= 3){
                $registroC = new Includes;

                $registroC->nombre = $beneficiosOpcionales[2]->beneficio;
                $registroC->urlimage = $beneficiosOpcionales[2]->url_beneficio;
                $registroC->activo = 1;
                $registroC->borrado = 0;
                $registroC->cotizacion_id = $registroA->id;

                $registroC->save();
            }

            if(intval($include4) == 1 && count($beneficiosOpcionales) >= 4){
                $registroC = new Includes;

                $registroC->nombre = $beneficiosOpcionales[3]->beneficio;
                $registroC->urlimage = $beneficiosOpcionales[3]->url_beneficio;
                $registroC->activo = 1;
                $registroC->borrado = 0;
                $registroC->cotizacion_id = $registroA->id;

                $registroC->save();
            }

            $msj='Nueva Cotización Registrada con Éxiton Número de cotización: '.$registroA->year.'-'.$registroA->numero;

        return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector, 'cotizacion'=>$registroA]);
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
