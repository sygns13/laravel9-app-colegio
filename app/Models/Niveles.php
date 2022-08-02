<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Niveles extends Model
{
    use HasFactory;

    protected $table = 'niveles';
    protected $fillable = ['nombre',
                            'siglas',
                            'institucion_educativa_id',
                            'turno_id',
                            'activo',
                            'borrado',
                        ];
	protected $guarded = ['id'];
}
