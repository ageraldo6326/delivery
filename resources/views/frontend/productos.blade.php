@extends('layouts.app')

@section('content')


<div class="container">
    
    <div class="row">
        <div class="col-sm-12 text-center">
            <h2 class="my-3">Productos</h2>
        </div>
    </div>
    
 
    <form action="{{ route("frontend.indexProductos") }}" method="get">
    @csrf
    <div class="row">       
        <div class="col-md-9">
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="valor_busqueda" id="valor_busqueda" placeholder="Buscar...">
                <div class="input-group-prepend">            
                    <input type="submit" class="btn btn-success rounded-right" value="Buscar"> 
                </div>            
            </div>            
        </div>

        <div class="col-md-3">
            <table class="w-100 p-2">
  @forelse ( Cart::getContent() as $item)
                {{-- <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>X</td>
                    <td>{{ number_format($item->price,2) }}</td>
                    <td>=</td><td class="text-right">${{ number_format($item->getPriceSum(),2) }}</td>
                    <td class="text-danger font-weight-bold"><a class="text-decoration-none text-danger" href=" {{ route("frontend.borraritem",$item->id) }}" >X</a></td>
                </tr>  --}}
            @empty
                <h4 class="text-info">Carrito Vacio</h4>
            @endforelse
            @if (Cart::getContent()->count()>0) 
                <table class="w-100">
                    {{-- <tr><td class="text-right">Subtotal {{ number_format(Cart::getSubTotal(),2) }}</td></tr>
                    <tr><td class="text-right">Impuestos {{ number_format(Cart::getSubTotal()*0.18,2) }}</td></tr> --}}
                    <tr><td class="text-right">Total {{ number_format(Cart::getSubTotal()*1.18,2) }}</td></tr>
                    {{-- <tr><td class="text-right">Subsidio Diario {{ number_format(Auth::user()->subsidio_diario,2) }}</td></tr> --}}
                    <tr><td class="text-right">Balance a pagar por nomina @if ( ((Cart::getSubTotal()*1.18) - Auth::user()->subsidio_diario)<=0) {{ number_format(0,2)}} @else {{ number_format( (Cart::getSubTotal()*1.18) - Auth::user()->subsidio_diario,2)  }} @endif</td></tr>
                    <tr><td><a href="{{ route("frontend.carrito") }}" class="btn btn-primary shadow btn-block rounded-pill">Carrito {{ Cart::getContent()->count() }} items</a></td></tr>
                    <tr>
                        <td>
                          
                        </td>
                    </tr>
                </table>            
            @endif
            </table>
            @if($errors->any())
            <h5 class="text-success">{{$errors->first()}}</h5>
            @endif  
        </div> 

    </div>
    </form>

 
    <div class="row">
        <div class="col-lg-2 my-2 just">
            <aside>
            
                
                    <div class="font-weight-bold">Categorías</div>
                    @foreach ($categoriasgenerales as $categoriageneral)
                        <div class="font-weight-normale">
                            <a href="/frontend/proveedoresporcategoria/{{ $categoriageneral->id }}" class="text-decoration-none text-dark">
                            <span class="text-sm font-weight-lighter">{{ $categoriageneral->nombre }}</span>
                        </a>
                        </div>
                    @endforeach

              
            </aside>
        </div>

        <div class="col-lg-10 col-md-12">
            <div class="row">
            @foreach ($productos as $producto)
                    
                        <div class="col-lg-6 col-md-6 justify-content-right mb-5 ">
                            <div class="card shadow h-100 justify-content-center m-auto w-100">
                            <img src="/img/productos/{{ $producto->fotourl }}" height="300px" class="card-img-top imagen_menu" alt="...">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $producto->nombre }}</h5>
                                <p class="card-text h-100">{{ $producto->descripcion }}.</p>
                                <span class="card-footer text-dark bg-light font-weight-bold mb-1">${{  number_format($producto->precio,2) }}.</span>

                                <form method="get" action="{{ route("frontend.agregaritem",[$producto->id])}}" >
                                @csrf
                                <input type="number" value="1" min=1 max=10 name="cantidad" id="cantidad" class="form-control">
                                <p><input type="submit" value="Agregar" name="agregar" id="agregar" class="btn btn-primary mt-1 btn-block"></p>
                                </form>
                            </div>
                            </div>
                        </div>
                    
            @endforeach
            </div>


        </div>
    </div>

</div>


@endsection
