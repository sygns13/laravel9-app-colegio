<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;

class Personal extends Model
{
    use HasFactory;

    protected $table = 'personals';
    protected $fillable = [
                            'user_id',
                            'nombres',
                            'apellidos',
                            'celular',
                            'correo',
                            'tipo_documento_id',
                            'documento',
                            'activo',
                            'borrado',
                            'empresa',
                        ];
	protected $guarded = ['id'];

    public function salesPersonal(){
        return $this->hasMany(Sale::class, 'personal_id');
    }

    public static function GetPersonal(Request $request){

        $buscar=$request->busca;

        $registros = DB::table('personals')
        ->join('tipo_documentos', 'tipo_documentos.id', '=', 'personals.tipo_documento_id')
        ->join('users', 'users.id', '=', 'personals.user_id')
        ->join('tipo_users', 'tipo_users.id', '=', 'users.tipo_user_id')

        
        ->where('personals.borrado','0')

        ->where(function($query) use ($buscar){
            $query->where('personals.documento','like','%'.$buscar.'%');
            $query->orWhere('personals.nombres','like','%'.$buscar.'%');
            $query->orWhere('personals.apellidos','like','%'.$buscar.'%');
            $query->orWhere('personals.empresa','like','%'.$buscar.'%');
            $query->orWhere('tipo_documentos.nombre','like','%'.$buscar.'%');
            $query->orWhere('tipo_documentos.sigla','like','%'.$buscar.'%');
            $query->orWhere('users.name','like','%'.$buscar.'%');
            $query->orWhere('users.email','like','%'.$buscar.'%');
            }) 
            ->orderBy('users.tipo_user_id')
            ->orderBy('personals.empresa')
            ->orderBy('personals.apellidos')
            ->orderBy('personals.nombres')
            ->orderBy('personals.id')
        ->select(
                'personals.id',
                'personals.tipo_documento_id',
                'personals.documento',
                'personals.apellidos',
                'personals.nombres',
                'personals.empresa',
                'personals.celular',
                'personals.correo',
                'personals.user_id',
                'personals.activo',
                'personals.borrado',
               

                'tipo_documentos.id as tipo_documentos_id',
                'tipo_documentos.nombre as tipo_documentos_nombre',
                'tipo_documentos.sigla as tipo_documentos_sigla',
                'tipo_documentos.digitos as tipo_documentos_digitos',

                'tipo_users.id as tipo_users_id',
                'tipo_users.nombre as tipo_users_nombre',
                'tipo_users.descripcion as tipo_users_descripcion',

                'users.id as users_id',
                'users.name as users_name',
                'users.email as users_email',
                'users.activo as users_activo',
         )
        ->paginate(30);


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
