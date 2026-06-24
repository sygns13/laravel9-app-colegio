<?php

namespace App\Http\Controllers;

use App\Exports\ReportePromocionesExport;
use App\Models\ClientePromocion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Formulario PÚBLICO (sin autenticación) de registro de clientes para la
 * campaña de promociones / novedades de Yamaha.
 *
 * Vive fuera del prefijo /admin (rutas en routes/web.php) y guarda en la tabla
 * independiente `clientes_promociones` (modelo ClientePromocion); no toca las
 * tablas ya implementadas (clientes, sales, etc.).
 */
class ClientePromocionController extends Controller
{
    /** Tipos de documento admitidos por el formulario. */
    public const TIPOS_DOCUMENTO = [
        'DNI',
        'Carnet de extranjería',
        'RUC',
        'Pasaporte',
        'Otros tipos de documento',
    ];

    /**
     * Muestra el formulario público de registro.
     */
    public function index1()
    {
        return view('promociones.registro', [
            'tiposDocumento' => self::TIPOS_DOCUMENTO,
        ]);
    }

    /**
     * Registra (o actualiza) al cliente. Si el número de documento ya existe se
     * actualizan sus datos (updateOrCreate) para evitar duplicados.
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'tipo_documento'   => ['required', Rule::in(self::TIPOS_DOCUMENTO)],
                'numero_documento' => ['required', 'string', 'max:25'],
                'nombres_apellidos' => ['required', 'string', 'min:3', 'max:255'],
                'celular'          => ['required', 'string', 'max:25', 'regex:/^[0-9+\s\-\(\)]{6,20}$/'],
                'correo'           => ['required', 'email', 'max:250'],
                // Obligatorio: debe venir marcado para poder registrarse.
                'acepta_privacidad' => ['accepted'],
                // Opcional: puede o no estar marcado.
                'acepta_promociones' => ['nullable', 'boolean'],
            ],
            [
                'tipo_documento.required'   => 'Selecciona el tipo de documento.',
                'tipo_documento.in'         => 'Selecciona un tipo de documento válido.',
                'numero_documento.required' => 'El número de documento es obligatorio.',
                'nombres_apellidos.required' => 'Los nombres y apellidos son obligatorios.',
                'nombres_apellidos.min'     => 'Ingresa al menos 3 caracteres.',
                'celular.required'          => 'El celular es obligatorio.',
                'celular.regex'             => 'Ingresa un número de celular válido.',
                'correo.required'           => 'El correo electrónico es obligatorio.',
                'correo.email'              => 'Ingresa un correo electrónico válido.',
                'acepta_privacidad.accepted' => 'Debes aceptar la Política de Privacidad para continuar.',
            ]
        );

        // Validación de longitud específica para DNI y RUC (solo dígitos).
        if ($data['tipo_documento'] === 'DNI' && ! preg_match('/^\d{8}$/', $data['numero_documento'])) {
            return back()
                ->withErrors(['numero_documento' => 'El DNI debe tener exactamente 8 dígitos.'])
                ->withInput();
        }
        if ($data['tipo_documento'] === 'RUC' && ! preg_match('/^\d{11}$/', $data['numero_documento'])) {
            return back()
                ->withErrors(['numero_documento' => 'El RUC debe tener exactamente 11 dígitos.'])
                ->withInput();
        }

        ClientePromocion::updateOrCreate(
            ['numero_documento' => $data['numero_documento']],
            [
                'tipo_documento'    => $data['tipo_documento'],
                'nombres_apellidos' => $data['nombres_apellidos'],
                'celular'           => $data['celular'],
                'correo'            => $data['correo'],
                'acepta_privacidad' => 1,
                'acepta_promociones' => $request->boolean('acepta_promociones') ? 1 : 0,
                'activo'            => 1,
                'borrado'           => 0,
            ]
        );

        return redirect()
            ->route('promociones.registro')
            ->with('registro_exitoso', true);
    }

    /* ------------------------------------------------------------------ */
    /*  REPORTE (sección administrador: admin y ventas)                   */
    /* ------------------------------------------------------------------ */

    /**
     * Pantalla del reporte de clientes registrados por promociones.
     */
    public function index2()
    {
        $isAdmin = Gate::allows('admin');
        $tiposDocumento = self::TIPOS_DOCUMENTO;
        $hoy = date('Y-m-d');

        return view('yamaha.reportepromociones.index', compact('isAdmin', 'tiposDocumento', 'hoy'));
    }

