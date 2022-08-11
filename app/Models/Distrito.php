<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distrito extends Model
{
    use HasFactory;

    protected $table = 'distritos';
    protected $fillable = ['nombre',
                            'codigo',
                            'activo',
                            'borrado',
                            'provincia_id',
                        ];
	protected $guarded = ['id'];
}
