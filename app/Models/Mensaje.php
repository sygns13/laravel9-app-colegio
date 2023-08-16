<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    use HasFactory;

    protected $table = 'mensajes';
    protected $fillable = ['fecha',
                            'hora',
                            'estado',
                            'titulo',
                            'mensaje',
                            'user_id_envia',
                            'activo',
                            'borrado',
                        ];
	protected $guarded = ['id'];
}
