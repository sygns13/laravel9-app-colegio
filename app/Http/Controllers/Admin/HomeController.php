<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Resolucion;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(){

        $iduser=Auth::user()->id;
        $user = User::find($iduser);
        
        $resolucionAperturas = Resolucion::where('activo',1)->where('borrado',0)->where('tipo',1)->orderBy('id','desc')->get();
        $resolucionCierres = Resolucion::where('activo',1)->where('borrado',0)->where('tipo',1)->orderBy('id','desc')->get();

        if($user->activo != '1'){
            Auth::guard('web')->logout();

          return redirect()->back()
            ->withErrors([
                'email' => 'usuarioActiv'
            ]);
        }

        return view('admin.inicio.index',compact('user', 'resolucionAperturas', 'resolucionCierres'));
    }

    public function legajo(){

        $iduser=Auth::user()->id;
        $user = User::find($iduser);

        if($user->activo != '1'){
            Auth::guard('web')->logout();

          return redirect()->back()
            ->withErrors([
                'email' => 'usuarioActiv'
            ]);
        }

        return view('admin.legajo.index');
    }

    public function legajoNuevo2(){

        $iduser=Auth::user()->id;
        $user = User::find($iduser);

        if($user->activo != '1'){
            Auth::guard('web')->logout();

          return redirect()->back()
            ->withErrors([
                'email' => 'usuarioActiv'
            ]);
        }


        return view('admin.legajo-nuevo2.index',compact('user'));
    }

    public function legajoFichas(){

        $iduser=Auth::user()->id;
        $user = User::find($iduser);

        if($user->activo != '1'){
            Auth::guard('web')->logout();

          return redirect()->back()
            ->withErrors([
                'email' => 'usuarioActiv'
            ]);
        }

        return view('admin.legajo-fichas.index',compact('user'));
    }
}
