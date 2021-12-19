<?php echo $__env->make('site.layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


  <!-- Body-->
  <body class="handheld-toolbar-enabled">
    <!-- Add Payment Method-->
    <form class="needs-validation modal fade" method="post" id="add-payment" tabindex="-1" novalidate>
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Add a payment method</h5>
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
    <?php if(session()->has('storeCreated')): ?>
        <div class="alert alert-success alert-dismissible" id="successAlert" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <div class="alert-message">
                <strong> اهلا <?php echo e(Auth::user()->name); ?> </strong> <?php echo e(session()->get('storeCreated')); ?>

            </div>
        </div>
    <?php endif; ?>
      <div class="bg-light shadow-lg rounded-3 overflow-hidden">
        <div class="row">
          <!-- Sidebar-->
          <?php echo $__env->make('vendors.layouts.aside', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          <!-- Content-->
          <section class="col-lg-8 pt-lg-4 pb-4 mb-3">
            <div class="pt-2 px-4 ps-lg-0 pe-xl-5">
              <h2 class="h3 py-2 text-center text-sm-start">الاعدادت</h2>
              <!-- Tabs-->
              <ul class="nav nav-tabs nav-justified" role="tablist">
                <li class="nav-item"><a class="nav-link px-0 active" href="#profile" data-bs-toggle="tab" role="tab">
                    <div class="d-none d-lg-block"><i class="ci-user opacity-60 ml-2"></i>معلومات المتجر</div>
                    <div class="d-lg-none text-center"><i class="ci-user opacity-60 d-block fs-xl mb-2"></i><span class="fs-ms">المتجر</span></div></a></li>
                <li class="nav-item"><a class="nav-link px-0" href="#notifications" data-bs-toggle="tab" role="tab">
                    <div class="d-none d-lg-block"><i class="ci-bell opacity-60 ml-2"></i>الاشعارات</div>
                    <div class="d-lg-none text-center"><i class="ci-bell opacity-60 d-block fs-xl mb-2"></i><span class="fs-ms">الاشعارات</span></div></a></li>
                <li class="nav-item"><a class="nav-link px-0" href="#payment" data-bs-toggle="tab" role="tab">
                    <div class="d-none d-lg-block"><i class="ci-card opacity-60 ml-2"></i> طرق الدفع </div>
                    <div class="d-lg-none text-center"><i class="ci-card opacity-60 d-block fs-xl mb-2"></i><span class="fs-ms">الدفع</span></div></a></li>
              </ul>
              <!-- Tab content-->
              <div class="tab-content ml-5">
                <!-- Profile-->
                <div class="tab-pane fade show active" id="profile" role="tabpanel">
                  <div class="ml-5 row">
                    <div class="bg-secondary rounded-3 p-5">
                        <form action="<?php echo e(route('vendors.store')); ?>" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="row gx-4 gy-3">
                            <div class="col-sm-6">
                            <label class="form-label" for="store_name"> اسم المتجر </label>
                            <input class="form-control" value="<?php echo e($vendor->store_name); ?>" name="store_name"  type="text" id="store_name" placeholder="ادخل اسم المتجر هنا">
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
                            <input class="form-control" value="<?php echo e($vendor->store_phone); ?>" name="store_phone" type="text" id="store_phone" placeholder="ادخل رقم الهاتف الاول" >
                            </div>
                            <div class="col-sm-6">
                            <label class="form-label" for="store_phone2"> رقم هاتف المتجر الثاني </label>
                            <input class="form-control" value="<?php echo e($vendor->store_phone2); ?>" name="store_phone2" type="text" id="store_phone2" placeholder="ادخل رقم الهاتف الثاني" >
                            </div>
                            <div class="col-sm-12">
                            <label class="form-label" for="store_address">عنوان المتجر</label>
                            <textarea class="form-control" name="store_address" rows="4" cols="4" id="store_address" placeholder="ادخل رقم الهاتف الثاني" ><?php echo e($vendor->store_address); ?></textarea>
                            </div>
                            <div class="col-sm-12">
                            <label class="form-label" for="store_description">وصف المتجر</label>
                            <textarea class="form-control" name="store_description" rows="8" cols="8" id="store_description" placeholder="ادخل رقم الهاتف الثاني" ><?php echo e($vendor->store_description); ?></textarea>
                            </div>
                            <div class="col-12">
                            <hr class="mt-2 mb-4">
                            <div class="d-sm-flex justify-content-between align-items-center">
                                <button class="btn btn-primary mt-3 mt-sm-0" type="submit"> حفظ التعديلات  </button>
                            </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
                </div>
                <!-- Notifications-->
                <div class="tab-pane fade" id="notifications" role="tabpanel">
                  <div class="bg-secondary rounded-3 p-4">
                    <div class="form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="nf-disable-all" data-master-checkbox-for="#notifocation-settings">
                      <label class="form-check-label fw-medium" for="nf-disable-all"> تفعيل جميع الاشعارات المتجر </label>
                    </div>
                  </div>
                  <div id="notifocation-settings">
                    <div class="border-bottom p-4">
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="nf-product-sold" checked>
                        <label class="form-check-label" for="nf-product-sold"> اشعار بيع المنتجات </label>
                      </div>
                      <div class="form-text"> قم بارسال ايميل في حالة ت بيع احد المنتجات </div>
                    </div>
                    <div class="border-bottom p-4">
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="nf-product-review" checked>
                        <label class="form-check-label" for="nf-product-review"> اشعار تقييم المنتج </label>
                      </div>
                      <div class="form-text"> قم بارسال ايميل في حالة تقييم المنتجات </div>
                    </div>
                    <div class="border-bottom p-4">
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="nf-daily-summary">
                        <label class="form-check-label" for="nf-daily-summary"> اشعار يومي </label>
                      </div>
                      <div class="form-text"> قم بارسال ايميل بالنشاطات اليومية </div>
                    </div>
                  </div>
                  <div class="text-sm-end mt-4">
                    <button class="btn btn-primary" type="button"> حفظ التعديلات </button>
                  </div>
                </div>
                <!-- Payment methods-->
                <div class="tab-pane fade" id="payment" role="tabpanel">
                  <div class="bg-secondary rounded-3 p-4 mb-4">
                    <p class="fs-sm text-muted mb-0"> الدفع عن طريق الكاش هو الافتراضي </p>
                  </div>
                  <div class="table-responsive fs-md mb-4">
                    <table class="table table-hover mb-0">
                      <thead>
                        <tr>
                          <th> بطاقة الدفع الخاصة بك </th>
                          <th> اسم البطاقة </th>
                          <th> فترة انتهاء الصلاحية </th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="py-3 align-middle">
                            <div class="d-flex align-items-center"><img src="img/card-visa.png" width="39" alt="Visa">
                              <div class="ps-2"><span class="fw-medium text-heading me-1">فيزة</div>
                            </div>
                          </td>
                          <td class="py-3 align-middle"> محمد الخير </td>
                          <td class="py-3 align-middle">08 / 2022</td>
                          <td class="py-3 align-middle"><a class="nav-link-style me-2" href="#" data-bs-toggle="tooltip" title="Edit"><i class="ci-edit"></i></a><a class="nav-link-style text-danger" href="#" data-bs-toggle="tooltip" title="Remove">
                              <div class="ci-trash"></div></a></td>
                        </tr>
                        <tr>
                          <td class="py-3 align-middle">
                            <div class="d-flex align-items-center"><img src="img/card-master.png" width="39" alt="MesterCard">
                              <div class="ps-2">  ماستر كارد </div>
                            </div>
                          </td>
                          <td class="py-3 align-middle">أسامة محمد</td>
                          <td class="py-3 align-middle">11 / 2023</td>
                          <td class="py-3 align-middle"><a class="nav-link-style me-2" href="#" data-bs-toggle="tooltip" title="Edit"><i class="ci-edit"></i></a><a class="nav-link-style text-danger" href="#" data-bs-toggle="tooltip" title="Remove">
                              <div class="ci-trash"></div></a></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="text-sm-end"><a class="btn btn-primary" href="#add-payment" data-bs-toggle="modal"> اضافة وسيلة دفع  </a></div>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
    <!-- Footer-->
    <?php echo $__env->make('site.layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\wamp64\www\dronz\resources\views/vendors/show.blade.php ENDPATH**/ ?>