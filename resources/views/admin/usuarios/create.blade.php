@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4">Registrar Usuario</h1>
        <hr>
        
        <div class="row">
            <div class="col-md-12">
                
        <div class="card shadow mb-4">
            <div class="card-header ">
                <h6 class="m-0 font-weight-bold text-primary">Llenar los campos</h6>
            </div>
            <hr>
            <div class="card-body">
                <form action=" {{ url('/admin/usuarios/create') }}" method="POST">
                    @csrf
                       <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="rol">Rol </label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-person-vcard-fill"></i>
                                    </span>
                                    <select name="rol" id="rol" class="form-control" required>
                                        @foreach ($roles as $rol)
                                        @if ($rol->name != 'SUPER ADMIN')
                                            <option value="{{ $rol->name }}"
                                                {{ old('rol') == $rol->name ? 'selected' : '' }}
                                                >{{ $rol->name }}</option>
                                        @endif
                                        @endforeach
                                    </select>
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
                                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
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
                                        <input type="text" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
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
                                    <label for="">Contraseña</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-key-fill"></i></span>
                                        <input type="text" name="password" id="password" class="form-control" value="{{ old('password') }}" required>
                                    </div>
                                    @error('password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                </div>
                                
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Confirmar contraseña</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                        <input type="text" name="password_confirmation" id="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}" required>
                                    </div>
                                    @error('password_confirmation')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                </div>
                                
                            </div>
                            
                        </div>
                        <hr>
                        
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="{{ url('/admin/usuarios') }}" class="btn btn-secondary">
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
    </div>
@endsection


