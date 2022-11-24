@extends('admin.layout')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Portadas</h1>
            <form action="{{ route("admin.portadas.create") }}" method="">
                @method("put")
                @csrf
                <input class="btn btn-success m-1" type="submit" value="Nueva" id="nueva" name="nueva">
            </form>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">N</th>
                            <th scope="col">Orden</th>
                            <th scope="col">Imagen</th>
                            <th scope="col">Enlace</th>
                            <th scope="col">Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($portadas as $portada)
                            <tr>
                                <td scope="row">{{ $portada->id }}</td>
                                <td>{{ $portada->orden }}</td>
                                <td>{{ $portada->fotourl }}</td>
                                <td>{{ $portada->enlace }}</td>
                                <td scope="col"><a class="btn btn-primary" href="{{ route("admin.portadas.edit",$portada->id)}}">Editar</a></td>
                                <td scope="col">
                                    <form action="{{ route('admin.portadas.destroy', $portada->id) }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <input class="btn btn-danger display:inline-block" type="submit" value="Eliminar">
                                    </form> 
                                <td/>                                   
                            </tr>
                        
                        @endforeach

                    </tbody>
                </table>           
        </div>
    </div>
</div>


@endsection

