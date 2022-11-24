@extends('admin.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">N</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usuarios as $usuario)
                            <tr class="">
                                <td scope="row">{{ $usuario->id }}</td>
                                <td>{{ $usuario->name }}</td>
                                <td>{{ $usuario->email }}</td>
                                <th scope="col"><a class="btn btn-primary" href="{{ route("admin.usuarios.edit",$usuario->id)}}">Editar</a></th>
                            </tr>                            
                        @endforeach

                    </tbody>
                </table>           
        </div>
    </div>
    <div>{{ $usuarios->links() }}</div>
</div>
@endsection

