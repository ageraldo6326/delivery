<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\Models\Categorias;
use Illuminate\Http\Request;
use App\Models\Subcategorias;
use App\Http\Controllers\Controller;
use App\Models\Proveedores;

class CategoriasController extends Controller
{
    public function __construct() {
     $this->middleware('auth');
    }    

    public function index()
    {
        //
        $categorias = Categorias::where("proveedor_id",session()->get("proveedor_id"))->get();

        $proveedor = Proveedores::where("id",session()->get("proveedor_id"))->first();

        session(["proveedor_nombre" => $proveedor->nombre]);

        return view("admin.categorias.index",compact("categorias"));

    }


    public function create()
    {

        return view("admin.categorias.create");
    }


    public function store(Request $request)
    {
        //

        $validated = $request->validate([
        'nombre' => 'required',
        'descripcion' => 'required',
        'portada' => 'required',
        'fotourl' => 'required'
        ]);


        $categoria = new Categorias();
        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion;
        $categoria->proveedor_id = session()->get("proveedor_id");

        if ($request->has('portada')) {
            $categoria->portada = 1;
        } else {
            $categoria->portada = 0;
        }        

        if ($request->hasFile('fotourl')) {

            $urlfoto = $request->file("fotourl");
  
            $categoria->fotourl = $request->file("fotourl")->getClientOriginalName(); 
              
            $ruta = public_path('\\img\\categorias\\').$request->file("fotourl")->getClientOriginalName();
          
            copy($urlfoto->getRealPath(),$ruta);
        }
 

        $categoria->save();

        return redirect()->route("admin.categorias.index");
    }


    public function show($id)
    {
    
        $categorias =  Categorias::where('proveedor_id',$id)->get();

        $proveedor_nombre = Proveedores::where('id',$id)->first()->nombre;

        session(['proveedor_id' => $id,"proveedor_nombre" => $proveedor_nombre]);

        return view("admin.categorias.index",compact("categorias"));
    }


    public function edit($id)
    {
        //

        $categoria = Categorias::Where('id',$id)->first();
        
        return view("admin.categorias.edit", compact("categoria"));
    }


    public function update(Request $request, $id)
    {
        //

        $validated = $request->validate([
        'nombre' => 'required',
        'descripcion' => 'required'
        ]);

        $categoria = Categorias::Where('id',$id)->first();

        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion;
        $categoria->proveedor_id = session()->get("proveedor_id");


        if ($request->has('portada')) {
            $categoria->portada = 1;
        } else {
            $categoria->portada = 0;
        }
        
        if ($request->hasFile('fotourl')) {

           $urlfoto = $request->file("fotourl");
 
           $categoria->fotourl = $request->file("fotourl")->getClientOriginalName(); 
             
           $ruta = public_path('\\img\\categorias\\').$request->file("fotourl")->getClientOriginalName();
         
           copy($urlfoto->getRealPath(),$ruta);
         }

        $categoria->save();

        return redirect()->route("admin.categorias.index");
    }


    public function destroy($id)
    {
        //
       

        $categoria = Categorias::Where('id',$id)->first();

        $categoria->delete();

        $categorias = Categorias::all();

        return view("admin.categorias.index",compact("categorias"));


    }
}
