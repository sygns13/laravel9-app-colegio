<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Controles extends Model
{
    use HasFactory;

    protected $table = 'controles';
    protected $fillable = ['tipo_control',
                            'nombre_control',
                            'valor',
                            'resultado',
                            'fecha',
                            'alumno_id',
                            'activo',
                            'borrado',
                            'matricula_id',
                        ];
	protected $guarded = ['id'];
}