    /**
     * Construye la consulta filtrada (compartida por el listado y la exportación).
     */
    private function buildQuery(Request $request)
    {
        $query = ClientePromocion::where('borrado', 0);

        $fechaIni = $request->fechaIni;
        $fechaFin = $request->fechaFin;

        if (! empty($fechaIni) && ! empty($fechaFin)) {
            $query->whereBetween('created_at', [
                Carbon::createFromFormat('Y-m-d', $fechaIni)->startOfDay(),
                Carbon::createFromFormat('Y-m-d', $fechaFin)->endOfDay(),
            ]);
        }

        if (! empty($request->tipo_documento) && $request->tipo_documento != '0') {
            $query->where('tipo_documento', $request->tipo_documento);
        }
        if (! empty($request->numero_documento)) {
            $query->where('numero_documento', 'like', '%' . $request->numero_documento . '%');
        }
        if (! empty($request->nombres_apellidos)) {
            $query->where('nombres_apellidos', 'like', '%' . $request->nombres_apellidos . '%');
        }
        if (! empty($request->correo)) {
            $query->where('correo', 'like', '%' . $request->correo . '%');
        }
        if (! empty($request->celular)) {
            $query->where('celular', 'like', '%' . $request->celular . '%');
        }
        // 'acepta_promociones': '0'/'1' filtra; '' o 'todos' no filtra.
        if ($request->filled('acepta_promociones') && in_array($request->acepta_promociones, ['0', '1'], true)) {
            $query->where('acepta_promociones', (int) $request->acepta_promociones);
        }

        return $query->orderBy('id', 'desc');
    }

    /**
     * Listado paginado (AJAX) del reporte.
     */
    public function data(Request $request)
    {
        $registros = $this->buildQuery($request)->paginate(30);

        foreach ($registros as $registro) {
            $registro->fecha = $registro->created_at
                ? Carbon::parse($registro->created_at)->format('d-m-Y H:i')
                : '';
        }

        return [
            'pagination' => [
                'total'        => $registros->total(),
                'current_page' => $registros->currentPage(),
                'per_page'     => $registros->perPage(),
                'last_page'    => $registros->lastPage(),
                'from'         => $registros->firstItem(),
                'to'           => $registros->lastItem(),
            ],
            'registros' => $registros,
        ];
    }

    /**
     * Exporta a Excel TODOS los resultados de la búsqueda (sin paginar).
     */
    public function export(Request $request)
    {
        $response = $this->buildQuery($request)->get();

        $data = [];
        $titulo = 'REPORTE DE CLIENTES - PROMOCIONES';

        array_push($data, [$titulo]);
        array_push($data, ['']);

        $cont = 1;

        array_push($data, ['Filtros de Búsqueda:', '', '']);

        if (! empty($request->fechaIni) && ! empty($request->fechaFin)) {
            array_push($data, ['', 'Fecha Inicial: ', $this->pasFechaVista($request->fechaIni), 'Fecha Final: ', $this->pasFechaVista($request->fechaFin)]);
            $cont++;
        }

        $tipoDocumento = (! empty($request->tipo_documento) && $request->tipo_documento != '0') ? $request->tipo_documento : 'Todos';
        array_push($data, ['', 'Tipo de Documento: ', $tipoDocumento, 'Número de Documento: ', $request->numero_documento]);
        $cont++;

        $cont = $cont + 3;

        array_push($data, ['N°', 'TIPO DOCUMENTO', 'N° DOCUMENTO', 'NOMBRES Y APELLIDOS', 'CELULAR', 'CORREO', 'ACEPTA PRIVACIDAD', 'ACEPTA PROMOCIONES', 'FECHA DE REGISTRO']);

        foreach ($response as $key => $dato) {
            array_push($data, [
                $key + 1,
                $dato->tipo_documento ?? '',
                $dato->numero_documento ?? '',
                $dato->nombres_apellidos ?? '',
                $dato->celular ?? '',
                $dato->correo ?? '',
                $dato->acepta_privacidad ? 'Sí' : 'No',
                $dato->acepta_promociones ? 'Sí' : 'No',
                $dato->created_at ? Carbon::parse($dato->created_at)->format('d-m-Y H:i') : '',
            ]);
        }

        $export = new ReportePromocionesExport($data, $cont);

        return Excel::download($export, 'Reporte_Clientes_Promociones.xlsx');
    }

    /**
     * Formatea una fecha Y-m-d a d/m/Y para las cabeceras del Excel.
     */
    private function pasFechaVista($fecha)
    {
        $fechadev = '';
        if (strlen($fecha) == 10) {
            $fechadev = substr($fecha, -2) . '/' . substr($fecha, -5, 2) . '/' . substr($fecha, -10, 4);
        }

        return $fechadev;
    }
}
