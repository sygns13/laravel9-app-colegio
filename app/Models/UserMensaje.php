<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMensaje extends Model
{
    use HasFactory;

    protected $table = 'user_mensajes';
    protected $fillable = [ 'user_id',
                            'fecha_leida',
                            'hora_leida',
                            'activo',
                            'borrado',
                            'mensaje_id',
                            'estado',                            
                        ];
	protected $guarded = ['id'];
}
