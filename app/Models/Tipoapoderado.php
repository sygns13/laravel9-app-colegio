<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipoapoderado extends Model
{
    use HasFactory;

    protected $table = 'tipo_apoderados';
    protected $fillable = ['nombre',
                            'activo',
                            'borrado'
                        ];
	protected $guarded = ['id'];
}
