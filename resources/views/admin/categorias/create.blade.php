@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4">Registrar Categoría</h1>
        <hr>
        
        <div class="row">
            <div class="col-md-12">
                
        <div class="card shadow mb-4">
            <div class="card-header ">
                <h6 class="m-0 font-weight-bold text-primary">Llenar los campos</h6>
            </div>
            <hr>
            <div class="card-body">
                <form action=" {{ url('/admin/categorias/create') }}" method="POST">
                    @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Nombre</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-tag"></i></span>
                                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
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
                                        <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug') }}" readonly required>
                                    </div>
                                    @error('slug')
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
                                        <textarea name="description" id="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                                    </div>
                                    @error('description')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                </div>

                                </div>
                            </div>
                            
                        </div>

                            
                        </div>
                        <hr>
                        
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="{{ url('/admin/categorias') }}" class="btn btn-secondary">
                            <i class="bi bi-x-square me-2"></i>Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-2"></i>Guardar
                        </button>
                    </div>
                </form>
            </div>
      
            </div>
        </div>
    </div>

        <script>
        // Generar slug automáticamente desde el nombre
        document.getElementById('name').addEventListener('input', function() {
        let nombre = this.value;
        let slug = nombre.toLowerCase()
        . replace(/[úüüü]/g, 'u')
        . replace(/[áàäâ]/g, 'a')
        . replace(/[éèëê]/g, 'e')
        . replace(/[íìïî]/g, 'i')
        . replace(/[óòöô]/g, 'o')
        . replace(/[úùüû]/g, 'u')
        . replace( /[^a-z0-9\s-]/g, '')
        . replace(/\s+/g, '-')
        . replace(/-+/g, '-')
        . replace(/^-+|-+$/g, '');
        
        document.getElementById('slug').value = slug;
        });
        </script>

@endsection


