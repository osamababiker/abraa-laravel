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

                    <h1 class="h3 mb-3">Manage All Quotes Table</h1>

                    <div class="row">
                        <div class="col-12"> 
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title"> You have <span id="rfqs_counter"></span> Quotes in this table  </h5>
                                    <div class="row">
                                        <button class="btn btn-primary"> <i class="fa fa-plus"></i> Add New  </button>
                                        &nbsp; &nbsp;
                                        <button type="button" data-toggle="modal" data-target="#approve_selected_buying_request" class="btn btn-success"> Approve Selected  </button>
                                        &nbsp; &nbsp;
                                        <button type="button"  data-toggle="modal" data-target="#delete_selected_confirm" class="btn btn-danger"> <i class="fa fa-trash"></i> Delete Selected  </button>
                                        &nbsp; &nbsp;
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Tools
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="<?php echo e(route('rfqs.export.excel')); ?>" target="_blank">Export to excel</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body"> 
                                    
                                    <div class="row mb-2 m-1">
                                        <div class="col-md-2 form-group">
                                            <label for="product_name">Product Name</label>
                                            <input type="text" name="product_name" id="product_name" class="filter_data_table form-control" aria-label="Search">
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <label for="buying_requests_status">Filter by Status</label>
                                            <select name="buying_requests_status"  id="buying_requests_status" class="filter_data_table form-control select2">
                                                <option value=""> All Items </option>   
                                                <option value="approved"> Approved request </option>
                                                <option value="pending"> Pending request </option>
                                                <option value="completed"> Completed request </option>
                                                <option value="canceled"> Canceled request </option>
                                            </select>
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <label for="shipping_country"> Shipping Country</label>
                                            <select name="shipping_country[]" multiple="multiple" id="shipping_country" class="filter_data_table form-control select2">
                                                <option value=""> choose country </option>
                                                <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($country->co_code); ?>"><?php echo e($country->en_name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                            </select>
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <label for="request_type">Filter Request Type</label>
                                            <select name="request_type" id="request_type" class="filter_data_table form-control select2">
                                                <option value="">  </option>   
                                                <option value="global"> Global Request </option>
                                                <option value="normail"> Normal Request </option>
                                            </select>
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <label for="rows_numbers">Numbers of rows</label>
                                            <select name="rows_numbers" id="rows_numbers" class="filter_data_table form-control select2">
                                                <option value="10"> 10 </option>
                                                <option value="100"> 100 </option>
                                                <option value="500"> 500 </option>
                                                <option value="1000"> 1000 </option>
                                            </select>
                                        </div>
                                    </div>

                                    <table id="datatables-reponsive" class="table table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th> <input type="checkbox" class="select_all_colums"> </th>
                                                <th>Id</th>
                                                <th> Product name </th>
                                                <th>Category</th>
                                                <th>Buying Request</th>
                                                <th>Supplier</th>
                                                <th>Supplier Email</th>
                                                <th>Quantity</th>
                                                <th>Unit</th>
                                                <th>Price</th>
                                                <th>Total price</th>
                                                <th>Message</th>
                                                <th>Datetime</th>
                                                <th> Actions </th>
                                            </tr>
                                        </thead>
                                        <tbody id="buying_requests_table_body">
                                            
                                        </tbody>
                                    </table>
                                    <?php echo $__env->make('admin.rfq.components.delete_selected', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </main>

            <!-- footer is here -->
            <?php echo $__env->make('admin.layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\wamp64\www\abraa-dash\resources\views/admin/rfq/index.blade.php ENDPATH**/ ?>