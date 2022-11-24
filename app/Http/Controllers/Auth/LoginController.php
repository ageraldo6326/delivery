<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Models\Balance;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    public function redirectTo() {

            $balance_count = Balance::where('user_id',Auth::user()->id)->count();
            
            
            if ($balance_count==0) {
                $balance = New Balance();

                $balance->user_id = Auth::user()->id;
                $balance->fecha = date('Y-m-d');
                $balance->limite_diario = Auth::user()->credito_diario;
                $balance->limite_subsidio = Auth::user()->subsidio_diario;
                $balance->consumo_del_dia = 0.0;
                $balance->balance_del_dia = Auth::user()->credito_diario -$balance->consumo_del_dia;
                $balance->consumo_del_mes = 0.0;
                $balance->balance_del_mes = 0.0;

                $balance->save();                
            } else {

                $balance = Balance::where('user_id',Auth::user()->id)->first();

                if ($balance->fecha != date('Y-m-d')) {                  
                   
                    $balance = Balance::where('user_id',Auth::user()->id)->first();
                    $balance->user_id = Auth::user()->id;
                    $balance->fecha = date('Y-m-d');
                    $balance->limite_diario = Auth::user()->credito_diario;
                    $balance->limite_subsidio = Auth::user()->subsidio_diario;
                    $balance->consumo_del_dia = 0.0;
                    $balance->balance_del_dia = Auth::user()->credito_diario -$balance->consumo_del_dia;

                    
                    $balance->save();

                }                
            }        


            $role = Auth::user()->role;

            switch ($role) {
            case 'admin':
            return '/admin/usuarios';
            break;
            case 'proveedor':
            return '/panelproveedor/pedidos';
            break; 
            case 'cliente':
            return '/panelcliente/pedidos';
            break; 
            case 'empleado':
            return '/frontend';
            break; 

            // default:
            // return '/home'; 
            // break;
        }
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
