@extends('layouts.web')

@section('content')

  <main class="main">

    <!-- Page Title -->
    <div class="page-title light-background">
      <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Completar Pedido</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="/">Inicio</a></li>
            <li class="current">Completar Pedido</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Checkout Section -->
    <section id="checkout" class="checkout section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row">
          <div class="col-lg-7">
            <!-- Checkout Form -->
            <div class="checkout-container" data-aos="fade-up">
              <form  action="{{ url('/carrito/completar') }}" method="POST">
                @csrf


                <!-- Shipping Address -->
                <div class="checkout-section" id="shipping-address">
                  <div class="section-header">
                    <div class="section-number">1</div>
                    <h3>Dirección de Envío</h3>
                  </div>
                  <div class="section-content">
                    
                    <div class="form-group">
                      <label for="whatsapp">Whatsapp</label>
                      <input type="tel" class="form-control" name="whatsapp" id="whatsapp" placeholder="0987654321" required="">
                    </div>
                    <div class="form-group">
                      <label for="address">Dirección</label>
                      <input type="text" class="form-control" name="address" id="address" placeholder="Dirección" required="">
                    </div>

                    <input type="text" name="id" value= {{ auth('web')->user()->id }} hidden>

                    <input type="text" name="divisa" value={{ $ajuste->divisa }} hidden>

                    <input type="text" name="estado_pago" value="Pendiente" hidden>
                    <input type="text" name="estado_orden" value="Pendiente" hidden>
                    <input type="text" name="transaccion_id" value="00" hidden>

                    @php
                      $total2 = 0;
                      foreach($carritos as $item) {

                        $subtotal2 = $item->producto->precio_venta * $item->cantidad;
                        $total2 += $subtotal2;
                      }
                    @endphp
                    <input type="text" name="total" value="{{ $total2 }}" hidden>


                    
                    
                    

                  </div>
                </div>



                <!-- Order Review -->
                <div class="checkout-section" id="order-review">

                  <div class="section-content">
                    
                    {{-- <div class="success-message d-none">¡Tu pedido ha sido realizado exitosamente! Gracias por tu compra.</div> --}}
                    <div class="place-order-container">
                      <button type="submit" class="btn btn-primary place-order-btn">
                        <span class="btn-text">Pagar</span>
                        {{-- <span class="btn-price"> </span> --}}
                      </button>
                    </div>
                    
                </div>
              </form>
            </div>
          </div>
        </div>

          <div class="col-lg-5">
            <!-- Order Summary -->
            <div class="order-summary" data-aos="fade-left" data-aos-delay="200">
              <div class="order-summary-header">
                <h3>Detalles del Pedido</h3>
                @php
                  $count = 0;
                @endphp
                @foreach ($carritos as $carrito)
                  @php
                    $count++;
                  @endphp
                @endforeach

                <span class="item-count">{{ $count }} Items</span>
              </div>

              @php
                $total = 0;
                $envio = 5; 
               
              @endphp
              
              <div class="order-summary-content">
                @foreach($carritos as $carrito)
                <div class="order-items">
                  <div class="order-item">
                    <div class="order-item-image">
                      @php
                        $img = $carrito->producto->imagenes()->first()?->imagen;
                      @endphp
                      <img src="{{ $img ? asset('storage/'.$img) : asset('default/no_photo.png') }}" alt="Producto" class="img-fluid">
                    </div>
                    <div class="order-item-details">
                      <h4>{{ $carrito->producto->nombre }}</h4>
                      <p class="order-item-variant"> {{ $carrito->producto->descripcion_corta }}</p>
                      <div class="order-item-price">
                        <span class="quantity"> {{ $carrito->cantidad }}  ×</span>
                        <span class="price">${{ $carrito->producto->precio_venta }}</span>
                      </div>
                    </div>
                  </div>
                  @php
                    $subtotal = $carrito->producto->precio_venta * $carrito->cantidad;
                    $total += $subtotal;
                  @endphp
                @endforeach
                </div>

                {{-- <div class="promo-code">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Promo Code" aria-label="Promo Code">
                    <button class="btn btn-outline-primary" type="button">Apply</button>
                  </div>
                </div> --}}

                <div class="order-totals">
                  <div class="order-subtotal d-flex justify-content-between">
                    <span>Subtotal</span>
                    <span>$ {{ $total }}</span>
                  </div>
                  <div class="order-shipping d-flex justify-content-between">
                    <span>Envio</span>
                    <span>$ {{ $envio }}</span>
                  </div>
                  {{-- <div class="order-tax d-flex justify-content-between">
                    <span>Impuesto</span>
                    <span>$21.00</span>
                  </div> --}}
                  <div class="order-total d-flex justify-content-between">
                    <span>Total</span>

                    <span>${{ $total + $envio }}</span>
                  </div>
                </div>

                <div class="secure-checkout">
                  <div class="secure-checkout-header">
                    <i class="bi bi-shield-lock"></i>
                    <span>Secure Checkout</span>
                  </div>
                  {{-- <div class="payment-icons">
                    <i class="bi bi-credit-card-2-front"></i>
                    <i class="bi bi-credit-card"></i>
                    <i class="bi bi-paypal"></i>
                    <i class="bi bi-apple"></i>
                  </div> --}}
                </div>
              </div>
            </div>
          </div>
        </div>



      </div>

    </section><!-- /Checkout Section -->

  </main>

@endsection

