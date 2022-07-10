<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CicloNivel extends Model
{
    use HasFactory;

    protected $table = 'ciclo_niveles';
    protected $fillable = ['nivel_id',
                            'nombre',
                            'institucion_educativa_id',
                            'ciclo_escolar_id',
                            'turno_id',
                            'activo',
                            'borrado',
                        ];
	protected $guarded = ['id'];
}
