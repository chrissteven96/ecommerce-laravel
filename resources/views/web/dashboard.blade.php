@extends('layouts.acount')

@section('content2')

                <div class="tab-pane fade show active" id="orders">
                  <div class="section-header" data-aos="fade-up">
                    <h2>Mis Pedidos</h2>
                    <div class="header-actions">
                      <div class="search-box">
                        <i class="bi bi-search"></i>
                        <input type="text" placeholder="Buscar ordenes...">
                      </div>
                      <div class="dropdown">
                        <button class="filter-btn" data-bs-toggle="dropdown">
                          <i class="bi bi-funnel"></i>
                          <span>Filter</span>
                        </button>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="#">All Orders</a></li>
                          <li><a class="dropdown-item" href="#">Processing</a></li>
                          <li><a class="dropdown-item" href="#">Shipped</a></li>
                          <li><a class="dropdown-item" href="#">Delivered</a></li>
                          <li><a class="dropdown-item" href="#">Cancelled</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>

                @foreach($misordenes as $orden)
                  <div class="orders-grid">
                    <!-- Order Card 1 -->
                    <div class="order-card" data-aos="fade-up" data-aos-delay="100">
                      <div class="order-header">
                        <div class="order-id">
                          <span class="label">Order ID:</span>
                          <span class="value"> {{ $orden->id }} </span>
                        </div>
                        <div class="order-date"> 
                        @php
                            $meses = ['ene', 'feb', 'mar', 'abr', 'may', 'jun', 'jul', 'ago', 'sep', 'oct', 'nov', 'dic'];
                            $mes = $meses[$orden->created_at->month - 1];
                        @endphp
                        {{ $mes }} {{ $orden->created_at->day }}, {{ $orden->created_at->year }}
                    </div>
                      </div>
                      <div class="order-content">
                        <div class="product-grid">
                          <img src="assets/img/product/product-1.webp" alt="Product" loading="lazy">
                          <img src="assets/img/product/product-2.webp" alt="Product" loading="lazy">
                          <img src="assets/img/product/product-3.webp" alt="Product" loading="lazy">
                        </div>
                        <div class="order-info">
                          <div class="info-row">
                            <span>Estado</span>
                            <span class="status processing"> {{ $orden->estado_orden }} </span>
                          </div>
                          <div class="info-row">
                            <span>Productos</span>
                            @php
                                $totalItems = 0;
                                foreach($orden->detalle as $detalle) {
                                    $totalItems += $detalle->cantidad;
                                }
                            @endphp
                            <span>{{ $totalItems }} items</span>
                          </div>
                          <div class="info-row">
                            <span>Total</span>
                            <span class="price">{{ $orden->divisa }} {{ $orden->total }} </span>
                          </div>
                        </div>
                      </div>
                      <div class="order-footer">
                        <button type="button" class="btn-track" data-bs-toggle="collapse" data-bs-target="#tracking1" aria-expanded="false">Track Order</button>
                        <button type="button" class="btn-details" data-bs-toggle="collapse" data-bs-target="#details1" aria-expanded="false">View Details</button>
                      </div>

                      <!-- Order Tracking -->
                      <div class="collapse tracking-info" id="tracking1">
                        <div class="tracking-timeline">
                          <div class="timeline-item completed">
                            <div class="timeline-icon">
                              <i class="bi bi-check-circle-fill"></i>
                            </div>
                            <div class="timeline-content">
                              <h5>Order Confirmed</h5>
                              <p>Your order has been received and confirmed</p>
                              <span class="timeline-date">Feb 20, 2025 - 10:30 AM</span>
                            </div>
                          </div>

                          <div class="timeline-item completed">
                            <div class="timeline-icon">
                              <i class="bi bi-check-circle-fill"></i>
                            </div>
                            <div class="timeline-content">
                              <h5>Processing</h5>
                              <p>Your order is being prepared for shipment</p>
                              <span class="timeline-date">Feb 20, 2025 - 2:45 PM</span>
                            </div>
                          </div>

                          <div class="timeline-item active">
                            <div class="timeline-icon">
                              <i class="bi bi-box-seam"></i>
                            </div>
                            <div class="timeline-content">
                              <h5>Packaging</h5>
                              <p>Your items are being packaged for shipping</p>
                              <span class="timeline-date">Feb 20, 2025 - 4:15 PM</span>
                            </div>
                          </div>

                          <div class="timeline-item">
                            <div class="timeline-icon">
                              <i class="bi bi-truck"></i>
                            </div>
                            <div class="timeline-content">
                              <h5>In Transit</h5>
                              <p>Expected to ship within 24 hours</p>
                            </div>
                          </div>

                          <div class="timeline-item">
                            <div class="timeline-icon">
                              <i class="bi bi-house-door"></i>
                            </div>
                            <div class="timeline-content">
                              <h5>Delivery</h5>
                              <p>Estimated delivery: Feb 22, 2025</p>
                            </div>
                          </div>
                        </div>
                      </div>

                      <!-- Order Details -->
                      <div class="collapse order-details" id="details1">
                        <div class="details-content">
                          <div class="detail-section">
                            <h5>Order Information</h5>
                            <div class="info-grid">
                              <div class="info-item">
                                <span class="label">Payment Method</span>
                                <span class="value">Credit Card (**** 4589)</span>
                              </div>
                              <div class="info-item">
                                <span class="label">Shipping Method</span>
                                <span class="value">Express Delivery (2-3 days)</span>
                              </div>
                            </div>
                          </div>

                          <div class="detail-section">
                            <h5>Items (3)</h5>
                            <div class="order-items">
                              <div class="item">
                                <img src="assets/img/product/product-1.webp" alt="Product" loading="lazy">
                                <div class="item-info">
                                  <h6>Lorem ipsum dolor sit amet</h6>
                                  <div class="item-meta">
                                    <span class="sku">SKU: PRD-001</span>
                                    <span class="qty">Qty: 1</span>
                                  </div>
                                </div>
                                <div class="item-price">$899.99</div>
                              </div>

                              <div class="item">
                                <img src="assets/img/product/product-2.webp" alt="Product" loading="lazy">
                                <div class="item-info">
                                  <h6>Consectetur adipiscing elit</h6>
                                  <div class="item-meta">
                                    <span class="sku">SKU: PRD-002</span>
                                    <span class="qty">Qty: 2</span>
                                  </div>
                                </div>
                                <div class="item-price">$599.95</div>
                              </div>

                              <div class="item">
                                <img src="assets/img/product/product-3.webp" alt="Product" loading="lazy">
                                <div class="item-info">
                                  <h6>Sed do eiusmod tempor</h6>
                                  <div class="item-meta">
                                    <span class="sku">SKU: PRD-003</span>
                                    <span class="qty">Qty: 1</span>
                                  </div>
                                </div>
                                <div class="item-price">$129.99</div>
                              </div>
                            </div>
                          </div>

                          <div class="detail-section">
                            <h5>Price Details</h5>
                            <div class="price-breakdown">
                              <div class="price-row">
                                <span>Subtotal</span>
                                <span>$1,929.93</span>
                              </div>
                              <div class="price-row">
                                <span>Shipping</span>
                                <span>$15.99</span>
                              </div>
                              <div class="price-row">
                                <span>Tax</span>
                                <span>$159.98</span>
                              </div>
                              <div class="price-row total">
                                <span>Total</span>
                                <span>$2,105.90</span>
                              </div>
                            </div>
                          </div>

                          <div class="detail-section">
                            <h5>Shipping Address</h5>
                            <div class="address-info">
                              <p>Sarah Anderson<br>123 Main Street<br>Apt 4B<br>New York, NY 10001<br>United States</p>
                              <p class="contact">+1 (555) 123-4567</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                @endforeach


                  </div>

                  <!-- Pagination -->
                  <div class="pagination-wrapper" data-aos="fade-up">
                    <button type="button" class="btn-prev" disabled="">
                      <i class="bi bi-chevron-left"></i>
                    </button>
                    <div class="page-numbers">
                      <button type="button" class="active">1</button>
                      <button type="button">2</button>
                      <button type="button">3</button>
                      <span>...</span>
                      <button type="button">12</button>
                    </div>
                    <button type="button" class="btn-next">
                      <i class="bi bi-chevron-right"></i>
                    </button>
                  </div>
                </div>

    </section>

  </main>

@endsection
