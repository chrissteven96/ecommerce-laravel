@extends('layouts.acount')

@section('content2')
                <!-- Wishlist Tab -->
                <div class="tab-pane fade show active" id="wishlist">
                  <div class="section-header" data-aos="fade-up">
                    <h2>Favoritos</h2>
                    {{-- <div class="header-actions">
                      <button type="button" class="btn-add-all">Agregar todos al carrito</button>
                    </div> --}}
                  </div>

                  <div class="wishlist-grid">
                    <!-- Wishlist Item 1 -->
                    @foreach($favoritos as $favorito)
                    <div class="wishlist-card" data-aos="fade-up" data-aos-delay="100">
                    @php
                    $img=$favorito->producto->imagenes()->first()?->imagen;
                    
                    @endphp
                      <div class="wishlist-image">
                        <img src="{{ $img ? asset('storage/'.$img) : asset('default/no_photo.png') }}" alt="Producto" loading="lazy">


                                <form class="d-inline" action="{{ url('/favorito/' . $favorito->id) }}" method="POST" id="delete-form-{{ $favorito->id }}">
                                        @method('DELETE')
                                        @csrf
                                    
                                    {{-- <button type="button" class="btn btn-danger" title="Eliminar" onclick="confirmDelete{{ $favorito->id }}(event)">
                                        <i class="bi bi-trash "></i>
                                    </button> --}}

                                    <button class="btn-remove" type="button" title="Eliminar" onclick="confirmDelete{{ $favorito->id }}(event)">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                    </form>
                                    <script>
                                        function confirmDelete{{ $favorito->id }}(event) {
                                            event.preventDefault();
                                            Swal.fire({
                                                title: "¿Desea eliminar el producto {{ $favorito->producto->nombre }} de sus favoritos?",
                                               
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
                                                    document.getElementById('delete-form-{{ $favorito->id }}').submit();
                                                    
                                                }
                                                });
                                        }
                                    </script>
                        {{-- <button class="btn-remove" type="button" aria-label="Remove from wishlist">
                          <i class="bi bi-trash"></i>
                        </button> --}}





                        <div class="sale-badge"> {{ $favorito->producto->stock }} disponibles </div> 
                      </div>
                      <div class="wishlist-content">
                        <a href="{{ url('producto/' . $favorito->producto->id) }}"><h4>{{ $favorito->producto->nombre }}</h4></a>
                        <div class="product-meta">
                          <div class="rating">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-half"></i>
                            <span>(4.5)</span>
                          </div>
                          <div class="price">
                            <span class="current"> {{ $favorito->producto->precio_venta }} </span>
                            {{-- <span class="original">$99.99</span> --}}
                          </div>
                        </div>
                        <form action="{{ url('/carrito/agregar') }}" method="POST">
                          @csrf
                          <input type="hidden" name="producto_id" value="{{ $favorito->producto->id }}">
                          <input type="hidden" name="cantidad" value="1">
                          <button type="submit" class="btn-add-cart">Agregar al carrito</button>
                        </form>
                      </div>
                    </div>
                    @endforeach


                  </div>
                </div>


@endsection
