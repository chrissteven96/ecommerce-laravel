@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4">Usuarios</h1>
        <hr>
        <div class="col-md-12">

        
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Usuarios registrados
                    <a href="{{ url('/admin/usuarios/create') }}" class="btn btn-success float-end " title="Agregar usuario">
                    <span class="text-xl "> <i class="bi bi-plus"></i></span>
                </a></h6>

            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{ url('/admin/usuarios') }}" method="GET">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Buscar" value="{{ $_REQUEST['search'] ?? '' }}">
                                <button type="submit" class="btn btn-primary" title="Buscar"> <i class="bi bi-search"></i></button>
                                @if (isset($_REQUEST['search']))
                                    <a href="{{ url('/admin/usuarios') }}" class="btn btn-secondary" title="Limpiar"> <i class="bi bi-arrow-clockwise"></i></a>
                                @endif
                            </div>
                        </form>
                        
                    </div>
                </div>
                <hr>
                <table class="table table-bordered table-hover table-striped table-responsive table-fixed">
                    <thead>
                        <tr>
                            <th>Nro</th>
                            <th>Rol</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    @php
                        $i = ($usuarios->currentPage() - 1) * $usuarios->perPage() + 1;
                    @endphp
                    <tbody>
                        @if ($usuarios->isEmpty())
                        <tr>
                            <td colspan="6" class="text-center">No se encontraron registros </td>
                        </tr>
                        @else
                        @foreach ($usuarios as $usuario)
                        <tr>
                            <td class="text-center"> {{ $i++ }}</td>
                            <td> {{ $usuario->roles->pluck('name')->implode(' , ') }}</td>
                            <td> {{ $usuario->name }}</td>
                            <td> {{ $usuario->email }}</td>
                            <td> @if ($usuario->status == 1)
                                <span class="badge bg-success">Activo</span>
                            @else
                                <span class="badge bg-danger">Inactivo</span>
                            @endif</td>
                            <td class="text-center gap-2">
                                @if ($usuario->status == 1)
                                
                                
                                    <a href="{{ url('/admin/usuario/'.$usuario->id) }}" class="btn btn-success" title="Ver">
                                        <i class="bi bi-eye "></i>
                                    </a>
                                    <a href="{{ url('/admin/usuario/' . $usuario->id . '/edit') }}" class="btn btn-primary" title="Editar">
                                        <i class="bi bi-pencil "></i>
                                    </a>
                                    <form class="d-inline" action="{{ url('/admin/usuario/' . $usuario->id) }}" method="POST" id="delete-form-{{ $usuario->id }}">
                                        @method('DELETE')
                                        @csrf
                                    
                                    <button type="button" class="btn btn-danger" title="Eliminar" onclick="confirmDelete{{ $usuario->id }}(event)">
                                        <i class="bi bi-trash "></i>
                                    </button>
                                    </form>
                                    <script>
                                        function confirmDelete{{ $usuario->id }}(event) {
                                            event.preventDefault();
                                            Swal.fire({
                                                title: "¿Desea eliminar el usuario {{ $usuario->name }}?",
                                               
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
                                                    document.getElementById('delete-form-{{ $usuario->id }}').submit();
                                                    
                                                }
                                                });
                                        }
                                    </script>

                                @else
                                <form action="{{ url('/admin/usuario/' . $usuario->id . '/restore') }}" method="POST" id="restore-form-{{ $usuario->id }}">
                                    @csrf
                                    <button type="submit" class="btn btn-secondary" title="Restaurar" onclick="confirmRestore{{ $usuario->id }}(event)">
                                        <i class="bi bi-arrow-clockwise "></i>
                                    </button>
                                    </form>
                                    <script>
                                        function confirmRestore{{ $usuario->id }}(event) {
                                            event.preventDefault();
                                            Swal.fire({
                                                title: "¿Desea restaurar el usuario {{ $usuario->name }}?",
                                               
                                                icon: "warning",
                                                showCancelButton: true,
                                                reverseButtons: true,
                                                buttonsStyling: false,
                                                confirmButtonText: "Restaurar",
                                                cancelButtonText: "Cancelar",
                                                customClass: {
                                                    actions: 'd-flex gap-2',
                                                    confirmButton: 'btn btn-warning',
                                                    cancelButton: 'btn btn-secondary'
                                                }
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    document.getElementById('restore-form-{{ $usuario->id }}').submit();
                                                    
                                                }
                                                });
                                        }
                                    </script>
                                    
                                @endif
                                     
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>

                @if ($usuarios->hasPages())
                <div class="d-flex justify-content-between mt-4">
                    {{ $usuarios->links('pagination::bootstrap-4') }}
                </div>
                @endif
            </div>
        </div>
        </div>
    </div>




@endsection


