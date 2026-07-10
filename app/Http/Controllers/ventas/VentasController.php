<?php

namespace App\Http\Controllers\ventas;

use App\Exports\Reporte1Export;
use App\Exports\Reporte1ExportDetalleVentas;
use App\Exports\Reporte1ExportVentas;
use App\Http\Controllers\Controller;
use App\Models\Config;
use App\Models\Cotizacion;
use App\Models\Personal;
use App\Models\TipoDocumento;
use App\Models\TipoSale;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\Cliente;
use App\Mail\VentaRegistrada;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use Storage;
use PDF;
use Validator;
use Auth;
use Carbon\Carbon;

class VentasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index1()
    {
        $isAdmin = false;

        if (Gate::allows('admin')) {
            $isAdmin = true;
        }

        $tipoSales = TipoSale::where('activo', 1)->where('borrado', 0)->orderBy('id','asc')->get();
        $tipoDocumentos = TipoDocumento::where('activo', 1)->where('borrado', 0)->orderBy('id','asc')->get();

        $tipoCambio = Config::first();

        $hoy = date('Y-m-d');

        return view('yamaha.ventas.index',compact('isAdmin', 'tipoDocumentos','tipoSales', 'tipoCambio', 'hoy'));
    }
    public function index2()
    {
        $isAdmin = false;

        if (Gate::allows('admin')) {
            $isAdmin = true;
        }

        $tipoDocumentos = TipoDocumento::where('activo', 1)->where('borrado', 0)->orderBy('id','asc')->get();
        $tipoSales = TipoSale::where('activo', 1)->where('borrado', 0)->orderBy('id','asc')->get();

        $tipoCambio = Config::first();

        $hoy = date('Y-m-d');

        //return response()->json(["isAdmin"=>$isAdmin,'modelos'=>$modelos,'years'=>$years,'colors'=>$colors]);

        return view('yamaha.reporteventas.index',compact('isAdmin', 'tipoDocumentos','tipoSales', 'tipoCambio', 'hoy'));
    }

    public function index(Request $request)
    {
        $fechaIni=$request->fechaIni;
        $fechaFin=$request->fechaFin;
        $tipoSales=$request->tipoSales;
        $tipo_documento_id=$request->tipo_documento_id;
        $documento=$request->documento;

        $query = Sale::with('tipoSales', 'clientes.tipoDocumento', 'personals')
            ->where('sales.activo', '=', 1)
            ->where('sales.borrado', '=', 0)
            ->orderBy('sales.fecha');

        if (!empty($tipo_documento_id) || (!empty($documento) && $documento != '0')) {
            $query->whereHas('clientes', function ($q) use ($tipo_documento_id, $documento) {
                if (!empty($tipo_documento_id)) {
                    $q->where('tipo_documento_id', $tipo_documento_id);
                }
                if (!empty($documento) && $documento != '0') {
                    $q->where('documento', $documento);
                }
            });
        }

        if (!empty($tipoSales) && $tipoSales != '0') {
            $query->where('sales.tipo_sales_id', '=', $tipoSales);
        }

        if (!empty($fechaIni) && !empty($fechaFin)) {
            $query->whereBetween('sales.fecha', [
                Carbon::createFromFormat('Y-m-d', $fechaIni)->startOfDay(),
                Carbon::createFromFormat('Y-m-d', $fechaFin)->endOfDay(),
            ]);
        }

        $query->orderBy('sales.id','desc');

        $registros = $query->paginate(30);

        foreach ($registros as $registro) {
            $fechaOriginal = Carbon::parse($registro->fecha);

            // Formato legible para mostrar las fechas
            $registro->fecha = $fechaOriginal->format('d-m-Y');

            if ($registro->fecha) {
                $registro->fecha = Carbon::parse($registro->fecha)->format('d-m-Y');
            }
        }


        return [
            'pagination'=>[
                'total'=> $registros->total(),
                'current_page'=> $registros->currentPage(),
                'per_page'=> $registros->perPage(),
                'last_page'=> $registros->lastPage(),
                'from'=> $registros->firstItem(),
                'to'=> $registros->lastItem(),
            ],
            'registros'=>$registros
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
        DB::beginTransaction();

        try {
            // Guardar/actualizar cliente: si ya existe (mismo documento) se
            // actualizan sus datos (nombres, celular, correo, etc.); si no, se crea.
            $cliente = Cliente::updateOrCreate(
                ['documento' => $request->documento],
                [
                    'nombres' => $request->nombres,
                    'tipo_documento_id' => $request->tipo_documento_id,
                    'celular' => $request->celular,
                    'correo' => $request->correo,
                    'activo' => 1,
                    'borrado' => 0
                ]
            );

            // Procesar imagen
            $rutaVoucher = null;
            if ($request->hasFile('voucher')) {
                $file = $request->file('voucher');
                $nombreArchivo = 'voucher-' . $request->documento . '-' . now()->format('YmdHis') . '.jpg';
                $file->move(public_path('vouchers'), $nombreArchivo);
                $rutaVoucher = 'vouchers/' . $nombreArchivo;
            }

            $iduser = Auth::user()->id;
            $personal = Personal::where('user_id',$iduser)->first();

            // Registrar venta
            $venta = new Sale();
            $venta->cliente_id = $cliente->id;
            $venta->tipo_sales_id = $request->tipo_sales_id;
            $venta->fecha = now();
            $venta->voucher = $rutaVoucher;
            $venta->observacion = $request->observacion;
            $venta->registrado = $request->input('registrado', 0);
            $venta->responsable = "";
            $venta->entregado = 0;
            $venta->activo = 1;
            $venta->borrado = 0;
            $venta->personal_id = $personal->id;
            $venta->save();

            // Registrar detalles
            $items = json_decode($request->input('items'), true);
            foreach ($items as $item) {
                $detalle = new SaleDetail();
                $detalle->sale_id = $venta->id;
                $detalle->item_id = $item['id'];
                $detalle->cantidad = $item['cantidad'];
                $detalle->total = $item['cantidad'] * $item['precio']; // ajusta si usas otro campo
                $detalle->activo = 1;
                $detalle->borrado = 0;
                $detalle->save();
            }

            DB::commit();

            // Envío de correo solo cuando es una VENTA (tipo_sales_id == 1), no cotización.
            // Se dispara de forma asíncrona (afterResponse) y cualquier fallo se registra
            // en el log sin afectar el registro de la venta ni la respuesta al usuario.
            if (intval($request->tipo_sales_id) === 1 && !empty($cliente->correo)) {
                $correoCliente = $cliente->correo;
                $celularAsesor = $personal->celular ?? '';

                dispatch(function () use ($correoCliente, $celularAsesor) {
                    try {
                        Mail::to($correoCliente)->send(new VentaRegistrada($celularAsesor));
                    } catch (\Throwable $e) {
                        Log::error('Error al enviar correo de venta a ' . $correoCliente . ': ' . $e->getMessage());
                    }
                })->afterResponse();
            }

            return response()->json([
                'result' => '1',
                'msj' => 'La venta se registró correctamente.'
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'result' => '0',
                'msj' => 'Error al registrar la venta: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tipoSales = TipoSale::where('activo', 1)->where('borrado', 0)->orderBy('id','asc')->get();
        $tipoDocumentos = TipoDocumento::where('activo', 1)->where('borrado', 0)->orderBy('id','asc')->get();
        $tipoCambio = Config::first();

        $sales = Sale::with('clientes.tipoDocumento')->where('id', '=', $id)
            ->first();

        $registros = SaleDetail::with('item')
            ->with('sale')
            ->where('sale_details.sale_id', '=', $id)
            ->where('sale_details.activo', '=', 1)
            ->where('sale_details.borrado', '=', 0)
            ->orderBy('sale_details.id')
            ->get();

        return [
            'registros'=>$registros,
            'sales'=>$sales,
            'tipoSales'=>$tipoSales,
            'tipoDocumentos'=>$tipoDocumentos,
            'tipoCambio'=>$tipoCambio,
        ];
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $registros = SaleDetail::with('item')
            ->with('sale')
            ->where('sale_details.sale_id', '=', $id)
            ->where('sale_details.activo', '=', 1)
            ->where('sale_details.borrado', '=', 0)
            ->orderBy('sale_details.id')
            ->get();

        return [
            'registros'=>$registros
        ];
    }
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
        $iduser = Auth::user()->id;
        $personal = Personal::where('user_id',$iduser)->first();

        $fechaIni=$request->fechaIni;
        $fechaFin=$request->fechaFin;
        $tipoSales=$request->tipoSales;
        $tipo_documento_id=$request->tipo_documento_id;
        $documento=$request->documento;

        $query = Sale::with('tipoSales', 'clientes.tipoDocumento', 'personals')
            ->where('sales.activo', '=', 1)
            ->where('sales.borrado', '=', 0)
            ->orderBy('sales.fecha');

        if (!empty($tipo_documento_id) || (!empty($documento) && $documento != '0')) {
            $query->whereHas('clientes', function ($q) use ($tipo_documento_id, $documento) {
                if (!empty($tipo_documento_id)) {
                    $q->where('tipo_documento_id', $tipo_documento_id);
                }
                if (!empty($documento) && $documento != '0') {
                    $q->where('documento', $documento);
                }
            });
        }

        if (!empty($tipoSales) && $tipoSales != '0') {
            $query->where('sales.tipo_sales_id', '=', $tipoSales);
        }

        if (!empty($fechaIni) && !empty($fechaFin)) {
            $query->whereBetween('sales.fecha', [
                Carbon::createFromFormat('Y-m-d', $fechaIni)->startOfDay(),
                Carbon::createFromFormat('Y-m-d', $fechaFin)->endOfDay(),
            ]);
        }

        $query->orderBy('sales.id', 'desc');
        
        $response = $query->get();

        foreach ($response as $registro) {
            $fechaOriginal = Carbon::parse($registro->fecha);

            // Formato legible para mostrar las fechas
            $registro->fecha = $fechaOriginal->format('d-m-Y');

            if ($registro->fecha) {
                $registro->fecha = Carbon::parse($registro->fecha)->format('d-m-Y');
            }
        }


        $data=[];

        $titulo='REPORTE DE VENTAS';

        array_push($data, array($titulo));
        array_push($data, array(''));

        $cont = 1;

        array_push($data, array('Filtros de Búsqueda:','', ''));

        if(isset($fechaIni) && !empty($fechaIni) && isset($fechaFin) && !empty($fechaFin)){
            array_push($data, array('','Fecha de Inicial: ', $this->pasFechaVista($fechaIni), 'Fecha Final: ', $this->pasFechaVista($fechaIni)));
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

        array_push($data, array('N°','TIPO VENTA', 'CLIENTE', 'TIPO DOCUMENTO', 'DOCUMENTO','TELEFONO','CORREO','FECHA DE VENTA', 'RESPONSABLE DE REGISTRO', 'ENTREGADO', 'REGISTRADO', 'RESPONSABLE DE FACTURACIÓN', 'OBSERVACIONES'));

        //return response()->json($response);

        foreach ($response as $key => $dato) {
            array_push($data, array(
                $key + 1,
                $dato->tipoSales->descripcion ?? '',
                $dato->clientes->nombres ?? '',
                $dato->clientes->tipoDocumento->nombre ?? '',
                $dato->clientes->documento ?? '',
                $dato->clientes->celular ?? '',
                $dato->clientes->correo ?? '',
                $dato->fecha ?? '',
                ($dato->personals->nombres ?? '') . ' ' . ($dato->personals->apellidos ?? ''),
                $dato->entregado ? 'Si' : 'No',
                $dato->registrado ? 'Si' : 'No',
                $dato->responsable ?? '',
                $dato->observacion ?? '',
            ));
        }

        $export = new Reporte1ExportVentas($data, $cont);

        return Excel::download($export, 'Reporte_Ventas.xlsx');
    }
    public function exportdetalle(Request $request)
    {
        $iduser = Auth::user()->id;
        $personal = Personal::where('user_id',$iduser)->first();

        $response = SaleDetail::with('item')
            ->with('sale')
            ->where('sale_details.sale_id', '=', $request->idsales)
            ->where('sale_details.activo', '=', 1)
            ->where('sale_details.borrado', '=', 0)
            ->orderBy('sale_details.id')
            ->get();

        $cliente = DB::table('sales')
            ->join('clientes', 'clientes.id', '=', 'sales.cliente_id')
            ->select('clientes.nombres')
            ->where('sales.id', '=', $request->idsales)
            ->first();


        $data=[];

        $titulo='REPORTE DE VENTAS - DETALLE';

        array_push($data, array($titulo));
        array_push($data, array('Usuario: ', $personal->nombres.' '.$personal->apellidos.' ('.Auth::user()->name.')'));

        $cont = 1;

        array_push($data, array('Cliente: '.$cliente->nombres));
        array_push($data, array(''));

        $cont++;

        $cont = $cont + 3;

        array_push($data, array('N°','CÓDIGO', 'DESCRIPCIÓN', 'PRECIO UNIT.', 'CANTIDAD','TOTAL'));

        //return response()->json($response);

        foreach ($response as $key => $dato) {
            array_push($data, array(
                $key + 1,
                $dato->item->codigo ?? '',
                $dato->item->descripcion ?? '',
                $dato->item->precio ?? '',
                $dato->cantidad ?? '',
                $dato->total ?? ''
            ));
        }

        $export = new Reporte1ExportDetalleVentas($data, $cont);

        return Excel::download($export, 'Reporte_Ventas_Detalle.xlsx');
    }
    /**
     * Update the specified resource in storage.
     */
    public function actualizarRegistrado(Request $request, string $id)
    {
        $venta = Sale::findOrFail($id);

        // validación opcional
        $data = $request->validate([
            'registrado'  => 'required|boolean',
            'responsable' => 'nullable|string|max:200',
        ]);

        $venta->update($data);

        return response()->json([
            'status'  => 'ok',
            'venta'   => $venta,
        ]);
    }

    public function actualizarEntregado(Request $request, string $id)
    {
        $venta = Sale::findOrFail($id);

        // validación opcional
        $data = $request->validate([
            'entregado'  => 'required|boolean',
        ]);

        $venta->update($data);

        return response()->json([
            'status'  => 'ok',
            'venta'   => $venta,
        ]);
    }

    public function update(Request $request, string $id)
    {
        DB::beginTransaction();

        try {
            // 1. Obtener la venta
            $venta = Sale::findOrFail($id);

            // 2. Guardar/actualizar cliente: si ya existe (mismo documento) se
            //    actualizan sus datos (nombres, celular, correo, etc.); si no, se crea.
            $cliente = Cliente::updateOrCreate(
                ['documento' => $request->documento],
                [
                    'nombres' => $request->nombres,
                    'tipo_documento_id' => $request->tipo_documento_id,
                    'celular' => $request->celular,
                    'correo' => $request->correo,
                    'activo' => 1,
                    'borrado' => 0
                ]
            );

            // 3. Procesar nuevo voucher si se envía
            if ($request->hasFile('voucher')) {
                // Borrar anterior si existe
                if ($venta->voucher && file_exists(public_path($venta->voucher))) {
                    unlink(public_path($venta->voucher));
                }

                $file = $request->file('voucher');
                $nombreArchivo = 'voucher-' . $request->documento . '-' . now()->format('YmdHis') . '.jpg';
                $file->move(public_path('vouchers'), $nombreArchivo);
                $venta->voucher = 'vouchers/' . $nombreArchivo;
            }

            // 4. Actualizar venta
            $venta->cliente_id = $cliente->id;
            $venta->tipo_sales_id = $request->tipo_sales_id;
            $venta->observacion = $request->observacion;
            $venta->fecha = now(); // puedes mantener la fecha original si lo deseas
            $venta->save();

            // 5. Procesar detalles
            $items = json_decode($request->input('items'), true);
            $idsProcesados = [];

            foreach ($items as $item) {
                // Si ya tiene ID, actualizar
                if (isset($item['id']) && $item['id']) {
                    $detalle = SaleDetail::find($item['id']);
                    if ($detalle) {
                        $detalle->cantidad = $item['cantidad'];
                        $detalle->total = $item['cantidad'] * $item['item']['precio']; // usar `item.precio`
                        $detalle->save();
                        $idsProcesados[] = $detalle->id;
                    }
                } else {
                    // Crear nuevo
                    $nuevo = new SaleDetail();
                    $nuevo->sale_id = $venta->id;
                    $nuevo->item_id = $item['item_id'];
                    $nuevo->cantidad = $item['cantidad'];
                    $nuevo->total = $item['cantidad'] * $item['item']['precio'];
                    $nuevo->activo = 1;
                    $nuevo->borrado = 0;
                    $nuevo->save();
                    $idsProcesados[] = $nuevo->id;
                }
            }

            // 6. Eliminar los detalles quitados
            SaleDetail::where('sale_id', $venta->id)
                ->whereNotIn('id', $idsProcesados)
                ->delete();

            DB::commit();

            return response()->json([
                'result' => '1',
                'msj' => 'La venta se actualizó correctamente.'
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'result' => '0',
                'msj' => 'Error al actualizar la venta: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
