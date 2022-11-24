<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Detalles;

class DetallesController extends Controller
{
    //

    public function __construct() {
     $this->middleware('auth');
    }    

    public function show($id)
    {
        //
        
        $detalles = Detalles::where("pedido_id",$id)->get();

        return view("admin.detalles.index",compact("detalles"));
    }


}
