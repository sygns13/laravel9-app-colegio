<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domicilio extends Model
{
    use HasFactory;

    protected $table = 'domicilios';
    protected $fillable = ['anio',
                            'direccion',
                            'lugar',
                            'departamento',
                            'provincia',
                            'distrito',
                            'telefono',
                            'alumno_id',
                            'activo',
                            'borrado'
                        ];
	protected $guarded = ['id'];
}
