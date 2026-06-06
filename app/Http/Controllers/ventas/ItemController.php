<?php

namespace App\Http\Controllers\ventas;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    public function buscarItem(Request $request){

        $result='1';
        $msj='';
        $selector='';

        $codigo = $request->input('codigo');

        /*
        $item = Item::with('tipoItem')
            ->where('items.codigo', '=', $codigo)
            ->where('items.activo', '=', 1)
            ->where('items.borrado', '=', 0)
            ->first();
        */
        $items = Item::with('tipoItem')
        ->where(function ($query) use ($codigo) {
            $query->where('items.codigo', 'like', "%{$codigo}%")
                ->orWhere('items.descripcion', 'like', "%{$codigo}%");
        })
        ->where('items.activo', 1)
        ->where('items.borrado', 0)
        ->get();

        $resultFound = false;
        if(!$items->isEmpty()){
            $resultFound = true;
            $msj='Item encontrado en el Sistema';
        }

        if ($items->count() === 1) {

            return response()->json([
                "result"=>$result,
                'msj'=>$msj,
                'item'=>$items->first(),
                'single'      => true, 
                'resultFound' => $resultFound,
                'items'       => [],
            ]);
        }

        return response()->json([
                "result"=>$result,
                'msj'=>$msj,
                'item'=> null,
                'single'      => false, 
                'resultFound' => $resultFound,
                'items'       => $items,
            ]);

    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
