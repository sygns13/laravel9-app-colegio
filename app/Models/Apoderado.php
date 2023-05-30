<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apoderado extends Model
{
    use HasFactory;

    protected $table = 'apoderados';
    protected $fillable = ['apellido_materno',
                            'apellido_paterno',
                            'nombres',
                            'vive',
                            'fecha_nacimiento',
                            'grado_instruccion',
                            'ocupacion',
                            'vive_con_estudiante',
                            'religion',
                            'tipo_apoderado',
                            'tipo_documento_id',
                            'alumno_id',
                            'num_documento',
                            'telefono',
                            'celular',
                            'direccion',
                            'correo',
                            'tipo_apoderado_id',
                            'principal',
                            'activo',
                            'borrado',
                            'escolaridad_sigla'
                        ];
	protected $guarded = ['id'];
}
