<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $table = 'items';
    protected $fillable = ['codigo',
        'descripcion',
        'talla',
        'tipo_item_id',
        'precio',
        'stock',
        'activo',
        'borrado'];
    protected $guarded = ['id'];

    public function tipoItem(){
        return $this->belongsTo(TipoItem::class, 'tipo_item_id');
    }
}
