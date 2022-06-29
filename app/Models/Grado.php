<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grado extends Model
{
    use HasFactory;

    protected $table = 'grados';
    protected $fillable = ['nombre',
                            'ciclo',
                            'orden',
                            'nivele_id',
                            'activo',
                            'borrado',
                        ];
	protected $guarded = ['id'];
}
