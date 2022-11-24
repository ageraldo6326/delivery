<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Categoriagenerales;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categoriasgenerales;
use Illuminate\Support\Facades\Redirect;

class CategoriasgeneralesController extends Controller
{
    //

    public function __construct() {
     $this->middleware('auth');
    }    

    public function index() {
        $categoriasgenerales = Categoriasgenerales::all();

        return view("admin.categoriasgenerales.index",compact("categoriasgenerales"));
    }

    public function edit($id){

        $categoriagenerale = Categoriasgenerales::where("id",$id)->first();

        return view("admin.categoriasgenerales.edit",compact("categoriagenerale"));

    }

    public function create(){

        return view("admin.categoriasgenerales.create");

    }    

    

    public function update(Request $request,$id) {

        $categoriagenerale = Categoriasgenerales::where("id",$id)->first();

        $categoriagenerale->nombre = $request->nombre;

        $categoriagenerale->descripcion = $request->descripcion;

        $categoriagenerale->save();

        return Redirect::route("admin.categoriasgenerales.index")->with(["estado" => "Categoria " . $categoriagenerale->nombre . " actualizada"]);

    }

    public function store(Request $request) {

        $categoriagenerale = new Categoriasgenerales;

        $categoriagenerale->nombre = $request->nombre;

        $categoriagenerale->descripcion = $request->descripcion;

        $categoriagenerale->save();

        return Redirect::route("admin.categoriasgenerales.index")->with(["estado" => "Categoria " . $categoriagenerale->nombre . " agregada"]);

    }

    public function destroy($id) {

        $categoriageneral = Categoriasgenerales::where("id",$id)->first();

        $categoriageneral->delete();

        return Redirect::back()->with(["estado" => "Categoria eliminada"]);        

    }

}
