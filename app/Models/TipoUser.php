<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoUser extends Model
{
    use HasFactory;

    protected $table = 'tipo_documentos';
    protected $fillable = ['id',
                            'nombre',
                            'descripcion',
                            'activo',
                            'borrado',
                        ];
	protected $guarded = ['id'];
}
