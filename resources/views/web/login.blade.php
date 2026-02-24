@extends('layouts.web')

@section('content')
      <main class="main">

    <!-- Page Title -->
    <div class="page-title light-background">
      <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Iniciar Sesión</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="/">Inicio</a></li>
            <li class="current">Iniciar Sesión</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Login Section -->
    <section id="login" class="login section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row justify-content-center">
          <div class="col-lg-8 col-md-10">
            <div class="auth-container" data-aos="fade-in" data-aos-delay="200">

              <!-- Login Form -->
              <div class="auth-form login-form active">
                <div class="form-header">
                  <h3>Bienvenido</h3>
                  <p>Inicia sesión en tu cuenta</p>
                </div>

                <form action="{{ route('web.autenticacion') }}" method="POST" class="auth-form-content">
                  @csrf
                  <div class="input-group mb-3">
                    <span class="input-icon">
                      <i class="bi bi-envelope"></i>
                    </span>
                    <input type="email" name="email" class="form-control" placeholder="Email address" required="" autocomplete="email">
                  </div>

                  <div class="input-group mb-3">
                    <span class="input-icon">
                      <i class="bi bi-lock"></i>
                    </span>
                    <input type="password" name="password" class="form-control" placeholder="Password" required="" autocomplete="current-password">
                    <span class="password-toggle">
                      <i class="bi bi-eye"></i>
                    </span>
                  </div>

                  <div class="form-options mb-4">
                    <div class="remember-me">
                      <input type="checkbox" id="rememberLogin">
                      <label for="rememberLogin">Recuerdame</label>
                    </div>
                    <a href="#" class="forgot-password">¿Olvidaste tu contraseña?</a>
                  </div>

                  <button type="submit" class="auth-btn primary-btn mb-3">
                    Iniciar Sesión
                    <i class="bi bi-arrow-right"></i>
                  </button>

                  <div class="divider">
                    <span>o</span>
                  </div>

                  <button type="button" class="auth-btn social-btn">
                    <i class="bi bi-google"></i>
                    Continuar con Google
                  </button>

                  <div class="switch-form">
                    <span>¿No tienes una cuenta?</span>
                    <a href="{{ url('web/registro') }}" class="switch-btn">Crear cuenta</a>
                  </div>
                </form>
              </div>

    

            </div>
          </div>
        </div>

      </div>

    </section><!-- /Login Section -->

  </main>
@endsection