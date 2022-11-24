@extends('admin.layout')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{ route("admin.productos.store") }}" method="post" enctype="multipart/form-data">
                <h2>Producto Categoria <span class="text-info"> {{ session("categoria_nombre")}} </span> de <span class="text-info"> {{ session("proveedor_nombre")}} </span> </h2>
                @include("admin.usuarios.error")
                @method("post")
                @csrf
                <div class="form-group">

                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="nombre" value="{{ old('nombre') }}">
                    </div>
                    
                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3">{{ old('descripcion') }}</textarea>
                    </div> 

                    <div class="form-group">
                        <label for="precio">Precio</label>
                        <input type="number" class="form-control" id="precio" name="precio" placeholder="precio" value="{{ old('precio') }}">
                    </div>

                    <div class="form-group">
                        <label for="precio">Unidad</label>
                        <input type="text" class="form-control" id="unidad" name="unidad" placeholder="unidad">
                    </div>

                    <div class="form-group">
                    <label for="fotourl">Foto</label>                    
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

