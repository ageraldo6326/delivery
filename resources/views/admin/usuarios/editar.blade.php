@extends('admin.layout')

@section('content')
<div class="container">
       <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row">
                        <form action="{{ route("admin.usuarios.update",$usuario->id) }}" method="post">
                        @method('patch')
                        @csrf
                        <div class="col-sm-12">
                            <div class="form-check">                          
                                <input type="checkbox" class="form-check-input" id="estado" name="estado" @if ($usuario->estado==1) checked value="1" @else value="0" @endif>
                                <label for="estado">Estado</label>  
                            </div>

                            <div class="form-group">
                                <label for="celular">Celular</label>
                                <input type="phone" class="form-control" id="celular" name="celular" placeholder="celular" value="{{ $usuario->celular }}">
                            </div>

                            <div class="form-group">
                                <label for="celular">Credito diario</label>
                                <input type="number" class="form-control" id="credito" name="credito_diario" placeholder="celular_diario" value="{{ $usuario->credito_diario }}">
                            </div>  
                            
                            <div class="form-group">
                                <label for="celular">Subsidio diario</label>
                                <input type="number" class="form-control" id="subsidio_diario" name="subsidio_diario" placeholder="subsidio_diario" value="{{ $usuario->subsidio_diario }}">
                            </div>                            


                            <div>
                                <input type="submit" class="btn btn-success" name="grabar" id="grabar" value="Actualizar">                      
                            </div>

                        </div>
                        </form>                
            </div>   
        </div>
    </div>
</div>
@endsection

