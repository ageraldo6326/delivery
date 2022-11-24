@extends('layouts.app')

@section('content')


<div class="container">
    
    <div class="row">
        <div class="col-sm-12 text-center">
            <h2 class="my-3">Carrito</h2>
        </div>
    </div>
    

    <div class="row">       

        <div class="col-md-12">
            <table class="table table-striped w-100 p-2">
            <thead>
                <tr>
                <th scope="col">Cantidad</th>
                <th scope="col">Producto</th>
                <th scope="col">Precio</th>
                <th scope="col" class="text-left">SubTotal</th>
                <th scope="col" class="text-center">ELIMINAR</th>
                </tr>
            </thead>
            @forelse ( Cart::getContent() as $item)
                <tr>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ number_format($item->price,2) }}</td>
                    <td class="">${{ number_format($item->getPriceSum(),2) }}</td>
                    <td class="text-danger font-weight-bold text-center"><a class="text-decoration-none text-danger text-center" href=" {{ route("frontend.borraritem",$item->id) }}" >X</a></td>
                </tr> 
            @empty
                Carrito Vacio
            @endforelse
                <table class="w-100">
                    <tr><td class="text-right">Subtotal {{ number_format(Cart::getSubTotal(),2) }}</td></tr>
                    <tr><td class="text-right">Impuestos {{ number_format(Cart::getSubTotal()*0.18,2) }}</td></tr>
                    <tr><td class="text-right">Total {{ number_format(Cart::getSubTotal()*1.18,2) }}</td></tr>
                    <tr><td class="text-right">Subsidio Diario {{ number_format(Auth::user()->subsidio_diario,2) }}</td></tr>
                    <tr><td class="text-right">Balance a pagar por nomina @if ( ((Cart::getSubTotal()*1.18) - Auth::user()->subsidio_diario)<=0) {{ number_format(0,2)}} @else {{ number_format( (Cart::getSubTotal()*1.18) - Auth::user()->subsidio_diario,2)  }} @endif</td></tr>
                    <tr><td>
                        <table class="w-100">
                        <tr>
                        <td class="w-50"><a href="{{ route("frontend.procesar") }}" class="btn btn-success btn-block font-weight-bold" name="checkout">Procesar</td>
                        <td class="w-50"><a href="{{ route("frontend.vaciar") }}" class="btn btn-primary btn-block font-weight-bold" name="checkout">Vaciar</td>
                
                        </tr>
                        </table>
                    </td></tr>
                    <tr>
                        <td>
                            @if($errors->any())
                            <h5 class="text-success">{{$errors->first()}}</h5>
                            @endif                            
                        </td>
                    </tr>
                </table>
            </table>
        </div>

    </div>
    </form>

 
    <div class="row">
        <div class="col w-100 text-center">
                @if (session('pedido_nuevo')) <h2 class="text-info">{{ session('pedido_nuevo') }}</h2> @endif 
        </div>
    </div>

</div>


@endsection
