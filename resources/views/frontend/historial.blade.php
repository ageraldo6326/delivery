@extends('layouts.app')

@section('content')


<div class="container">
    
    <div class="row">
        <div class="col-sm-12 text-center">
            <h2 class="my-3">HISTORIAL</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <form action="{{ route("frontend.historial") }}" method="GET">
            @csrf
                <div class="input-group date m-2" data-provide="datepicker">
                    <label class="form-label mx-2 my-auto font-weight-bold" for="fecha_inicio">Fecha inicio</label>
                    <input type="date" value="{{ date('Y-m-d') }}" class="form-control" id="fecha_inicio" name="fecha_inicio">
                    <label class="form-label mx-2 my-auto font-weight-bold" for="fecha_fin">Fecha fin</label>
                    <input type="date" value="{{ date('Y-m-d') }}" class="form-control" id="fecha_fin" name="fecha_fin">                    
                    <input type="submit" class="form-control btn btn-primary rounded-pill mx-2 my-auto" id="buscar" name="buscar" value="Buscar">
                </div>                
            </form>
        </div>
    </div>

    <div class="row">       

        <div class="col-md-12">
            <table class="table table-striped table-responsive-xl w-100 p-2">
                <thead>
                    <tr>
                    <th scope="col">FECHA</th>
                    <th scope="col">ID</th>
                    <th scope="col">CODIGO</th>
                    <th scope="col" class="text-left">TOTAL</th>
                    <th scope="col" class="text-left">DESCUENTO</th>
                    <th scope="col" class="text-center">ENTREGADO?</th>
                    <th scope="col" class="text-center">DETALLE</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $acumulador_nosubsidio = 0;
                        $acumulador_total = 0;
                    @endphp 
            @forelse ( $pedidos as $pedido)
                <tr>
                    <td>{{ date_format($pedido->created_at,"d-m-y h:i A") }}</td>
                    <td>{{ $pedido->id }}</td>
                    <td><a href="{{ route("frontend.historialdetalle",$pedido->id) }}">{{ $pedido->codigo }}</a></td>
                    <td>{{ number_format($pedido->total,2) }}</td>
                    <td>{{ number_format($pedido->nosubsidio,2) }}</td>
                    @php
                        $acumulador_total = $acumulador_total + $pedido->total;
                        //$acumulador_nosubsidio = $acumulador_nosubsidio + $pedido->nosubsidio;
                    @endphp
                    <td class="text-center">@if ( $pedido->estado==0) NO @else SI @endif</td>
                    <td class="text-center">
                        <a href="{{ route("frontend.historialdetalle",$pedido->id) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                            </svg>
                        </a>                           
                    </td>
                </tr>
            @empty
                Sin Pedidos
            @endforelse
                </tbody>
                <tr><td></td><td></td><td></td><td>{{ number_format($acumulador_total,2)}}</td><td></td><td></td><td></td></tr>
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
