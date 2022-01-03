<?php echo $__env->make('admin.layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-behavior="sticky">
    <div class="wrapper">

        <?php echo $__env->make('admin.layouts.loader', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <!-- main sidebar here -->
        <?php echo $__env->make('admin.layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="main">

            <!-- main nav here -->
            <?php echo $__env->make('admin.layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <main class="content">
                <div class="container-fluid p-0">

                    <h1 class="h3 mb-3">Manage Suppliers Table</h1>

                    <form id="suppliers_actions_form" action="<?php echo e(route('suppliers.actions')); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title"> You have <span id="suppliers_counter"></span> supplier
                                            in this table </h5>

                                        <div class="row ml-1">
                                            <a href="<?php echo e(route('suppliers.create')); ?>" class="btn btn-primary"> <i
                                                    class="fa fa-plus"></i> Add New </a>
                                            &nbsp; &nbsp;
                                            <button type="button" data-toggle="modal"
                                                data-target="#delete_selected_confirm" class="btn btn-danger"> <i
                                                    class="fa fa-trash"></i> Archive Selected </button>
                                            &nbsp; &nbsp;
                                            <button type="button" data-toggle="modal"
                                                data-target="#send_emails_to_selected" class="btn btn-info"> <i
                                                    class="fa fa-envelope"></i> Send Email </button>
                                            &nbsp; &nbsp;
                                            <button type="button" name="send_sms_multiple" class="btn btn-success"> <i
                                                    class="fa fa-phone"></i> Send SMS </button>
                                            &nbsp; &nbsp;
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    Tools
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a href="<?php echo e(route('suppliers.export.excel')); ?>" target="_blank"
                                                        class="dropdown-item" href="#">Export to excel</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">

                                        <div class="row mb-2 m-1">
                                            <div class="col-md-2 form-group">
                                                <label for="search_by_name">Search suppliers by Name</label>
                                                <input type="text" name="search_query" id="supplier_name"
                                                    class="filter_data_table form-control" aria-label="Search">
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <label for="filter_by_country">Filter by Country</label>
                                                <select name="country[]" multiple="multiple" id="filter_by_country"
                                                    class="filter_data_table form-control select2">
                                                    <option value=""> choose country </option>
                                                    <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($country->co_code); ?>"><?php echo e($country->en_name); ?>

                                                    </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <label for="filter_by_keywords">Filter by Keywords</label>
                                                <select name="keywords[]" multiple="multiple" id="filter_by_keywords"
                                                    class="filter_data_table form-control select2">
                                                    <option value=""> enter keywords </option>
                                                </select>
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <label for="supplier_type">Filter by Type</label>
                                                <select name="supplier_type"  id="supplier_type"
                                                    class="filter_data_table form-control select2">
                                                    <option value=""></option>
                                                    <option value="organic"> Organic Suppliers </option>
                                                    <option value="no_keywords"> has no Keywords </option>
                                                </select>
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <label for="filter_by_products_title">Filter by products title</label>
                                                <select name="products_title[]" multiple="multiple"
                                                    id="filter_by_products_title"
                                                    class="filter_data_table form-control select2">
                                                    <option value=""> enter words </option>
                                                </select> 
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <label for="rows_numbers">Numbers of rows</label>
                                                <select name="rows_numbers" id="rows_numbers"
                                                    class="filter_data_table form-control select2">
                                                    <option value="10"> 10 </option>
                                                    <option value="100"> 100 </option>
                                                    <option value="500"> 500 </option>
                                                    <option value="1000"> 1000 </option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="table_wrapper_1">
                                            <div class="table_div_1"></div>
                                        </div>
                                        <div class="table_wrapper_2">
                                            <div class="table_div_2">
                                                <table id="" class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th> <input type="checkbox" name="all_colums"
                                                                    class="select_all_colums"> </th>
                                                            <th>Id</th>
                                                            <th>Full Name</th>
                                                            <th>Email</th>
                                                            <th>Phone</th>
                                                            <th>Date Registered</th>
                                                            <th>Verified</th>
                                                            <th>Country</th>
                                                            <th>Company</th>
                                                            <th>Is Organic</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="suppliers_table_body">

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <?php echo $__env->make('admin.suppliers.components.email_editors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        <?php echo $__env->make('admin.suppliers.components.delete_selected', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form> 

                </div>
            </main>

            <!-- scripts is here -->
            <?php echo $__env->make('admin.layouts.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <script src="<?php echo e(asset('js/dataTables/suppliersDataTable.js')); ?>"></script>
            <!-- footer is here -->
            <?php echo $__env->make('admin.layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\abraa-dash\resources\views/admin/suppliers/index.blade.php ENDPATH**/ ?>