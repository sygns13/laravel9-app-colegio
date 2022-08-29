<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApoderadoMatricula extends Model
{
    use HasFactory;

    protected $table = 'apoderado_matriculas';
    protected $fillable = ['alumno_id',
                            'matricula_id',
                            'apellido_paterno',
                            'apellido_materno',
                            'nombres',
                            'parentesco',
                            'fecha_nac',
                            'instruccion',
                            'ocupacion',
                            'direccion',
                            'telefono',
                            'activo',
                            'borrado',
                        ];
	protected $guarded = ['id'];
}
