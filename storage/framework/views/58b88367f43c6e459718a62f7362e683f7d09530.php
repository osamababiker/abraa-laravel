<div class="modal fade" id="signin-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header bg-secondary">
          <ul class="nav nav-tabs card-header-tabs" role="tablist">
            <li class="nav-item"><a class="nav-link fw-medium" href="#signin-tab" data-bs-toggle="tab" role="tab"
                aria-selected="true"><i class="ci-unlocked mt-n1 m1-2"></i> تسجيل دخول </a></li>
            <li class="nav-item"><a class="nav-link fw-medium active" href="#signup-tab" data-bs-toggle="tab" role="tab"
                aria-selected="false"><i class="ci-user mt-n1 m1-2"></i> انشاء حساب </a></li>
          </ul>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body tab-content py-4">
          <form method="post" action="<?php echo e(route('login')); ?>" class="needs-validation tab-pane fade" autocomplete="off" novalidate id="signin-tab">
            <?php echo csrf_field(); ?>
            <div class="mb-3">
              <label class="form-label" for="si-email"> البريد الالكتروني </label>
              <input class="form-control" name="email" type="email" id="si-email" placeholder="user@example.com" required>
              <div class="invalid-feedback">Please provide a valid email address.</div>
            </div>
            <div class="mb-3">
              <label class="form-label" for="si-password">كلمة المرور</label>
              <div class="password-toggle">
                <input class="form-control" name="password" type="password" id="si-password" required>
                <label class="password-toggle-btn" aria-label="Show/hide password">
                  <input class="password-toggle-check" type="checkbox"><span class="password-toggle-indicator"></span>
                </label>
              </div>
            </div>
            <div class="mb-3 d-flex flex-wrap justify-content-between">
              <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" id="si-remember">
                <label class="form-check-label" for="si-remember"> تذكرني </label>
              </div><a class="fs-sm" href="#"> نسيت كلمة المرور ؟ </a>
            </div>
            <button class="btn btn-primary btn-shadow d-block w-100" type="submit"> تسجيل دخول </button>
          </form>
          <form method="post" action="<?php echo e(route('register')); ?>" class="needs-validation tab-pane  show active fade" autocomplete="off" novalidate id="signup-tab">
            <?php echo csrf_field(); ?>
            <div class="mb-3">
              <label class="form-label" for="su-name"> الاسم  </label>
              <input class="form-control" name="name" type="text" id="su-name" placeholder="John Doe" required>
              <div class="invalid-feedback">Please fill in your name.</div>
            </div>
            <div class="mb-3">
              <label for="su-email"> البريد الالكتروني </label>
              <input class="form-control" name="email" type="email" id="su-email" placeholder="johndoe@example.com" required>
              <div class="invalid-feedback">Please provide a valid email address.</div>
            </div>
            <div class="mb-3">
              <label for="su-phone"> رقم الهاتف </label>
              <input class="form-control" name="phone" type="tel" id="su-phone" placeholder="+971527081904" required>
              <div class="invalid-feedback">Please provide a valid phone number.</div>
            </div>
            <div class="mb-3">
              <label for="su-country"> الدولة </label>
              <select class="form-control select2" name="country_id" required>
                  <option value=""> اختار الدولة </option>
                  <option value="1"> السودان </option>
              </select>
              <div class="invalid-feedback"></div>
            </div>
            <div class="mb-3">
              <label class="form-label" for="su-password">كلمة المرور</label>
              <div class="password-toggle">
                <input class="form-control" name="password" type="password" id="su-password" required>
                <label class="password-toggle-btn" aria-label="Show/hide password">
                  <input class="password-toggle-check" type="checkbox"><span class="password-toggle-indicator"></span>
                </label>
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label" for="su-password-confirm"> تأكيد كلمة المرور </label>
              <div class="password-toggle">
                <input class="form-control" name="password_confirmation" type="password" id="su-password-confirm" required>
                <label class="password-toggle-btn" aria-label="Show/hide password">
                  <input class="password-toggle-check" type="checkbox"><span class="password-toggle-indicator"></span>
                </label>
              </div>
            </div>
            <button class="btn btn-primary btn-shadow d-block w-100" type="submit"> انشاء حساب </button>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php /**PATH C:\wamp64\www\dronz\resources\views/site/layouts/auth.blade.php ENDPATH**/ ?>