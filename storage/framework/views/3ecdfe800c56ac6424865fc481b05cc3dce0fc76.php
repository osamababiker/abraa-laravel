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

                    <h1 class="h3 mb-3"> <i class="fa fa-plus"></i> Add New Store </h1>
                    <div class="col-12">
                        <form id="smartwizard-validation" class="wizard wizard-primary" action="javascript:void(0)">
                            <ul class="nav">
                                <li class="nav-item"><a class="nav-link" href="#step-1">First
                                        Step<br /><small>Account Info</small></a></li>
                                <li class="nav-item"><a class="nav-link" href="#step-2">Second
                                        Step<br /><small>Store Info</small></a></li>
                                <li class="nav-item"><a class="nav-link" href="#step-3">Third
                                        Step<br /><small>Logo & Banners</small></a></li>
                                <li class="nav-item"><a class="nav-link" href="#step-4">Four
                                        Step<br /><small>Membership</small></a></li>
                                <li class="nav-item"><a class="nav-link" href="#step-5">Five
                                        Step<br /><small>Store Setting</small></a></li>
                                <li class="nav-item"><a class="nav-link" href="#step-6">Six
                                        Step<br /><small>Sales Person</small></a></li>
                            </ul>

                            <div class="tab-content">
                                <div id="step-1" class="tab-pane" role="tabpanel">
                                    <div class="text-center mb-5 mt-5">
                                        <h3> Provide Account Details </h3>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="form-label">Full name</label>
                                            <input type="text" name="full_name" class="form-control required"
                                                placeholder="Full Name">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-label">Email address</label>
                                            <input type="email" name="email" class="form-control required" placeholder="Email">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-label">Password</label>
                                            <input type="password" class="form-control required" placeholder="Password">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-label">Country</label>
                                            <select name="country" id="country" class="form-control required select2">
                                                <option value="">Select Country</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-label">City</label>
                                            <select name="city" id="city" class="form-control required select2">
                                                <option value="">Select City</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-label">Phone</label>
                                            <input type="number" class="form-control required" name="phone">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label class="form-label">Password</label>
                                            <input type="password" class="form-control required" name="password">
                                        </div>
                                    </div>
                                </div>
                                <div id="step-2" class="tab-pane" role="tabpanel">
                                    <div class="text-center mb-5 mt-5">
                                        <h3> Provide Store Details </h3>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="form-label">Store Name</label>
                                            <input type="text" name="store_name" class="form-control required"
                                                placeholder="Store Name">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-label">Sub Domain</label>
                                            <input type="text" name="sub_domain" class="form-control required"
                                                placeholder="Sub domain">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label class="form-label">Contact Address</label>
                                            <textarea name="contact_address" cols="4" rows="4"
                                                class="form-control required"></textarea>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label class="form-label">Website Url</label>
                                            <input type="text" class="form-control required" name="website_url">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label class="form-label">About Store</label>
                                            <textarea name="about_store" cols="4" rows="4"
                                                class="form-control required"></textarea>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="form-label">Facebook Url</label>
                                            <input type="text" class="form-control required" name="facebook_url">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="form-label">Twitter Url</label>
                                            <input type="text" class="form-control required" name="twitter_url">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="form-label">Instagram Url</label>
                                            <input type="text" class="form-control required" name="instagram_url">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label class="form-label">Meta Title</label>
                                            <textarea name="meta_title" cols="4" rows="4"
                                                class="form-control required"></textarea>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label class="form-label">Meta Description</label>
                                            <textarea name="meta_description" cols="4" rows="4"
                                                class="form-control required"></textarea>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label class="form-label">Meta Keywords</label>
                                            <textarea name="meta_keywords" cols="4" rows="4"
                                                class="form-control required"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div id="step-3" class="tab-pane" role="tabpanel">
                                    <div class="text-center mb-5 mt-5">
                                        <h3> Provide Logo and Banner(s) </h3>
                                    </div>
                                    <div class="row" id="my-dropzone">
                                        <div class="form-group col-md-12">
                                            <h5> Please verify the logo before uploading as belonging to the same store/supplier. The logo file should be optimized for web use. Logo should be in square resolution i.e 200x200 </h5>
                                            <div id="logo_dropzone" style="width: 200px" class="dropzone mt-3"></div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <h5> Please verify the banner(s) before uploading as belonging to the same store/supplier. The banner file(s) should be optimized for web use. Banner should be in Rectangles </>
                                            <div id="banner_dropzone" class="dropzone mt-3"></div>
                                        </div>
                                    </div>
                                </div>
                                <div id="step-4" class="tab-pane" role="tabpanel">
                                    <div class="text-center mb-5 mt-5">
                                        <h3> Select Membership </h3>
                                    </div>
                                    <div class="row" id="my-dropzone">
                                        <div class="form-group col-md-12">
                                            <div class="form-row" id="membership_date">
                                                <div class="form-group col-md-6">
                                                    <label class="form-label">Start Date</label>
                                                    <input class="form-control datepicker" type="text" name="datesingle" />
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="form-label">End Date</label>
                                                    <input class="form-control datepicker" type="text" name="datesingle" />
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <label class="custom-control custom-radio">
                                                    <input  name="membership" id="basic_membership" value="basic" type="radio" class="custom-control-input" checked>
                                                    <span class="custom-control-label">Basic</span>
                                                </label>
                                                &nbsp; &nbsp;
                                                <label class="custom-control custom-radio">
                                                    <input name="membership" id="silver_membership" value="silver" type="radio" class="custom-control-input">
                                                    <span class="custom-control-label">Silver</span>
                                                </label>
                                                &nbsp; &nbsp;
                                                <label class="custom-control custom-radio">
                                                    <input name="membership" id="gold_membership"  value="gold" type="radio" class="custom-control-input">
                                                    <span class="custom-control-label">Gold</span>
                                                </label>
                                                &nbsp; &nbsp;
                                                <label class="custom-control custom-radio">
                                                    <input name="membership" id="platinum_membership"  value="platinum" type="radio" class="custom-control-input">
                                                    <span class="custom-control-label">Platinum</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="step-5" class="tab-pane" role="tabpanel">
                                    <div class="text-center mb-5 mt-5">
                                        <h3> Select Store Settings </h3>
                                    </div>
                                    <div class="row" id="my-dropzone">
                                        <div class="form-group col-md-12">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for=""> Disable the Store </label>
                                                    <select name="disable_store" id="disable_store" class="form-control required select2">
                                                        <option value=""></option>
                                                        <option value="1">Yes</option>
                                                        <option value="0">No</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for=""> Store Verified </label>
                                                    <select name="verified_store" id="verified_store" class="form-control required select2">
                                                        <option value=""></option>
                                                        <option value="1">Yes</option>
                                                        <option value="0">No</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label class="custom-control custom-checkbox">
                                                        <input type="checkbox" name="show_home_page" class="custom-control-input">
                                                        <span class="custom-control-label">Show store in home page </span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="step-6" class="tab-pane" role="tabpanel">
                                    <div class="text-center mb-5 mt-5">
                                        <h3> Select Sales Executive </h3>
                                    </div>
                                    <div class="row" id="my-dropzone">
                                        <div class="form-group col-md-12">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for=""> Sales Executive </label>
                                                    <select name="sales_executive" id="sales_executive" class="form-control required select2">
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </main>

            <!-- footer is here -->
            <?php echo $__env->make('admin.layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\Abraa\abraa-app\resources\views/admin/stores/add.blade.php ENDPATH**/ ?>