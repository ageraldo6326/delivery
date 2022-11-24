<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Portadas;
use App\Models\Productos;
use App\Models\Proveedores;
use App\Models\Balance;
use Cart;
use Illuminate\Http\Request;
use App\Models\Categoriasgenerales;
use App\Http\Controllers\Controller;
use App\Models\Detalles;
use App\Models\Pedidos;
use Illuminate\Support\Facades\Redirect;
use Auth;

class FrontendController extends Controller
{
    //

    public function __construct() {
     $this->middleware('auth');
    }    

    public function index(Request $request) {

        $balance_count = Balance::where('user_id',Auth::user()->id)->count();

        if ($balance_count==1) {
            $balance = Balance::where('user_id',Auth::user()->id)->first(); 
            session(['balance' => $balance->balance_del_dia]);
        } else {
            session(['balance' => Auth::user()->credito_diario]);
        }

        $portadas = Portadas::all();

        $categoriasgenerales = Categoriasgenerales::all();

        if (!(trim($request->valor_busqueda==""))) {
            $proveedores = Proveedores::where('nombre', 'like', '%' . trim($request->valor_busqueda) . '%' )
            ->orWhere('descripcion', 'like', '%' . trim($request->valor_busqueda) . '%')->get(); 
            
            return view('frontend.index', compact("portadas","proveedores","categoriasgenerales"));
            
        }
        else {

            $proveedores = Proveedores::all();

            return view('frontend.index', compact("portadas","proveedores","categoriasgenerales"));
        }
    }

    public function indexProductos(Request $request) {
        $categoriasgenerales = Categoriasgenerales::all();

        $portadas = Portadas::all();

        if (!(trim($request->valor_busqueda==""))) {
            $productos = Productos::where('nombre', 'like', '%' . trim($request->valor_busqueda) . '%' )
            ->orWhere('descripcion', 'like', '%' . trim($request->valor_busqueda) . '%')->get(); 
            
            return view('frontend.productos', compact("productos","categoriasgenerales"));
            
        }
        else {

            return Redirect::back();
        }
    }

    public function categoriasgenerales() {

        $categoriasgenerales = Categoriasgenerales::all();

        return view("admin.usuarios.categoriagenerales",compact("categoriasgenerales"));
    }

    public function proveedoresporcategoria($categoria_id) {

        $portadas = Portadas::all();

        $categoriasgenerales = Categoriasgenerales::all();

        if ($categoria_id>0) {
            $proveedores = Proveedores::where('categoriageneral_id',$categoria_id)->get();
            //dd($proveedores);
            return view('frontend.index', compact("portadas","proveedores","categoriasgenerales"));
        }
    }

    public function productos($proveedor_id) {
        

        $categoriasgenerales = Categoriasgenerales::all();

        if ($proveedor_id>0) {
            $productos = Productos::where('proveedor_id',$proveedor_id)->get();
            
            return view('frontend.productos',compact("productos","categoriasgenerales"));
        }
    }

    public function agregaritem(Request $request, $producto_id) {

        $producto = Productos::where('id',$producto_id)->first();

        if ( ( (Cart::getSubTotal()*1.18) + ($producto->precio*1.18)) < session()->get('balance') ) {            

            Cart::add(array(
                'id' => $producto->id,
                'name' => $producto->nombre,
                'price' => $producto->precio,
                'quantity' => $request->cantidad)
            );

            return Redirect::back();
        } else {
            return Redirect::back()->withErrors(["limite" => "No puede exceder su límite diario"]);
        }

    }

    public function borraritem($item) {
        Cart::remove($item);

        Return Redirect::back();
    }

    public function carrito() {
        return view("frontend.carrito");
    }

