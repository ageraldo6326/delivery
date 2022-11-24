<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Clientecontroller extends Controller
{
    //

    public function __construct() {
     $this->middleware('auth');
    }

    public function index() {
        return view("cliente.index");
    }
}
