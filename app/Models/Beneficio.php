<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beneficio extends Model
{
    use HasFactory;

    protected $table = 'beneficios';
    protected $fillable = [
                            'beneficio',
                            'url_beneficio',
                            'type',
                            'activo',
                            'borrado',
                        ];
	protected $guarded = ['id'];
}
