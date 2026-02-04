@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4">Categoría: {{ $categoria->nombre }}</h1>
        <hr>
        
        <div class="row">
            <div class="col-md-12">
                
        <div class="card shadow mb-4">
            <div class="card-header ">
                <h6 class="m-0 font-weight-bold text-primary">Llenar los campos</h6>
            </div>
            <hr>
            <div class="card-body">
                <form action="" method="POST">
                    @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Nombre</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-tag"></i></span>
                                        <input type="text" name="name" id="name" class="form-control" value="{{ $categoria->nombre }}" readonly>
                                    </div>
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                </div>
                                
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">URL</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-link-45deg"></i></span>
                                        <input type="text" name="slug" id="url" class="form-control" value="{{ $categoria->slug }}" readonly>
                                    </div>
                                    @error('url')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                </div>
                                
                                    
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="form-group">
                                    <label for="">Descripción</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-text-paragraph"></i></span>
                                        <textarea name="description" id="description" class="form-control" readonly>{{ $categoria->descripcion }}</textarea>
                                    </div>
                                    @error('description')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Fecha de creación</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                                        <input type="text" name="created_at" id="created_at" class="form-control" value="{{ $categoria->created_at }}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                            
                     
                        <hr>
                        
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="{{ url('/admin/categoria/' . $categoria->id . '/edit')  }}" class="btn btn-secondary">
                            <i class="bi bi-pencil me-2"></i>Editar
                        </a>

                        <a href="{{ url('/admin/categorias') }}" class="btn btn-secondary">
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


