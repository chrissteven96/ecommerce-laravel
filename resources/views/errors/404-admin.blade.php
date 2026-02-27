@extends('layouts.admin')

@section('content')
<body>
    <script src="assets/static/js/initTheme.js"></script>
    <div id="error">
        

<div class="error-page container">
    <div class="col-md-8 col-12 offset-md-2">
        <div class="text-center">
            <img class="img-error" src="{{ asset('assets/compiled/svg/error-404.svg') }}" height="400" alt="Not Found">
            <h1 class="error-title">Página no encontrada</h1>
            <p class='fs-5 text-gray-600'>La página que estás buscando no existe.</p>
            <a href="{{ url('/admin') }}" class="btn btn-lg btn-outline-primary mt-3">Ir al inicio</a>
        </div>
    </div>
</div>


    </div>
</body>
@endsection