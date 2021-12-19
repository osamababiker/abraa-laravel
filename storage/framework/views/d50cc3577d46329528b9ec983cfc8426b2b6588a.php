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

                    <h1 class="h3 mb-3">Manage Stores Table</h1>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title"> Suppliers Store list  </h5>
                                    <div class="row">
                                        <button class="btn btn-primary"> <i class="fa fa-plus"></i> Add New  </button>
                                        &nbsp; &nbsp;
                                        <button class="btn btn-secondary">  Send Questionnaire  </button>
                                        &nbsp; &nbsp;
                                        <button class="btn btn-info">  Send Reminder  </button>
                                        &nbsp; &nbsp;
                                        <button class="btn btn-danger"> <i class="fa fa-trash"></i> Delete Selected  </button>
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
                                                <label for="store_type"> Store Type </label>
                                                <select name="" id="store_type" class="form-control select2">
                                                    <option value="">Platinum</option>
                                                    <option value="">Old Gold</option>
                                                    <option value="">Gold</option>
                                                    <option value="">Silver</option>
                                                    <option value="">Basic</option>
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
                                                <th>Registered Email</th>
                                                <th>Store Name</th>
                                                <th>Sub Domain</th>
                                                <th>Logo</th>
                                                <th>Visits</th>
                                                <th>Disabled</th>
                                                <th>Rejected</th>
                                                <th>Store Verified</th>
                                                <th>Contact Count</th>
                                                <th>Date Added </th>
                                                <th>Products</th>
                                                <th>Reminders Sent</th>
                                                <th> Actions </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>bassel@proverdeco.com </td>
                                                <td>Proverde Cleaning Equipment Trading LLC    Send Questionnair</td>
                                                <td> <a target="_blank" href="https://www.abraa.com/store/58741"> https://www.abraa.com/store/58741 </a> </td>
                                                <td>
                                                    <a target="_blank" href="<?php echo e(asset('image/logo.png')); ?>"> <img width="100" height="100" src="<?php echo e(asset('image/logo.png')); ?>" alt="">  </a>
                                                </td>
                                                <td>1423</td>
                                                <td> No </td>
                                                <td>No</td>
                                                <td> 0 </td>
                                                <td> 0 </td>
                                                <td> 2021-12-05 09:01:04  </td>
                                                <td> <a target="_blank" href=""> 52 </a> </td>
                                                <td> 0 </td>
                                                <td class="table-action">
                                                    <a href="#"><i class="align-middle" data-feather="edit-2"></i></a>
                                                    <a href="#"><i class="align-middle" data-feather="trash"></i></a>
                                                </td>
                                            </tr>
                                            <!-- include table component -->
                                            <?php echo $__env->make('admin.suppliers.components.edit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            <?php echo $__env->make('admin.suppliers.components.delete', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
<?php /**PATH C:\Abraa\abraa-app\resources\views/admin/stores/index.blade.php ENDPATH**/ ?>