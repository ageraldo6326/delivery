<?php

namespace App\Http\Controllers\Admin;

use Sesion;
use App\Models\Categorias;
use Illuminate\Http\Request;
use App\Models\Subcategorias;
use App\Http\Controllers\Controller;


class SubcategoriasController extends Controller
{
    public function __construct() {
     $this->middleware('auth');
    }

    public function index()
    {
        //
        $subcategorias = Subcategorias::all();

        return view("admin.subcategoria.index",compact("subcategorias"));
    }

    public function create()
    {
        return view("admin.subcategorias.create");
    }

    public function store(Request $request)
    {
        //
        $subcategoria = new Subcategorias();
        $subcategoria->nombre = $request->nombre;
        $subcategoria->titulo = $request->titulo;
        $subcategoria->descripcion = $request->descripcion;
        $subcategoria->slug = $request->slug;
        $subcategoria->categoria_id = session()->get("categoria");
        
        
        if ($request->hasFile('fotourl')) {

            $urlfoto = $request->file("fotourl");
  
            $subcategoria->fotourl = $request->file("fotourl")->getClientOriginalName(); 
              
            $ruta = public_path('\\img\\subcategorias\\').$request->file("fotourl")->getClientOriginalName();
          
            copy($urlfoto->getRealPath(),$ruta);
        }
 

        $subcategoria->save();

        $subcategorias = Subcategorias::wherecategoria_id(session()->get("categoria"))->get();

        return view("admin.subcategorias.index",compact("subcategorias"));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //

        $subcategoria = Subcategorias::Where('id',$id)->first();
        
        return view("admin.subcategorias.edit", compact("subcategoria"));
    }


    public function update(Request $request, $id)
    {
        //

        $subcategoria = Subcategorias::Where('id',$id)->first();

        $subcategoria->nombre = $request->nombre;
        $subcategoria->titulo = $request->titulo;
        $subcategoria->descripcion = $request->descripcion;
        $subcategoria->slug = $request->slug;
        $subcategoria->categoria_id = session()->get("categoria");



        
        if ($request->hasFile('fotourl')) {

           $urlfoto = $request->file("fotourl");
 
           $subcategoria->fotourl = $request->file("fotourl")->getClientOriginalName(); 
             
           $ruta = public_path('\\img\\subcategorias\\').$request->file("fotourl")->getClientOriginalName();
         
           copy($urlfoto->getRealPath(),$ruta);
         }

        $subcategoria->save();

        $subcategorias = Subcategorias::wherecategoria_id(session()->get("categoria"))->get();

        return view("admin.subcategorias.index",compact("subcategorias"));
    }

  
    public function destroy($id)
    {
        //
       

        $subcategoria = Subcategorias::Where('id',$id)->first();

        $subcategoria->delete();

        $subcategorias = Subcategorias::wherecategoria_id(session()->get("categoria"))->get();

        return view("admin.subcategorias.index",compact("subcategorias"));


    }
}
