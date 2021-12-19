<aside class="col-lg-4 pe-xl-5">
    <!-- Account menu toggler (hidden on screens larger 992px)-->
    <div class="d-block d-lg-none p-4"><a class="btn btn-outline-accent d-block" href="#account-menu" data-bs-toggle="collapse"><i class="ci-menu ml-2"></i>Account menu</a></div>
    <!-- Actual menu-->
    <div class="h-100 border-end mb-2">
        <div class="d-lg-block collapse" id="account-menu">
        <div class="bg-secondary p-4">
            <h3 class="fs-sm mb-0 text-muted"> <a target="_blank" href="/vendors/<?php echo e($vendor->id); ?>/store"> show store  </a> </h3>
        </div>
        <ul class="list-unstyled mb-0">
            <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="dashboard-settings.html"><i class="ci-settings opacity-60 ml-2"></i>الاعدادات</a></li>
        </ul>
        <div class="bg-secondary p-4">
            <h3 class="fs-sm mb-0 text-muted"> لوحة البائع </h3>
        </div>
        <ul class="list-unstyled mb-0">
            <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="dashboard-sales.html"><i class="ci-dollar opacity-60 ml-2"></i>المبيعات<span class="fs-sm text-muted ms-auto">$1,375.00</span></a></li>
            <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3 active" href="<?php echo e(route('vendors.products')); ?>"><i class="ci-package opacity-60 ml-2"></i>المنتجات<span class="fs-sm text-muted ms-auto">5</span></a></li>
            <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="<?php echo e(route('vendors.create_product')); ?>"><i class="ci-cloud-upload opacity-60 ml-2"></i>اضافة منتج جديد</a></li>
            <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="dashboard-payouts.html"><i class="ci-currency-exchange opacity-60 ml-2"></i>الدفعيات</a></li>
            <li class="mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="account-signin.html"><i class="ci-sign-out opacity-60 ml-2"></i> تسجيل خروج </a></li>
        </ul>
        <hr>
        </div>
    </div>
    </aside>
<?php /**PATH C:\wamp64\www\dronz\resources\views/vendors/layouts/aside.blade.php ENDPATH**/ ?>