<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    use HasFactory;

    protected $table = 'tipo_documentos';
    protected $fillable = ['id',
                            'nombre',
                            'sigla',
                            'digitos',
                            'activo',
                            'borrado',
                        ];
	protected $guarded = ['id'];
    public $timestamps = false;
}
