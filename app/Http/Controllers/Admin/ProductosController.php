<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Productos;
use App\Models\Categorias;
use Illuminate\Http\Request;

class ProductosController extends Controller
{
    public function __construct() {
     $this->middleware('auth');
    }    

    public function index()
    {
        //

        $productos = Productos::where('categoria_id',session()->get("categoria_id") )->get();

        return view("admin.productos.index",compact("productos"));
    }


    public function create()
    {
        //

        return view("admin.productos.create");
    }


    public function store(Request $request)
    {
        //
        $validated = $request->validate([
        'nombre' => 'required',
        'descripcion' => 'required',
        'precio' => 'required',
        'fotourl' => 'required'
        ]);

        $producto = new Productos();
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->precio = $request->precio;
        $producto->unidad = $request->unidad;
        $producto->fotourl = $request->fotourl;
        $producto->proveedor_id = session()->get("proveedor_id");
        $producto->categoria_id = session()->get("categoria_id");
        
        
        if ($request->hasFile('fotourl')) {

            $urlfoto = $request->file("fotourl");
    
            $producto->fotourl = $request->file("fotourl")->getClientOriginalName(); 
                
            $ruta = public_path('\\img\\productos\\').$request->file("fotourl")->getClientOriginalName();
            
            copy($urlfoto->getRealPath(),$ruta);
        }


        $producto->save();

        return redirect()->route("admin.productos.index");
    }


    public function show($id)
    {
        //
        session(["categoria_id" => $id]);

        $categoria_nombre = Categorias::where('id',$id)->first()->nombre;
        
        $productos = Productos::where('categoria_id',$id)->get();

        session(["categoria_nombre" => $categoria_nombre]);

        return view("admin.productos.index",compact("productos"));
    }

    public function edit($id)
    {
        $producto = Productos::where('id',$id)->first();

        return view("admin.productos.edit",compact("producto"));
    }


    public function update(Request $request, $id)
    {
        //

        $validated = $request->validate([
        'nombre' => 'required',
        'descripcion' => 'required',
        'precio' => 'required'
        ]);

        $producto = Productos::where("id",$id)->first();
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->precio = $request->precio;
        $producto->unidad = $request->unidad;        
        
        if ($request->hasFile('fotourl')) {

            $urlfoto = $request->file("fotourl");
  
            $producto->fotourl = $request->file("fotourl")->getClientOriginalName(); 
              
            $ruta = public_path('\\img\\productos\\').$request->file("fotourl")->getClientOriginalName();
          
            copy($urlfoto->getRealPath(),$ruta);
        }
 

        $producto->save();

        return redirect()->route("admin.productos.index");
    }


    public function destroy($id)
    {
        $producto = Productos::where("id",$id)->first();

        $producto->delete();

        $productos = Productos::wheresubcategoria_id(session()->get("subcategoria"))->get();
        return view("admin.productos.index",compact("productos"));

        
    }
}
