<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;

    protected $table = 'asistencias';
    protected $fillable = ['fecha',
                            'ciclo_seccion_id',
                            'ciclo_escolar_id',
                            'ciclo_curso_id',
                            'activo',
                            'borrado',
                            'horario_id',
                            'tema',
                        ];
	protected $guarded = ['id'];
}
