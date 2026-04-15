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
              <form class="checkout-form">
                <!-- Customer Information -->
                {{-- <div class="checkout-section" id="customer-info">
                  <div class="section-header">
                    <div class="section-number">1</div>
                    <h3>Customer Information</h3>
                  </div>
                  <div class="section-content">
                    <div class="row">
                      <div class="col-md-6 form-group">
                        <label for="first-name">First Name</label>
                        <input type="text" name="first-name" class="form-control" id="first-name" placeholder="Your First Name" required="">
                      </div>
                      <div class="col-md-6 form-group">
                        <label for="last-name">Last Name</label>
                        <input type="text" name="last-name" class="form-control" id="last-name" placeholder="Your Last Name" required="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="email">Email Address</label>
                      <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required="">
                    </div>
                    <div class="form-group">
                      <label for="phone">Phone Number</label>
                      <input type="tel" class="form-control" name="phone" id="phone" placeholder="Your Phone Number" required="">
                    </div>
                  </div>
                </div> --}}

                <!-- Shipping Address -->
                <div class="checkout-section" id="shipping-address">
                  <div class="section-header">
                    <div class="section-number">1</div>
                    <h3>Dirección de Envío</h3>
                  </div>
                  <div class="section-content">
                    <div class="form-group">
                      <label for="address">Dirección</label>
                      <input type="text" class="form-control" name="address" id="address" placeholder="Dirección" required="">
                    </div>
                    {{-- <div class="form-group">
                      <label for="apartment">Apartment, Suite, etc. (optional)</label>
                      <input type="text" class="form-control" name="apartment" id="apartment" placeholder="Apartment, Suite, Unit, etc.">
                    </div> --}}
                    {{-- <div class="row">
                      <div class="col-md-4 form-group">
                        <label for="city">City</label>
                        <input type="text" name="city" class="form-control" id="city" placeholder="City" required="">
                      </div>
                      <div class="col-md-4 form-group">
                        <label for="state">State</label>
                        <input type="text" name="state" class="form-control" id="state" placeholder="State" required="">
                      </div>
                      <div class="col-md-4 form-group">
                        <label for="zip">ZIP Code</label>
                        <input type="text" name="zip" class="form-control" id="zip" placeholder="ZIP Code" required="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="country">País</label>
                      <select class="form-select" id="country" name="country" required="">
                        <option value="">Seleccionar País</option>
                        <option value="US">United States</option>
                        <option value="CA">Canada</option>
                        <option value="UK">United Kingdom</option>
                        <option value="AU">Australia</option>
                        <option value="DE">Germany</option>
                        <option value="FR">France</option>
                      </select>
                    </div> --}}
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="save-address" name="save-address">
                      <label class="form-check-label" for="save-address">
                        Guardar esta dirección para futuros pedidos
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="billing-same" name="billing-same" checked="">
                      <label class="form-check-label" for="billing-same">
                        La dirección de facturación es la misma que la de envío
                      </label>
                    </div>
                  </div>
                </div>

                <!-- Payment Method -->
                {{-- <div class="checkout-section" id="payment-method">
                  <div class="section-header">
                    <div class="section-number">3</div>
                    <h3>Método de Pago</h3>
                  </div>
                  <div class="section-content">
                    <div class="payment-options">
                      <div class="payment-option active">
                        <input type="radio" name="payment-method" id="credit-card" checked="">
                        <label for="credit-card">
                          <span class="payment-icon"><i class="bi bi-credit-card-2-front"></i></span>
                          <span class="payment-label">Credit / Debit Card</span>
                        </label>
                      </div>
                      <div class="payment-option">
                        <input type="radio" name="payment-method" id="paypal">
                        <label for="paypal">
                          <span class="payment-icon"><i class="bi bi-paypal"></i></span>
                          <span class="payment-label">PayPal</span>
                        </label>
                      </div>
                      <div class="payment-option">
                        <input type="radio" name="payment-method" id="apple-pay">
                        <label for="apple-pay">
                          <span class="payment-icon"><i class="bi bi-apple"></i></span>
                          <span class="payment-label">Apple Pay</span>
                        </label>
                      </div>
                    </div>

                    <div class="payment-details" id="credit-card-details">
                      <div class="form-group">
                        <label for="card-number">Card Number</label>
                        <div class="card-number-wrapper">
                          <input type="text" class="form-control" name="card-number" id="card-number" placeholder="1234 5678 9012 3456" required="">
                          <div class="card-icons">
                            <i class="bi bi-credit-card-2-front"></i>
                            <i class="bi bi-credit-card"></i>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6 form-group">
                          <label for="expiry">Expiration Date</label>
                          <input type="text" class="form-control" name="expiry" id="expiry" placeholder="MM/YY" required="">
                        </div>
                        <div class="col-md-6 form-group">
                          <label for="cvv">Security Code (CVV)</label>
                          <div class="cvv-wrapper">
                            <input type="text" class="form-control" name="cvv" id="cvv" placeholder="123" required="">
                            <span class="cvv-hint" data-bs-toggle="tooltip" data-bs-placement="top" title="3-digit code on the back of your card">
                              <i class="bi bi-question-circle"></i>
                            </span>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="card-name">Name on Card</label>
                        <input type="text" class="form-control" name="card-name" id="card-name" placeholder="John Doe" required="">
                      </div>
                    </div>

                    <div class="payment-details d-none" id="paypal-details">
                      <p class="payment-info">You will be redirected to PayPal to complete your purchase securely.</p>
                    </div>

                    <div class="payment-details d-none" id="apple-pay-details">
                      <p class="payment-info">You will be prompted to authorize payment with Apple Pay.</p>
                    </div>
                  </div>
                </div> --}}

                <!-- Order Review -->
                <div class="checkout-section" id="order-review">
                  <div class="section-header">
                    <div class="section-number">2</div>
                    <h3>Revisar y Pagar</h3>
                  </div>
                  <div class="section-content">
                    <div class="form-check terms-check">
                      <input class="form-check-input" type="checkbox" id="terms" name="terms" required="">
                      <label class="form-check-label" for="terms">
                        Estoy de acuerdo con los <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal">Términos y Condiciones</a> y la <a href="#" data-bs-toggle="modal" data-bs-target="#privacyModal">Política de Privacidad</a>
                      </label>
                    </div>
                    <div class="success-message d-none">¡Tu pedido ha sido realizado exitosamente! Gracias por tu compra.</div>
                    <div class="place-order-container">
                      <button type="submit" class="btn btn-primary place-order-btn">
                        <span class="btn-text">Pagar</span>
                        {{-- <span class="btn-price"> </span> --}}
                      </button>
                    </div>
                  </div>
                </div>
              </form>
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

        <!-- Terms and Privacy Modals -->
        <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="termsModalLabel">Terms and Conditions</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in dui mauris. Vivamus hendrerit arcu sed erat molestie vehicula. Sed auctor neque eu tellus rhoncus ut eleifend nibh porttitor. Ut in nulla enim. Phasellus molestie magna non est bibendum non venenatis nisl tempor.</p>
                <p>Suspendisse in orci enim. Vivamus hendrerit arcu sed erat molestie vehicula. Sed auctor neque eu tellus rhoncus ut eleifend nibh porttitor. Ut in nulla enim. Phasellus molestie magna non est bibendum non venenatis nisl tempor.</p>
                <p>Suspendisse in orci enim. Vivamus hendrerit arcu sed erat molestie vehicula. Sed auctor neque eu tellus rhoncus ut eleifend nibh porttitor. Ut in nulla enim. Phasellus molestie magna non est bibendum non venenatis nisl tempor.</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">I Understand</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="privacyModal" tabindex="-1" aria-labelledby="privacyModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="privacyModalLabel">Privacy Policy</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in dui mauris. Vivamus hendrerit arcu sed erat molestie vehicula. Sed auctor neque eu tellus rhoncus ut eleifend nibh porttitor. Ut in nulla enim.</p>
                <p>Suspendisse in orci enim. Vivamus hendrerit arcu sed erat molestie vehicula. Sed auctor neque eu tellus rhoncus ut eleifend nibh porttitor. Ut in nulla enim. Phasellus molestie magna non est bibendum non venenatis nisl tempor.</p>
                <p>Suspendisse in orci enim. Vivamus hendrerit arcu sed erat molestie vehicula. Sed auctor neque eu tellus rhoncus ut eleifend nibh porttitor. Ut in nulla enim. Phasellus molestie magna non est bibendum non venenatis nisl tempor.</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">I Understand</button>
              </div>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /Checkout Section -->

  </main>

@endsection