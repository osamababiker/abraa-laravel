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

                    <h1 class="h3 mb-3">Manage All Quotes Table</h1>

                    <div class="row">
                        <div class="col-12"> 
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title"> You have <?php echo e($buying_requests_count); ?> Quotes in this table  </h5>
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
                                                <a class="dropdown-item" href="#">Export to excel</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    
                                    <!-- custome search box to search all table  -->
                                    <div class="row mb-2 m-1">
                                        <div class="d-non d-sm-inline-block">
                                            <div class="input-group input-group-navbar">
                                                <input type="text" name="search_query" class="form-control" placeholder="Search buyers ...." aria-label="Search">
                                                <div class="input-group-append">
                                                    <button name="search_rfq_btn" form="rfq_actions_form" class="btn" type="submit">
                                                        <i class="align-middle" data-feather="search"></i>
                                                    </button>
                                                </div>
                                            </div>
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
                                                <th>Currency </th>
                                                <th>Message</th>
                                                <th>Confirmed</th>
                                                <th>Datetime</th>
                                                <th>Vat</th>
                                                <th> Actions </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $buying_requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $buying_request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td> <input type="checkbox" name="buying_request_id[]" value="<?php echo e($buying_request->id); ?>" id=""> </td>
                                                <td> <?php echo e($buying_request->id); ?> </td>
                                                <td> <?php echo e($buying_request->product_name); ?> </td>
                                                <td> 
                                                    <?php if($buying_request->category): ?>
                                                    <?php echo e($buying_request->category->en_title); ?> 
                                                    <?php endif; ?>
                                                </td>
                                                <td>  </td>
                                                <td>  </td>
                                                <td>  </td>
                                                <td> <?php echo e($buying_request->quantity); ?> </td>
                                                <td> 
                                                    <?php if($buying_request->unit): ?>
                                                    <?php echo e($buying_request->unit->unit_en); ?> 
                                                    <?php endif; ?>
                                                </td>
                                                <td> <?php echo e($buying_request->target_price); ?> </td>
                                                <td> <?php echo e($buying_request->target_price * $buying_request->quantity); ?> </td>
                                                <td>  </td>
                                                <td> <a type="button" data-toggle="modal" data-target="#buying_message_<?php echo e($buying_request->id); ?>"><i class="align-middle" href="javascript:;"> <i class="fa fa-ellipsis-h"></i> </a> </td>
                                                <td>
                                                    <i class="fa fa-check" style="color: green"></i>
                                                </td>
                                                <td> <?php echo e($buying_request->date_added); ?> </td>
                                                <td>  </td>
                                                <td class="table-action">
                                                    <a href="#" type="button" data-toggle="modal" data-target="#view_buying_request_<?php echo e($buying_request->id); ?>"><i class="align-middle" data-feather="eye"></i></a>
                                                    <a href="#" type="button" data-toggle="modal" data-target="#edit_buying_request_<?php echo e($buying_request->id); ?>"><i class="align-middle" data-feather="edit-2"></i></a>
                                                    <a href="#"><i class="align-middle" data-toggle="modal" data-target="#delete_buying_request_<?php echo e($buying_request->id); ?>" data-feather="trash"></i></a>
                                                </td>
                                            </tr>
                                            <!-- include table component -->
                                            <?php echo $__env->make('admin.rfq.components.edit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            <?php echo $__env->make('admin.rfq.components.delete', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            <?php echo $__env->make('admin.rfq.components.buying_message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            <?php echo $__env->make('admin.rfq.components.approve', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            <?php echo $__env->make('admin.rfq.components.delete_selected', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-center">
                                        <?php echo $buying_requests->links("pagination::bootstrap-4"); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </main>

            <!-- footer is here -->
            <?php echo $__env->make('admin.layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\wamp64\www\abraa-dash\resources\views/admin/rfq/index.blade.php ENDPATH**/ ?>