@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4">Ajustes del Sistema</h1>
        <hr>
        
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Configuración General</h6>
            </div>
            <div class="card-body">
                <form action="{{ url('/admin/ajustes/create') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{-- @method('PUT') --}}
                    
                    <div class="row">
                        <!-- Columna Izquierda -->
                        <div class="col-md-6">
                            <!-- Nombre -->
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre del Negocio</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-shop"></i></span>
                                    <input type="text" 
                                           id="nombre"
                                           name="nombre" 
                                           value="{{ old('nombre', $ajuste->nombre ?? '') }}"
                                           class="form-control @error('nombre') is-invalid @enderror"
                                           required>
                                    @error('nombre')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Descripción -->
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-card-text"></i></span>
                                    <input type="text" 
                                           id="descripcion"
                                           name="descripcion" 
                                           value="{{ old('descripcion', $ajuste->descripcion ?? '') }}"
                                           class="form-control @error('descripcion') is-invalid @enderror">
                                    @error('descripcion')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Sucursal -->
                            <div class="mb-3">
                                <label for="sucursal" class="form-label">Sucursal</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-shop-window"></i></span>
                                    <input type="text" 
                                           id="sucursal"
                                           name="sucursal" 
                                           value="{{ old('sucursal', $ajuste->sucursal ?? '') }}"
                                           class="form-control @error('sucursal') is-invalid @enderror">
                                    @error('sucursal')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Dirección -->
                            <div class="mb-3">
                                <label for="direccion" class="form-label">Dirección</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                                    <input type="text" 
                                           id="direccion"
                                           name="direccion" 
                                           value="{{ old('direccion', $ajuste->direccion ?? '') }}"
                                           class="form-control @error('direccion') is-invalid @enderror">
                                    @error('direccion')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Columna Derecha -->
                        <div class="col-md-6">
                            <!-- Teléfono -->
                            <div class="mb-3">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                    <input type="text" 
                                           id="telefono"
                                           name="telefono" 
                                           value="{{ old('telefono', $ajuste->telefono ?? '') }}"
                                           class="form-control @error('telefono') is-invalid @enderror">
                                    @error('telefono')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo Electrónico</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                    <input type="email" 
                                           id="email"
                                           name="email" 
                                           value="{{ old('email', $ajuste->email ?? '') }}"
                                           class="form-control @error('email') is-invalid @enderror">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Divisa -->
                            <div class="mb-3">
                                <label for="divisa" class="form-label">Moneda</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-currency-dollar"></i></span>
                                    <select id="divisa" 
                                            name="divisa" 
                                            class="form-select @error('divisa') is-invalid @enderror">
                                        @foreach($monedas as $moneda)
                                            <option value="{{ $moneda['symbol'] }}" {{ (old('divisa', $ajuste->divisa ?? '') == $moneda['symbol']) ? 'selected' : '' }}>{{ $moneda['name'] }} ({{ $moneda['symbol'] }})</option>
                                        @endforeach
                                    </select>
                                    @error('divisa')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Página Web -->
                            <div class="mb-3">
                                <label for="pagina_web" class="form-label">Página Web</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-globe"></i></span>
                                    <input type="url" 
                                           id="pagina_web"
                                           name="pagina_web" 
                                           value="{{ old('pagina_web', $ajuste->pagina_web ?? '') }}"
                                           class="form-control @error('pagina_web') is-invalid @enderror">
                                    @error('pagina_web')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Logos -->
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="logo" class="form-label">Logo
                                </label>
                                <input type="file" 
                                       id="logo"
                                       name="logo" 
                                       class="form-control @error('logo') is-invalid @enderror"
                                       accept="image/*" 
                                       @if(!isset($ajuste) || !$ajuste->logo) required @else  @endif
                                       onchange="mostrarImagen(event)">
                                @error('logo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if(isset($ajuste->logo) && $ajuste->logo)
                                    <div class="mt-2">
                                        <img src="{{ url('storage/' . $ajuste->logo) }}" id="logopreview" alt="Logo actual" style="max-height: 300px; margin-top: 10px;">
                                    </div>
                                @endif

                                <img id="logopreview" style="max-height: 300px; margin-top: 10px;" alt="" src="">

                                <script>
                                    const mostrarImagen = e =>
                                    document.getElementById('logopreview').src=URL.createObjectURL(e.target.files[0]);
                                </script>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="img_login" class="form-label">Imagen de Login</label>
                                <input type="file" 
                                       id="img_login"
                                       name="img_login" 
                                       class="form-control @error('img_login') is-invalid @enderror"
                                       accept="image/*"
                                        @if(!isset($ajuste) || !$ajuste->img_login) required @else  @endif
                                       onchange="mostrarImagen2(event)">
                                @error('img_login')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if(isset($ajuste->img_login) && $ajuste->img_login)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $ajuste->img_login) }}" id="loginpreview" alt="Imagen de login actual" style="max-height: 300px;">
                                    </div>
                                @endif

                                <img id="loginpreview" style="max-height: 300px; margin-top: 10px;" alt="" src="">

                                <script>
                                    const mostrarImagen2 = e =>
                                    document.getElementById('loginpreview').src=URL.createObjectURL(e.target.files[0]);
                                </script>

                            </div>

                        </div>
                    </div>
<hr>    
                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-2"></i>Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .input-group-text {
            min-width: 45px;
            justify-content: center;
        }
    </style>
@endpush
