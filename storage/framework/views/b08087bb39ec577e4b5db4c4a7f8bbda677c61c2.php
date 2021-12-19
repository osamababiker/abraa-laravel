<?php echo $__env->make('site.layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <!-- Body-->
  <body class="handheld-toolbar-enabled">

    <!-- Quick View Modal-->
    <div class="modal-quick-view modal fade" id="quick-view-electro" tabindex="-1">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title product-title"><a href="shop-single-v2.html" data-bs-toggle="tooltip" data-bs-placement="right" title="Go to product page">Smartwatch Youth Edition<i class="ci-arrow-left fs-lg ms-2"></i></a></h4>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row">
              <!-- Product gallery-->
              <div class="col-lg-7 pe-lg-0">
                <div class="product-gallery">
                  <div class="product-gallery-preview order-sm-2">
                    <div class="product-gallery-preview-item active" id="first"><img class="image-zoom" src="<?php echo e(asset('site/img/shop/single/gallery/05.jpg')); ?>" data-zoom="<?php echo e(asset('site/img/shop/single/gallery/05.jpg')); ?>" alt="Product image">
                      <div class="image-zoom-pane"></div>
                    </div>
                    <div class="product-gallery-preview-item" id="second"><img class="image-zoom" src="<?php echo e(asset('site/img/shop/single/gallery/06.jpg')); ?>" data-zoom="<?php echo e(asset('site/img/shop/single/gallery/06.jpg')); ?>" alt="Product image">
                      <div class="image-zoom-pane"></div>
                    </div>
                    <div class="product-gallery-preview-item" id="third"><img class="image-zoom" src="<?php echo e(asset('site/img/shop/single/gallery/07.jpg')); ?>" data-zoom="<?php echo e(asset('site/img/shop/single/gallery/07.jpg')); ?>" alt="Product image">
                      <div class="image-zoom-pane"></div>
                    </div>
                    <div class="product-gallery-preview-item" id="fourth"><img class="image-zoom" src="<?php echo e(asset('site/img/shop/single/gallery/08.jpg')); ?>" data-zoom="<?php echo e(asset('site/img/shop/single/gallery/08.jpg')); ?>" alt="Product image">
                      <div class="image-zoom-pane"></div>
                    </div>
                  </div>
                  <div class="product-gallery-thumblist order-sm-1"><a class="product-gallery-thumblist-item active" href="#first"><img src="<?php echo e(asset('site/img/shop/single/gallery/th05.jpg')); ?>" alt="Product thumb"></a><a class="product-gallery-thumblist-item" href="#second"><img src="<?php echo e(asset('site/img/shop/single/gallery/th06.jpg')); ?>" alt="Product thumb"></a><a class="product-gallery-thumblist-item" href="#third"><img src="<?php echo e(asset('site/img/shop/single/gallery/th07.jpg')); ?>" alt="Product thumb"></a><a class="product-gallery-thumblist-item" href="#fourth"><img src="<?php echo e(asset('site/img/shop/single/gallery/th08.jpg')); ?>" alt="Product thumb"></a></div>
                </div>
              </div>
              <!-- Product details-->
              <div class="col-lg-5 pt-4 pt-lg-0 image-zoom-pane">
                <div class="product-details ms-auto pb-3">
                  <div class="mb-2">
                    <div class="star-rating"><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star"></i>
                    </div><span class="d-inline-block fs-sm text-body align-middle mt-1 ms-1">74 Reviews</span>
                  </div>
                  <div class="h3 fw-normal text-accent mb-3 me-1">$124.<small>99</small></div>
                  <div class="fs-sm mb-4"><span class="text-heading fw-medium me-1">Color:</span><span class="text-muted" id="colorOptionText">Dark blue/Orange</span></div>
                  <div class="position-relative me-n4 mb-3">
                    <div class="form-check form-option form-check-inline mb-2">
                      <input class="form-check-input" type="radio" name="color" id="color1" data-bs-label="colorOptionText" value="Dark blue/Orange" checked>
                      <label class="form-option-label rounded-circle" for="color1"><span class="form-option-color rounded-circle" style="background-color: #f25540;"></span></label>
                    </div>
                    <div class="form-check form-option form-check-inline mb-2">
                      <input class="form-check-input" type="radio" name="color" id="color2" data-bs-label="colorOptionText" value="Dark gray/Green">
                      <label class="form-option-label rounded-circle" for="color2"><span class="form-option-color rounded-circle" style="background-color: #65805b;"></span></label>
                    </div>
                    <div class="form-check form-option form-check-inline mb-2">
                      <input class="form-check-input" type="radio" name="color" id="color3" data-bs-label="colorOptionText" value="White">
                      <label class="form-option-label rounded-circle" for="color3"><span class="form-option-color rounded-circle" style="background-color: #f5f5f5;"></span></label>
                    </div>
                    <div class="form-check form-option form-check-inline mb-2">
                      <input class="form-check-input" type="radio" name="color" id="color4" data-bs-label="colorOptionText" value="Black">
                      <label class="form-option-label rounded-circle" for="color4"><span class="form-option-color rounded-circle" style="background-color: #333;"></span></label>
                    </div>
                    <div class="product-badge product-available mt-n1"><i class="ci-security-check"></i>Product available</div>
                  </div>
                  <div class="d-flex align-items-center pt-2 pb-4">
                    <select class="form-select me-3" style="width: 5rem;">
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                    </select>
                    <button class="btn btn-primary btn-shadow d-block w-100" type="button"><i class="ci-cart fs-lg me-2"></i>Add to Cart</button>
                  </div>
                  <div class="d-flex mb-4">
                    <div class="w-100 me-3">
                      <button class="btn btn-secondary d-block w-100" type="button"><i class="ci-heart fs-lg me-2"></i><span class='d-none d-sm-inline'>Add to </span>Wishlist</button>
                    </div>
                    <div class="w-100">
                      <button class="btn btn-secondary d-block w-100" type="button"><i class="ci-compare fs-lg me-2"></i>Compare</button>
                    </div>
                  </div>
                  <h5 class="h6 mb-3 py-2 border-bottom"><i class="ci-announcement text-muted fs-lg align-middle mt-n1 me-2"></i>Product info</h5>
                  <h6 class="fs-sm mb-2">General</h6>
                  <ul class="fs-sm pb-2">
                    <li><span class="text-muted">Model: </span>Amazfit Smartwatch</li>
                    <li><span class="text-muted">Gender: </span>Unisex</li>
                    <li><span class="text-muted">OS campitibility: </span>Android / iOS</li>
                  </ul>
                  <h6 class="fs-sm mb-2">Physical specs</h6>
                  <ul class="fs-sm pb-2">
                    <li><span class="text-muted">Shape: </span>Rectangular</li>
                    <li><span class="text-muted">Body material: </span>Plastics / Ceramics</li>
                    <li><span class="text-muted">Band material: </span>Silicone</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Navbar Electronics Store-->
    <header class="shadow-sm">
      <!-- Topbar-->
      <div class="topbar topbar-dark bg-dark">
        <div class="container">
          <div>
            <div class="topbar-text dropdown disable-autohide"><a class="topbar-link dropdown-toggle" href="#" data-bs-toggle="dropdown"><img class="me-2" src="<?php echo e(asset('site/img/flags/en.png')); ?>" width="20" alt="English">Eng / $</a>
              <ul class="dropdown-menu my-1">
                <li class="dropdown-item">
                  <select class="form-select form-select-sm">
                    <option value="usd">$ USD</option>
                    <option value="eur">€ EUR</option>
                    <option value="ukp">£ UKP</option>
                    <option value="jpy">¥ JPY</option>
                  </select>
                </li>
                <li><a class="dropdown-item pb-1" href="#"><img class="mr-2" src="<?php echo e(asset('site/img/flags/fr.png')); ?>" width="20" alt="Français">Français</a></li>
                <li><a class="dropdown-item pb-1" href="#"><img class="mr-2" src="<?php echo e(asset('site/img/flags/de.png')); ?>" width="20" alt="Deutsch">Deutsch</a></li>
                <li><a class="dropdown-item" href="#"><img class="mr-2" src="<?php echo e(asset('site/img/flags/it.png')); ?>" width="20" alt="Italiano">Italiano</a></li>
              </ul>
            </div>
            <div class="topbar-text text-nowrap d-none d-md-inline-block border-start border-light ps-3 ms-3"><span class="text-muted mr-1"> Available 24/7 at </span><a class="topbar-link" href="tel:00331697720">(00) 33 169 7720</a></div>
          </div>
          <div class="topbar-text dropdown d-md-none ms-auto"><a class="topbar-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Wishlist / Compare / Track</a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="account-wishlist.html"><i class="ci-heart text-muted mr-2"></i>Wishlist (3)</a></li>
              <li><a class="dropdown-item" href="comparison.html"><i class="ci-compare text-muted mr-2"></i>Compare (3)</a></li>
              <li><a class="dropdown-item" href="order-tracking.html"><i class="ci-location text-muted mr-2"></i>Order tracking</a></li>
            </ul>
          </div>
          <div class="d-none d-md-block ms-3 text-nowrap"><a class="topbar-link d-none d-md-inline-block" href="account-wishlist.html"><i class="ci-heart mt-n1"></i>Wishlist (3)</a><a class="topbar-link ms-3 ps-3 border-start border-light d-none d-md-inline-block" href="comparison.html"><i class="ci-compare mt-n1"></i>Compare (3)</a><a class="topbar-link ms-3 border-start border-light ps-3 d-none d-md-inline-block" href="order-tracking.html"><i class="ci-location mt-n1"></i>Order tracking</a></div>
        </div>
      </div>
      <!-- Remove "navbar-sticky" class to make navigation bar scrollable with the page.-->
      <div class="navbar-sticky bg-light">
        <div class="navbar navbar-expand-lg navbar-light">
          <div class="container"><a class="navbar-brand d-none d-sm-block me-3 flex-shrink-0" href="index.html"><img src="<?php echo e(asset('site/img/logo-dark.png')); ?>" width="142" alt="Cartzilla"></a><a class="navbar-brand d-sm-none me-2" href="index.html"><img src="img/logo-icon.png') }}" width="74" alt="Cartzilla"></a>
            <!-- Search-->
            <div class="input-group d-none d-lg-flex flex-nowrap mx-4"><i class="ci-search position-absolute top-50 start-0 translate-middle-y ms-3"></i>
              <input class="form-control rounded-end w-100" type="text" placeholder="Search for products">
              <select class="form-select flex-shrink-0" style="width: 10.5rem;">
                <option>All categories</option>
                <option>Computers</option>
                <option>Smartphones</option>
                <option>TV, Video, Audio</option>
                <option>Cameras</option>
                <option>Headphones</option>
                <option>Wearables</option>
                <option>Printers</option>
                <option>Video Games</option>
                <option>Home Music</option>
                <option>Data Storage</option>
              </select>
            </div>
            <!-- Toolbar-->
            <div class="navbar-toolbar d-flex flex-shrink-0 align-items-center">
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"><span class="navbar-toggler-icon"></span></button><a class="navbar-tool navbar-stuck-toggler" href="#"><span class="navbar-tool-tooltip">Toggle menu</span>
                <div class="navbar-tool-icon-box"><i class="navbar-tool-icon ci-menu"></i></div></a>
                <a class="navbar-tool ms-1 ms-lg-0 me-n1 me-lg-2" href="#signin-modal" data-bs-toggle="modal">
                  <div class="navbar-tool-icon-box"><i class="navbar-tool-icon ci-user"></i></div>
                </a>
              <div class="navbar-tool dropdown ms-3"><a class="navbar-tool-icon-box bg-secondary dropdown-toggle" href="shop-cart.html"><span class="navbar-tool-label">4</span><i class="navbar-tool-icon ci-cart"></i></a><a class="navbar-tool-text" href="shop-cart.html"><small>My Cart</small>$1,247.00</a>
                <!-- Cart dropdown-->
                <div class="dropdown-menu dropdown-menu-start">
                  <div class="widget widget-cart px-3 pt-2 pb-3" style="width: 20rem;">
                    <div style="height: 15rem;" data-simplebar data-simplebar-auto-hide="false">
                      <div class="widget-cart-item pb-2 border-bottom">
                        <button class="btn-close text-danger" type="button" aria-label="Remove"><span aria-hidden="true">&times;</span></button>
                        <div class="d-flex align-items-center"><a class="d-block flex-shrink-0" href="shop-single-v2.html"><img src="<?php echo e(asset('site/img/shop/cart/widget/05.jpg')); ?>" width="64" alt="Product"></a>
                          <div class="ps-2">
                            <h6 class="widget-product-title"><a href="shop-single-v2.html">Bluetooth Headphones</a></h6>
                            <div class="widget-product-meta"><span class="text-accent me-2">$259.<small>00</small></span><span class="text-muted">x 1</span></div>
                          </div>
                        </div>
                      </div>
                      <div class="widget-cart-item py-2 border-bottom">
                        <button class="btn-close text-danger" type="button" aria-label="Remove"><span aria-hidden="true">&times;</span></button>
                        <div class="d-flex align-items-center"><a class="d-block flex-shrink-0" href="shop-single-v2.html"><img src="<?php echo e(asset('site/img/shop/cart/widget/06.jpg')); ?>" width="64" alt="Product"></a>
                          <div class="ps-2">
                            <h6 class="widget-product-title"><a href="shop-single-v2.html">Cloud Security Camera</a></h6>
                            <div class="widget-product-meta"><span class="text-accent me-2">$122.<small>00</small></span><span class="text-muted">x 1</span></div>
                          </div>
                        </div>
                      </div>
                      <div class="widget-cart-item py-2 border-bottom">
                        <button class="btn-close text-danger" type="button" aria-label="Remove"><span aria-hidden="true">&times;</span></button>
                        <div class="d-flex align-items-center"><a class="d-block flex-shrink-0" href="shop-single-v2.html"><img src="<?php echo e(asset('site/img/shop/cart/widget/07.jpg')); ?>" width="64" alt="Product"></a>
                          <div class="ps-2">
                            <h6 class="widget-product-title"><a href="shop-single-v2.html">Android Smartphone S10</a></h6>
                            <div class="widget-product-meta"><span class="text-accent me-2">$799.<small>00</small></span><span class="text-muted">x 1</span></div>
                          </div>
                        </div>
                      </div>
                      <div class="widget-cart-item py-2 border-bottom">
                        <button class="btn-close text-danger" type="button" aria-label="Remove"><span aria-hidden="true">&times;</span></button>
                        <div class="d-flex align-items-center"><a class="d-block flex-shrink-0" href="shop-single-v2.html"><img src="<?php echo e(asset('site/img/shop/cart/widget/08.jpg')); ?>" width="64" alt="Product"></a>
                          <div class="ps-2">
                            <h6 class="widget-product-title"><a href="shop-single-v2.html">Android Smart TV Box</a></h6>
                            <div class="widget-product-meta"><span class="text-accent me-2">$67.<small>00</small></span><span class="text-muted">x 1</span></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="d-flex flex-wrap justify-content-between align-items-center py-3">
                      <div class="fs-sm me-2 py-2"><span class="text-muted">Subtotal:</span><span class="text-accent fs-base ms-1">$1,247.<small>00</small></span></div><a class="btn btn-outline-secondary btn-sm" href="shop-cart.html">Expand cart<i class="ci-arrow-left ms-1 me-n1"></i></a>
                    </div><a class="btn btn-primary btn-sm d-block w-100" href="checkout-details.html"><i class="ci-card me-2 fs-base align-middle"></i>Checkout</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="navbar navbar-expand-lg navbar-light navbar-stuck-menu mt-n2 pt-0 pb-2">
          <div class="container">
            <div class="collapse navbar-collapse" id="navbarCollapse">
              <!-- Search-->
              <div class="input-group d-lg-none my-3"><i class="ci-search position-absolute top-50 start-0 translate-middle-y ms-3"></i>
                <input class="form-control rounded-end" type="text" placeholder="Search for products">
              </div>
              <!-- Departments menu-->
              <ul class="navbar-nav navbar-mega-nav pe-lg-2 me-lg-2">
                <li class="nav-item dropdown"><a class="nav-link dropdown-toggle ps-lg-0" href="#" data-bs-toggle="dropdown"><i class="ci-menu align-middle mt-n1 mr-2"></i> Departments </a>
                  <ul class="dropdown-menu">
                    <li class=""><a class="dropdown-item" href="#" > Computers &amp; Accessories <i class="ci-laptop opacity-60 fs-lg mt-n1 mr-2"></i> </a></li>
                    <li class=""><a class="dropdown-item" href="#" > Smartphones &amp; Tablets  <i class="ci-mobile opacity-60 fs-lg mt-n1 mr-2"></i> </a></li>
                    <li class=""><a class="dropdown-item" href="#" > TV, Video &amp; Audio <i class="ci-monitor opacity-60 fs-lg mt-n1 mr-2"></i> </a></li>
                    <li class=""><a class="dropdown-item" href="#" > Wearable Electronics <i class="ci-watch opacity-60 fs-lg mt-n1 mr-2"></i></a></li>
                  </ul>
                </li>
              </ul>
              <!-- Primary menu-->
              <ul class="navbar-nav">
                <li class="nav-item active"><a class="nav-link" href="#">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Shop</a></li>
                <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Account</a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="account-orders.html">Orders History</a></li>
                    <li><a class="dropdown-item" href="account-profile.html">Profile Settings</a></li>
                    <li><a class="dropdown-item" href="account-wishlist.html">Wishlist</a></li>
                    <li><a class="dropdown-item" href="dashboard-purchases.html">Purchases</a></li>
                  </ul>
                </li>
                <li class="nav-item"><a class="nav-link" href="#">Blog</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </header>
    <!-- Hero (Banners + Slider)-->
    <section class="bg-secondary py-4 pt-md-5">
      <div class="container py-xl-2">
        <div class="row">
          <!-- Slider     -->
          <div class="col-xl-9 pt-xl-4 order-xl-2">
            <div class="tns-carousel">
              <div class="tns-carousel-inner" data-carousel-options="{&quot;items&quot;: 1, &quot;controls&quot;: false, &quot;loop&quot;: false}">
                <div>
                  <div class="row align-items-center">
                    <div class="col-md-6 order-md-2"><img class="d-block mx-auto" src="<?php echo e(asset('site/img/home/hero-slider/05.jpg')); ?>" alt="VR Collection"></div>
                    <div class="col-lg-5 col-md-6 offset-lg-1 order-md-1 pt-4 pb-md-4 text-center text-md-start">
                      <h2 class="fw-light pb-1 from-bottom">World of music with</h2>
                      <h1 class="display-4 from-bottom delay-1">Headphones</h1>
                      <h5 class="fw-light pb-3 from-bottom delay-2">Choose between top brands</h5>
                      <div class="d-table scale-up delay-4 mx-auto mx-md-0"><a class="btn btn-primary btn-shadow" href="shop-grid-ls.html">Shop Now<i class="ci-arrow-left ms-2 me-n1"></i></a></div>
                    </div>
                  </div>
                </div>
                <div>
                  <div class="row align-items-center">
                    <div class="col-md-6 order-md-2"><img class="d-block mx-auto" src="<?php echo e(asset('site/img/home/hero-slider/04.jpg')); ?>" alt="VR Collection"></div>
                    <div class="col-lg-5 col-md-6 offset-lg-1 order-md-1 pt-4 pb-md-4 text-center text-md-start">
                      <h2 class="fw-light pb-1 from-start">Explore the best</h2>
                      <h1 class="display-4 from-start delay-1">VR Collection</h1>
                      <h5 class="fw-light pb-3 from-start delay-2">on the market</h5>
                      <div class="d-table scale-up delay-4 mx-auto mx-md-0"><a class="btn btn-primary btn-shadow" href="shop-grid-ls.html">Shop Now <i class="ci-arrow-left ms-2 me-n1"></i></a></div>
                    </div>
                  </div>
                </div>
                <div>
                  <div class="row align-items-center">
                    <div class="col-md-6 order-md-2"><img class="d-block mx-auto" src="<?php echo e(asset('site/img/home/hero-slider/06.jpg')); ?>" alt="VR Collection"></div>
                    <div class="col-lg-5 col-md-6 offset-lg-1 order-md-1 pt-4 pb-md-4 text-center text-md-start">
                      <h2 class="fw-light pb-1 scale-up">Check our huge</h2>
                      <h1 class="display-4 scale-up delay-1">Smartphones</h1>
                      <h5 class="fw-light pb-3 scale-up delay-2">&amp; Accessories collection</h5>
                      <div class="d-table scale-up delay-4 mx-auto mx-md-0"><a class="btn btn-primary btn-shadow" href="shop-grid-ls.html">Shop Now <i class="ci-arrow-left ms-2 mr-n1"></i></a></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Banner group-->
          <div class="col-xl-3 order-xl-1 pt-4 mt-3 mt-xl-0 pt-xl-0">
            <div class="table-responsive" data-simplebar>
              <div class="d-flex d-xl-block"><a class="d-flex align-items-center bg-faded-info rounded-3 pt-2 ps-2 mb-4 me-4 me-xl-0" href="#" style="min-width: 16rem;"><img src="<?php echo e(asset('site/img/home/banners/banner-sm01.png')); ?>" width="125" alt="Banner">
                  <div class="py-4 px-2">
                    <h5 class="mb-2"><span class="fw-light">Next Gen</span><br>Video <span class="fw-light">with</span><br>360 Cam</h5>
                    <div class="text-info fs-sm">Shop now<i class="ci-arrow-left fs-xs ms-1"></i></div>
                  </div></a><a class="d-flex align-items-center bg-faded-warning rounded-3 pt-2 ps-2 mb-4 me-4 me-xl-0" href="#" style="min-width: 16rem;"><img src="<?php echo e(asset('site/img/home/banners/banner-sm02.png')); ?>" width="125" alt="Banner">
                  <div class="py-4 px-2">
                    <h5 class="mb-2"><span class="fw-light">Top Rated</span><br>Gadgets<br><span class="fw-light">are on </span>Sale</h5>
                    <div class="text-warning fs-sm">Shop now<i class="ci-arrow-left fs-xs ms-1"></i></div>
                  </div></a><a class="d-flex align-items-center bg-faded-success rounded-3 pt-2 ps-2 mb-4" href="#" style="min-width: 16rem;"><img src="<?php echo e(asset('site/img/home/banners/banner-sm03.png')); ?>" width="125" alt="Banner">
                  <div class="py-4 px-2">
                    <h5 class="mb-2"><span class="fw-light">Catch Big</span><br>Deals <span class="fw-light">on</span><br>Earbuds</h5>
                    <div class="text-success fs-sm">Shop now<i class="ci-arrow-left fs-xs ms-1"></i></div>
                  </div></a></div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Products grid (Trending products)-->
    <section class="container pt-5">
      <!-- Heading-->
      <div class="d-flex flex-wrap justify-content-between align-items-center pt-1 border-bottom pb-4 mb-4">
        <h2 class="h3 mb-0 pt-3 me-2">Trending products</h2>
        <div class="pt-3"><a class="btn btn-outline-accent btn-sm" href="shop-grid-ls.html">More products<i class="ci-arrow-left ms-1 me-n1"></i></a></div>
      </div>
      <!-- Grid-->
      <div class="row pt-2 mx-n2">
        <!-- Product-->
        <div class="col-lg-3 col-md-4 col-sm-6 px-2 mb-4">
          <div class="card product-card">
            <div class="product-card-actions d-flex align-items-center"><a class="btn-action nav-link-style me-2" href="#"><i class="ci-compare me-1"></i>Compare</a>
              <button class="btn-wishlist btn-sm" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="ci-heart"></i></button>
            </div><a class="card-img-top d-block overflow-hidden" href="shop-single-v2.html"><img src="<?php echo e(asset('site/img/shop/catalog/58.jpg')); ?>" alt="Product"></a>
            <div class="card-body py-2"><a class="product-meta d-block fs-xs pb-1" href="#">Headphones</a>
              <h3 class="product-title fs-sm"><a href="shop-single-v2.html">Wireless Bluetooth Headphones</a></h3>
              <div class="d-flex justify-content-between">
                <div class="product-price"><span class="text-accent">$198.<small>00</small></span></div>
                <div class="star-rating"><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i>
                </div>
              </div>
            </div>
            <div class="card-body card-body-hidden">
              <button class="btn btn-primary btn-sm d-block w-100 mb-2" type="button"><i class="ci-cart fs-sm me-1"></i>Add to Cart</button>
              <div class="text-center"><a class="nav-link-style fs-ms" href="#quick-view-electro" data-bs-toggle="modal"><i class="ci-eye align-middle me-1"></i>Quick view</a></div>
            </div>
          </div>
          <hr class="d-sm-none">
        </div>
        <!-- Product-->
        <div class="col-lg-3 col-md-4 col-sm-6 px-2 mb-4">
          <div class="card product-card"><span class="badge bg-danger badge-shadow">Sale</span>
            <div class="product-card-actions d-flex align-items-center"><a class="btn-action nav-link-style me-2" href="#"><i class="ci-compare me-1"></i>Compare</a>
              <button class="btn-wishlist btn-sm" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="ci-heart"></i></button>
            </div><a class="card-img-top d-block overflow-hidden" href="shop-single-v2.html"><img src="<?php echo e(asset('site/img/shop/catalog/59.jpg')); ?>" alt="Product"></a>
            <div class="card-body py-2"><a class="product-meta d-block fs-xs pb-1" href="#">Computers</a>
              <h3 class="product-title fs-sm"><a href="shop-single-v2.html">AirPort Extreme Base Station</a></h3>
              <div class="d-flex justify-content-between">
                <div class="product-price"><span class="text-accent">$98.<small>50</small></span>
                  <del class="fs-sm text-muted">$149.<small>99</small></del>
                </div>
                <div class="star-rating"><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star"></i>
                </div>
              </div>
            </div>
            <div class="card-body card-body-hidden">
              <button class="btn btn-primary btn-sm d-block w-100 mb-2" type="button"><i class="ci-cart fs-sm me-1"></i>Add to Cart</button>
              <div class="text-center"><a class="nav-link-style fs-ms" href="#quick-view-electro" data-bs-toggle="modal"><i class="ci-eye align-middle me-1"></i>Quick view</a></div>
            </div>
          </div>
          <hr class="d-sm-none">
        </div>
        <!-- Product-->
        <div class="col-lg-3 col-md-4 col-sm-6 px-2 mb-4">
          <div class="card product-card">
            <div class="product-card-actions d-flex align-items-center"><a class="btn-action nav-link-style me-2" href="#"><i class="ci-compare me-1"></i>Compare</a>
              <button class="btn-wishlist btn-sm" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="ci-heart"></i></button>
            </div><a class="card-img-top d-block overflow-hidden" href="shop-single-v2.html"><img src="<?php echo e(asset('site/img/shop/catalog/60.jpg')); ?>" alt="Product"></a>
            <div class="card-body py-2"><a class="product-meta d-block fs-xs pb-1" href="#">TV, Video &amp; Audio</a>
              <h3 class="product-title fs-sm"><a href="shop-single-v2.html">Smart TV LED 49’’ Ultra HD</a></h3>
              <div class="d-flex justify-content-between">
                <div class="product-price"><span class="text-muted fs-sm">Out of stock</span></div>
              </div>
            </div>
            <div class="card-body card-body-hidden"><a class="btn btn-secondary btn-sm d-block w-100 mb-2" href="shop-single-v2.html">View details</a>
              <div class="text-center"><a class="nav-link-style fs-ms" href="#quick-view-electro" data-bs-toggle="modal"><i class="ci-eye align-middle me-1"></i>Quick view</a></div>
            </div>
          </div>
          <hr class="d-sm-none">
        </div>
        <!-- Product-->
        <div class="col-lg-3 col-md-4 col-sm-6 px-2 mb-4">
          <div class="card product-card">
            <div class="product-card-actions d-flex align-items-center"><a class="btn-action nav-link-style me-2" href="#"><i class="ci-compare me-1"></i>Compare</a>
              <button class="btn-wishlist btn-sm" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="ci-heart"></i></button>
            </div><a class="card-img-top d-block overflow-hidden" href="shop-single-v2.html"><img src="<?php echo e(asset('site/img/shop/catalog/61.jpg')); ?>" alt="Product"></a>
            <div class="card-body py-2"><a class="product-meta d-block fs-xs pb-1" href="#">Smart Home</a>
              <h3 class="product-title fs-sm"><a href="shop-single-v2.html">Smart Speaker with Voice Control</a></h3>
              <div class="d-flex justify-content-between">
                <div class="product-price"><span class="text-accent">$49.<small>99</small></span></div>
                <div class="star-rating"><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star"></i>
                </div>
              </div>
            </div>
            <div class="card-body card-body-hidden">
              <button class="btn btn-primary btn-sm d-block w-100 mb-2" type="button"><i class="ci-cart fs-sm me-1"></i>Add to Cart</button>
              <div class="text-center"><a class="nav-link-style fs-ms" href="#quick-view-electro" data-bs-toggle="modal"><i class="ci-eye align-middle me-1"></i>Quick view</a></div>
            </div>
          </div>
          <hr class="d-sm-none">
        </div>
        <!-- Product-->
        <div class="col-lg-3 col-md-4 col-sm-6 px-2 mb-4">
          <div class="card product-card">
            <div class="product-card-actions d-flex align-items-center"><a class="btn-action nav-link-style me-2" href="#"><i class="ci-compare me-1"></i>Compare</a>
              <button class="btn-wishlist btn-sm" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="ci-heart"></i></button>
            </div><a class="card-img-top d-block overflow-hidden" href="shop-single-v2.html"><img src="<?php echo e(asset('site/img/shop/catalog/62.jpg')); ?>" alt="Product"></a>
            <div class="card-body py-2"><a class="product-meta d-block fs-xs pb-1" href="#">Wearable Electronics</a>
              <h3 class="product-title fs-sm"><a href="shop-single-v2.html">Fitness GPS Smart Watch</a></h3>
              <div class="d-flex justify-content-between">
                <div class="product-price"><span class="text-accent">$317.<small>40</small></span></div>
                <div class="star-rating"><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-half active"></i><i class="star-rating-icon ci-star"></i><i class="star-rating-icon ci-star"></i>
                </div>
              </div>
            </div>
            <div class="card-body card-body-hidden">
              <button class="btn btn-primary btn-sm d-block w-100 mb-2" type="button"><i class="ci-cart fs-sm me-1"></i>Add to Cart</button>
              <div class="text-center"><a class="nav-link-style fs-ms" href="#quick-view-electro" data-bs-toggle="modal"><i class="ci-eye align-middle me-1"></i>Quick view</a></div>
            </div>
          </div>
          <hr class="d-sm-none">
        </div>
        <!-- Product-->
        <div class="col-lg-3 col-md-4 col-sm-6 px-2 mb-4">
          <div class="card product-card">
            <div class="product-card-actions d-flex align-items-center"><a class="btn-action nav-link-style me-2" href="#"><i class="ci-compare me-1"></i>Compare</a>
              <button class="btn-wishlist btn-sm" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="ci-heart"></i></button>
            </div><a class="card-img-top d-block overflow-hidden" href="shop-single-v2.html"><img src="<?php echo e(asset('site/img/shop/catalog/63.jpg')); ?>" alt="Product"></a>
            <div class="card-body py-2"><a class="product-meta d-block fs-xs pb-1" href="#">Smartphones</a>
              <h3 class="product-title fs-sm"><a href="shop-single-v2.html">Popular Smartphone 128GB</a></h3>
              <div class="d-flex justify-content-between">
                <div class="product-price"><span class="text-accent">$965.<small>00</small></span></div>
                <div class="star-rating"><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i>
                </div>
              </div>
            </div>
            <div class="card-body card-body-hidden">
              <button class="btn btn-primary btn-sm d-block w-100 mb-2" type="button"><i class="ci-cart fs-sm me-1"></i>Add to Cart</button>
              <div class="text-center"><a class="nav-link-style fs-ms" href="#quick-view-electro" data-bs-toggle="modal"><i class="ci-eye align-middle me-1"></i>Quick view</a></div>
            </div>
          </div>
          <hr class="d-sm-none">
        </div>
        <!-- Product-->
        <div class="col-lg-3 col-md-4 col-sm-6 px-2 mb-4">
          <div class="card product-card"><span class="badge bg-info badge-shadow">New</span>
            <div class="product-card-actions d-flex align-items-center"><a class="btn-action nav-link-style me-2" href="#"><i class="ci-compare me-1"></i>Compare</a>
              <button class="btn-wishlist btn-sm" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="ci-heart"></i></button>
            </div><a class="card-img-top d-block overflow-hidden" href="shop-single-v2.html"><img src="<?php echo e(asset('site/img/shop/catalog/64.jpg')); ?>" alt="Product"></a>
            <div class="card-body py-2"><a class="product-meta d-block fs-xs pb-1" href="#">Wearable Electronics</a>
              <h3 class="product-title fs-sm"><a href="shop-single-v2.html">Smart Watch Series 5, Aluminium</a></h3>
              <div class="d-flex justify-content-between">
                <div class="product-price"><span class="text-accent">$349.<small>99</small></span></div>
                <div class="star-rating"><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-half active"></i><i class="star-rating-icon ci-star"></i>
                </div>
              </div>
            </div>
            <div class="card-body card-body-hidden">
              <button class="btn btn-primary btn-sm d-block w-100 mb-2" type="button"><i class="ci-cart fs-sm me-1"></i>Add to Cart</button>
              <div class="text-center"><a class="nav-link-style fs-ms" href="#quick-view-electro" data-bs-toggle="modal"><i class="ci-eye align-middle me-1"></i>Quick view</a></div>
            </div>
          </div>
          <hr class="d-sm-none">
        </div>
        <!-- Product-->
        <div class="col-lg-3 col-md-4 col-sm-6 px-2">
          <div class="card product-card">
            <div class="product-card-actions d-flex align-items-center"><a class="btn-action nav-link-style me-2" href="#"><i class="ci-compare me-1"></i>Compare</a>
              <button class="btn-wishlist btn-sm" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="ci-heart"></i></button>
            </div><a class="card-img-top d-block overflow-hidden" href="shop-single-v2.html"><img src="<?php echo e(asset('site/img/shop/catalog/65.jpg')); ?>" alt="Product"></a>
            <div class="card-body py-2"><a class="product-meta d-block fs-xs pb-1" href="#">Computers</a>
              <h3 class="product-title fs-sm"><a href="shop-single-v2.html">Convertible 2-in-1 HD Laptop</a></h3>
              <div class="d-flex justify-content-between">
                <div class="product-price"><span class="text-accent">$412.<small>00</small></span></div>
              </div>
            </div>
            <div class="card-body card-body-hidden">
              <button class="btn btn-primary btn-sm d-block w-100 mb-2" type="button"><i class="ci-cart fs-sm me-1"></i>Add to Cart</button>
              <div class="text-center"><a class="nav-link-style fs-ms" href="#quick-view-electro" data-bs-toggle="modal"><i class="ci-eye align-middle me-1"></i>Quick view</a></div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Promo banner-->
    <section class="container mt-4 mb-grid-gutter">
      <div class="bg-faded-info rounded-3 py-4">
        <div class="row align-items-center">
          <div class="col-md-5">
            <div class="px-4 pe-sm-0 ps-sm-5"><span class="badge bg-danger">Limited Offer</span>
              <h3 class="mt-4 mb-1 text-body fw-light">All new</h3>
              <h2 class="mb-1">Last Gen iPad Pro</h2>
              <p class="h5 text-body fw-light">at discounted price. Hurry up!</p>
              <div class="countdown py-2 h4" data-countdown="07/01/2021 07:00:00 PM">
                <div class="countdown-days"><span class="countdown-value"></span><span class="countdown-label text-muted">d</span></div>
                <div class="countdown-hours"><span class="countdown-value"></span><span class="countdown-label text-muted">h</span></div>
                <div class="countdown-minutes"><span class="countdown-value"></span><span class="countdown-label text-muted">m</span></div>
                <div class="countdown-seconds"><span class="countdown-value"></span><span class="countdown-label text-muted">s</span></div>
              </div><a class="btn btn-accent" href="#">View offers<i class="ci-arrow-left fs-ms ms-1"></i></a>
            </div>
          </div>
          <div class="col-md-7"><img src="<?php echo e(asset('site/img/home/banners/offer.jpg')); ?>" alt="iPad Pro Offer"></div>
        </div>
      </div>
    </section>
    <!-- Brands carousel-->
    <section class="container mb-5">
      <div class="tns-carousel border-end">
        <div class="tns-carousel-inner" data-carousel-options="{ &quot;nav&quot;: false, &quot;controls&quot;: false, &quot;autoplay&quot;: true, &quot;autoplayTimeout&quot;: 4000, &quot;loop&quot;: true, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1},&quot;360&quot;:{&quot;items&quot;:2},&quot;600&quot;:{&quot;items&quot;:3},&quot;991&quot;:{&quot;items&quot;:4},&quot;1200&quot;:{&quot;items&quot;:4}} }">
          <div><a class="d-block bg-white border py-4 py-sm-5 px-2" href="#" style="margin-right: -.0625rem;"><img class="d-block mx-auto" src="<?php echo e(asset('site/img/shop/brands/13.png')); ?>" style="width: 165px;" alt="Brand"></a></div>
          <div><a class="d-block bg-white border py-4 py-sm-5 px-2" href="#" style="margin-right: -.0625rem;"><img class="d-block mx-auto" src="<?php echo e(asset('site/img/shop/brands/14.png')); ?>" style="width: 165px;" alt="Brand"></a></div>
          <div><a class="d-block bg-white border py-4 py-sm-5 px-2" href="#" style="margin-right: -.0625rem;"><img class="d-block mx-auto" src="<?php echo e(asset('site/img/shop/brands/17.png')); ?>" style="width: 165px;" alt="Brand"></a></div>
          <div><a class="d-block bg-white border py-4 py-sm-5 px-2" href="#" style="margin-right: -.0625rem;"><img class="d-block mx-auto" src="<?php echo e(asset('site/img/shop/brands/16.png')); ?>" style="width: 165px;" alt="Brand"></a></div>
          <div><a class="d-block bg-white border py-4 py-sm-5 px-2" href="#" style="margin-right: -.0625rem;"><img class="d-block mx-auto" src="<?php echo e(asset('site/img/shop/brands/15.png')); ?>" style="width: 165px;" alt="Brand"></a></div>
          <div><a class="d-block bg-white border py-4 py-sm-5 px-2" href="#" style="margin-right: -.0625rem;"><img class="d-block mx-auto" src="<?php echo e(asset('site/img/shop/brands/18.png')); ?>" style="width: 165px;" alt="Brand"></a></div>
          <div><a class="d-block bg-white border py-4 py-sm-5 px-2" href="#" style="margin-right: -.0625rem;"><img class="d-block mx-auto" src="<?php echo e(asset('site/img/shop/brands/19.png')); ?>" style="width: 165px;" alt="Brand"></a></div>
          <div><a class="d-block bg-white border py-4 py-sm-5 px-2" href="#" style="margin-right: -.0625rem;"><img class="d-block mx-auto" src="<?php echo e(asset('site/img/shop/brands/20.png')); ?>" style="width: 165px;" alt="Brand"></a></div>
        </div>
      </div>
    </section>
    <!-- Product widgets-->
    <section class="container pb-4 pb-md-5">
      <div class="row">
        <!-- Bestsellers-->
        <div class="col-md-4 col-sm-6 mb-2 py-3">
          <div class="widget">
            <h3 class="widget-title">Bestsellers</h3>
            <div class="d-flex align-items-center pb-2 border-bottom"><a class="d-block flex-shrink-0" href="shop-single-v2.html"><img src="<?php echo e(asset('site/img/shop/cart/widget/05.jpg')); ?>" width="64" alt="Product"></a>
              <div class="ps-2">
                <h6 class="widget-product-title"><a href="shop-single-v2.html">Wireless Bluetooth Headphones</a></h6>
                <div class="widget-product-meta"><span class="text-accent">$259.<small>00</small></span></div>
              </div>
            </div>
            <div class="d-flex align-items-center py-2 border-bottom"><a class="d-block flex-shrink-0" href="shop-single-v2.html"><img src="<?php echo e(asset('site/img/shop/cart/widget/06.jpg')); ?>" width="64" alt="Product"></a>
              <div class="ps-2">
                <h6 class="widget-product-title"><a href="shop-single-v2.html">Cloud Security Camera</a></h6>
                <div class="widget-product-meta"><span class="text-accent">$122.<small>00</small></span></div>
              </div>
            </div>
            <div class="d-flex align-items-center py-2 border-bottom"><a class="d-block flex-shrink-0" href="shop-single-v2.html"><img src="<?php echo e(asset('site/img/shop/cart/widget/07.jpg')); ?>" width="64" alt="Product"></a>
              <div class="ps-2">
                <h6 class="widget-product-title"><a href="shop-single-v2.html">Android Smartphone S10</a></h6>
                <div class="widget-product-meta"><span class="text-accent">$799.<small>00</small></span></div>
              </div>
            </div>
            <div class="d-flex align-items-center py-2"><a class="d-block flex-shrink-0" href="shop-single-v2.html"><img src="<?php echo e(asset('site/img/shop/cart/widget/08.jpg')); ?>" width="64" alt="Product"></a>
              <div class="ps-2">
                <h6 class="widget-product-title"><a href="shop-single-v2.html">Android Smart TV Box</a></h6>
                <div class="widget-product-meta"><span class="text-accent">$67.<small>00</small></span>
                  <del class="text-muted fs-xs">$90.<small>43</small></del>
                </div>
              </div>
            </div>
            <p class="mb-0">...</p><a class="fs-sm" href="shop-grid-ls.html">View more<i class="ci-arrow-left fs-xs ms-1"></i></a>
          </div>
        </div>
        <!-- New arrivals-->
        <div class="col-md-4 col-sm-6 mb-2 py-3">
          <div class="widget">
            <h3 class="widget-title">New arrivals</h3>
            <div class="d-flex align-items-center pb-2 border-bottom"><a class="d-block flex-shrink-0" href="shop-single-v2.html"><img src="<?php echo e(asset('site/img/shop/widget/06.jpg')); ?>" width="64" alt="Product"></a>
              <div class="ps-2">
                <h6 class="widget-product-title"><a href="shop-single-v2.html">Monoblock Desktop PC</a></h6>
                <div class="widget-product-meta"><span class="text-accent">$1,949.<small>00</small></span></div>
              </div>
            </div>
            <div class="d-flex align-items-center py-2 border-bottom"><a class="d-block flex-shrink-0" href="shop-single-v2.html"><img src="<?php echo e(asset('site/img/shop/widget/07.jpg')); ?>" width="64" alt="Product"></a>
              <div class="ps-2">
                <h6 class="widget-product-title"><a href="shop-single-v2.html">Laserjet Printer All-in-One</a></h6>
                <div class="widget-product-meta"><span class="text-accent">$428.<small>60</small></span></div>
              </div>
            </div>
            <div class="d-flex align-items-center py-2 border-bottom"><a class="d-block flex-shrink-0" href="shop-single-v2.html"><img src="<?php echo e(asset('site/img/shop/widget/08.jpg')); ?>" width="64" alt="Product"></a>
              <div class="ps-2">
                <h6 class="widget-product-title"><a href="shop-single-v2.html">Console Controller Charger</a></h6>
                <div class="widget-product-meta"><span class="text-accent">$14.<small>97</small></span>
                  <del class="text-muted fs-xs">$16.<small>47</small></del>
                </div>
              </div>
            </div>
            <div class="d-flex align-items-center py-2"><a class="d-block flex-shrink-0" href="shop-single-v2.html"><img src="<?php echo e(asset('site/img/shop/widget/09.jpg')); ?>" width="64" alt="Product"></a>
              <div class="ps-2">
                <h6 class="widget-product-title"><a href="shop-single-v2.html">Smart Watch Series 5, Aluminium</a></h6>
                <div class="widget-product-meta"><span class="text-accent">$349.<small>99</small></span></div>
              </div>
            </div>
            <p class="mb-0">...</p><a class="fs-sm" href="shop-grid-ls.html">View more<i class="ci-arrow-left fs-xs ms-1"></i></a>
          </div>
        </div>
        <!-- Top rated-->
        <div class="col-md-4 col-sm-6 mb-2 py-3">
          <div class="widget">
            <h3 class="widget-title">Top rated</h3>
            <div class="d-flex align-items-center pb-2 border-bottom"><a class="d-block flex-shrink-0" href="shop-single-v2.html"><img src="<?php echo e(asset('site/img/shop/widget/10.jpg')); ?>" width="64" alt="Product"></a>
              <div class="ps-2">
                <h6 class="widget-product-title"><a href="shop-single-v2.html">Android Smartphone S9</a></h6>
                <div class="widget-product-meta"><span class="text-accent">$749.<small>99</small></span>
                  <del class="text-muted fs-xs">$859.<small>99</small></del>
                </div>
              </div>
            </div>
            <div class="d-flex align-items-center py-2 border-bottom"><a class="d-block flex-shrink-0" href="shop-single-v2.html"><img src="<?php echo e(asset('site/img/shop/widget/11.jpg')); ?>" width="64" alt="Product"></a>
              <div class="ps-2">
                <h6 class="widget-product-title"><a href="shop-single-v2.html">Wireless Bluetooth Headphones</a></h6>
                <div class="widget-product-meta"><span class="text-accent">$428.<small>60</small></span></div>
              </div>
            </div>
            <div class="d-flex align-items-center py-2 border-bottom"><a class="d-block flex-shrink-0" href="shop-single-v2.html"><img src="<?php echo e(asset('site/img/shop/widget/12.jpg')); ?>" width="64" alt="Product"></a>
              <div class="ps-2">
                <h6 class="widget-product-title"><a href="shop-single-v2.html">360 Degrees Camera</a></h6>
                <div class="widget-product-meta"><span class="text-accent">$98.<small>75</small></span></div>
              </div>
            </div>
            <div class="d-flex align-items-center py-2"><a class="d-block flex-shrink-0" href="shop-single-v2.html"><img src="<?php echo e(asset('site/img/shop/widget/13.jpg')); ?>" width="64" alt="Product"></a>
              <div class="ps-2">
                <h6 class="widget-product-title"><a href="shop-single-v2.html">Digital Camera 40MP</a></h6>
                <div class="widget-product-meta"><span class="text-accent">$210.<small>00</small></span>
                  <del class="text-muted fs-xs">$249.<small>00</small></del>
                </div>
              </div>
            </div>
            <p class="mb-0">...</p><a class="fs-sm" href="shop-grid-ls.html">View more<i class="ci-arrow-left fs-xs ms-1"></i></a>
          </div>
        </div>
      </div>
    </section>
    <!-- Blog + Instagram info cards-->
    <section class="container-fluid px-0">
      <div class="row g-0">
        <div class="col-md-6"><a class="card border-0 rounded-0 text-decoration-none py-md-4 bg-faded-primary" href="blog-list-sidebar.html">
            <div class="card-body text-center"><i class="ci-edit h3 mt-2 mb-4 text-primary"></i>
              <h3 class="h5 mb-1">Read the blog</h3>
              <p class="text-muted fs-sm">Latest store, fashion news and trends</p>
            </div></a></div>
        <div class="col-md-6"><a class="card border-0 rounded-0 text-decoration-none py-md-4 bg-faded-accent" href="#">
            <div class="card-body text-center"><i class="ci-instagram h3 mt-2 mb-4 text-accent"></i>
              <h3 class="h5 mb-1">Follow on Instagram</h3>
              <p class="text-muted fs-sm">#ShopWithCartzilla</p>
            </div></a></div>
      </div>
    </section>
    
  <?php echo $__env->make('vendors.store.layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\dronz\resources\views/vendors/store/index.blade.php ENDPATH**/ ?>