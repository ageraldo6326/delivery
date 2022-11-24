@extends('admin.layout')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Proveedor</h1>
            @include("admin.usuarios.error")
            <form action="{{ route("admin.proveedores.store") }}" method="post" enctype="multipart/form-data">
                @method("post")
                @csrf
                <div class="form-group">

                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="nombre" value="{{ old('nombre') }}">
                    </div>
                    
                    <div class="form-group">
                        <label for="telefono">Telefono</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" placeholder="telefono" value="{{ old('telefono') }}">
                    </div>

                    <div class="form-group">
                        <label for="correo">Correo</label>
                        <input type="text" class="form-control" id="correo" name="correo" placeholder="correo" value="{{ old('correo') }}">
                    </div>

                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3">{{ old('descripcion') }}</textarea>
                    </div>                    

                    <div class="form-group">
                        <label for="direccion">Dirección</label>
                        <textarea class="form-control" id="direcion" name="direccion" rows="3">{{ old('direccion') }}</textarea>
                    </div>        

                    <div class="form-group">
                        <label for="direccion">Categoria del Negocio</label>
                        <div>
                        <select class="form-select form-group" id="categoriageneral_id" name="categoriageneral_id">
                        <option selected>Selecciona la categoria</option>
                        @foreach ($categoriasgenerales as $categoriageneral)
                            <option value="{{$categoriageneral->id}}">{{$categoriageneral->nombre}}</option>
                         @endforeach   
                        </select>
                        <div>
                     </div>  

                    <div class="form-check">                          
                        <input type="checkbox" class="form-check-input" id="estado" name="estado" value="{{ old('estado') }}">
                        <label for="estado">Activo?</label>  
                    </div>                     


                    <div class="form-group">
                    <label for="fotourl">Foto</label>                    
                    <input type="file" class="form-control-file" name="fotourl" id="fotourl" value="{{ old('fotourl') }}">
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

