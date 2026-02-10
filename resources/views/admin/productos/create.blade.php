@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4">Registrar Producto</h1>
        <hr>
        
        <div class="row">
            <div class="col-md-12">
                
        <div class="card shadow mb-4">
            <div class="card-header ">
                <h6 class="m-0 font-weight-bold text-primary">Llenar los campos</h6>
            </div>
            <hr>
            <div class="card-body">
                <form action=" {{ url('/admin/productos/create') }}" enctype="multipart/form-data" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">Categoria</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-tag"></i>
                                    </span>
                                <select name="categoria_id" id="categoria_id" class="form-control"  required>
                                    <option value="{{ old('categoria_id') }}">Selecciona una categoria</option>
                                    @foreach ($categorias as $categoria)
                                        <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>{{ $categoria->nombre }}</option>
                                    @endforeach
                                </select>
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
                                    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre del producto" required>
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
                                    <input type="text" name="codigo" id="codigo" class="form-control" placeholder="Código del producto" required>
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
                                    <textarea name="descripcion_corta" id="descripcion_corta" class="form-control" rows="3"></textarea>
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
                                    <textarea name="descripcion_larga" id="descripcion_larga" class="form-control ckeditor" placeholder="Descripción larga" rows="3" required></textarea>
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
                                    <input type="number" name="precio_compra" id="precio_compra" class="form-control" value="{{ old('precio_compra') }}" required>
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
                                    <input type="number" name="precio_venta" id="precio_venta" class="form-control" value="{{ old('precio_venta') }}" required>
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
                                        <i class="bi bi-boxes"></i>
                                    </span>
                                    <input type="number" name="stock" id="stock" class="form-control" value="{{ old('stock') }}" required  min="0">
                                </div>
                                @error('stock')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror   
                            </div>
                        </div>

                        <input type="hidden" name="slug" id="slug" class="form-control" value="{{ old('slug') }}" readonly required>

                    </div>

  
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <h6 class="m-0 font-weight-bold text-primary">Subir imagenes</h6>
                            <div class="form-group">
                                <label for="imagenes">Imagenes</label>
                                <input type="file"
                                    name="images[]"
                                    class="form-control"
                                    multiple
                                    accept="image/*"
                                    onchange="previewImages(this)"
                                    id="imagenes">
                            </div>
                            <div id="imagePreview" class="row mt-2"></div>
                            <script>
                                function previewImages(input) {
                                    const preview = document.getElementById('imagePreview');
                                    preview.innerHTML = '';

                                    Array.from(input.files).forEach(file => {
                                        const reader = new FileReader();

                                        reader.onload = e => {
                                            preview.innerHTML += `
                                                <div class="col-md-3 mb-3">
                                                    <img src="${e.target.result}"
                                                        class="img-fluid rounded"
                                                        style="height:150px;object-fit:cover;">
                                                </div>
                                            `;
                                        };

                                        reader.readAsDataURL(file);
                                    });
                                }
                                </script>
                        </div>
                    </div>


                        
                        <hr>
                <div class="row">
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="{{ url('/admin/productos') }}" class="btn btn-secondary">
                            <i class="bi bi-x-square me-2"></i>Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-2"></i>Guardar
                        </button>
                    </div>
                </div>
                </form>
            </div>
      
            </div>
        </div>
    </div>

        <script>
        // Generar slug automáticamente desde el nombre
        document.getElementById('nombre').addEventListener('input', function() {
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


