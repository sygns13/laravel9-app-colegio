<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaestroBeneficio extends Model
{
    use HasFactory;

    protected $table = 'maestro_beneficios';
    protected $fillable = [
                            'codigo',
                            'modelo',
                            'year',
                            'color_fabrica',
                            'color_comercial',
                            'nombre_producto',
                            'linea_negocio',
                            'garantia_id',
                            'beneficio1_id',
                            'beneficio1_status',
                            'beneficio2_id',
                            'beneficio2_status',
                            'beneficio3_id',
                            'beneficio3_status',
                            'beneficio4_id',
                            'beneficio4_status',
                            'activo',
                            'borrado',
                        ];
	protected $guarded = ['id'];
}
