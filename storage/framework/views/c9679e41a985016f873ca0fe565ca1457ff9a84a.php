<?php echo $__env->make('site.layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Body-->
<body class="bg-secondary">
  <!-- Sign in / sign up modal-->

  <?php echo $__env->make('site.layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <?php echo $__env->make('site.layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <!-- Sidebar menu-->
  <?php echo $__env->make('site.layouts.aside', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <!-- Page-->
  <main class="offcanvas-enabled" style="padding-top: 5rem;">
    <section class="ps-lg-4 pe-lg-3 pt-4">
      <div class="px-3 pt-2">
        <!-- Page title + breadcrumb-->
        <!-- Content-->
        <!-- Slider-->
        <section class="tns-carousel mb-3 mb-md-5">
          <div class="tns-carousel-inner"
            data-carousel-options="{&quot;items&quot;: 1, &quot;mode&quot;: &quot;gallery&quot;, &quot;nav&quot;: false, &quot;responsive&quot;: {&quot;0&quot;: {&quot;nav&quot;: true, &quot;controls&quot;: false}, &quot;576&quot;: {&quot;nav&quot;: false, &quot;controls&quot;: true}}}">
            <!-- Slide 1-->
            <div>
              <div class="rounded-3 px-md-5 text-center text-xl-start" style="background-color: #1a6fb0;">
                <div class="d-xl-flex justify-content-between align-items-center px-4 px-sm-5 mx-auto"
                  style="max-width: 1226px;">
                  <div class="py-5 me-xl-4 mx-auto mx-xl-0" style="max-width: 490px;">
                    <h2 class="h1 text-light">شريكك في تجارتك الإلكترونية </h2>
                    <p class="text-light pb-4">هدفنا نمو تجارتك الإلكترونية ومساندتك في رحلتك للتوسع والنجاح</p>
                    <div class="d-flex flex-wrap justify-content-center justify-content-xl-start">
                      <a  href="#signin-modal" data-bs-toggle="modal" class="btn btn-dark"> أبدأ تجربتك المجانية الان </a>
                    </div>
                  </div>
                  <div><img src="<?php echo e(asset('site/img/grocery/slider/slide02.jpg')); ?>" alt="Image"></div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- How it works-->
        <section class="pt-4 mb-4 mb-md-5">
          <h2 class="h3 text-center mb-grid-gutter pt-2"> ثلاث خطوات لتبدأ تجارتك الالكترونية </h2>
          <div class="row g-0 bg-light rounded-3">
            <div class="col-xl-4 col-lg-12 col-md-4 border-end">
              <div class="py-3">
                <div class="d-flex align-items-center mx-auto py-3 px-3" style="max-width: 362px;">
                  <div class="display-3 fw-normal opacity-15 me-4">01</div>
                  <div class="ps-2"><img class="d-block my-2" src="<?php echo e(asset('site/img/grocery/steps/01.png')); ?>" width="72"
                      alt="Order online">
                    <p class="mb-3 pt-1"> أبني متجرك الالكتروني </p>
                  </div>
                </div>
                <hr class="d-md-none d-lg-block d-xl-none">
              </div>
            </div>
            <div class="col-xl-4 col-lg-12 col-md-4 border-end">
              <div class="py-3">
                <div class="d-flex align-items-center mx-auto py-3 px-3" style="max-width: 362px;">
                  <div class="display-3 fw-normal opacity-15 me-4">02</div>
                  <div class="ps-2"><img class="d-block my-2" src="<?php echo e(asset('site/img/grocery/steps/02.png')); ?>" width="72"
                      alt="Grocery collected">
                    <p class="mb-3 pt-1"> أحصل على عملاء جدد كل يوم </p>
                  </div>
                </div>
                <hr class="d-md-none d-lg-block d-xl-none">
              </div>
            </div>
            <div class="col-xl-4 col-lg-12 col-md-4">
              <div class="py-3">
                <div class="d-flex align-items-center mx-auto py-3 px-3" style="max-width: 362px;">
                  <div class="display-3 fw-normal opacity-15 me-4">03</div>
                  <div class="ps-2"><img class="d-block my-2" src="<?php echo e(asset('site/img/grocery/steps/03.png')); ?>" width="72" alt="Delivery">
                    <p class="mb-3 pt-1"> وفر خدمات التوصيل من الباب للباب </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>


        <!-- Categories (cuisine) grid-->
        <section class="container py-4 my-lg-3 py-sm-5" id="cuisine">
          <h2 class="text-center pt-4 pt-sm-3"> انواع المتاجر التي ندعم </h2>
          <div class="row">
            <div class="col-md-4 col-sm-6 mb-grid-gutter"><a class="card border-0 shadow"
                href="food-delivery-category.html"><img class="card-img-top" src="<?php echo e(asset('site/img/food-delivery/category/01.jpg')); ?>"
                  alt="Burgers &amp; Fries">
                <div class="card-body py-4 text-center">
                  <h3 class="h5 mt-1"> متاجر الالكسسوارات</h3>
                </div>
              </a></div>
            <div class="col-md-4 col-sm-6 mb-grid-gutter"><a class="card border-0 shadow"
                href="food-delivery-category.html"><img class="card-img-top" src="<?php echo e(asset('site/img/food-delivery/category/02.jpg')); ?>"
                  alt="Noodles">
                <div class="card-body py-4 text-center">
                  <h3 class="h5 mt-1"> متاجر العطور </h3>
                </div>
              </a></div>
            <div class="col-md-4 col-sm-6 mb-grid-gutter"><a class="card border-0 shadow"
                href="food-delivery-category.html"><img class="card-img-top" src="<?php echo e(asset('site/img/food-delivery/category/03.jpg')); ?>"
                  alt="Sushi &amp; Rolls">
                <div class="card-body py-4 text-center">
                  <h3 class="h5 mt-1"> متاجر الملبوسات </h3>
                </div>
              </a></div>
          </div>
        </section>
        <!-- Mobile app CTA-->
        <section class="bg-primary bg-size-cover bg-position-center pt-5"
          style="background-image: url('site/img/food-delivery/mobile-app-bg.jpg');">
          <div class="container pt-2 pt-sm-0">
            <div class="row align-items-center">
              <div class="col-xl-4 col-lg-5 col-sm-6 offset-xl-2 offset-lg-1 mt-md-n5 text-center text-sm-start">
                <h2 class="text-light mb-3"> امتلك تطبيقا للهواتف لمتجرك </h2>
                <p class="text-light opacity-70 mb-0 d-block d-sm-none d-md-block">
                  قم بتسهيل تصفح وطلب المنتجات على عملائك بتامتلاك تطبيق يمكنهم من الطلب بسهولة ويسر
                </p>
                <div class="mt-4 pt-2"><a class="btn-market btn-apple me-3 mb-2" href="#" role="button"><span
                      class="btn-market-subtitle"> تطبيق على </span><span class="btn-market-title"> متجر ابل </span></a>
                      <a class="btn-market btn-google mb-2" href="#" role="button"><span
                      class="btn-market-subtitle"> تطبيق على  </span><span class="btn-market-title"> قوقل بلي </span></a></div>
              </div>
              <div class="col-lg-5 col-sm-6 offset-lg-1 pt-5 pt-sm-3"><img class="d-block mx-auto mx-sm-0"
                  src="<?php echo e(asset('site/img/food-delivery/phone.png')); ?>" width="331" alt="Mobile App Screen"></div>
            </div>
          </div>
        </section>
        <!-- Become Courier / Partner CTA-->
        <section class="container pb-4 pt-lg-5 pb-sm-5">
          <div class="row pt-4 mt-2 mt-lg-3 mb-md-2">
            <div class="col-lg-6 mb-grid-gutter">
              <div class="d-block d-sm-flex justify-content-between align-items-center bg-faded-info rounded-3">
                <div class="pt-5 py-sm-5 px-4 ps-md-5 pe-md-0 text-center text-sm-start">
                  <h2> انضم لفريق التوصيل </h2>
                  <p class="text-muted pb-2">Earn competitive salary as delivery courier working flexible schedule.</p>
                  <a class="btn btn-primary" href="#"> ابدأ العمل </a>
                </div><img class="d-block mx-auto mx-sm-0" src="<?php echo e(asset('site/img/food-delivery/courier.png')); ?>" width="272"
                  alt="Become a Courier">
              </div>
            </div>
            <div class="col-lg-6 mb-grid-gutter">
              <div class="d-block d-sm-flex justify-content-between align-items-center bg-faded-warning rounded-3">
                <div class="pt-5 py-sm-5 px-4 ps-md-5 pe-md-0 text-center text-sm-start">
                  <h2> كن احد شركائنا </h2>
                  <p class="text-muted pb-2">Grow your business by reaching new customers.</p><a class="btn btn-primary"
                    href="#"> انضم لنا </a>
                </div><img class="d-block mx-auto mx-sm-0" src="<?php echo e(asset('site/img/food-delivery/chef.png')); ?>" width="269"
                  alt="Become a Partner">
              </div>
            </div>
          </div>
        </section>
        <!-- Popular restaurants logo grid-->
        <section class="container pb-4 pt-2 pt-sm-0 pt-md-2 pb-sm-5">
          <h2 class="text-center"> بعض المتاجر لدينا </h2>
          <p class="text-muted pb-4 text-center"> قائمة بالمتاجر التي تم بناءها عبر درونز </p>
          <div class="row pb-2 pb-sm-0 pb-md-3">
            <div class="col-md-3 col-sm-4 col-6"><a
                class="d-block bg-white shadow-sm rounded-3 py-3 py-sm-4 mb-grid-gutter"
                href="food-delivery-single.html"><img class="d-block mx-auto"
                  src="<?php echo e(asset('site/img/food-delivery/restaurants/logos/01.png')); ?>" style="width: 150px;" alt="Brand"></a></div>
            <div class="col-md-3 col-sm-4 col-6"><a
                class="d-block bg-white shadow-sm rounded-3 py-3 py-sm-4 mb-grid-gutter"
                href="food-delivery-single.html"><img class="d-block mx-auto"
                  src="<?php echo e(asset('site/img/food-delivery/restaurants/logos/02.png')); ?>" style="width: 150px;" alt="Brand"></a></div>
            <div class="col-md-3 col-sm-4 col-6"><a
                class="d-block bg-white shadow-sm rounded-3 py-3 py-sm-4 mb-grid-gutter"
                href="food-delivery-single.html"><img class="d-block mx-auto"
                  src="<?php echo e(asset('site/img/food-delivery/restaurants/logos/03.png')); ?>" style="width: 150px;" alt="Brand"></a></div>
            <div class="col-md-3 col-sm-4 col-6"><a
                class="d-block bg-white shadow-sm rounded-3 py-3 py-sm-4 mb-grid-gutter"
                href="food-delivery-single.html"><img class="d-block mx-auto"
                  src="<?php echo e(asset('site/img/food-delivery/restaurants/logos/04.png')); ?>" style="width: 150px;" alt="Brand"></a></div>
            <div class="col-md-3 col-sm-4 col-6"><a
                class="d-block bg-white shadow-sm rounded-3 py-3 py-sm-4 mb-grid-gutter"
                href="food-delivery-single.html"><img class="d-block mx-auto"
                  src="<?php echo e(asset('site/img/food-delivery/restaurants/logos/05.png')); ?>" style="width: 150px;" alt="Brand"></a></div>
            <div class="col-md-3 col-sm-4 col-6"><a
                class="d-block bg-white shadow-sm rounded-3 py-3 py-sm-4 mb-grid-gutter"
                href="food-delivery-single.html"><img class="d-block mx-auto"
                  src="<?php echo e(asset('site/img/food-delivery/restaurants/logos/06.png')); ?>" style="width: 150px;" alt="Brand"></a></div>
            <div class="col-md-3 col-sm-4 col-6"><a
                class="d-block bg-white shadow-sm rounded-3 py-3 py-sm-4 mb-grid-gutter"
                href="food-delivery-single.html"><img class="d-block mx-auto"
                  src="<?php echo e(asset('site/img/food-delivery/restaurants/logos/07.png')); ?>" style="width: 150px;" alt="Brand"></a></div>
            <div class="col-md-3 col-sm-4 col-6"><a
                class="d-block bg-white shadow-sm rounded-3 py-3 py-sm-4 mb-grid-gutter"
                href="food-delivery-single.html"><img class="d-block mx-auto"
                  src="<?php echo e(asset('site/img/food-delivery/restaurants/logos/08.png')); ?>" style="width: 150px;" alt="Brand"></a></div>
            <div class="col-md-3 col-sm-4 col-6"><a
                class="d-block bg-white shadow-sm rounded-3 py-3 py-sm-4 mb-grid-gutter"
                href="food-delivery-single.html"><img class="d-block mx-auto"
                  src="<?php echo e(asset('site/img/food-delivery/restaurants/logos/08.png')); ?>" style="width: 150px;" alt="Brand"></a></div>
            <div class="col-md-3 col-sm-4 col-6"><a
                class="d-block bg-white shadow-sm rounded-3 py-3 py-sm-4 mb-grid-gutter"
                href="food-delivery-single.html"><img class="d-block mx-auto"
                  src="<?php echo e(asset('site/img/food-delivery/restaurants/logos/09.png')); ?>" style="width: 150px;" alt="Brand"></a></div>
            <div class="col-md-3 col-sm-4 col-6"><a
                class="d-block bg-white shadow-sm rounded-3 py-3 py-sm-4 mb-grid-gutter"
                href="food-delivery-single.html"><img class="d-block mx-auto"
                  src="<?php echo e(asset('site/img/food-delivery/restaurants/logos/10.png')); ?>" style="width: 150px;" alt="Brand"></a></div>
            <div class="col-md-3 col-sm-4 col-6"><a
                class="d-block bg-white shadow-sm rounded-3 py-3 py-sm-4 mb-grid-gutter"
                href="food-delivery-single.html"><img class="d-block mx-auto"
                  src="<?php echo e(asset('site/img/food-delivery/restaurants/logos/11.png')); ?>" style="width: 150px;" alt="Brand"></a></div>
          </div>
        </section>
        <!-- Reviews-->
        <section class="bg-secondary py-5" dir="ltr">
          <div class="container py-md-4 pt-3 pb-0 py-sm-3">
            <h2 class="text-center mb-4 mb-md-5">  قصص نجاح </h2>
            <div class="tns-carousel mb-3">
              <div class="tns-carousel-inner"
                data-carousel-options="{&quot;items&quot;: 2, &quot;controls&quot;: false, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1, &quot;gutter&quot;:20}, &quot;576&quot;:{&quot;items&quot;:2, &quot;gutter&quot;:20},&quot;850&quot;:{&quot;items&quot;:3, &quot;gutter&quot;:20},&quot;1080&quot;:{&quot;items&quot;:4, &quot;gutter&quot;:25}}}">
                <blockquote class="mb-2">
                  <div class="card card-body fs-md text-muted border-0 shadow-sm">
                    <div class="mb-2">
                      <div class="star-rating"><i class="star-rating-icon ci-star-filled active"></i><i
                          class="star-rating-icon ci-star-filled active"></i><i
                          class="star-rating-icon ci-star-filled active"></i><i
                          class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star"></i>
                      </div>
                    </div>Lorem ipsum dolor sit amet, quia non consectetur adipiscing elit, sed do eiusmod tempor
                    incididunt ut labore et dolore magna aliqua.
                  </div>
                  <footer class="d-flex justify-content-center align-items-center pt-4"><img class="rounded-circle"
                      src="<?php echo e(asset('site/img/testimonials/03.jpg')); ?>" width="50" alt="Richard Davis">
                    <div class="ps-3">
                      <h6 class="fs-sm mb-n1">Richard Davis</h6><span class="fs-ms text-muted opacity-75">Feb 14,
                        2020</span>
                    </div>
                  </footer>
                </blockquote>
                <blockquote class="mb-2">
                  <div class="card card-body fs-md text-muted border-0 shadow-sm">
                    <div class="mb-2">
                      <div class="star-rating"><i class="star-rating-icon ci-star-filled active"></i><i
                          class="star-rating-icon ci-star-filled active"></i><i
                          class="star-rating-icon ci-star-filled active"></i><i
                          class="star-rating-icon ci-star-filled active"></i><i
                          class="star-rating-icon ci-star-filled active"></i>
                      </div>
                    </div>Lorem ipsum dolor sit amet, quia non consectetur adipiscing elit, sed do eiusmod tempor
                    incididunt ut labore et dolore magna aliqua.
                  </div>
                  <footer class="d-flex justify-content-center align-items-center pt-4"><img class="rounded-circle"
                      src="<?php echo e(asset('site/img/testimonials/04.jpg')); ?>" width="50" alt="Laura Willson">
                    <div class="ps-3">
                      <h6 class="fs-sm mb-n1">Laura Willson</h6><span class="fs-ms text-muted opacity-75">Feb 05,
                        2020</span>
                    </div>
                  </footer>
                </blockquote>
                <blockquote class="mb-2">
                  <div class="card card-body fs-md text-muted border-0 shadow-sm">
                    <div class="mb-2">
                      <div class="star-rating"><i class="star-rating-icon ci-star-filled active"></i><i
                          class="star-rating-icon ci-star-filled active"></i><i
                          class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star"></i><i
                          class="star-rating-icon ci-star"></i>
                      </div>
                    </div>Lorem ipsum dolor sit amet, quia non consectetur adipiscing elit, sed do eiusmod tempor
                    incididunt ut labore et dolore magna aliqua.
                  </div>
                  <footer class="d-flex justify-content-center align-items-center pt-4"><img class="rounded-circle"
                      src="<?php echo e(asset('site/img/testimonials/01.jpg')); ?>" width="50" alt="Mary Grant">
                    <div class="ps-3">
                      <h6 class="fs-sm mb-n1">Mary Alice Grant</h6><span class="fs-ms text-muted opacity-75">Jan 27,
                        2020</span>
                    </div>
                  </footer>
                </blockquote>
                <blockquote class="mb-2">
                  <div class="card card-body fs-md text-muted border-0 shadow-sm">
                    <div class="mb-2">
                      <div class="star-rating"><i class="star-rating-icon ci-star-filled active"></i><i
                          class="star-rating-icon ci-star-filled active"></i><i
                          class="star-rating-icon ci-star-filled active"></i><i
                          class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star"></i>
                      </div>
                    </div>Lorem ipsum dolor sit amet, quia non consectetur adipiscing elit, sed do eiusmod tempor
                    incididunt ut labore et dolore magna aliqua.
                  </div>
                  <footer class="d-flex justify-content-center align-items-center pt-4"><img class="rounded-circle"
                      src="<?php echo e(asset('site/img/testimonials/02.jpg')); ?>" width="50" alt="Rafael Marquez">
                    <div class="ps-3">
                      <h6 class="fs-sm mb-n1">Rafael Marquez</h6><span class="fs-ms text-muted opacity-75">Dec 19,
                        2020</span>
                    </div>
                  </footer>
                </blockquote>
                <blockquote class="mb-2">
                  <div class="card card-body fs-md text-muted border-0 shadow-sm">
                    <div class="mb-2">
                      <div class="star-rating"><i class="star-rating-icon ci-star-filled active"></i><i
                          class="star-rating-icon ci-star-filled active"></i><i
                          class="star-rating-icon ci-star-filled active"></i><i
                          class="star-rating-icon ci-star-filled active"></i><i
                          class="star-rating-icon ci-star-filled active"></i>
                      </div>
                    </div>Lorem ipsum dolor sit amet, quia non consectetur adipiscing elit, sed do eiusmod tempor
                    incididunt ut labore et dolore magna aliqua.
                  </div>
                  <footer class="d-flex justify-content-center align-items-center pt-4"><img class="rounded-circle"
                      src="<?php echo e(asset('site/img/testimonials/03.jpg')); ?>" width="50" alt="Adrian Lewis">
                    <div class="ps-3">
                      <h6 class="fs-sm mb-n1">Adrian Lewis</h6><span class="fs-ms text-muted opacity-75">Dec 13,
                        2020</span>
                    </div>
                  </footer>
                </blockquote>
                <blockquote class="mb-2">
                  <div class="card card-body fs-md text-muted border-0 shadow-sm">
                    <div class="mb-2">
                      <div class="star-rating"><i class="star-rating-icon ci-star-filled active"></i><i
                          class="star-rating-icon ci-star-filled active"></i><i
                          class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star"></i><i
                          class="star-rating-icon ci-star"></i>
                      </div>
                    </div>Lorem ipsum dolor sit amet, quia non consectetur adipiscing elit, sed do eiusmod tempor
                    incididunt ut labore et dolore magna aliqua.
                  </div>
                  <footer class="d-flex justify-content-center align-items-center pt-4"><img class="rounded-circle"
                      src="<?php echo e(asset('site/img/testimonials/01.jpg')); ?>" width="50" alt="Daniel Adams">
                    <div class="ps-3">
                      <h6 class="fs-sm mb-n1">Daniel Adams</h6><span class="fs-ms text-muted opacity-75">Dec 04,
                        2020</span>
                    </div>
                  </footer>
                </blockquote>
              </div>
            </div>
          </div>
        </section>
        <div class="pb-3"></div>
      </div>
    </section>
    <!-- Footer-->
    <!-- Footer-->
    <?php echo $__env->make('site.layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\wamp64\www\dronz\resources\views/site/index.blade.php ENDPATH**/ ?>