<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Director extends Model
{
    use HasFactory;

    protected $table = 'directors';
    protected $fillable = [
                            'tipo_documento_id', 
                            'num_documento', 
                            'apellidos', 
                            'nombre', 
                            'genero',
                            'cargo',
                            'condicion',
                            'dedicacion',
                            'celular',
                            'email',
                            'user_id',
                            'activo',
                            'borrado',
                            'telefono',
                        ];
	protected $guarded = ['id'];
}
