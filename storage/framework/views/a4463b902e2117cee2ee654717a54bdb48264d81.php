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

                    <h1 class="h3 mb-3">Manage Suppliers Table</h1>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">  All Categories In All Countries List  </h5>
                                    <div class="row">
                                        <button class="btn btn-info"> <i class="fa fa-envelope"></i> Send Email  </button>
                                        &nbsp; &nbsp;
                                        <button class="btn btn-success"> <i class="fa fa-phone"></i> Send SMS  </button>
                                        &nbsp; &nbsp;
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Tools
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="#">Export to excel</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">

                                    <!-- custom filter -->
                                    <div class="custom-filter mb-4">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label for="category"> Category </label>
                                                <select name="" id="category" class="form-control select2">
                                                    <option value="">Select category</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="country"> Country </label>
                                                <select name="" id="country" class="form-control select2">
                                                    <option value="">Select country</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <label for="product_count"> Product Count </label>
                                                <select name="" id="product_count" class="form-control select2">
                                                    <option value="">All</option>
                                                    <option value="">1-10</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="sort_by"> Sort By </label>
                                                <select name="" id="sort_by" class="form-control select2">
                                                    <option value="">Sort by</option>
                                                </select>
                                            </div>
                                            <div class="col-md-1">
                                                <label for="">&nbsp; &nbsp;</label>
                                                <select name="" id="" class="form-control select2">
                                                    <option value="">Desc</option>
                                                    <option value="">Asc</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <table id="datatables-reponsive" class="table table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Supplier Id</th>
                                                <th>Supplier</th>
                                                <th>Store</th>
                                                <th>Email</th>
                                                <th>Supplier Country</th>
                                                <th>Phone</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>45788</td>
                                                <td>Energid Instruments</td>
                                                <td>Energid Instruments</td>
                                                <td>marketing@energidinstruments.com</td>
                                                <td>India</td>
                                                <td>0097191904447883</td>
                                            </tr>
                                            <tr>
                                                <td>32288</td>
                                                <td>Bdneny Samrt</td>
                                                <td>Energid Instruments</td>
                                                <td>marketing@energidinstruments.com</td>
                                                <td>India</td>
                                                <td>0097191904447883</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </main>

            <!-- footer is here -->
            <?php echo $__env->make('admin.layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\Abraa\abraa-app\resources\views/admin/suppliers/suppliers_by_category.blade.php ENDPATH**/ ?>