@extends('layouts.web')

@section('content')

<main class="main">

    <!-- Page Title -->
    <div class="page-title light-background">
      <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Registrate</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="{{ url('/') }}">Inicio</a></li>
            <li class="current">Registrate</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Register Section -->
    <section id="register" class="register section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row justify-content-center">
          <div class="col-lg-10">
            <div class="registration-form-wrapper">
              <div class="form-header text-center">
                <h2>Crear tu cuenta</h2>
                <p>Crear tu cuenta y empieza a comprar con nosotros</p>
              </div>

              <div class="row">
                <div class="col-lg-8 mx-auto">
                  <form action="{{ url('web/registro') }}" method="post">
                    @csrf
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="name" name="name" placeholder="Full Name" required="" autocomplete="name">
                      <label for="name">Nombre completo</label>
                    </div>

                    <div class="form-floating mb-3">
                      <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" required="" autocomplete="email">
                      <label for="email">Correo electrónico</label>
                    </div>

                    <div class="row mb-3">
                      <div class="col-md-6">
                        <div class="form-floating">
                          <input type="password" class="form-control" id="password" name="password" placeholder="Password" required="" minlength="8" autocomplete="new-password">
                          <label for="password">Contraseña</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-floating">
                          <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" required="" minlength="8" autocomplete="new-password">
                          <label for="password_confirmation">Confirmar Contraseña</label>
                        </div>
                      </div>
                    </div>

                    {{-- <div class="form-floating mb-4">
                      <select class="form-select" id="country" name="country" required="">
                        <option value="" selected="" disabled="">Selecciona tu país</option>
                        <option value="us">United States</option>
                        <option value="ca">Canada</option>
                        <option value="uk">United Kingdom</option>
                        <option value="au">Australia</option>
                        <option value="de">Germany</option>
                        <option value="fr">France</option>
                        <option value="jp">Japan</option>
                        <option value="other">Other</option>
                      </select>
                      <label for="country">País</label>
                    </div> --}}

                    {{-- <div class="form-check mb-4">
                      <input class="form-check-input" type="checkbox" id="termsCheck" name="termsCheck" required="">
                      <label class="form-check-label" for="termsCheck">
                        Acepto los <a href="#">Términos de Servicio</a> y <a href="#">Política de Privacidad</a>
                      </label>
                    </div>

                    <div class="form-check mb-4">
                      <input class="form-check-input" type="checkbox" id="marketingCheck" name="marketingCheck">
                      <label class="form-check-label" for="marketingCheck">
                        Deseo recibir comunicaciones de marketing sobre productos, servicios y promociones
                      </label>
                    </div> --}}

                    <div class="d-grid mb-4">
                      <button type="submit" class="btn btn-register">Crear cuenta</button>
                    </div>

                    <div class="login-link text-center">
                      <p>¿Ya tienes una cuenta? <a href="#">Inicia sesión</a></p>
                    </div>
                  </form>
                </div>
              </div>

              <div class="social-login">
                <div class="row">
                  <div class="col-lg-8 mx-auto">
                    <div class="divider">
                      <span>O regístrate con</span>
                    </div>
                    <div class="social-buttons">
                      <a href="#" class="btn btn-social">
                        <i class="bi bi-google"></i>
                        <span>Google</span>
                      </a>
                      <a href="#" class="btn btn-social">
                        <i class="bi bi-facebook"></i>
                        <span>Facebook</span>
                      </a>
                      <a href="#" class="btn btn-social">
                        <i class="bi bi-apple"></i>
                        <span>Apple</span>
                      </a>
                    </div>
                  </div>
                </div>
              </div>

              <div class="decorative-elements">
                <div class="circle circle-1"></div>
                <div class="circle circle-2"></div>
                <div class="circle circle-3"></div>
                <div class="square square-1"></div>
                <div class="square square-2"></div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /Register Section -->

  </main>

@endsection