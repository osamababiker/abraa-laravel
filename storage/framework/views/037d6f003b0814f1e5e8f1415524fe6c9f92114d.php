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
                                    <h5 class="card-title"> All Suppliers List </h5>
                                    <div class="row">
                                        <button class="btn btn-primary"> <i class="fa fa-plus"></i> Add New  </button>
                                        &nbsp; &nbsp;
                                        <button class="btn btn-danger"> <i class="fa fa-trash"></i> Delete Selected  </button>
                                        &nbsp; &nbsp;
                                        <button class="btn btn-info"> <i class="fa fa-envelope"></i> Send Email  </button>
                                        &nbsp; &nbsp;
                                        <button class="btn btn-success"> <i class="fa fa-phone"></i> Send Sms  </button>
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
                                                <label for="supplier_source"> Supplier Source </label>
                                                <select name="" id="supplier_source" class="form-control select2">
                                                    <option value="">Select source</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="country"> Country </label>
                                                <select name="" id="country" class="form-control select2">
                                                    <option value="">Select country</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="sort_by"> Sort By </label>
                                                <select name="" id="sort_by" class="form-control select2">
                                                    <option value="">Sort by</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="">&nbsp; &nbsp;</label>
                                                <select name="" id="sort_by" class="form-control select2">
                                                    <option value="">Desc</option>
                                                    <option value="">Asc</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <table id="datatables-reponsive" class="table table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Full Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Date Registered</th>
                                                <th>Verified</th>
                                                <th>Country</th>
                                                <th>Company</th>
                                                <th>Is Organic</th>
                                                <th>User Source </th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>45788</td>
                                                <td>Omer Alhamra</td>
                                                <td>omer@abraa.com</td>
                                                <td>051462378</td>
                                                <td>2011/06/27</td>
                                                <td> <i class="fa fa-check text-green"></i> </td>
                                                <td>UAE</td>
                                                <td>SOUQ AL MENA </td>
                                                <td> <i class="fa fa-check text-green"></i> </td>
                                                <td> Sign Up Express </td>
                                                <td class="table-action">
                                                    <a href="#"><i class="align-middle" data-feather="edit-2"></i></a>
                                                    <a href="#"><i class="align-middle" data-feather="trash"></i></a>
                                                    <a class="dropdown">
                                                        <a class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item" href="#">Items</a>
                                                            <a class="dropdown-item" href="#">Users store</a>
                                                            <a class="dropdown-item" href="#">Buying request suppliers</a>
                                                            <a class="dropdown-item" href="#">Users files</a>
                                                            <a class="dropdown-item" href="#">Buy request views</a>
                                                            <a class="dropdown-item" href="#">Buying request invoice</a>
                                                            <a class="dropdown-item" href="#">Marketing store activities </a>
                                                            <a class="dropdown-item" href="#">Call center activities</a>
                                                            <a class="dropdown-item" href="#">Rfq pending suppliers</a>
                                                            <a class="dropdown-item" href="#">Store marketing docs</a>
                                                            <a class="dropdown-item" href="#">Rfq supplier log</a>
                                                            <a class="dropdown-item" href="#">Supplier verification</a>
                                                        </div>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>32288</td>
                                                <td>Osama Babiker</td>
                                                <td>omer@abraa.com</td>
                                                <td>051462378</td>
                                                <td>2011/06/27</td>
                                                <td> <i class="fa fa-check text-green"></i> </td>
                                                <td>UAE</td>
                                                <td>SOUQ AL MENA </td>
                                                <td> <i class="fa fa-check text-green"></i> </td>
                                                <td> Sign Up Express </td>
                                                <td class="table-action">
                                                    <a href="#"><i class="align-middle" data-feather="edit-2"></i></a>
                                                    <a href="#"><i class="align-middle" data-feather="trash"></i></a>
                                                    <a class="dropdown">
                                                        <a class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item btn" href="#">Items</a>
                                                            <a class="dropdown-item btn" href="#">Users store</a>
                                                            <a class="dropdown-item btn" href="#">Buying request suppliers</a>
                                                            <a class="dropdown-item btn" href="#">Users files</a>
                                                            <a class="dropdown-item btn" href="#">Buy request views</a>
                                                            <a class="dropdown-item btn" href="#">Buying request invoice</a>
                                                            <a class="dropdown-item btn" href="#">Marketing store activities </a>
                                                            <a class="dropdown-item btn" href="#">Call center activities</a>
                                                            <a class="dropdown-item btn" href="#">Rfq pending suppliers</a>
                                                            <a class="dropdown-item btn" href="#">Store marketing docs</a>
                                                            <a class="dropdown-item btn" href="#">Rfq supplier log</a>
                                                            <a class="dropdown-item btn" href="#">Supplier verification</a>
                                                        </div>
                                                    </a>
                                                </td>
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
<?php /**PATH C:\Abraa\abraa-app\resources\views/admin/suppliers/all.blade.php ENDPATH**/ ?>