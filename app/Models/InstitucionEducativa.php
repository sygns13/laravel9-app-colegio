<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstitucionEducativa extends Model
{
    use HasFactory;

    protected $table = 'institucion_educativas';
    protected $fillable = ['codigo_modular',
                            'nombre',
                            'gestion',
                            'sigla_gestion',
                            'resolucion_creacion',
                            'forma',
                            'sigla_forma',
                            'departamento',
                            'provincia',
                            'distrito',
                            'centro_poblado',
                            'codigo_ugel',
                            'nombre_ugel',
                            'caracteristica',
                            'sigla_caracteristica',
                            'programa',
                            'sigla_programa',
                            'activo',
                            'borrado',
                        ];
	protected $guarded = ['id'];
}
