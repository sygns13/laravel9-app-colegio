<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Auth;

use App\Models\Curso;
use App\Models\Grado;

use stdClass;

class CursoController extends Controller
{
    public function index1()
    {
        return view('admin.curso.index');
    }

    public function index()
    {

        $registros = Curso::GetAllDataCursos();
        
        return [ 
                'registros' => $registros 
               ];
    }

    public function store(Request $request)
    {
        $result='1';
        $msj='';
        $selector='';

        $nombre=$request->nombre;
        $orden=$request->orden;
        $grado_id=$request->grado_id;

        $input1  = array('nombre' => $nombre);
        $reglas1 = array('nombre' => 'required');

        $input2  = array('orden' => $orden);
        $reglas2 = array('orden' => 'required');

        $validator1 = Validator::make($input1, $reglas1);
        $validator2 = Validator::make($input2, $reglas2);

        if ($validator1->fails())
        {
            $result='0';
            $msj='Debe ingresar el nombre del Curso';
            $selector='txtnombre';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if ($validator2->fails())
        {
            $result='0';
            $msj='Debe ingresar el Orden';
            $selector='txtorden';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        $registro = new Curso;

        $registro->nombre=$nombre;
        $registro->orden=$orden;
        $registro->grado_id=$grado_id;
        $registro->activo='1';
        $registro->borrado='0';

        $registro->save();



        $msj='El Curso se ha registrado con éxito';

        return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
    }

    public function update(Request $request, $id)
    {
        $result='1';
        $msj='';
        $selector='';

        $nombre=$request->nombre;
        $orden=$request->orden;
        $grado_id=$request->grado_id;

        $input1  = array('nombre' => $nombre);
        $reglas1 = array('nombre' => 'required');

        $input2  = array('orden' => $orden);
        $reglas2 = array('orden' => 'required');

        $validator1 = Validator::make($input1, $reglas1);
        $validator2 = Validator::make($input2, $reglas2);

        if ($validator1->fails())
        {
            $result='0';
            $msj='Debe ingresar el nombre del curso';
            $selector='txtnombre';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if ($validator2->fails())
        {
            $result='0';
            $msj='Debe ingresar el Orden del Curso';
            $selector='txtorden';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        $registro = Curso::find($id);

        $registro->nombre=$nombre;
        $registro->orden=$orden;

        $registro->save();



        $msj='El Curso se ha modificado con éxito';

        return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
    }

    public function destroy($id)
    {
        $result='1';
        $msj='1';

        $registro = Curso::findOrFail($id);
        $registro->borrado = '1';
        $registro->save();
        
        //$registro->delete();

        $msj='El Curso fue eliminado exitosamente';


        return response()->json(["result"=>$result,'msj'=>$msj]);
    }

}
