<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Garantia extends Model
{
    use HasFactory;

    protected $table = 'garantias';
    protected $fillable = [
                            'garantia',
                            'url_imagen',
                            'activo',
                            'borrado',
                        ];
	protected $guarded = ['id'];
}
