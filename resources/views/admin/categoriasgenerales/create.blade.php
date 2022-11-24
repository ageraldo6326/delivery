@extends('admin.layout')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Categoria de Negocio</h1>
            @include("admin.usuarios.error")
            <form action="{{ route("admin.categoriasgenerales.store") }}" method="post" enctype="multipart/form-data">
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
                    <input type="submit" class="btn btn-success" name="submit" id="submit" value="Grabar">
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>



@endsection

