@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4">Detalles del rol</h1>
        <hr>
        
        <div class="row">
            <div class="col-md-6">
                
        <div class="card shadow mb-4">
            <div class="card-header ">
                <h6 class="m-0 font-weight-bold text-primary">Registro</h6>
            </div>
            <hr>
            <div class="card-body">
                <form action="">
                    @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Nombre del rol</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                                        <input type="text" name="name" id="name" class="form-control" value="{{ $rol->name }} " readonly>
                                    </div>

                                    
                                </div>

                                <div class="form-group">
                                    <label for="">Fecha y hora de creación</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-clock"></i></span>
                                        <input type="text" name="name" id="name" class="form-control" value="{{ $rol->created_at }} " readonly>
                                    </div>

                                    
                                </div>
                                
                            </div>
                        </div>
                        <hr>
                        
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        
                        <a href="{{ url('/admin/roles/' . $rol->id . '/edit')  }}" class="btn btn-secondary">
                            <i class="bi bi-pencil me-2"></i>Editar
                        </a>

                        <a href="{{ url('/admin/roles') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-return-left me-2"></i>Regresar
                        </a>
                    </div>
                </form>
            </div>
        </div>
            </div>
        </div>
    </div>
@endsection


