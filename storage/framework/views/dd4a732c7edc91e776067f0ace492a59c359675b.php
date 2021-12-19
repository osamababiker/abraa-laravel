<?php echo $__env->make('site.layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


  <!-- Body-->
  <body class="handheld-toolbar-enabled">
    <!-- Remove "navbar-sticky" class to make navigation bar scrollable with the page.-->
     <?php echo $__env->make('site.layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

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
            <div class="pt-2 px-4 ps-lg-0 pe-xl-5">
              <!-- Title-->
              <div class="d-sm-flex flex-wrap justify-content-between align-items-center border-bottom">
                <h2 class="h3 py-2 me-2 text-center text-sm-start"> منتجاتك <span class="badge bg-faded-accent fs-sm text-body align-middle me-2">5</span></h2>
              </div>

              <!-- Product-->
              <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
              <div class="d-block d-sm-flex align-items-center pt-4 pb-2">
                <?php $product_image = json_decode($product->product_images); ?>
                  <?php for($i =0; $i < count($product_image); $i++): ?>
                    <a class="d-block mb-3 mb-sm-0 me-sm-4 ms-sm-0 mx-auto" href="#" style="width: 12.5rem;">
                        <img class="rounded-3" src="<?php echo e(asset('upload/products/'.$product_image[$i])); ?>" alt="Product">
                    </a>
                    <?php break; ?>
                    <?php endfor; ?>
                <div class="text-center text-sm-start me-3">
                  <h3 class="h6 product-title mb-2"><a href="marketplace-single.html"> <?php echo e($product->product_name); ?> </a></h3>
                  <div class="d-inline-block text-accent"> <?php echo e($product->selling_price); ?> <small>$</small></div>
                  <div class="d-inline-block text-muted fs-ms border-start ms-2 ps-2">Sales: <span class="fw-medium">21</span></div>
                  <div class="d-flex justify-content-center justify-content-sm-start pt-3">
                    <a href="#edit_product_<?php echo e($product->id); ?>" data-bs-toggle="modal"  class="btn bg-faded-info btn-icon me-2" type="button"><i class="ci-edit text-info"></i></a>
                    <a href="#delete_product_<?php echo e($product->id); ?>" data-bs-toggle="modal"  class="btn bg-faded-danger btn-icon me-2" type="button"><i class="ci-trash text-danger"></i></a>
                  </div>
                </div>
              </div>
              <!-- include product components -->
              <?php echo $__env->make('vendors.components.editProduct', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
              <?php echo $__env->make('vendors.components.deleteProduct', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
          </section>
        </div>
      </div>
    </div> 
    <!-- Footer-->
    <?php echo $__env->make('site.layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\wamp64\www\dronz\resources\views/vendors/products.blade.php ENDPATH**/ ?>