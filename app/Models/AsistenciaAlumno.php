<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsistenciaAlumno extends Model
{
    use HasFactory;

    protected $table = 'asistencia_alumnos';
    protected $fillable = ['fecha',
                            'alumno_id',
                            'ciclo_escolar_id',
                            'horario_id',
                            'seccion_id',
                            'estado',
                            'observacion',
                            'activo',
                            'borrado',
                            'asistencia_id',
                        ];
	protected $guarded = ['id'];
}
