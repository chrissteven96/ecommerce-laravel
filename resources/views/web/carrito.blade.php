@extends('layouts.web')

@section('content')
  <main class="main">

    <!-- Page Title -->
    <div class="page-title light-background">
      <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Carrito</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="{{ route('home') }}">inicio</a></li>
            <li class="current">Carrito</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Cart Section -->
    <section id="cart" class="cart section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row">
          <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">
            <div class="cart-items">
              <div class="cart-header d-none d-lg-block">
                <div class="row align-items-center">
                  <div class="col-lg-6">
                    <h5>Productos</h5>
                  </div>
                  <div class="col-lg-2 text-center">
                    <h5>Precio</h5>
                  </div>
                  <div class="col-lg-2 text-center">
                    <h5>Cantidad</h5>
                  </div>
                  <div class="col-lg-2 text-center">
                    <h5>Subtotal</h5>
                  </div>
                </div>
              </div>

              @php
                $total = 0;
                $envio = 0; 
              @endphp


              @foreach ($carritos as $carrito)
              <div class="cart-item">
                <div class="row align-items-center">
                  <div class="col-lg-6 col-12 mt-3 mt-lg-0 mb-lg-0 mb-3">
                    <div class="product-info d-flex align-items-center">
                      <div class="product-image">
                        @php
                          
                          $img=$carrito->producto->imagenes()->first()?->imagen;
                          
                        @endphp
                        <img src={{ $img ? asset('storage/'.$img) : asset('default/no_photo.png') }} alt="Imagen del producto" class="img-fluid" >

                
                      </div>
                      <div class="product-details">
                        <h6 class="product-title">{{ $carrito->producto->nombre }}</h6>
                        <div class="product-meta">
                          {{-- <span class="product-color">Color: Black</span>
                          <span class="product-size">Size: M</span> --}}
                          <span class="product-quantity"> {{ $carrito->producto->stock }} disponibles</span>
                        </div>
                        {{-- <button class="remove-item" type="button">
                          <i class="bi bi-trash"></i> Eliminar
                        </button> --}}

                        <form class="d-inline" action="{{ url('/carrito/' . $carrito->id) }}" method="POST" id="delete-form-{{ $carrito->id }}">
                                        @method('DELETE')
                                        @csrf
                                    
                                    {{-- <button type="button" class="btn btn-danger" title="Eliminar" onclick="confirmDelete{{ $carrito->id }}(event)">
                                        <i class="bi bi-trash "></i>
                                    </button> --}}

                                    {{-- <button class="btn-remove" type="button" title="Eliminar" onclick="confirmDelete{{ $carrito->id }}(event)">
                                        <i class="bi bi-trash"></i>
                                    </button> --}}

                                    <button class="btn btn-sm btn-outline-danger" type="button" title="Eliminar" onclick="confirmDelete{{ $carrito->id }}(event)">
                                        <i class="bi bi-trash"></i> Eliminar
                                    </button>
                                    </form>
                                    <script>
                                        function confirmDelete{{ $carrito->id }}(event) {
                                            event.preventDefault();
                                            Swal.fire({
                                                title: "¿Desea eliminar el producto {{ $carrito->producto->nombre }} de su carrito?",
                                               
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
                                                    document.getElementById('delete-form-{{ $carrito->id }}').submit();
                                                    
                                                }
                                                });
                                        }
                                    </script>

                      </div>
                    </div>
                  </div>
                  <div class="col-lg-2 col-12 mt-3 mt-lg-0 text-center">
                    <div class="price-tag">
                      <span class="current-price"> {{ $ajuste->divisa." ".$carrito->producto->precio_venta   }}</span>
                    </div>
                  </div>
                  <div class="col-lg-2 col-12 mt-3 mt-lg-0 text-center">

                    <form action="{{ url('/carrito/actualizar') }}" method="POST">
                      @csrf
                      @method('PUT')
                      <input type="hidden" name="carrito_id" value="{{ $carrito->id }}">
                    <div class="quantity-selector">
                      <button class="quantity-btn decrease">
                        <i class="bi bi-dash"></i>
                      </button>

                      <input type="number" class="quantity-input" value="{{ $carrito->cantidad }}" min="1" max="{{ $carrito->producto->stock }}" name="cantidad">
                      <button class="quantity-btn increase">
                        <i class="bi bi-plus"></i>
                      </button>

                    </div>
                    </form>

                  </div>
                  <div class="col-lg-2 col-12 mt-3 mt-lg-0 text-center">
                    <div class="item-total">
                      @php
                        
                        $subtotal = $carrito->producto->precio_venta * $carrito->cantidad;
                        $total += $subtotal;
                        
                      @endphp
                      <span>{{ $ajuste->divisa." ".$subtotal }}</span>
                    </div>
                  </div>
                </div>
              </div><!-- End Cart Item -->
              
                  
              @endforeach
              <!-- Cart Item 1 -->




              <div class="cart-actions">
                <div class="row">
                  <div class="col-lg-6 mb-3 mb-lg-0">
                    {{-- <div class="coupon-form">
                      <div class="input-group">
                        <input type="text" class="form-control" placeholder="Coupon code">
                        <button class="btn btn-outline-accent" type="button">Apply Coupon</button>
                      </div>
                    </div> --}}
                  </div>
                  <div class="col-lg-6 text-md-end">
                    {{-- <button class="btn btn-outline-heading me-2">
                      <i class="bi bi-arrow-clockwise"></i> Actualizar Carrito
                    </button> --}}

                    <form action="{{ url('/carrito/limpiar') }}" method="POST">
                      @csrf
                      <button type="submit" class="btn btn-outline-remove">
                        <i class="bi bi-trash"></i> Vaciar Carrito
                      </button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="300">
            <div class="cart-summary">
              <h4 class="summary-title">Resumen de la Orden</h4>

              <div class="summary-item">
                <span class="summary-label">Subtotal</span>
                <span class="summary-value">{{ $ajuste->divisa." ".$total }}</span>
              </div>

              <div class="summary-item shipping-item">
                <span class="summary-label">Envío</span>


                <div class="shipping-options">
                  <div class="form-check text-end">
                    <input class="form-check-input" type="radio" name="shipping" id="standard" checked="" value="5">
                    <label class="form-check-label" for="standard">
                      Envío a provincia - $5.00
                    </label>
                  </div>

                  <div class="form-check text-end">
                    <input class="form-check-input" type="radio" name="shipping" id="delivery" value="1.50">
                    <label class="form-check-label" for="delivery" >
                      Envío delivery (Dentro de la ciudad) - $1.50
                    </label>
                  </div>

                  <div class="form-check text-end">
                    <input class="form-check-input" type="radio" name="shipping" id="shop" checked="">
                    <label class="form-check-label" for="shop">
                      Retiro en tienda - $0.00
                    </label>
                  </div>

                  <div class=" text-end">
                    {{-- <input class="form-check-input" type="radio" name="shipping" id="free"> --}}
                    <label class="form-check-label" for="free">
                      Envío Gratis (Pedidos sobre $150)
                    </label>
                  </div>
                </div>
              </div>
{{-- 
              <div class="summary-item">
                <span class="summary-label">Tax</span>
                <span class="summary-value">$27.00</span>
              </div>

              <div class="summary-item discount">
                <span class="summary-label">Discount</span>
                <span class="summary-value">-$0.00</span>
              </div> --}}

              <div class="summary-total">
                <span class="summary-label">Total</span>
                <span class="summary-value">$301.95</span>
              </div>

              <div class="checkout-button">
                <a href="#" class="btn btn-accent w-100">
                  Proceder al Pago <i class="bi bi-arrow-right"></i>
                </a>
              </div>

              <div class="continue-shopping">
                <a href="/" class="btn btn-link w-100">
                  <i class="bi bi-arrow-left"></i> Continuar Comprando
                </a>
              </div>

              <div class="payment-methods">
                <p class="payment-title">Aceptamos</p>
                <div class="payment-icons">
                  <i class="bi bi-credit-card"></i>
                  <i class="bi bi-paypal"></i>
                  <i class="bi bi-wallet2"></i>
                  <i class="bi bi-bank"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /Cart Section -->

  </main>
@endsection
