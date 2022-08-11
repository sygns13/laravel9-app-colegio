<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Auth;

use App\Models\CicloEscolar;
use App\Models\Matricula;
use App\Models\TipoDocumento;
use App\Models\User;
use App\Models\Estado;
use App\Models\Departamento;
use App\Models\Provincia;
use App\Models\Distrito;
use App\Models\Niveles;
use App\Models\Grado;

use stdClass;
use Illuminate\Support\Facades\Hash;

class MatriculaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index1()
    {
        $cicloActivo = CicloEscolar::GetCicloActivo();

        $estados = Estado::where('activo',1)->where('borrado',0)->orderBy('nombre','asc')->get();
        $departamentos = Departamento::where('activo',1)->where('borrado',0)->orderBy('nombre','asc')->get();
        $provincias = Provincia::where('activo',1)->where('borrado',0)->orderBy('nombre','asc')->get();
        $distritos = Distrito::where('activo',1)->where('borrado',0)->orderBy('nombre','asc')->get();

        $niveles = Niveles::where('activo',1)->where('borrado',0)->orderBy('id','asc')->get();
        $grados = Grado::where('activo',1)->where('borrado',0)->orderBy('orden','asc')->get();

        return view('admin.matricula.index',compact('cicloActivo', 'estados', 'departamentos', 'provincias', 'distritos', 'niveles', 'grados'));
    }

    public function index(Request $request)
    {
        return $tipoDocumentos = TipoDocumento::all();
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
