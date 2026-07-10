<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;

class Cotizacion extends Model
{
    use HasFactory;

    protected $table = 'cotizacions';
    protected $fillable = [
                            'numero',
                            'modelo',
                            'year',
                            'color',
                            'cliente_id',
                            'pdf_url',
                            'fecha',
                            'hora',
                            'fecha_fin',
                            'precio_usd',
                            'descuento_usd',
                            'precio_final_usd',
                            'precio_final_pen',
                            'personal_id',
                            'activo',
                            'borrado',
                            'tipo_cambio',
                            'observaciones',
                        ];
	protected $guarded = ['id'];

    public static function GetData(Request $request){

        $fechaIni=$request->fechaIni;
        $fechaFin=$request->fechaFin;
        $year=$request->year;
        $numero=$request->numero;
        $tipo_documento_id=$request->tipo_documento_id;
        $documento=$request->documento;

        $query = DB::table('cotizacions')
        ->join('personals', 'personals.id', '=', 'cotizacions.personal_id')
        ->join('clientes', 'clientes.id', '=', 'cotizacions.cliente_id')
        ->join('tipo_documentos as tpC', 'tpC.id', '=', 'clientes.tipo_documento_id')
        ->join('tipo_documentos as tpP', 'tpP.id', '=', 'personals.tipo_documento_id')
        ->join('data_cotizacions', 'cotizacions.id', '=', 'data_cotizacions.cotizacion_id')

        
        ->where('cotizacions.borrado','0')

      /*   ->where(function($query) use ($buscar){
            $query->where('personals.documento','like','%'.$buscar.'%');
            $query->orWhere('personals.nombres','like','%'.$buscar.'%');
            $query->orWhere('personals.apellidos','like','%'.$buscar.'%');
            $query->orWhere('personals.empresa','like','%'.$buscar.'%');
            $query->orWhere('tipo_documentos.nombre','like','%'.$buscar.'%');
            $query->orWhere('tipo_documentos.sigla','like','%'.$buscar.'%');
            $query->orWhere('users.name','like','%'.$buscar.'%');
            $query->orWhere('users.email','like','%'.$buscar.'%');
            })  */
            ->orderBy('cotizacions.id', 'desc')
        ->select(
                'cotizacions.id',
                'cotizacions.numero',
                'cotizacions.modelo',
                'cotizacions.year',
                'cotizacions.color',
                'cotizacions.cliente_id',
                'cotizacions.pdf_url',
                'cotizacions.fecha',
                'cotizacions.hora',
                'cotizacions.fecha_fin',
                'cotizacions.precio_usd',
                'cotizacions.descuento_usd',
                'cotizacions.precio_final_usd',
                'cotizacions.precio_final_pen',
                'cotizacions.personal_id',
                'cotizacions.activo',
                'cotizacions.borrado',
                'cotizacions.created_at',
                'cotizacions.updated_at',
                'cotizacions.tipo_cambio',
                'cotizacions.observaciones',

                'data_cotizacions.id as data_cotizacions_id',
                'data_cotizacions.color_comercial as data_cotizacions_color_comercial',
                'data_cotizacions.codigo as data_cotizacions_codigo',
                'data_cotizacions.year as data_cotizacions_year',

                'clientes.id as cli_id',
                'clientes.nombres as cli_nombres',
                'clientes.apellidos as cli_apellidos',
                'clientes.tipo_documento_id as cli_tipo_documento_id',
                'clientes.documento as cli_documento',
                'clientes.celular as cli_celular',
                'clientes.correo as cli_correo',

                'tpC.id as tpC_id',
                'tpC.nombre as tpC_nombre',
                'tpC.sigla as tpC_sigla',
                'tpC.digitos as tpC_digitos',

                'personals.id as personal_id',
                'personals.user_id as personal_user_id',
                'personals.nombres as personal_nombres',
                'personals.apellidos as personal_apellidos',
                'personals.celular as personal_celular',
                'personals.correo as personal_correo',
                'personals.tipo_documento_id as personal_tipo_documento_id',
                'personals.documento as personal_documento',
                'personals.activo as personal_activo',
                'personals.borrado as personal_borrado',
                'personals.empresa as personal_empresa',

                'tpP.id as tpP_id',
                'tpP.nombre as tpP_nombre',
                'tpP.sigla as tpP_sigla',
                'tpP.digitos as tpP_digitos',
        );


        if(isset($fechaIni) && !empty($fechaIni) && isset($fechaFin) && !empty($fechaFin)){
            $query->whereBetween('cotizacions.fecha', [$fechaIni, $fechaFin]);
        }

        if(isset($year) && !empty($year) && intval($year) > 0){
            $query->where('cotizacions.year', $year);
        }

        if(isset($numero) && !empty($numero)){
            $query->where('cotizacions.numero', 'like', '%' . $numero . '%');
        }

        if(isset($tipo_documento_id) && !empty($tipo_documento_id) && intval($tipo_documento_id) > 0){
            $query->where('clientes.tipo_documento_id', $tipo_documento_id);
        }

        if(isset($documento) && !empty($documento)){
            $query->where('clientes.documento', 'like', '%' . $documento . '%');
        }

        $registros = $query->paginate(30);

        foreach ($registros as $registro) {
            $registro->precioIni = number_format($registro->precio_usd, 2, '.', '');
            $registro->precioDto = number_format($registro->descuento_usd, 2, '.', '');
            $registro->precioFin = number_format($registro->precio_final_usd, 2, '.', '');
            $registro->precioFinPen = number_format($registro->precio_final_pen, 2, '.', '');
            $registro->tipoCambio = number_format($registro->tipo_cambio, 2, '.', '');
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

    public static function GetDataExport(Request $request){

        $fechaIni=$request->fechaIni;
        $fechaFin=$request->fechaFin;
        $year=$request->year;
        $numero=$request->numero;
        $tipo_documento_id=$request->tipo_documento_id;
        $documento=$request->documento;

        $query = DB::table('cotizacions')
        ->join('personals', 'personals.id', '=', 'cotizacions.personal_id')
        ->join('clientes', 'clientes.id', '=', 'cotizacions.cliente_id')
        ->join('tipo_documentos as tpC', 'tpC.id', '=', 'clientes.tipo_documento_id')
        ->join('tipo_documentos as tpP', 'tpP.id', '=', 'personals.tipo_documento_id')
        ->join('data_cotizacions', 'cotizacions.id', '=', 'data_cotizacions.cotizacion_id')

        
        ->where('cotizacions.borrado','0')

      /*   ->where(function($query) use ($buscar){
            $query->where('personals.documento','like','%'.$buscar.'%');
            $query->orWhere('personals.nombres','like','%'.$buscar.'%');
            $query->orWhere('personals.apellidos','like','%'.$buscar.'%');
            $query->orWhere('personals.empresa','like','%'.$buscar.'%');
            $query->orWhere('tipo_documentos.nombre','like','%'.$buscar.'%');
            $query->orWhere('tipo_documentos.sigla','like','%'.$buscar.'%');
            $query->orWhere('users.name','like','%'.$buscar.'%');
            $query->orWhere('users.email','like','%'.$buscar.'%');
            })  */
            ->orderBy('cotizacions.id', 'desc')
        ->select(
                'cotizacions.id',
                'cotizacions.numero',
                'cotizacions.modelo',
                'cotizacions.year',
                'cotizacions.color',
                'cotizacions.cliente_id',
                'cotizacions.pdf_url',
                'cotizacions.fecha',
                'cotizacions.hora',
                'cotizacions.fecha_fin',
                'cotizacions.precio_usd',
                'cotizacions.descuento_usd',
                'cotizacions.precio_final_usd',
                'cotizacions.precio_final_pen',
                'cotizacions.personal_id',
                'cotizacions.activo',
                'cotizacions.borrado',
                'cotizacions.created_at',
                'cotizacions.updated_at',
                'cotizacions.tipo_cambio',
                'cotizacions.observaciones',

                'data_cotizacions.id as data_cotizacions_id',
                'data_cotizacions.color_comercial as data_cotizacions_color_comercial',
                'data_cotizacions.codigo as data_cotizacions_codigo',
                'data_cotizacions.year as data_cotizacions_year',

                'clientes.id as cli_id',
                'clientes.nombres as cli_nombres',
                'clientes.apellidos as cli_apellidos',
                'clientes.tipo_documento_id as cli_tipo_documento_id',
                'clientes.documento as cli_documento',
                'clientes.celular as cli_celular',
                'clientes.correo as cli_correo',

                'tpC.id as tpC_id',
                'tpC.nombre as tpC_nombre',
                'tpC.sigla as tpC_sigla',
                'tpC.digitos as tpC_digitos',

                'personals.id as personal_id',
                'personals.user_id as personal_user_id',
                'personals.nombres as personal_nombres',
                'personals.apellidos as personal_apellidos',
                'personals.celular as personal_celular',
                'personals.correo as personal_correo',
                'personals.tipo_documento_id as personal_tipo_documento_id',
                'personals.documento as personal_documento',
                'personals.activo as personal_activo',
                'personals.borrado as personal_borrado',
                'personals.empresa as personal_empresa',

                'tpP.id as tpP_id',
                'tpP.nombre as tpP_nombre',
                'tpP.sigla as tpP_sigla',
                'tpP.digitos as tpP_digitos',
        );


        if(isset($fechaIni) && !empty($fechaIni) && isset($fechaFin) && !empty($fechaFin)){
            $query->whereBetween('cotizacions.fecha', [$fechaIni, $fechaFin]);
        }

        if(isset($year) && !empty($year) && intval($year) > 0){
            $query->where('cotizacions.year', $year);
        }

        if(isset($numero) && !empty($numero)){
            $query->where('cotizacions.numero', 'like', '%' . $numero . '%');
        }

        if(isset($tipo_documento_id) && !empty($tipo_documento_id) && intval($tipo_documento_id) > 0){
            $query->where('clientes.tipo_documento_id', $tipo_documento_id);
        }

        if(isset($documento) && !empty($documento)){
            $query->where('clientes.documento', 'like', '%' . $documento . '%');
        }

        $registros = $query->get();

        foreach ($registros as $registro) {
            $registro->precioIni = number_format($registro->precio_usd, 2, '.', '');
            $registro->precioDto = number_format($registro->descuento_usd, 2, '.', '');
            $registro->precioFin = number_format($registro->precio_final_usd, 2, '.', '');
            $registro->precioFinPen = number_format($registro->precio_final_pen, 2, '.', '');
            $registro->tipoCambio = number_format($registro->tipo_cambio, 2, '.', '');
        }


          return [
            'registros'=>$registros
        ];

    }
}
