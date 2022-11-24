@extends('admin.layout')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Categoría de Negocios</h1>
            @if (session("estado")) <h2 class="text-info"> {{session("estado")}} </h2> @endif
            <form action="{{ route("admin.categoriasgenerales.create") }}" method="">
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
                        @foreach ($categoriasgenerales as $categoriageneral)
                            <tr>
                                <td scope="row">{{ $categoriageneral->id }}</td>
                                <td>{{ $categoriageneral->nombre }}</td>
                                <th scope="col"><a class="btn btn-info" href="{{ route("admin.categoriasgenerales.edit",$categoriageneral->id)}}">Editar</a></th>
                                <th scope="col">
                                <form method="post" action="{{ route("admin.categoriasgenerales.destroy",$categoriageneral->id) }}" >
                                    @csrf
                                    @method("DELETE")
                                    <input type="submit" class="btn btn-primary" value="Eliminar" name="eliminar" id="eliminar" onclick="return confirm('Desea eliminar este registro')">
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

