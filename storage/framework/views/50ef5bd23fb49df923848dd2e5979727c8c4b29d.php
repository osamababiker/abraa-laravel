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
                                        <button class="btn btn-success"> <i class="fa fa-envelope"></i> Send to Selected  </button>
                                    </div>
                                </div>
                                <div class="card-body">

                                    <!-- custom filter -->
                                    <div class="custom-filter mb-4">
                                        <div class="row">
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
                                                <th>Send</th>
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
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td> <button class="btn btn-success"> <i class="fa fa-envelope"></i> </button> </td>
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
                                            </tr>
                                            <tr>
                                                <td> <button class="btn btn-success"> <i class="fa fa-envelope"></i> </button> </td>
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
<?php /**PATH C:\Abraa\abraa-app\resources\views/admin/suppliers/suppliers_no_keywords.blade.php ENDPATH**/ ?>