<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $table = 'sale_details';
    protected $fillable = ['sale_id',
        'item_id',
        'cantidad',
        'total',
        'activo',
        'borrado'];
    protected $guarded = ['id'];


    public function sale(){
        return $this->belongsTo(Sale::class, 'sale_id');
    }
    public function item(){
        return $this->belongsTo(Item::class, 'item_id');
    }
}
