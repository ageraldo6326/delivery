@extends('admin.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Proveedores</h1>
            <form action="{{ route("admin.proveedores.create") }}" method="">
                @method("put")
                @csrf
                <input class="btn btn-success m-1" type="submit" value="Nueva" id="nueva" name="nueva">
            </form>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">N</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Correo</th>
                            <th scope="col">Telefono</th>
                            <th scope="col">Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($proveedores as $proveedor)
                            <tr>
                                <td scope="row">{{ $proveedor->id }}</td>
                                <td>{{ $proveedor->nombre }}</td>
                                <td>{{ $proveedor->correo }}</td>
                                <td>{{ $proveedor->telefono }}</td>
                                <th scope="col"><a class="btn btn-info" href="{{ route("admin.categorias.show",$proveedor->id)}}">Categorias</a></th>
                                <th scope="col"><a class="btn btn-primary" href="{{ route("admin.proveedores.edit",$proveedor->id)}}">Editar</a></th>
                            </tr>                            
                        @endforeach

                    </tbody>
                </table>           
        </div>
    </div>
</div>
@endsection

