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
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    @php
                        $i = ($usuarios->currentPage() - 1) * $usuarios->perPage() + 1;
                    @endphp
                    <tbody>
                        @if ($usuarios->isEmpty())
                        <tr>
                            <td colspan="5" class="text-center">No se encontraron registros </td>
                        </tr>
                        @else
                        @foreach ($usuarios as $usuario)
                        <tr>
                            <td class="text-center"> {{ $i++ }}</td>
                            <td> {{ $usuario->roles->pluck('name')->implode(' | ') }}</td>
                            <td> {{ $usuario->name }}</td>
                            <td> {{ $usuario->email }}</td>
                            <td class="text-center gap-2">
                                
                                    <a href="{{ url('/admin/usuario/'.$usuario->id) }}" class="btn btn-success" title="Ver">
                                        <i class="bi bi-eye "></i>
                                    </a>
                                    <a href="{{ url('/admin/usuario/' . $usuario->id . '/edit') }}" class="btn btn-primary" title="Editar">
                                        <i class="bi bi-pencil "></i>
                                    </a>
                                    <button type="button" class="btn btn-danger" title="Eliminar" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $usuario->id }}">
                                        <i class="bi bi-trash "></i>
                                    </button>
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

    <!-- Modal de confirmación de eliminación -->
    @foreach ($usuarios as $usuario)
    <div class="modal fade" id="deleteModal{{ $usuario->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $usuario->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title " id="deleteModalLabel{{ $usuario->id }}"><i class="bi bi-exclamation-triangle-fill" style="font-size: 3rem; color: #dc3545;"></i></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Está seguro de que desea eliminar el usuario "{{ $usuario->name }}"? Esta acción no se puede deshacer.
                </div>
                <div class="modal-footer">
                    <form action="{{ url('/admin/usuario/'. $usuario->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Sí, eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach


@endsection


