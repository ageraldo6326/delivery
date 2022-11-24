<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pedidos;
use Illuminate\Http\Request;

class PedidosController extends Controller
{

    public function __construct() {
     $this->middleware('auth');
    }

    public function index(Request $request)
    {
        //

        if ($request->buscar=="Buscar") {

        $pedidos = Pedidos::where('created_at','>=',$request->fecha_inicio . ' 00:00:00')
        ->where('created_at','<=',$request->fecha_fin . ' 23:59:59')
        ->orderby('id','desc')->paginate(5);

        return view("admin.pedidos.index",compact("pedidos"));

        } else {

        $pedidos = Pedidos::paginate(5);  

        return view("admin.pedidos.index",compact("pedidos"));
        
        } 


        return view("admin.pedidos.index",compact("pedidos"));
    }

    
    public function edit($id)
    {
        //

        $pedido = Pedidos::Where('id',$id)->first();
        
        return view("admin.pedidos.edit", compact("pedido"));

    }

    public function update(Request $request, $id)
    {
        //

        $pedido = Pedidos::Where('id',$id)->first();


        if ($request->estado=="") {
            $pedido->estado = 0;
        } else {
            $pedido->estado = 1;
        }

        $pedido->save();

        $pedidos = Pedidos::all();

        return view("admin.pedidos.index",compact("pedidos"));

    }
}
