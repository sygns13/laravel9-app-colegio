<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataCotizacion extends Model
{
    use HasFactory;

    protected $table = 'data_cotizacions';
    protected $fillable = [
                            'codigo',
                            'modelo',
                            'year',
                            'color_fabrica',
                            'color_comercial',
                            'nombre_producto',
                            'linea_negocio',
                            'claim',
                            'descripcion',
                            'color1',
                            'color2',
                            'color3',
                            'beneficio1',
                            'beneficio2',
                            'beneficio3',
                            'beneficio4',
                            'tipo_motor',
                            'cilindrada',
                            'potencia_max',
                            'torque_max',
                            'sistema_arrranque',
                            'sistema_transmision',
                            'suministro_combustible',
                            'capacidad_combustible',
                            'altura_asiento',
                            'peso_total',
                            'suspension_delantera',
                            'suspencion_trasera',
                            'freno_delantero',
                            'freno_trasero',
                            'neumatico_delantero',
                            'numatico_trasero',
                            'precio_usd',
                            'categoria',
                            'subcategoria',
                            'cotizacion_id',
                            'maestro_modelo_id',
                            'url_logo',
                            'url_moto_principal',
                            'url_color1',
                            'url_color2',
                            'url_color3',
                            'url_beneficio1',
                            'url_beneficio2',
                            'url_beneficio3',
                            'url_beneficio4',
                            'activo',
                            'borrado',
                        ];
	protected $guarded = ['id'];
}
