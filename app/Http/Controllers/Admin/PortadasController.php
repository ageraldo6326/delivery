<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portadas;
use Illuminate\Http\Request;

class PortadasController extends Controller
{
    //
    public function __construct() {
     $this->middleware('auth');
    }    

    public function index()
    {
        //
        $portadas = Portadas::all();

        return view("admin.portadas.index",compact("portadas"));
    }

    public function create()
    {

        return view("admin.portadas.create");
    }

    public function store(Request $request)
    {
        //
        $portada = new portadas();
        $portada->mensaje = $request->mensaje;
        $portada->enlace = $request->enlace;
        $portada->orden = $request->orden;

        if ($request->hasFile('fotourl')) {

            $urlfoto = $request->file("fotourl");
  
            $portada->fotourl = $request->file("fotourl")->getClientOriginalName(); 
              
            $ruta = public_path('\\img\\portadas\\').$request->file("fotourl")->getClientOriginalName();
          
            copy($urlfoto->getRealPath(),$ruta);
        }

        $portada->save();


        return redirect()->route("admin.portadas.index");
    }

     public function update(Request $request,$id)
    {
        //
        $portada = Portadas::Where('id',$id)->first();
        $portada->mensaje = $request->mensaje;
        $portada->enlace = $request->enlace;
        $portada->orden = $request->orden;

        if ($request->hasFile('fotourl')) {

            $urlfoto = $request->file("fotourl");
  
            $portada->fotourl = $request->file("fotourl")->getClientOriginalName(); 
              
            $ruta = public_path('\\img\\portadas\\').$request->file("fotourl")->getClientOriginalName();
          
            copy($urlfoto->getRealPath(),$ruta);
        }
 

        $portada->save();

        
        return redirect()->route("admin.portadas.index");
    }

   

    public function destroy($id)
    {
        //
       

        $portada = Portadas::Where('id',$id)->first();

        $portada->delete();

        return redirect()->route("admin.portadas.index");


    }


    public function edit($id)
    {
        //

        $portada = Portadas::Where('id',$id)->first();
        
        return view("admin.portadas.edit", compact("portada"));
    }

}
