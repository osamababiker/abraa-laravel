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

                    <form id="suppliers_actions_form" action="<?php echo e(route('suppliers.actions')); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title"> You have <?php echo e($suppliers_count); ?> supplier in this table </h5>
                                        <div class="row">
                                            <a href="<?php echo e(route('suppliers.create')); ?>" class="btn btn-primary"> <i class="fa fa-plus"></i> Add New  </a>
                                            &nbsp; &nbsp;
                                            <button type="button" data-toggle="modal" data-target="#delete_selected_confirm" class="btn btn-danger"> <i class="fa fa-trash"></i> Archive Selected  </button>
                                            &nbsp; &nbsp;
                                            <button type="button" name="send_email_multiple" class="btn btn-info"> <i class="fa fa-envelope"></i> Send Email  </button>
                                            &nbsp; &nbsp;
                                            <button type="button" name="send_sms_multiple" class="btn btn-success"> <i class="fa fa-phone"></i> Send SMS  </button>
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
                                        <table id="datatables-reponsive" class="table table-striped" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th> <input type="checkbox" name="all_colums" class="select_all_colums"> </th>
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
                                                <?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td> <input type="checkbox" name="supplier_id[]" value="<?php echo e($supplier->id); ?>" id=""> </td>
                                                    <td><?php echo e($supplier->id); ?></td>
                                                    <td><?php echo e($supplier->full_name); ?></td>
                                                    <td><?php echo e($supplier->email); ?></td>
                                                    <td><?php echo e($supplier->phone); ?></td>
                                                    <td><?php echo e($supplier->date_added); ?></td>
                                                    <td> 
                                                        <?php if($supplier->verified): ?>
                                                            <i class="fa fa-check" style="color: green;"></i> 
                                                        <?php else: ?> 
                                                            <i class="fa fa-times" style="color: red;"></i>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <?php if($supplier->supplier_country): ?>
                                                        <?php echo e($supplier->supplier_country->en_name); ?>

                                                        <?php endif; ?>
                                                    </td>
                                                    <td> <?php echo e($supplier->company); ?> </td>
                                                    <td> 
                                                        <?php if($supplier->is_organic): ?>
                                                            <i class="fa fa-check" style="color: green;"></i> 
                                                        <?php else: ?> 
                                                            <i class="fa fa-times" style="color: red;"></i>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td> <?php echo e($supplier->getUserSource($supplier->user_source)); ?> </td>
                                                    <td class="table-action">
                                                        <a href="#" type="button" data-toggle="modal" data-target="#edit_supplier_<?php echo e($supplier->id); ?>"><i class="align-middle" data-feather="edit-2"></i></a>
                                                        <a href="#"><i class="align-middle" data-toggle="modal" data-target="#delete_supplier_<?php echo e($supplier->id); ?>" data-feather="trash"></i></a>
                                                        <a class="dropdown">
                                                            <a class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                <a class="dropdown-item" type="button" data-toggle="modal" data-target="#supplier_items_<?php echo e($supplier->id); ?>"><i class="align-middle">Items</a>
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
                                                <!-- include table component -->
                                                <?php echo $__env->make('admin.suppliers.components.items', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                <?php echo $__env->make('admin.suppliers.components.edit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                <?php echo $__env->make('admin.suppliers.components.delete', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                <?php echo $__env->make('admin.suppliers.components.delete_selected', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                        </table>
                                        <div class="d-flex justify-content-center">
                                            <?php echo $suppliers->links("pagination::bootstrap-4"); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </main>

            <!-- footer is here -->
            <?php echo $__env->make('admin.layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\wamp64\www\abraa-dash\resources\views/admin/suppliers/organic.blade.php ENDPATH**/ ?>