    public function procesar() {

        if ( (Cart::getContent()->count()>0) and ( (Cart::getSubTotal() * 1.18)<session()->get('balance') ) ) {

            $balance_count = Balance::where('user_id',Auth::user()->id)->count();            
            
            if ($balance_count==1) {

                $balance = Balance::where('user_id',Auth::user()->id)->first();
                
                if ($balance->fecha == date('Y-m-d')) {                                      
                    
                    $balance->user_id = Auth::user()->id;
                    $balance->fecha = date('Y-m-d');
                    $balance->consumo_del_dia = $balance->consumo_del_dia + Cart::getSubTotal()*1.18;
                    $balance->balance_del_dia = $balance->limite_diario - $balance->consumo_del_dia; 
                    $balance->consumo_del_mes = $balance->consumo_del_mes + Cart::getSubTotal()*1.18;
                    $balance->balance_del_mes = 0.0; 

                    $balance->save();

                    $pedido = new Pedidos();

                    $pedido->codigo = 'COD' . "-USU-" . Auth::user()->id . "-" . time();
                    $pedido->subtotal = Cart::getSubTotal();
                    $pedido->impuestos = Cart::getSubTotal()*0.18;
                    $pedido->total = Cart::getSubTotal()*1.18;
                    $pedido->user_id = Auth::user()->id;
                    $pedido->user_nombre = Auth::user()->name;
                    $pedido->credito = session()->get('balance');
                    $pedido->subsidio = Auth::user()->subsidio_diario;
                    $pedido->nosubsidio = Auth::user()->subsidio_diario - ($balance->limite_diario  - $balance->balance_del_dia);
                    $pedido->estado = 0;
                    $pedido->save();                    
                    
                } 
                else 
                {
                    $balance->user_id = Auth::user()->id;
                    $balance->fecha = date('Y-m-d');
                    $balance->limite_diario = Auth::user()->credito_diario;
                    $balance->consumo_del_dia = Cart::getSubTotal()*1.18;
                    $balance->balance_del_dia = Auth::user()->credito_diario - Cart::getSubTotal()*1.18;
                    $balance->consumo_del_mes = $balance->consumo_del_mes + Cart::getSubTotal()*1.18;
                    $balance->balance_del_mes = 0.0; 
                    
                    $balance->save();

                    $pedido = new Pedidos();

                    $pedido->codigo = 'COD' . "-USU-" . Auth::user()->id . "-" . time();
                    $pedido->subtotal = Cart::getSubTotal();
                    $pedido->impuestos = Cart::getSubTotal()*0.18;
                    $pedido->total = Cart::getSubTotal()*1.18;
                    $pedido->user_id = Auth::user()->id;
                    $pedido->user_nombre = Auth::user()->name;
                    $pedido->credito = session()->get('balance');
                    $pedido->subsidio = Auth::user()->subsidio_diario;
                    $pedido->nosubsidio = Auth::user()->subsidio_diario - ($balance->limite_diario  - $balance->balance_del_dia);
                    $pedido->estado = 0;
                    $pedido->save();                       

                }

            } else {

                $balance = New Balance();

                $balance->user_id = Auth::user()->id;
                $balance->fecha = date('Y-m-d');
                $balance->limite_diario = Auth::user()->credito_diario;
                $balance->limite_subsidio = Auth::user()->subsidio_diario;
                $balance->consumo_del_dia = Cart::getSubTotal()*1.18;
                $balance->balance_del_dia = Auth::user()->credito_diario - Cart::getSubTotal()*1.18;
                $balance->consumo_del_mes = $balance->consumo_del_mes + Cart::getSubTotal()*1.18;
                $balance->balance_del_mes = 0.0;

                $balance->save();

                $pedido = new Pedidos();

                $pedido->codigo = 'COD' . "-USU-" . Auth::user()->id . "-" . time();
                $pedido->subtotal = Cart::getSubTotal();
                $pedido->impuestos = Cart::getSubTotal()*0.18;
                $pedido->total = Cart::getSubTotal()*1.18;
                $pedido->user_id = Auth::user()->id;
                $pedido->user_nombre = Auth::user()->name;
                $pedido->credito = session()->get('balance');
                $pedido->subsidio = Auth::user()->subsidio_diario;
                $pedido->nosubsidio = Auth::user()->subsidio_diario - ($balance->limite_diario  - $balance->balance_del_dia);
                $pedido->estado = 0;
                $pedido->save();                   

            }

            session(["balance" => $balance->balance_del_dia]);

            foreach (Cart::getContent() as $item):
                $detalle = new Detalles();
                $detalle->producto_id = $item->id;
                $detalle->user_nombre = Auth::user()->name;

                $producto = Productos::where('id', $item->id)->first();
                $detalle->producto_nombre = $producto->nombre;
                $detalle->cantidad = $item->quantity;
                $detalle->precio = $item->price;
                $detalle->pedido_id = $pedido->id;
                $detalle->pedido_codigo = $pedido->codigo;
                $detalle->proveedor_id = $producto->proveedor_id;
                $detalle->proveedor_nombre = Proveedores::where("id",$producto->proveedor_id)->first()->nombre;
                $detalle->user_id = Auth::user()->id;
                $detalle->subtotal = $item->quantity * $item->price;
                $detalle->impuestos = ($item->quantity * $item->price) * 0.18;
                $detalle->total = ($item->quantity * $item->price) * 1.18;
                $detalle->save();

            endforeach;
            
            Cart::clear();

            return Redirect::back()->with(["pedido_nuevo" => "Nuevo pedido #" . $pedido->codigo]);

        } else {

            if ( (Cart::getSubTotal() * 1.18) > session()->get('balance') ) {
                return Redirect::back()->withErrors(["error" => "No puede exceder su limite diario"]);
            } elseif (Cart::getContent()->count() < 1) {
                return Redirect::back()->withErrors(["error" => "Carrito Vacio"]);
            }
        }
        
    }

    public function vaciar() {
        Cart::clear();
        return Redirect::back();
    }

    public function historial(Request $request) {
            
          if ($request->buscar=="Buscar") {
            $pedidos = Pedidos::where('user_id',Auth::user()->id)
            ->where('created_at','>=',$request->fecha_inicio . ' 00:00:00')
            ->where('created_at','<=',$request->fecha_fin . ' 23:59:59')
            ->orderby('id','desc')->get();

            return view("frontend.historial",compact("pedidos"));
          } else {

            $pedidos = Pedidos::where('user_id',Auth::user()->id)
            ->orderby('id','desc')->get();            
            return view("frontend.historial",compact("pedidos"));
          }




    }

    public function historialdetalle($id) {

        $detalles = Detalles::where('pedido_id',$id)->get();

        return view("frontend.historialdetalle",compact("detalles"));
    }

    public function productonombre($id) {

        $producto = Productos::where('id',$id)->first();

        return $producto->nombre;

    }

    public function productocodigo($id) {

        $producto = Productos::where('id',$id)->first();

        return $producto->codigo;

    }

    public function proveedornombre($id) {

        $proveedor = Proveedores::where('id',$id)->first();

        return $proveedor->nombre;

    }


}
