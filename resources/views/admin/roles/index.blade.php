@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4">Roles</h1>
        <hr>
        <div class="col-md-6">

        
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Roles registrados
                    <a href="{{ url('/admin/roles/create') }}" class="btn btn-success float-end " title="Agregar rol">
                    <span class="text-xl "> <i class="bi bi-plus"></i></span>
                </a></h6>

            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover table-striped table-responsive table-fixed">
                    <thead>
                        <tr>
                            <th>Nro</th>
                            <th>Nombre</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    @php
                        $i = ($roles->currentPage() - 1) * $roles->perPage() + 1;
                    @endphp
                    <tbody>
                        @foreach ($roles as $role)
                        <tr>
                            <td class="text-center"> {{ $i++ }}</td>
                            <td> {{ $role->name }}</td>
                            <td class="text-center gap-2">
                                
                                    <a href="{{ url('/admin/roles/'.$role->id) }}" class="btn btn-success" title="Ver">
                                        <i class="bi bi-eye "></i>
                                    </a>
                                    <a href="{{ url('/admin/roles/' . $role->id . '/edit') }}" class="btn btn-primary" title="Editar">
                                        <i class="bi bi-pencil "></i>
                                    </a>
                                    <button type="button" class="btn btn-danger" title="Eliminar" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $role->id }}">
                                        <i class="bi bi-trash "></i>
                                    </button>
                            </td>
                        </tr>
                            
                        @endforeach
                    </tbody>
                </table>

                @if ($roles->hasPages())
                <div class="d-flex justify-content-between mt-4">
                    {{ $roles->links('pagination::bootstrap-4') }}
                </div>
                @endif
            </div>
        </div>
        </div>
    </div>

    <!-- Modal de confirmación de eliminación -->
    @foreach ($roles as $role)
    <div class="modal fade" id="deleteModal{{ $role->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $role->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title " id="deleteModalLabel{{ $role->id }}"><i class="bi bi-exclamation-triangle-fill" style="font-size: 3rem; color: #dc3545;"></i></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Está seguro de que desea eliminar el rol "{{ $role->name }}"? Esta acción no se puede deshacer.
                </div>
                <div class="modal-footer">
                    <form action="{{ url('/admin/roles/'. $role->id) }}" method="POST">
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


