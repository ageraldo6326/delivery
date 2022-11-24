<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UsuariosController extends Controller
{
    //
    public function __construct() {
     $this->middleware('auth');
    }


    public function index () {
        $usuarios = User::paginate(2);
        // dd($usuarios);
        return view("admin\usuarios\index",["usuarios" => $usuarios]);
    }

    public function edit($id) {

        $usuario = User::Where('id', $id)->first();
        
        return view('admin.usuarios.editar',["usuario" => $usuario]);
    }

    public function update(Request $request, $id){


        $usuario = User::Where('id', $id)->first();
        $usuario->celular = $request->celular;
        $usuario->credito_diario = $request->credito_diario;
        $usuario->subsidio_diario = $request->subsidio_diario;

        if ($request->has('estado')) {
            $usuario->estado = 1; 
        } else {
            $usuario->estado = 0; 
        }

        $usuario->save();
        
        return redirect()->route("admin.usuarios.index");
    }
}
