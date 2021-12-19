<?php echo $__env->make('site.layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


  <!-- Body-->
  <body class="handheld-toolbar-enabled">

    <!-- Add Payment Method-->
    <form class="needs-validation modal fade" method="post" id="add-payment" tabindex="-1" novalidate>
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title"> اضافة وسيلة دفع الكتروني </h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="form-check mb-4">
              <input class="form-check-input" type="radio" id="paypal" name="payment-method">
              <label class="form-check-label" for="paypal">PayPal<img class="d-inline-block align-middle ms-2" src="img/card-paypal.png" width="39" alt="PayPal"></label>
            </div>
            <div class="form-check mb-4">
              <input class="form-check-input" type="radio" id="card" name="payment-method" checked>
              <label class="form-check-label" for="card">Credit / Debit card<img class="d-inline-block align-middle ms-2" src="img/cards.png" width="187" alt="Credit card"></label>
            </div>
            <div class="row g-3 mb-2">
              <div class="col-sm-6">
                <input class="form-control" type="text" name="number" placeholder="Card Number" required>
                <div class="invalid-feedback">Please fill in the card number!</div>
              </div>
              <div class="col-sm-6">
                <input class="form-control" type="text" name="name" placeholder="Full Name" required>
                <div class="invalid-feedback">Please provide name on the card!</div>
              </div>
              <div class="col-sm-3">
                <input class="form-control" type="text" name="expiry" placeholder="MM/YY" required>
                <div class="invalid-feedback">Please provide card expiration date!</div>
              </div>
              <div class="col-sm-3">
                <input class="form-control" type="text" name="cvc" placeholder="CVC" required>
                <div class="invalid-feedback">Please provide card CVC code!</div>
              </div>
              <div class="col-sm-6">
                <button class="btn btn-primary d-block w-100" type="submit">Register this card</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
    <!-- Navbar Marketplace-->
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
        <?php if(session()->has('registerCompleted')): ?>
            <div class="alert alert-success alert-dismissible" id="successAlert" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <div class="alert-message">
                    <strong> اهلا <?php echo e(Auth::user()->name); ?> </strong> <?php echo e(session()->get('registerCompleted')); ?>

                </div>
            </div>
        <?php endif; ?>
      <div class="bg-light shadow-lg rounded-3 overflow-hidden">
        <div class="row">
          <!-- Content-->
          <section class="col-lg-12 pt-lg-4 pb-4 mb-3">
            <div class="pt-2 px-4 ps-lg-0 pe-xl-5">
              <h2 class="h3 py-2 text-center text-sm-start">معلومات المتجر</h2>
              <div class="ml-5">
                <div class="bg-secondary rounded-3 p-5">
                    <form action="<?php echo e(route('vendors.store')); ?>" method="post" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row gx-4 gy-3">
                        <div class="col-sm-6">
                        <label class="form-label" for="store_name"> اسم المتجر </label>
                        <input class="form-control" name="store_name"  type="text" id="store_name" placeholder="ادخل اسم المتجر هنا">
                        </div>
                        <div class="col-sm-6">
                        <label class="form-label" for="store_avatar"> شعار المتجر </label>
                        <input class="form-control" name="store_avatar" type="file" id="store_avatar" >
                        </div>
                        <div class="col-sm-12">
                        <label class="form-label" for="store_type">نوع المتجر</label>
                        <select class="form-select" name="store_type" id="store_type">
                            <option value> اختر نوع المتجر </option>
                            <option value="1">متجر عطور</option>
                            <option value="2">متجر ملبوسات</option>
                        </select>
                        </div>
                        <div class="col-sm-6">
                        <label class="form-label" for="store_phone"> رقم هاتف المتجر </label>
                        <input class="form-control" name="store_phone" type="text" id="store_phone" placeholder="ادخل رقم الهاتف الاول" >
                        </div>
                        <div class="col-sm-6">
                        <label class="form-label" for="store_phone2"> رقم هاتف المتجر الثاني </label>
                        <input class="form-control" name="store_phone2" type="text" id="store_phone2" placeholder="ادخل رقم الهاتف الثاني" >
                        </div>
                        <div class="col-sm-12">
                        <label class="form-label" for="store_address">عنوان المتجر</label>
                        <textarea class="form-control" name="store_address" rows="4" cols="4" id="store_address" placeholder="ادخل رقم الهاتف الثاني" ></textarea>
                        </div>
                        <div class="col-sm-12">
                        <label class="form-label" for="store_description">وصف المتجر</label>
                        <textarea class="form-control" name="store_description" rows="8" cols="8" id="store_description" placeholder="ادخل رقم الهاتف الثاني" ></textarea>
                        </div>
                        <div class="col-12">
                        <hr class="mt-2 mb-4">
                        <div class="d-sm-flex justify-content-between align-items-center">
                            <button class="btn btn-primary mt-3 mt-sm-0" type="submit"> نشر المتجر </button>
                        </div>
                        </div>
                    </div>
                    </form>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
    <!-- Footer-->
    <?php echo $__env->make('site.layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\wamp64\www\dronz\resources\views/vendors/create.blade.php ENDPATH**/ ?>