@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4">Actualizar Rol {{ $rol->name }}</h1>
        <hr>
        
        <div class="row">
            <div class="col-md-6">
                
        <div class="card shadow mb-4">
            <div class="card-header ">
                <h6 class="m-0 font-weight-bold text-primary">Llenar los campos</h6>
            </div>
            <hr>
            <div class="card-body">
                <form action=" {{ url('/admin/roles/'.$rol->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Nombre del rol</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                                        <input type="text" name="name" id="name" class="form-control" value="{{ $rol->name }}">
                                    </div>
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                </div>
                                
                            </div>
                        </div>
                        <hr>
                        
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="{{ url('/admin/roles') }}" class="btn btn-secondary">
                            <i class="bi bi-x-square me-2"></i>Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-2"></i>Actualizar
                        </button>
                    </div>
                </form>
            </div>
        </div>
            </div>
        </div>
    </div>
@endsection


