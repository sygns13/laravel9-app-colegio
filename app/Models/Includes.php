<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Includes extends Model
{
    use HasFactory;

    protected $table = 'includes';
    protected $fillable = [
                            'nombre',
                            'urlimage',
                            'activo',
                            'borrado',
                            'cotizacion_id',
                        ];
	protected $guarded = ['id'];
}
