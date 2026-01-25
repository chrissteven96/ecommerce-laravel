@extends('layouts.admin')

@section('content')
    <h1>Bienvenido {{ Auth::user()->name }}   </h1>
    <p>Welcome to the admin dashboard.</p>
@endsection
