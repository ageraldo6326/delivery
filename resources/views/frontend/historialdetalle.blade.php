@extends('layouts.app')

@section('content')


<div class="container">
    
    <div class="row">
        <div class="col-sm-12 text-center">
            <h2 class="my-3">HISTORIAL</h2>
        </div>
    </div>
    

    <div class="row">       

        <div class="col-md-12">
            <table class="table table-striped table-responsive-xl w-100 p-2">
                <thead>
                    <tr>
                    <th scope="col">FECHA</th>
                    <th scope="col">PROVEEDOR</th>
                    <th scope="col">CANTIDAD</th>
                    <th scope="col">PRODUCTO</th>
                    <th scope="col">PRECIO</th>
                    <th scope="col" class="text-left">IMPUESTOS</th>
                    <th scope="col" class="text-left">TOTAL</th>
                    </tr>
                </thead>
                <tbody>
            @forelse ( $detalles as $detalle)
                <tr>
                    <td>{{ date_format($detalle->created_at,"d-m-y h:i A") }}</td>
                    <td>{{ $detalle->proveedor_nombre }}</td>
                    <td>{{ $detalle->cantidad }}</td>
                    <td>{{ $detalle->producto_nombre }}</td>
                    <td>{{ number_format($detalle->precio,2) }}</td>
                    <td>{{ number_format($detalle->impuestos,2) }}</td>
                    <td>{{ number_format($detalle->total,2) }}</td>
                </tr>
            @empty
                Sin Pedidos
            @endforelse
                </tbody>
            </table>             
        </div>

    </div>


 
    <div class="row">
        <div class="col w-100 text-center">
                @if (session('pedido_nuevo')) <h2 class="text-info">{{ session('pedido_nuevo') }}</h2> @endif 
        </div>
    </div>

</div>


@endsection
