@extends('admin.layout')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Pedidos</h1>
            <form action="{{ route("admin.pedidos.update", $pedido->id) }}" method="post" enctype="multipart/form-data">
                @method("put")
                @csrf
                <div class="form-group">
                        
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="estado" name="estado" 
                          @if ($pedido->estado==1) 
                            checked 
                          @endif >
                          <label class="form-check-label" for="">
                            Estado
                          </label>
                        </div>

                </div>                    

                <div class="form-group">              
                <input type="submit" class="btn btn-success" name="submit" id="submit" value="Actualizar">
                </div>

                </div>
            </form>
        </div>
    </div>
</div>


@endsection

