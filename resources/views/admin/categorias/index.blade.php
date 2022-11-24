@extends('admin.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Categorias de <span class="text-info"> {{ session()->get("proveedor_nombre" )}}</span></h1>
            <form action="{{ route("admin.categorias.create",session()->get("proveedor_id")) }}" method="">
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
                        @foreach ($categorias as $categoria)
                            <tr class="">
                                <td scope="row">{{ $categoria->id }}</td>
                                <td>{{ $categoria->nombre }}</td>
                                <th scope="col"><a class="btn btn-info" href="{{ route("admin.productos.show",$categoria->id)}}">Productos</a></th>
                                <th scope="col"><a class="btn btn-primary" href="{{ route("admin.categorias.edit",$categoria->id)}}">Editar</a></th>
                                <th scope="col">
                                <form action="{{ route('admin.categorias.destroy', $categoria->id) }}" method="post">
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

