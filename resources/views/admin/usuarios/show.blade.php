@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4">Usuario: {{ $usuario->name }}</h1>
        <hr>
        
        <div class="row">
            <div class="col-md-12">
                
        <div class="card shadow mb-4">
            <div class="card-header ">
                <h6 class="m-0 font-weight-bold text-primary">Llenar los campos</h6>
            </div>
            <hr>
            <div class="card-body">
                <form action=" " method="POST">
                    @csrf
                       <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="rol">Rol </label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-person-vcard-fill"></i>
                                    </span>
                                    <input type="text" name="rol" id="rol" class="form-control" value="{{ $usuario->roles->pluck('name')->implode(' | ') }}" readonly>
                                </div>
                                
                            </div>
                        </div>
                       </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Nombre</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                                        <input type="text" name="name" id="name" class="form-control" value="{{ $usuario->name }}" readonly>
                                    </div>
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                </div>
                                
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                        <input type="text" name="email" id="email" class="form-control" value="{{ $usuario->email }}" readonly>
                                    </div>
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                </div>
                                
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Fecha de registro</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                                        <input type="text" name="created_at" id="created_at" class="form-control" value="{{ $usuario->created_at }}" readonly>
                                    </div>
                                </div>
                                
                            </div>
                            
                                
                            
                        </div>
                        <hr>
                        
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="{{ url('/admin/usuario/' . $usuario->id . '/edit')  }}" class="btn btn-secondary">
                            <i class="bi bi-pencil me-2"></i>Editar
                        </a>

                        <a href="{{ url('/admin/usuarios') }}" class="btn btn-secondary">
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


