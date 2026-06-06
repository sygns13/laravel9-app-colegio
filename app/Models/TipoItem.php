<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoItem extends Model
{
    public $timestamps = true;
    protected $table = 'tipo_item';
    protected $fillable = ['descripcion',
        'detalle',
        'activo',
        'borrado'];
    protected $guarded = ['id'];

    public function tipoItem(){
        return $this->hasMany(Item::class, 'tipo_item_id');
    }
}
