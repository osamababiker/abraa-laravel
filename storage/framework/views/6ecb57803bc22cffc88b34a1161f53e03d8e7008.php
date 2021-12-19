<?php echo $__env->make('admin.layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-behavior="sticky">
    <div class="wrapper">

        <!-- main sidebar here -->
        <?php echo $__env->make('admin.layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="main">

            <!-- main nav here -->
            <?php echo $__env->make('admin.layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <main class="content">
                <div class="container-fluid p-0">

                    <h1 class="h3 mb-3"> <i class="fa fa-plus"></i> Add New Buyer </h1>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <form>
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="full_name">Full Name</label>
                                                <input type="text" class="form-control" id="full_name"
                                                    placeholder="full_name">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" id="email"
                                                    placeholder="email">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="password">Password</label>
                                                <input type="password" class="form-control" id="password"
                                                    placeholder="password">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="counter">Country</label>
                                                <select name="country" id="country" class="form-control select2">
                                                    <option value="">Select country</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="counter">City</label>
                                                <select name="city" id="city" class="form-control select2">
                                                    <option value="">Select city</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="phone">Phone</label>
                                                <input type="number" class="form-control" name="phone" id="phone">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="company">Company</label>
                                                <input type="text" class="form-control" name="company" id="company">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="primary_name">Interested Products</label>
                                                <select name="" id="interested_products" multiple="multiple" class="form-control select2">
                                                    <option value=""></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <label class="custom-control custom-radio">
                                                <span class="custom-control-label">Verified</span>
                                                <input name="membership" id="gold_membership"  value="gold" type="radio" class="custom-control-input">
                                                &nbsp; &nbsp;
                                                <input name="membership" id="platinum_membership"  value="platinum" type="radio" class="custom-control-input">
                                            </label>
                                        </div>
                                        <div class="form-row">
                                            <label class="custom-control custom-radio">
                                                <span class="custom-control-label">Deactivated</span>
                                                <input name="membership" id="gold_membership"  value="gold" type="radio" class="custom-control-input">
                                                &nbsp; &nbsp;
                                                <input name="membership" id="platinum_membership"  value="platinum" type="radio" class="custom-control-input">
                                            </label>
                                        </div>
                                        <div class="form-row d-flex justify-content-center">
                                            <button type="submit" class="btn btn-success">Save Buyer</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </main>

            <!-- footer is here -->
            <?php echo $__env->make('admin.layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\Abraa\abraa-app\resources\views/admin/buyers/add.blade.php ENDPATH**/ ?>