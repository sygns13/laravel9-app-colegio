<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Validator;
use Auth;

use App\Models\Mensaje;
use App\Models\UserMensaje;
use App\Models\User;
use App\Models\TipoUser;
use App\Models\CicloEscolar;
use App\Models\Director;
use App\Models\Docente;
use App\Models\Alumno;
use App\Models\ApoderadoUser;

use stdClass;
use DB;
use Storage;
use PDF;

use Illuminate\Support\Facades\Hash;

class MensajeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index1()
    {
         $cicloActivo = CicloEscolar::GetCicloActivo();
        /*
        $estados = Estado::where('activo',1)->where('borrado',0)->orderBy('nombre','asc')->get();
        $departamentos = Departamento::where('activo',1)->where('borrado',0)->orderBy('nombre','asc')->get();
        $provincias = Provincia::where('activo',1)->where('borrado',0)->orderBy('nombre','asc')->get();
        $distritos = Distrito::where('activo',1)->where('borrado',0)->orderBy('nombre','asc')->get();

        $niveles = Niveles::where('activo',1)->where('borrado',0)->orderBy('id','asc')->get();
        $grados = Grado::where('activo',1)->where('borrado',0)->orderBy('orden','asc')->get(); */

        return view('admin.mensajes.index',compact('cicloActivo'));
    }

    public function index(Request $request)
    {
        $iduser = Auth::user()->id;
        $type = $request->type;

        //recibidos
        if($type == '1'){
            $registros = DB::table('user_mensajes')
            ->join('mensajes', 'mensajes.id', '=', 'user_mensajes.mensaje_id')
            ->join('users', 'users.id', '=', 'mensajes.user_id_envia')
            ->join('tipo_users', 'tipo_users.id', '=', 'users.tipo_user_id')

            ->where('user_mensajes.borrado','0')
            ->where('mensajes.borrado','0')
            ->where('user_mensajes.user_id', $iduser)

            ->orderBy('fecha', 'desc')
            ->orderBy('hora', 'desc')
            ->orderBy('id', 'desc')

            ->select(
                'mensajes.id as id',
                'mensajes.fecha',
                DB::Raw("DATE_FORMAT(`mensajes`.`fecha`,'%d/%m/%Y') as fecha"),
                'mensajes.hora',
                'mensajes.estado',
                'mensajes.titulo',
                'mensajes.mensaje',
                'mensajes.user_id_envia',

                'user_mensajes.id as user_mensajes_id',
                'user_mensajes.user_id as user_mensajes_user_id',
                DB::Raw("IFNULL(DATE_FORMAT(`user_mensajes`.`fecha_leida`,'%d/%m/%Y'),'') as user_mensajes_fecha_leida"),
                'user_mensajes.hora_leida as user_mensajes_hora_leida',
                'user_mensajes.estado as user_mensajes_estado',

                'tipo_users.id as tipo_users_id',
                'tipo_users.nombre as tipo_users_nombre',
                'tipo_users.descripcion as tipo_users_descripcion',

                'users.id as users_id',
                'users.name as users_name',
                'users.email as users_email',
                'users.activo as users_activo',
            )->paginate(30);

            foreach ($registros as $key => $dato) {
                if($dato->tipo_users_id == '1'){
                    $director = Director::where('borrado', '0')->where('user_id', $dato->users_id)->first();
                    $dato->director = $director;
                }
                elseif($dato->tipo_users_id == '3') {
                    $docente = Docente::where('borrado', '0')->where('user_id', $dato->users_id)->first();
                    $dato->docente = $docente;
                }
                elseif($dato->tipo_users_id == '4') {
                    $alumno = Alumno::where('borrado', '0')->where('user_id', $dato->users_id)->first();
                    $dato->alumno = $alumno;
                }
                elseif($dato->tipo_users_id == '5') {
                    $apoderado = ApoderadoUser::where('borrado', '0')->where('user_id', $dato->users_id)->first();
                    $dato->apoderado = $apoderado;
                }
            }

            return [
                'pagination'=>[
                    'total'=> $registros->total(),
                    'current_page'=> $registros->currentPage(),
                    'per_page'=> $registros->perPage(),
                    'last_page'=> $registros->lastPage(),
                    'from'=> $registros->firstItem(),
                    'to'=> $registros->lastItem(),
                ],
                'registros'=>$registros,
            ];
        }

        $registros = DB::table('mensajes')
            ->join('users', 'users.id', '=', 'mensajes.user_id_envia')
            ->join('tipo_users', 'tipo_users.id', '=', 'users.tipo_user_id')

            ->where('mensajes.borrado','0')
            ->where('mensajes.user_id_envia', $iduser)

            ->orderBy('fecha', 'desc')
            ->orderBy('hora', 'desc')
            ->orderBy('id', 'desc')

            ->select(
                'mensajes.id as id',
                'mensajes.fecha',
                DB::Raw("DATE_FORMAT(`mensajes`.`fecha`,'%d/%m/%Y') as fecha"),
                'mensajes.hora',
                'mensajes.estado',
                'mensajes.titulo',
                'mensajes.mensaje',
                'mensajes.user_id_envia',

                'tipo_users.id as tipo_users_id',
                'tipo_users.nombre as tipo_users_nombre',
                'tipo_users.descripcion as tipo_users_descripcion',

                'users.id as users_id',
                'users.name as users_name',
                'users.email as users_email',
                'users.activo as users_activo',
            )->paginate(30);

            foreach ($registros as $key => $dato) {

                $recibidos = UserMensaje::where('mensaje_id', $dato->id)->get();

                foreach ($recibidos as $keyR => $datoR) {
                    $user = User::find($datoR->user_id);
                    $datoR->tipo_users_id = $user->tipo_user_id;
                    if($user->tipo_user_id == '1'){
                        $director = Director::where('borrado', '0')->where('user_id', $datoR->user_id)->first();
                        $datoR->director = $director;
                    }
                    elseif($user->tipo_user_id == '3') {
                        $docente = Docente::where('borrado', '0')->where('user_id', $datoR->user_id)->first();
                        $datoR->docente = $docente;
                    }
                    elseif($user->tipo_user_id == '4') {
                        $alumno = Alumno::where('borrado', '0')->where('user_id', $datoR->user_id)->first();
                        $datoR->alumno = $alumno;
                    }
                    elseif($user->tipo_user_id == '5') {
                        $apoderado = ApoderadoUser::where('borrado', '0')->where('user_id', $datoR->user_id)->first();
                        $datoR->apoderado = $apoderado;
                    }
                }

                $dato->recibidos = $recibidos;
            }

       /*  $query = Mensaje::where(function ($query) use ($iduser) {
                                $query->where('user_id_envia', '=', $iduser);
                                      //->orWhere('user_id_recibe', '=', $iduser);
                            })->where(function ($query) {
                                $query->where('activo', '=', 1)
                                      ->where('borrado', '=', 0);
                            });

        $query->orderBy('fecha');
        $query->orderBy('hora');
        $query->orderBy('id');

        $registros = $query->paginate(30);
 */
        return [
            'pagination'=>[
                'total'=> $registros->total(),
                'current_page'=> $registros->currentPage(),
                'per_page'=> $registros->perPage(),
                'last_page'=> $registros->lastPage(),
                'from'=> $registros->firstItem(),
                'to'=> $registros->lastItem(),
            ],
            'registros'=>$registros,
        ];
    }

    public function indexGetPersonas(Request $request)
    {

        $buscar=$request->busca;

        $registros = DB::table('alumnos')
        ->join('tipo_documentos', 'tipo_documentos.id', '=', 'alumnos.tipo_documento_id')
        ->join('users', 'users.id', '=', 'alumnos.user_id')
        ->join('tipo_users', 'tipo_users.id', '=', 'users.tipo_user_id')

        ->where('alumnos.borrado','0')

        ->where(function($query) use ($buscar){
            $query->where('alumnos.num_documento','like','%'.$buscar.'%');
            $query->orWhere('alumnos.nombres','like','%'.$buscar.'%');
            $query->orWhere('alumnos.apellido_paterno','like','%'.$buscar.'%');
            $query->orWhere('alumnos.apellido_materno','like','%'.$buscar.'%');
            $query->orWhere('users.name','like','%'.$buscar.'%');
            $query->orWhere('users.email','like','%'.$buscar.'%');
            }) 
            ->orderBy('alumnos.apellido_paterno')
            ->orderBy('alumnos.apellido_materno')
            ->orderBy('alumnos.nombres')
            ->orderBy('alumnos.id')
        ->select(
                'alumnos.id as idP',
                'alumnos.tipo_documento_id',
                'alumnos.num_documento',
                'alumnos.nombres',
                DB::Raw("concat( IFNULL(`alumnos`.`apellido_paterno`,'') , ' ', IFNULL(`alumnos`.`apellido_materno`,'')) as apellidos"),

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
        ->union( DB::table('docentes')
        ->join('tipo_documentos', 'tipo_documentos.id', '=', 'docentes.tipo_documento_id')
        ->join('users', 'users.id', '=', 'docentes.user_id')
        ->join('tipo_users', 'tipo_users.id', '=', 'users.tipo_user_id')

        
        ->where('docentes.borrado','0')

        ->where(function($query) use ($buscar){
            $query->where('docentes.num_documento','like','%'.$buscar.'%');
            $query->orWhere('docentes.nombre','like','%'.$buscar.'%');
            $query->orWhere('docentes.apellidos','like','%'.$buscar.'%');
            $query->orWhere('users.name','like','%'.$buscar.'%');
            $query->orWhere('users.email','like','%'.$buscar.'%');
            }) 
            ->orderBy('docentes.apellidos')
            ->orderBy('docentes.nombre')
            ->orderBy('docentes.id')
        ->select(
                'docentes.id as idP',
                'docentes.tipo_documento_id',
                'docentes.num_documento',
                'docentes.nombre as nombres',
                'docentes.apellidos',
                

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
         ))
         ->union(DB::table('users')
         ->join('apoderado_users', 'apoderado_users.user_id', '=', 'users.id')
         ->join('tipo_documentos', 'tipo_documentos.id', '=', 'apoderado_users.tipo_documento_id')
         ->join('tipo_users', 'tipo_users.id', '=', 'users.tipo_user_id')

        
        ->where('users.tipo_user_id','5')
        ->where('users.borrado','0')

        ->where(function($query) use ($buscar){
            $query->where('apoderado_users.num_documento','like','%'.$buscar.'%');
            $query->orWhere('apoderado_users.nombres','like','%'.$buscar.'%');
            $query->orWhere('apoderado_users.apellido_paterno','like','%'.$buscar.'%');
            $query->orWhere('apoderado_users.apellido_materno','like','%'.$buscar.'%');
            $query->orWhere('users.name','like','%'.$buscar.'%');
            $query->orWhere('users.email','like','%'.$buscar.'%');
            }) 
            ->orderBy('apoderado_users.apellido_paterno')
            ->orderBy('apoderado_users.apellido_materno')
            ->orderBy('apoderado_users.nombres')
            ->orderBy('apoderado_users.id')
            ->groupBy('apoderado_users.user_id')
        ->select(
                'users.id as idP',
                'apoderado_users.tipo_documento_id',
                'apoderado_users.num_documento',
                DB::Raw("concat( IFNULL(`apoderado_users`.`apellido_paterno`,'') , ' ', IFNULL(`apoderado_users`.`apellido_materno`,'')) as apellidos"),
                'apoderado_users.nombres',               

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
         ))
         ->union( DB::table('directors')
        ->join('tipo_documentos', 'tipo_documentos.id', '=', 'directors.tipo_documento_id')
        ->join('users', 'users.id', '=', 'directors.user_id')
        ->join('tipo_users', 'tipo_users.id', '=', 'users.tipo_user_id')

        
        ->where('directors.borrado','0')

        ->where(function($query) use ($buscar){
            $query->where('directors.num_documento','like','%'.$buscar.'%');
            $query->orWhere('directors.nombre','like','%'.$buscar.'%');
            $query->orWhere('directors.apellidos','like','%'.$buscar.'%');
            $query->orWhere('users.name','like','%'.$buscar.'%');
            $query->orWhere('users.email','like','%'.$buscar.'%');
            }) 
            ->orderBy('directors.apellidos')
            ->orderBy('directors.nombre')
            ->orderBy('directors.id')
        ->select(
                'directors.id as idP',
                'directors.tipo_documento_id',
                'directors.num_documento',
                'directors.nombre as nombres',
                'directors.apellidos',
                

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
         ))
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
            'registros'=>$registros,
        ];
    }

    public function indexE()
    {
        $iduser =Auth::user()->id;

        $registros = Mensaje::where('user_id_envia', $iduser)
                            ->where('activo', 1)
                            ->where('borrado', 0)
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

            'registros'=>$registros,
        ];
    }

    public function indexR()
    {
        $iduser =Auth::user()->id;

        $registros = Mensaje::where('user_id_recibe', $iduser)
                            ->where('activo', 1)
                            ->where('borrado', 0)
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

            'registros'=>$registros,
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ini_set('memory_limit','256M');
        ini_set('upload_max_filesize','20M');

        $titulo=$request->titulo;
        $mensaje=$request->mensaje;
        $users = json_decode(stripslashes($request->users));

        $result='1';
        $msj='';
        $selector='';


        $input1  = array('mensaje' => $mensaje);
        $reglas1 = array('mensaje' => 'required');

        $validator1 = Validator::make($input1, $reglas1);


        if ($validator1->fails())
        {
            $result='0';
            $msj='Debe ingresar el Mensaje';
            $selector='txtmensaje';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if ($users == null || count($users) == 0)
        {
            $result='0';
            $msj='Debe de ingresar los usuarios al que va dirigido el mensaje';
            $selector='txtbuscarZ';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        $iduser =Auth::user()->id;

        $newMensaje = new Mensaje;

        $newMensaje->fecha = date('Y-m-d');
        $newMensaje->hora = date('H:i:s');
        $newMensaje->estado = '0';
        $newMensaje->titulo=$titulo;
        $newMensaje->mensaje=$mensaje;
        $newMensaje->user_id_envia = $iduser;
        $newMensaje->activo = '1';
        $newMensaje->borrado = '0';

        $newMensaje->save();


        $allAlumnos = false;
        $allDocentes = false;
        $allPadres = false;
        $allDirectors = false;
      

        foreach ($users as $key => $user) {
            if($user->id == 'Alu' && $user->tipo_user_id == '4'){
                $allAlumnos = true;
            }

            if($user->id == 'Pad' && $user->tipo_user_id == '5'){
                $allPadres = true;
            }

            if($user->id == 'Dir' && $user->tipo_user_id == '1'){
                $allDirectors = true;
            }

            if($user->id == 'Doc' && $user->tipo_user_id == '3'){
                $allDocentes = true;
            }
        }

        if($allAlumnos){
            $usersA = User::where('tipo_user_id', '4')->where('borrado','0')->where('id','!=',$iduser)->get();
            foreach ($usersA as $key => $user) {
                $newUserMensaje = new UserMensaje;

                $newUserMensaje->user_id = $user->id;
                $newUserMensaje->activo = '1';
                $newUserMensaje->borrado = '0';
                $newUserMensaje->mensaje_id = $newMensaje->id;
                $newUserMensaje->estado = '0';             
        
                $newUserMensaje->save();
            }
        }

        if($allPadres){
            $usersP = User::where('tipo_user_id', '5')->where('borrado','0')->where('id','!=',$iduser)->get();
            foreach ($usersP as $key => $user) {
                $newUserMensaje = new UserMensaje;

                $newUserMensaje->user_id = $user->id;
                $newUserMensaje->activo = '1';
                $newUserMensaje->borrado = '0';
                $newUserMensaje->mensaje_id = $newMensaje->id;
                $newUserMensaje->estado = '0';             
        
                $newUserMensaje->save();
            }
        }

        if($allDirectors){
            $usersD = User::where('tipo_user_id', '1')->where('borrado','0')->where('id','!=',$iduser)->get();
            foreach ($usersD as $key => $user) {
                $newUserMensaje = new UserMensaje;

                $newUserMensaje->user_id = $user->id;
                $newUserMensaje->activo = '1';
                $newUserMensaje->borrado = '0';
                $newUserMensaje->mensaje_id = $newMensaje->id;
                $newUserMensaje->estado = '0';             
        
                $newUserMensaje->save();
            }
        }

        if($allDocentes){
            $usersDo = User::where('tipo_user_id', '3')->where('borrado','0')->where('id','!=',$iduser)->get();
            foreach ($usersDo as $key => $user) {
                $newUserMensaje = new UserMensaje;

                $newUserMensaje->user_id = $user->id;
                $newUserMensaje->activo = '1';
                $newUserMensaje->borrado = '0';
                $newUserMensaje->mensaje_id = $newMensaje->id;
                $newUserMensaje->estado = '0';             
        
                $newUserMensaje->save();
            }
        }

        foreach ($users as $key => $user) {
            $mandarMsje = true;
            if($allAlumnos && $user->tipo_user_id == '4'){
                $mandarMsje = false;
            }

            if($allPadres && $user->tipo_user_id == '5'){
                $mandarMsje = false;
            }

            if($allDirectors && $user->tipo_user_id == '1'){
                $mandarMsje = false;
            }

            if($allDocentes && $user->tipo_user_id == '3'){
                $mandarMsje = false;
            }

            if($mandarMsje){
                $newUserMensaje = new UserMensaje;

                $newUserMensaje->user_id = $user->id;
                $newUserMensaje->activo = '1';
                $newUserMensaje->borrado = '0';
                $newUserMensaje->mensaje_id = $newMensaje->id;
                $newUserMensaje->estado = '0';             
        
                $newUserMensaje->save();
            }
        }

        $msj='Mensaje Remitido con Éxito';

        return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        ini_set('memory_limit','256M');
        ini_set('upload_max_filesize','20M');

        $titulo=$request->titulo;
        $mensaje=$request->mensaje;
        $users = json_decode(stripslashes($request->users));

        $result='1';
        $msj='';
        $selector='';


        $input1  = array('mensaje' => $mensaje);
        $reglas1 = array('mensaje' => 'required');

        $validator1 = Validator::make($input1, $reglas1);
        $validator2 = Validator::make($input2, $reglas2);


        if ($validator1->fails())
        {
            $result='0';
            $msj='Debe ingresar el Mensaje';
            $selector='txtmensaje';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

      /*   foreach ($users as $key => $user) {
            # code...
        } */
      

        $registro = Mensaje::find($id);

        $registro->fecha = date('d-m-Y');
        $registro->hora = date('H:i:s');
        $registro->estado = '0';
        $registro->titulo=$titulo;
        $registro->mensaje=$mensaje;

        $registro->save();

        $msj='Mensaje Actualizado con Éxito';

        return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result='1';
        $msj='1';

        $registro = Mensaje::find($id);
        $registro->delete();      

        $msj='Mensaje eliminado exitosamente';

        return response()->json(["result"=>$result,'msj'=>$msj]);
    }
}
