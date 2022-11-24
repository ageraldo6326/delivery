<?php

namespace App\Http\Controllers\Proveedores;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Panelproveedorescontroller extends Controller
{
    //

    public function __construct() {
     $this->middleware('auth');
    }

    public function index() {
        return view("proveedor.index");
    }
}
