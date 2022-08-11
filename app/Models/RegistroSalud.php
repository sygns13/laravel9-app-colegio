<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroSalud extends Model
{
    use HasFactory;

    protected $table = 'registro_saluds';
    protected $fillable = ['edad_aprox',
                            'enfermedad',
                            'vacuna',
                            'tipo',
                            'alumnos_id',
                            'activo',
                            'borrado'
                        ];
	protected $guarded = ['id'];
}
