<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $table = 'sales';
    protected $fillable = ['cliente_id',
        'tipo_sales_id',
        'fecha',
        'voucher',
        'activo',
        'borrado',
        'registrado',
        'responsable',
        'entregado',
        'personal_id',
        'observaciones',
    ];
    protected $guarded = ['id'];


    public function personals(){
        return $this->belongsTo(Personal::class, 'personal_id');
    }
    public function clientes(){
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }
    public function tipoSales(){
        return $this->belongsTo(TipoSale::class, 'tipo_sales_id');
    }
}
