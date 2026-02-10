@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4">Producto: {{ $producto->nombre }}</h1>
        <hr>
        
        <div class="row">
            <div class="col-md-12">
                
        <div class="card shadow mb-4">
            <div class="card-header ">
                <h6 class="m-0 font-weight-bold text-primary">Url: {{ $producto->slug }}</h6>
            </div>
            <hr>
            <div class="card-body">
                <form action="" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">Categoria</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-tag"></i>
                                    </span>
                                <input name="categoria_id" id="categoria_id" class="form-control" value="{{ $producto->categoria->nombre }}" readonly>
                                   
                                </div>
                                @error('categoria_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-box-seam-fill"></i>
                                    </span>
                                    <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $producto->nombre }}" readonly placeholder="Nombre del producto" required>
                                </div>
                                @error('nombre')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="codigo">Código</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-upc-scan"></i>
                                    </span>
                                    <input type="text" name="codigo" id="codigo" class="form-control" value="{{ $producto->codigo }}" readonly placeholder="Código del producto" required>
                                </div>
                                @error('codigo')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="descripcion_corta">Descripción corta</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-text-left"></i>
                                    </span>
                                    <textarea name="descripcion_corta" id="descripcion_corta" class="form-control" value="{{ $producto->descripcion_corta }}" readonly rows="3"> {{ $producto->descripcion_corta }}</textarea>
                                </div>
                                @error('descripcion_corta')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>


                    </div>
                     <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="descripcion_larga">Descripción larga</label>
                                <div class="" style="width: 100%;">
                                    <p name="descripcion_larga" id="descripcion_larga" readonly > {!! $producto->descripcion_larga !!}</p>
                                </div>
                                @error('descripcion_larga')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                                <script src="//cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
                                <script type="text/javascript">

                                    $(document).ready(function() {

                                    $('.ckeditor').ckeditor();

                                    });

                                </script>
                        </div>
                     </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="precio_compra">Precio de compra</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-currency-dollar"></i>
                                    </span>
                                    <input type="number" name="precio_compra" id="precio_compra" class="form-control" value="{{ $producto->precio_compra }}" readonly required>
                                </div>
                                @error('precio_compra')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="precio_venta">Precio de venta</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-currency-dollar"></i>
                                    </span>
                                    <input type="number" name="precio_venta" id="precio_venta" class="form-control" value="{{ $producto->precio_venta }}" readonly required>
                                </div>
                                @error('precio_venta')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="stock">Stock</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-currency-dollar"></i>
                                    </span>
                                    <input type="number" name="stock" id="stock" class="form-control" value="{{ $producto->stock }}" readonly  min="0">
                                </div>
                                @error('stock')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror   
                            </div>
                        </div>

                        <input type="hidden" name="slug" id="slug" class="form-control" value="{{ old('slug') }}" readonly>

                    </div>
<hr>
                    <div class="row mt-4 mb-4">
                        <h6 class="">Imagenes</h6>
                        
                        @if ($imagenes->count() > 0)
                        @foreach ($imagenes as $imagen)
                            <div class="col-md-4 mb-3">
                                <div class="card">
                                    <img src="{{ asset('storage/' . $imagen->imagen) }}"
                                        class="card-img-top img-fluid"
                                        style="height:250px; width:100% ; object-fit:contain;"
                                        alt="Imagen del producto">
                                </div>
                            </div>
                        @endforeach
                      @else
                        <p>No hay imágenes disponibles</p>
                        @endif
                    </div>

                        
                        <hr>
                <div class="row">
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="{{ url('/admin/producto/' . $producto->id . '/edit')  }}" class="btn btn-secondary">
                            <i class="bi bi-pencil me-2"></i>Editar
                        </a>

                        <a href="{{ url('/admin/productos') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-return-left me-2"></i>Regresar
                        </a>
                    </div>
                </div>


                </form>
            </div>
      
            </div>
        </div>
    </div>


@endsection


