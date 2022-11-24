@extends('layouts.app')

@section('content')

<div class="container-fluid mx-0">
    <div class="row justify-content-center">
            <div class="col-sm-12">

                <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($portadas as $portada)
                    @if ($portada->estado==1) 
                    <div class="carousel-item @if ($portada->orden==0) active @endif ">
                    <img src="img/portadas/{{$portada->fotourl}}" class="d-block w-100 img-responsive" alt="...">
                    </div>                    
                    @endif
                    @endforeach
                </div>
                </div>

            </div>
    </div>
</div>

<div class="container">
    
    <div class="row">
        <div class="col-sm-12 text-center">
            <h2 class="my-3">Proveedores</h2>
        </div>
    </div>
    
 

    <form action="{{ route("frontend") }}" method="get">
    @csrf
    <div class="row">       
        <div class="col-md-9">
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="valor_busqueda" id="valor_busqueda" placeholder="Buscar...">
                <div class="input-group-prepend">            
                    <input type="submit" class="btn btn-success rounded-right" value="Buscar" autofocus> 
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
                    <tr><td class="text-right">Impuestos {{ number_format(Cart::getSubTotal()*0.18,2) }}</td></tr>
                    <tr><td class="text-right">Total {{ number_format(Cart::getSubTotal()*1.18,2) }}</td></tr>
                    <tr><td class="text-right">Subsidio Diario {{ number_format(Auth::user()->subsidio_diario,2) }}</td></tr>
                    <tr><td class="text-right">Balance a pagar por nomina @if ( ((Cart::getSubTotal()*1.18) - Auth::user()->subsidio_diario)<=0) {{ number_format(0,2)}} @else {{ number_format( (Cart::getSubTotal()*1.18) - Auth::user()->subsidio_diario,2)  }} @endif</td></tr> --}}
                    <tr><td><a href="{{ route("frontend.carrito") }}" class="btn btn-primary shadow btn-block rounded-pill">Carrito {{ Cart::getContent()->count() }} items</a></td></tr>
                    <tr>
                        <td>
                            @if($errors->any())
                            <h5 class="text-success">{{$errors->first()}}</h5>
                            @endif                            
                        </td>
                    </tr>
                </table>            
            @endif
            </table>
        </div>  



    </div>
    </form>

 
    <div class="row">


        <div class="col-lg-2 my-2 just">
            <aside>
                
                    <div class="font-weight-bold">Categorías</div>
                    @foreach ($categoriasgenerales as $categoriageneral)
                        <div class="font-weight-normale">
                            <a href="/frontend/proveedoresporcategoria/{{ $categoriageneral->id }}" class="text-dark text-decoration-none">
                            <span class="text-sm font-weight-lighter">{{ $categoriageneral->nombre }}</span>
                        </a>
                        </div>
                    @endforeach

              
            </aside>
        </div>
        

        <div class="col-lg-10 col-md-12">
            <div class="row">

            @forelse ($proveedores as $proveedor)                    
                        <div class="col-lg-4 col-md-4 justify-content-right mb-5 ">
                            <div class="card shadow h-100 justify-content-center m-auto w-100">
                            <img src="/img/proveedores/{{ $proveedor->fotourl }}" class="card-img-top" alt="...">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $proveedor->nombre }}</h5>
                                <p class="card-text">{{ $proveedor->descripcion }}.</p>
                                <a href="{{ route("frontend.productos",$proveedor->id) }}" class="btn btn-primary mt-auto">Ver el menú</a>
                            </div>
                            </div>
                        </div>  
            @empty
                        <div class="col-12">
                        <p class="text-info">NO HAY PROVEEDORES</p>
                        </div>
            @endforelse
        
            </div>


        </div>
    </div>

</div>


@endsection
