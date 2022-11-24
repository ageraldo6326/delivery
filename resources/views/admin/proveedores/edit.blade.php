@extends('admin.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Proveedor</h1>
            @include("admin.usuarios.error")
            <form action="{{ route("admin.proveedores.update",$proveedor->id) }}" method="post" enctype="multipart/form-data">
                @method("put")
                @csrf
                <div class="form-group">

                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="nombre" value="{{ $proveedor->nombre }}">
                    </div>
                    
                    <div class="form-group">
                        <label for="titulo">Telefono</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" placeholder="telefono" value="{{ $proveedor->telefono }}">
                    </div>

                    <div class="form-group">
                        <label for="direccion">Correo</label>
                        <input type="text" class="form-control" id="correo" name="correo" placeholder="email" value="{{ $proveedor->correo }}">
                    </div>

                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3">{{ $proveedor->descripcion }}</textarea>
                    </div>  

                    <div class="form-group">
                        <label for="direccion">Dirección</label>
                        <textarea class="form-control" id="direcion" name="direccion" rows="3">{{ $proveedor->direccion }}</textarea>
                    </div>   


                    <div class="form-group">
                        <label for="descripcion">Activo?</label>
                        
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="estado" name="estado" @if ($proveedor->estado==1) checked @endif>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="direccion">Categoria del Negocio</label>
                        <div>
                        <select class="form-select form-group" id="categoriageneral_id" name="categoriageneral_id">
                        <option selected>Selecciona la categoria</option>
                        @foreach ($categoriasgenerales as $categoriageneral)
                            <option value="{{$categoriageneral->id}}" @if ($proveedor->categoriageneral_id==$categoriageneral->id) selected @endif >{{$categoriageneral->nombre}}</option>
                         @endforeach   
                        </select>
                        <div>
                     </div> 

                    <div class="form-group">
                    <label for="fotourl">Foto</label>                    
                    <input type="file" class="form-control-file" name="fotourl" id="fotourl" value="{{ $proveedor->fotourl }}">
                    </div>


                    <div class="form-group">
                        <img class="img-fluid img-thumbnail" src="{{ url('img/proveedores/'.$proveedor->fotourl) }}" alt="">
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

