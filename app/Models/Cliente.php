<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';
    protected $fillable = [
                            'nombres',
                            'apellidos',
                            'tipo_documento_id',
                            'documento',
                            'celular',
                            'correo',
                            'activo',
                            'borrado',
                        ];
	protected $guarded = ['id'];

    public static function GetByDocIdentidad($tipo_documento_id, $num_documento){
        $data = Cliente::where('tipo_documento_id', $tipo_documento_id)
                    ->where('documento', $num_documento)
                    ->first();

        return $data;
    }

    public function salesCliente(){
        return $this->hasMany(Sale::class, 'cliente_id');
    }
    public function tipoDocumento(){
        return $this->belongsTo(TipoDocumento::class, 'tipo_documento_id');
    }
}
