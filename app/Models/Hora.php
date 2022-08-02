<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Hora extends Model
{
    use HasFactory;

    protected $table = 'horas';
    protected $fillable = ['horaini',
                            'horafin',
                            'tipo',
                            'turno_id',
                            'activo',
                            'borrado',
                        ];
	protected $guarded = ['id'];

    public static function GetHoras(Request $request){

        $turno_id=$request->turno_id;

        $registros = Hora::where('borrado','0')
        ->where('turno_id',$turno_id)
        ->orderBy('horaini')
        ->orderBy('horafin')
        ->paginate(10);

        return [
            'pagination'=>[
                'total'=> $registros->total(),
                'current_page'=> $registros->currentPage(),
                'per_page'=> $registros->perPage(),
                'last_page'=> $registros->lastPage(),
                'from'=> $registros->firstItem(),
                'to'=> $registros->lastItem(),
            ],
            'registros'=>$registros
        ];

    }
}
