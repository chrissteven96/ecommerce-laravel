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
                            <td class=" text-center gap-2">
                                
                                    <a href="{{ url('/admin/roles/'.$role->id) }}" class="btn btn-success" title="Ver">
                                        <i class="bi bi-eye "></i>
                                    </a>
                                    <a href="{{ url('/admin/roles/' . $role->id . '/edit') }}" class="btn btn-primary" title="Editar">
                                        <i class="bi bi-pencil "></i>
                                    </a>
                                    <form class="d-inline" action="{{ url('/admin/roles/' . $role->id) }}" method="POST" id="delete-form-{{ $role->id }}">
                                        @method('DELETE')
                                        @csrf
                                    
                                    <button type="button" class="btn btn-danger" title="Eliminar" onclick="confirmDelete{{ $role->id }}(event)">
                                        <i class="bi bi-trash "></i>
                                    </button>
                                    </form>

                                    <script>
                                        function confirmDelete{{ $role->id }}(event) {
                                            event.preventDefault();
                                            Swal.fire({
                                                title: "¿Desea eliminar el rol {{ $role->name }}?",
                                                text: "¡No se podrá revertir esta acción!",
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
                                                    document.getElementById('delete-form-{{ $role->id }}').submit();
                                                    
                                                }
                                                });
                                        }
                                    </script>
                                    
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

@endsection


