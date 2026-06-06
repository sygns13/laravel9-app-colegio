<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoSale extends Model
{
    public $timestamps = true;
    protected $table = 'tipo_sales';
    protected $fillable = ['descripcion',
        'activo',
        'borrado'];
    protected $guarded = ['id'];

    public function tipoSale(){
        return $this->hasMany(Sale::class, 'tipo_sales_id');
    }
}
