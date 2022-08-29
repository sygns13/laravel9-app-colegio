<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Traslado extends Model
{
    use HasFactory;

    protected $table = 'traslados';
    protected $fillable = ['fecha',
                            'motivo',
                            'codigo_modular',
                            'ie_nombre',
                            'alumno_id',
                            'activo',
                            'borrado',
                            'res_traslado', 
                            'resolucion_traslado', 
                            'matricula_id',
                            'tipo',
                        ];
	protected $guarded = ['id'];
}
