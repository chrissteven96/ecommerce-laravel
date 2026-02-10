@extends('layouts.admin')

@section('content')
    <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h2>Bienvenido : {{ Auth::user()->name }}</h2>

            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href=""> {{ Auth::user()->roles->pluck('name')->implode(', ') }} </a></li>
                        {{-- <li class="breadcrumb-item active" aria-current="page">Breadcrumb</li> --}}
                    </ol>
                </nav>
            </div>
        </div>

        <br>
    <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <a href="{{ url('/admin/roles') }}">
                                    <div class="stats-icon purple mb-2">
                                        <i class=""><i class="bi bi-person-vcard-fill text-gray"></i></i>
                                    </div>
                                    </a>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Roles</h6>
                                    <h6 class="font-extrabold mb-0">{{ $total_roles }}</h6>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card"> 
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <a href="{{ url('/admin/usuarios') }}">
                                    <div class="stats-icon blue mb-2">
                                        <i class=""><i class="bi bi-person-bounding-box text-gray"></i></i>
                                    </div>
                                    </a>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Usuarios</h6>
                                    <h6 class="font-extrabold mb-0">{{ $total_users }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <a href="{{ url('/admin/categorias') }}">
                                    <div class="stats-icon purple mb-2">
                                        <i class=""><i class="bi bi-tags-fill text-gray"></i></i>
                                    </div>
                                    </a>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Categorias</h6>
                                    <h6 class="font-extrabold mb-0">{{ $total_categorias }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <a href="{{ url('/admin/productos') }}">
                                    <div class="stats-icon red mb-2">
                                        <i class=""><i class="bi bi-box-seam-fill text-gray"></i></i>
                                    </div>
                                    </a>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Prodcutos</h6>
                                    <h6 class="font-extrabold mb-0">{{ $total_productos }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection
