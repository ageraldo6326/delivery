@extends('admin.layout')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Detalles {{ session("pedido_id") }}</h1>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">N</th>
                            <th scope="col">PRODUCTO</th>
                            <th scope="col">PRECIO</th>
                            <th scope="col">CANTIDAD</th>
                            <th scope="col">TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($detalles as $detalle)
                            <tr class="">
                                <td scope="row">{{ $loop->index }}</td>
                                <td>{{ $detalle->producto_nombre }}</td>
                                <td>{{ $detalle->precio }}</td>
                                <td>{{ $detalle->cantidad }}</td>
                                <td>{{ $detalle->total }}</td>
                                <th scope="col">
                                </th>
                            </tr>                            
                        @endforeach

                    </tbody>
                </table>           
        </div>
    </div>
</div>


@endsection

