<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indicador extends Model
{
    use HasFactory;

    protected $table = 'indicadores';
    protected $fillable = ['nombre',
                            'orden',
                            'competencia_id',
                            'activo',
                            'borrado',
                        ];
	protected $guarded = ['id'];
}
