<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SituacionLaboral extends Model
{
    use HasFactory;

    protected $table = 'situacion_laborals';
    protected $fillable = ['anio',
                            'edad',
                            'trabajo',
                            'horas_semanales',
                            'alumno_id',
                            'activo',
                            'borrado',
                            'matricula_id',
                        ];
	protected $guarded = ['id'];
}
