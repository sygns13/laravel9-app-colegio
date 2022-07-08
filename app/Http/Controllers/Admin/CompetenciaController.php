<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Auth;

use App\Models\Curso;
use App\Models\Competencia;

use stdClass;


class CompetenciaController extends Controller
{

    public function index(Request $request)
    {

        $cursos_id=$request->cursos_id;

        $registros = Competencia::where('activo','1')
                    ->where('borrado','0')
                    ->where('cursos_id',$cursos_id)
                    ->get();
        
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
        $cursos_id=$request->cursos_id;

        $input1  = array('nombre' => $nombre);
        $reglas1 = array('nombre' => 'required');

        $input2  = array('orden' => $orden);
        $reglas2 = array('orden' => 'required');

        $validator1 = Validator::make($input1, $reglas1);
        $validator2 = Validator::make($input2, $reglas2);

        if ($validator1->fails())
        {
            $result='0';
            $msj='Debe ingresar el nombre de la Competencia';
            $selector='txtnombreC';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if ($validator2->fails())
        {
            $result='0';
            $msj='Debe ingresar el Orden de impresión de la Competencia';
            $selector='txtordenC';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        $registro = new Competencia;

        $registro->nombre=$nombre;
        $registro->orden=$orden;
        $registro->cursos_id=$cursos_id;
        $registro->activo='1';
        $registro->borrado='0';

        $registro->save();



        $msj='La Competencia se ha registrado con éxito';

        return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
    }

    public function update(Request $request, $id)
    {
        $result='1';
        $msj='';
        $selector='';

        $nombre=$request->nombre;
        $orden=$request->orden;
        $cursos_id=$request->cursos_id;

        $input1  = array('nombre' => $nombre);
        $reglas1 = array('nombre' => 'required');

        $input2  = array('orden' => $orden);
        $reglas2 = array('orden' => 'required');

        $validator1 = Validator::make($input1, $reglas1);
        $validator2 = Validator::make($input2, $reglas2);

        if ($validator1->fails())
        {
            $result='0';
            $msj='Debe ingresar el nombre de la Competencia';
            $selector='txtnombreC';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if ($validator2->fails())
        {
            $result='0';
            $msj='Debe ingresar el Orden de impresión de la Competencia';
            $selector='txtordenC';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        $registro = Competencia::find($id);

        $registro->nombre=$nombre;
        $registro->orden=$orden;

        $registro->save();



        $msj='La Competencia se ha modificado con éxito';

        return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
    }

    public function destroy($id)
    {
        $result='1';
        $msj='1';

        $registro = Competencia::findOrFail($id);
        $registro->borrado = '1';
        $registro->save();
        
        //$registro->delete();

        $msj='La Competencia fue eliminada exitosamente';


        return response()->json(["result"=>$result,'msj'=>$msj]);
    }
}
