@extends('layouts.web')

@section('content')
    <section id="best-sellers" class="best-sellers section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Resultados de búsqueda</h2>
        <p>Resultados para: {{ $query ?? '' }}</p>
      </div><!-- End Section Title -->

      @if($productos->isEmpty())
        <div class="container" data-aos="fade-up" data-aos-delay="100">
          <div class="row g-5">
            <div class="col-12">
              <p>No se encontraron productos.</p>
            </div>
          </div>
        </div>
      @else
      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row g-5">

          <!-- Product 2 -->
          @foreach ($productos as $producto)
          <div class="col-lg-3 col-md-6">
            <div class="product-item">
              <div class="product-image">
                <div class="product-badge sale-badge">25% Off</div>
                @php
                    $img=$producto->imagenes()->first()?->imagen;
                    
                @endphp
                <img src={{ $img ? asset('storage/'.$img) : asset('default/no_photo.png') }} alt="Imagen del producto" class="img-fluid" >
                <div class="product-actions">
                  <button class="action-btn wishlist-btn " title="Agregar a favoritos">
                    <i class="bi bi-heart"></i>
                  </button>
                  {{-- <button class="action-btn compare-btn" title="Agregar a comparar">
                    <i class="bi bi-arrow-left-right"></i>
                  </button> --}}
                  <a href = "{{ route('web.detalle_producto', $producto->id) }}" class="action-btn quickview-btn" title="Ver producto">
                    <i class="bi bi-zoom-in"></i>
                  </a>
                </div>
                <button class="cart-btn">Agregar al carrito</button>
              </div>
              <div class="product-info">
                <div class="product-category">{{$producto->nombre}}</div>
                <h4 class="product-name">{{ $producto->descripcion_corta }}</h4>
                <div class="product-rating">
                  <div class="stars">
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-half"></i>
                  </div>
                  <span class="rating-count">(38)</span>
                </div>
                <div class="product-price">
                  {{-- <span class="old-price">$240.00</span> --}}
                  <span class="current-price">$ {{ $producto->precio_venta }}</span>
                </div>
                {{-- <div class="color-swatches">
                  <span class="swatch active" style="background-color: #1f2937;"></span>
                  <span class="swatch" style="background-color: #f59e0b;"></span>
                  <span class="swatch" style="background-color: #8b5cf6;"></span>
                </div> --}}
              </div>
            </div>
          </div>
          @endforeach
          <!-- End Product 2 -->

          @if ($productos->hasPages())
          <div class="d-flex justify-content-between mt-4">
              <div>{{ $productos->total() }} productos</div>
              <div>{{ $productos->appends(request()->except('page'))->links('pagination::bootstrap-4') }}</div>
          </div>
          @endif
      @endif
        </div>

      </div>

    </section>
    
@endsection
