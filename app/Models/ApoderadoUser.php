<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApoderadoUser extends Model
{
    use HasFactory;

    protected $table = 'apoderado_users';
    protected $fillable = ['apellido_paterno',
                            'apellido_materno',
                            'nombres',
                            'user_id',
                            'tipo_documento_id',
                            'tipo_apoderado',
                            'num_documento',
                            'alumno_id',
                            'activo',
                            'borrado',
                        ];
	protected $guarded = ['id'];
}
