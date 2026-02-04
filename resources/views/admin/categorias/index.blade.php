@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4">Categorias</h1>
        <hr>
        <div class="col-md-12">

        
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Categorias registradas
                    <a href="{{ url('/admin/categorias/create') }}" class="btn btn-success float-end " title="Agregar categoria">
                    <span class="text-xl "> <i class="bi bi-plus"></i></span>
                </a></h6>

            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{ url('/admin/categorias') }}" method="GET">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Buscar" value="{{ $_REQUEST['search'] ?? '' }}">
                                <button type="submit" class="btn btn-primary" title="Buscar"> <i class="bi bi-search"></i></button>
                                @if (isset($_REQUEST['search']))
                                    <a href="{{ url('/admin/categorias') }}" class="btn btn-secondary" title="Limpiar"> <i class="bi bi-arrow-clockwise"></i></a>
                                @endif
                            </div>
                        </form>
                        
                    </div>
                </div>
                <hr>
                <table class="table table-bordered table-hover table-striped table-responsive-md table-auto">
                    <thead>
                        <tr>
                            <th>Nro</th>
                            <th>Nombre</th>
                            <th>Slug</th>
                            <th>Descripcion</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    @php
                        $i = ($categorias->currentPage() - 1) * $categorias->perPage() + 1;
                    @endphp
                    <tbody>
                        @if ($categorias->isEmpty())
                        <tr>
                            <td colspan="6" class="text-center">No se encontraron registros </td>
                        </tr>
                        @else
                        @foreach ($categorias as $categoria)
                        <tr>
                            <td class="text-center"> {{ $i++ }}</td>
                            <td> {{ $categoria->nombre }}</td>
                            <td> {{ $categoria->slug }}</td>
                            <td> {{ $categoria->descripcion }}</td>
                            <td class="text-center gap-2 btn-group">
                                
                                
                                    <a href="{{ url('/admin/categoria/'.$categoria->id) }}" class="btn btn-success" title="Ver">
                                        <i class="bi bi-eye "></i>
                                    </a>
                                    <a href="{{ url('/admin/categoria/' . $categoria->id . '/edit') }}" class="btn btn-primary" title="Editar">
                                        <i class="bi bi-pencil "></i>
                                    </a>
                                    <form class="d-inline" action="{{ url('/admin/categoria/' . $categoria->id) }}" method="POST" id="delete-form-{{ $categoria->id }}">
                                        @method('DELETE')
                                        @csrf
                                    
                                    <button type="button" class="btn btn-danger" title="Eliminar" onclick="confirmDelete{{ $categoria->id }}(event)">
                                        <i class="bi bi-trash "></i>
                                    </button>
                                    </form>
                                    <script>
                                        function confirmDelete{{ $categoria->id }}(event) {
                                            event.preventDefault();
                                            Swal.fire({
                                                title: "¿Desea eliminar la categoria {{ $categoria->nombre }}?",
                                               
                                                icon: "warning",
                                                showCancelButton: true,
                                                reverseButtons: true,
                                                buttonsStyling: false,
                                                confirmButtonText: "Eliminar",
                                                cancelButtonText: "Cancelar",
                                                customClass: {
                                                    actions: 'd-flex gap-2',
                                                    confirmButton: 'btn btn-danger',
                                                    cancelButton: 'btn btn-secondary'
                                                }
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    document.getElementById('delete-form-{{ $categoria->id }}').submit();
                                                    
                                                }
                                                });
                                        }
                                    </script>
                                     
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>

                @if ($categorias->hasPages())
                <div class="d-flex justify-content-between mt-4">
                    {{ $categorias->links('pagination::bootstrap-4') }}
                </div>
                @endif
            </div>
        </div>
        </div>
    </div>




@endsection


