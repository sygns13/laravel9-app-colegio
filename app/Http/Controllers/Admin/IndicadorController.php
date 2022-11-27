<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Auth;

use App\Models\Curso;
use App\Models\Competencia;
use App\Models\Indicador;
use App\Models\CicloEscolar;
use App\Models\CicloCurso;
use App\Models\CicloCompetencia;
use App\Models\CicloIndicador;

use stdClass;

class IndicadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $competencia_id=$request->competencia_id;
        $cursos_id=$request->cursos_id;

        $competencias = Competencia::where('activo','1')
                    ->where('borrado','0')
                    ->where('cursos_id',$cursos_id)
                    ->orderBy('orden')
                    ->orderBy('nombre')
                    ->get();

        foreach ($competencias as $key => $competencia) {
            $indicadores = Indicador::where('borrado','0')
                                        ->where('activo','1')
                                        ->where('competencia_id', $competencia->id)
                                        ->orderBy('orden')
                                        ->orderBy('nombre')
                                        ->get();
    
            $competencia->indicadores = $indicadores;
        }

        $registros = Indicador::where('activo','1')
                    ->where('borrado','0')
                    ->where('competencia_id',$competencia_id)
                    ->orderBy('orden')
                    ->orderBy('nombre')
                    ->get();
        
        return [ 
                'registros' => $registros ,
                'competencias' => $competencias ,
               ];
    }

    public function store(Request $request)
    {
        $result='1';
        $msj='';
        $selector='';

        $nombre=$request->nombre;
        $orden=$request->orden;
        $competencia_id=$request->competencia_id;

        $input1  = array('nombre' => $nombre);
        $reglas1 = array('nombre' => 'required');

        $input2  = array('orden' => $orden);
        $reglas2 = array('orden' => 'required');

        $validator1 = Validator::make($input1, $reglas1);
        $validator2 = Validator::make($input2, $reglas2);

        if ($validator1->fails())
        {
            $result='0';
            $msj='Debe ingresar el nombre del Indicador';
            $selector='txtnombreI';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if ($validator2->fails())
        {
            $result='0';
            $msj='Debe ingresar el Orden de impresión del Indicador';
            $selector='txtordenI';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        $registro = new Indicador;

        $registro->nombre=$nombre;
        $registro->orden=$orden;
        $registro->competencia_id=$competencia_id;
        $registro->activo='1';
        $registro->borrado='0';

        $registro->save();

        //Data Transaccional
        $cicloActivo = CicloEscolar::GetCicloActivo();

        if($cicloActivo != null){

            $competenciaActiva = CicloCompetencia::GetCompetenciaByCicloAndCompetencia($cicloActivo->id, $competencia_id);

            $registro_competencia = new CicloIndicador;
            $registro_competencia->ciclo_competencia_id = $competenciaActiva->id;
            $registro_competencia->nombre = $registro->nombre;
            $registro_competencia->orden = $registro->orden;
            $registro_competencia->indicador_id = $registro->id;
            $registro_competencia->activo='1';
            $registro_competencia->borrado='0';
            $registro_competencia->ciclo_escolar_id=$cicloActivo->id;

            $registro_competencia->save();

        }



        $msj='El Indicador se ha registrado con éxito';

        return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
    }

    public function update(Request $request, $id)
    {
        $result='1';
        $msj='';
        $selector='';

        $nombre=$request->nombre;
        $orden=$request->orden;
        $competencia_id=$request->competencia_id;

        $input1  = array('nombre' => $nombre);
        $reglas1 = array('nombre' => 'required');

        $input2  = array('orden' => $orden);
        $reglas2 = array('orden' => 'required');

        $validator1 = Validator::make($input1, $reglas1);
        $validator2 = Validator::make($input2, $reglas2);

        if ($validator1->fails())
        {
            $result='0';
            $msj='Debe ingresar el nombre del Indicador';
            $selector='txtnombreI';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if ($validator2->fails())
        {
            $result='0';
            $msj='Debe ingresar el Orden de impresión del Indicador';
            $selector='txtordenI';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        $registro = Indicador::find($id);

        $registro->nombre=$nombre;
        $registro->orden=$orden;

        $registro->save();

        //Data Transaccional
        $cicloActivo = CicloEscolar::GetCicloActivo();

        if($cicloActivo != null){
            $registro_indicador = CicloIndicador::GetIndicadorByCicloAndIndicador($cicloActivo->id, $registro->id);

            $registro_indicador->nombre=$registro->nombre;
            $registro_indicador->orden=$registro->orden;

            $registro_indicador->save();
        }



        $msj='El Indicador se ha modificado con éxito';

        return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
    }

    public function destroy($id)
    {
        $result='1';
        $msj='1';

        $registro = Indicador::findOrFail($id);
        $registro->borrado = '1';
        $registro->save();

        //Data Transaccional
        $cicloActivo = CicloEscolar::GetCicloActivo();

        if($cicloActivo != null){
            $registro_indicador = CicloIndicador::GetIndicadorByCicloAndIndicador($cicloActivo->id, $registro->id);
            $registro_indicador->delete();
        }
        
        //$registro->delete();

        $msj='La Competencia fue eliminada exitosamente';


        return response()->json(["result"=>$result,'msj'=>$msj]);
    }
}
