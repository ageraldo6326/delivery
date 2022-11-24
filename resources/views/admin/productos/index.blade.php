@extends('admin.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>Productos Categoria <span class="text-info"> {{ session("categoria_nombre")}} </span> de <span class="text-info"> {{ session("proveedor_nombre")}} </span> </h2>
            <form action="{{ route("admin.productos.create") }}" method="">
                @method("put")
                @csrf
                <input class="btn btn-success m-1" type="submit" value="Nueva" id="nueva" name="nueva">
            </form>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">N</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productos as $producto)
                            <tr class="">
                                <td scope="row">{{ $producto->id }}</td>
                                <td>{{ $producto->nombre }}</td>
                                
                                
                                <th scope="col"><a class="btn btn-primary" href="{{ route("admin.productos.edit",$producto->id)}}">Editar</a></th>
                                <th scope="col">
                                <form action="{{ route('admin.productos.destroy', $producto->id) }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <input class="btn btn-danger display:inline-block" type="submit" value="Eliminar">
                                </form>
                                </th>
                            </tr>                            
                        @endforeach

                    </tbody>
                </table>           
        </div>
    </div>
</div>

@endsection

