<?php echo $__env->make('site.layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


  <!-- Body-->
  <body class="handheld-toolbar-enabled">

    <!-- Remove "navbar-sticky" class to make navigation bar scrollable with the page.-->
    <?php echo $__env->make('site.layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Dashboard header-->
    <div class="page-title-overlap bg-accent pt-4" style="margin-top: 120px">
      <div class="container d-flex flex-wrap flex-sm-nowrap justify-content-center justify-content-sm-between align-items-center pt-2">
        <div class="d-flex align-items-center pb-3">
          <div class="img-thumbnail rounded-circle position-relative flex-shrink-0" style="width: 6.375rem;"><img class="rounded-circle" src="<?php echo e(asset('site/img/marketplace/account/avatar.png')); ?>" alt="Createx Studio"></div>
          <div class="ps-3"></div>
            <h3 class="text-light fs-lg mb-0"> <?php echo e(Auth::user()->name); ?> </h3> &nbsp;&nbsp;
            <span class="d-block text-light fs-ms opacity-60 py-1"> تم التسجيل قبل  <?php echo e(Auth::user()->created_at->diffForHumans()); ?> </span>
          </div>
        </div>
      </div>
    </div>


    <div class="container mb-5 pb-3">
      <div class="bg-light shadow-lg rounded-3 overflow-hidden">
        <div class="row">
          <!-- Sidebar-->
          <?php echo $__env->make('vendors.layouts.aside', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          <!-- Content-->
          <section class="col-lg-8 pt-lg-4 pb-4 mb-3">
            <div class="pt-2 px-4 ps-lg-0 pe-xl-5 ml-5">
              <!-- Title-->
              <div class="d-sm-flex flex-wrap justify-content-between align-items-center pb-2">
                <h2 class="h3 py-2 me-2 text-center text-sm-start"> اضافة منتج جديد </h2>
              </div>
              <form method="post" action="<?php echo e(route('vendors.create_product')); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="mb-3 col-sm-6 pb-2">
                    <label class="form-label" for="product_name"> اسم المنتج  </label>
                    <input class="form-control"  name="product_name" type="text" id="product_name">
                    <div class="form-text"> اقصى حد مسموح به هو 100 حرف </div>
                    </div>
                    <div class="mb-3 col-sm-6 pb-2">
                    <label class="form-label" for="product_type"> نوع المنتج  </label>
                    <select name="product_type" id="product_type" class="form-select">
                        <option value=""> قم باختيار نوع المنتج </option>
                        <option value="1"> عطور </option>
                    </select>
                    </div>
                </div>
                <div class="file-drop-area mb-3">
                  <div class="file-drop-icon"></div><span class="file-drop-message"> اسحب وافلت صور المنتج هنا </span>
                  <input name="product_images[]" multiple class="file-drop-input" type="file">
                  <button class="file-drop-btn btn btn-primary btn-sm mb-2" type="button"> او قم باختيار ملف  </button>
                  <div class="form-text">1000 x 800px انسب عرض</div>
                </div>
                <div class="mb-3 py-2">
                  <label class="form-label" for="product_description"> وصف المنتج  </label>
                  <textarea class="form-control" name="product_description" rows="6" id="product_description"></textarea>
                </div>
                <div class="row">
                  <div class="col-sm-6 mb-3">
                    <label class="form-label" for="selling_price"> سعر البيع للمنتج </label>
                    <div class="input-group">
                      <input class="form-control" name="selling_price" type="number" id="selling_price">
                    </div>
                    <div class="form-text"> قم بادخال سعر البيع للمنتح </div>
                  </div>
                  <div class="col-sm-6 mb-3">
                    <label class="form-label" for="price"> سعر العرض </label>
                    <div class="input-group">
                      <input class="form-control" type="number" name="price" id="price">
                    </div>
                    <div class="form-text"> قم بادخال سعر العرض هنا </div>
                  </div>
                </div>
                <div class="mb-3 py-2">
                  <label class="form-label" for="product_tags"> الكلمات المفتاحية  </label>
                  <select name="product_tags[]" class="form-control select2" multiple="multiple" id="product_tags">
                      <option value=""> اكتب الكلمة هنا </option>
                      <option value=""></option>
                  </select>
                  <div class="form-text"> قم بادخال 10 كلمات مفتاحية لوصف المنتج </div>
                </div>
                <button class="btn btn-primary d-block w-100" type="submit"><i class="ci-cloud-upload fs-lg me-2"></i> اضافة المنتج </button>
              </form>
            </div>
          </section>
        </div>
      </div>
    </div>
    <!-- Footer-->
    <?php echo $__env->make('site.layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- Toolbar for handheld devices (Marketplace)-->
    <div class="handheld-toolbar">
      <div class="d-table table-layout-fixed w-100"><a class="d-table-cell handheld-toolbar-item" href="dashboard-favorites.html"><span class="handheld-toolbar-icon"><i class="ci-heart"></i></span><span class="handheld-toolbar-label">Favorites</span></a><a class="d-table-cell handheld-toolbar-item" href="javascript:void(0)" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" onclick="window.scrollTo(0, 0)"><span class="handheld-toolbar-icon"><i class="ci-menu"></i></span><span class="handheld-toolbar-label">Menu</span></a><a class="d-table-cell handheld-toolbar-item" href="marketplace-cart.html"><span class="handheld-toolbar-icon"><i class="ci-cart"></i><span class="badge bg-primary rounded-pill ms-1">3</span></span><span class="handheld-toolbar-label">$56.00</span></a></div>
    </div>
    <!-- Back To Top Button--><a class="btn-scroll-top" href="#top" data-scroll><span class="btn-scroll-top-tooltip text-muted fs-sm me-2">Top</span><i class="btn-scroll-top-icon ci-arrow-up">   </i></a>
    <!-- Vendor scrits: js libraries and plugins-->
    <script src="vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/simplebar/dist/simplebar.min.js"></script>
    <script src="vendor/tiny-slider/dist/min/tiny-slider.js"></script>
    <script src="vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>
    <!-- Main theme script-->
    <script src="js/theme.min.js"></script>
  </body>
</html>
<?php /**PATH C:\wamp64\www\dronz\resources\views/vendors/create_product.blade.php ENDPATH**/ ?>