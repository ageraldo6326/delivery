<?php

namespace App\Http\Controllers\Admin;

use App\Models\Proveedores;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Categorias;
use App\Models\Categoriasgenerales;

class ProveedoresController extends Controller
{
    //
    public function __construct() {
     $this->middleware('auth');
    }
    
    public function index()
    {
        //
        $proveedores = Proveedores::all();
        

        return view("admin.proveedores.index",compact("proveedores"));
    }

    public function create()
    {
        $categoriasgenerales = Categoriasgenerales::all();
        return view("admin.proveedores.create",compact("categoriasgenerales"));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
        'nombre' => 'required',
        'telefono' => 'required',
        'correo' => 'required',
        'descripcion' => 'required',
        'direccion' => 'required',
        'fotourl' => 'required',
        'categoriageneral_id' => 'required'
        ]);

        $proveedor = new Proveedores();
        $proveedor->nombre = $request->nombre;
        $proveedor->telefono = $request->telefono;
        $proveedor->correo = $request->correo;
        $proveedor->direccion = $request->direccion;
        $proveedor->descripcion = $request->descripcion;
        $proveedor->categoriageneral_id = $request->categoriageneral_id;

        if ($request->has("estado")) {
            $proveedor->estado = 1;
        } else {
            $proveedor->estado = 0;
        }        

        if ($request->hasFile('fotourl')) {

            $urlfoto = $request->file("fotourl");
  
            $proveedor->fotourl = $request->file("fotourl")->getClientOriginalName(); 
              
            $ruta = public_path('\\img\\proveedores\\').$request->file("fotourl")->getClientOriginalName();
          
            copy($urlfoto->getRealPath(),$ruta);
        }
 

        $proveedor->save();

        $proveedores = Proveedores::all();

        

        return redirect()->route("admin.proveedores.index",compact("proveedores"));
    }

    public function edit($id)
    {
        //

        $proveedor = Proveedores::Where('id',$id)->first();
        $categoriasgenerales = Categoriasgenerales::all();
        
        return view("admin.proveedores.edit", compact("proveedor","categoriasgenerales"));
    }


    public function update(Request $request, $id)
    {
        //dd($request);
        
         $validated = $request->validate([
        'nombre' => 'required',
        'telefono' => 'required',
        'correo' => 'required',
        'descripcion' => 'required',
        'categoriageneral_id' => 'required'
        ]);

        $proveedor = Proveedores::where("id",$id)->first();
        $proveedor->nombre = $request->nombre;
        $proveedor->telefono = $request->telefono;
        $proveedor->correo = $request->correo;
        $proveedor->direccion = $request->direccion;
        $proveedor->descripcion = $request->descripcion;
        $proveedor->categoriageneral_id = $request->categoriageneral_id;

        if ($request->has("estado")) {
            $proveedor->estado = 1;
        } else {
            $proveedor->estado = 0;
        }
        

        if ($request->hasFile('fotourl')) {

            $urlfoto = $request->file("fotourl");
  
            $proveedor->fotourl = $request->file("fotourl")->getClientOriginalName(); 
              
            $ruta = public_path('\\img\\proveedores\\').$request->file("fotourl")->getClientOriginalName();
          
            copy($urlfoto->getRealPath(),$ruta);
        }
 

        $proveedor->save();

        $proveedores = Proveedores::all();

        

        return redirect()->route("admin.proveedores.index",compact("proveedores"));

        
    }




}
