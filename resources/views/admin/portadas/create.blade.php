@extends('admin.layout')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Portada</h1>
            <form action="{{ route("admin.portadas.store") }}" method="post" enctype="multipart/form-data">
                @method("post")
                @csrf
                <div class="form-group">

                    <div class="form-group">
                        <label for="nombre">Frase</label>
                        <input type="text" class="form-control" id="mensaje" name="mensaje" placeholder="mensaje">
                    </div>
                    
                    <div class="form-group">
                        <label for="titulo">Enlace</label>
                        <input type="text" class="form-control" id="enlace" name="enlace" placeholder="enlace">
                    </div>

                    <div class="form-group">
                        <label for="direccion">Orden</label>
                        <input type="text" class="form-control" id="orden" name="orden" placeholder="orden">
                    </div>                    

                    <div class="form-group">
                    <label for="slug">Imagen</label>                    
                    <input type="file" class="form-control-file" name="fotourl" id="fotourl">
                    </div>

                    <div class="form-group">              
                    <input type="submit" class="btn btn-success" name="submit" id="submit" value="Grabar">
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>


@endsection

