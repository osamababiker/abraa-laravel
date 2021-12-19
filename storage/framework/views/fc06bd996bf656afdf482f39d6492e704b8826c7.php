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

                    <h1 class="h3 mb-3">Manage Buyers Table</h1>

                    <div class="row">
                        <div class="col-12"> 
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title"> You have <?php echo e($buyers_count); ?> buyer in this table  </h5>
                                    <div class="row">
                                        <button class="btn btn-primary"> <i class="fa fa-plus"></i> Add New  </button>
                                        &nbsp; &nbsp;
                                        <button class="btn btn-secondary">  Send Questionnaire  </button>
                                        &nbsp; &nbsp;
                                        <button class="btn btn-info">  Send Reminder  </button>
                                        &nbsp; &nbsp;
                                        <button type="button"  data-toggle="modal" data-target="#delete_selected_confirm" class="btn btn-danger"> <i class="fa fa-trash"></i> Archive Selected  </button>
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
                                                    <button name="search_buyers_btn" form="buyers_actions_form" class="btn" type="submit">
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
                                                <th>Full name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Date Registered</th>
                                                <th>Verified</th>
                                                <th>Country</th>
                                                <th>Company</th>
                                                <th>Is Organic</th>
                                                <th>Source</th>
                                                <th> Actions </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $buyers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $buyer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td> <input type="checkbox" name="buyer_id[]" value="<?php echo e($buyer->id); ?>" id=""> </td>
                                                <td> <?php echo e($buyer->id); ?> </td>
                                                <td> <?php echo e($buyer->full_name); ?> </td>
                                                <td> <?php echo e($buyer->email); ?> </td>
                                                <td> <?php echo e($buyer->phone); ?> </td>
                                                <td> <?php echo e($buyer->date_added); ?> </td>
                                                <td>
                                                    <?php if($buyer->verified == 1): ?> 
                                                        <i class="fa fa-check" style="color: green"></i>
                                                    <?php else: ?> 
                                                        <i class="fa fa-times" style="color: red"></i>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if($buyer->buyer_country): ?>
                                                    <?php echo e($buyer->buyer_country->en_name); ?>

                                                    <?php endif; ?>
                                                </td>
                                                <td> <?php echo e($buyer->company); ?> </td>
                                                <td> 
                                                    <?php if($buyer->is_organic): ?>
                                                        <i class="fa fa-check" style="color: green;"></i> 
                                                    <?php else: ?> 
                                                        <i class="fa fa-times" style="color: red;"></i>
                                                    <?php endif; ?>
                                                </td>
                                                <td> <?php echo e($buyer->getUserSource($buyer->user_source)); ?> </td>
                                                <td class="table-action">
                                                    <a href="#" type="button" data-toggle="modal" data-target="#view_buyer_<?php echo e($buyer->id); ?>"><i class="align-middle" data-feather="eye"></i></a>
                                                    <a href="#" type="button" data-toggle="modal" data-target="#edit_buyer_<?php echo e($buyer->id); ?>"><i class="align-middle" data-feather="edit-2"></i></a>
                                                    <a href="#"><i class="align-middle" data-toggle="modal" data-target="#delete_buyer_<?php echo e($buyer->id); ?>" data-feather="trash"></i></a>
                                                </td>
                                            </tr>
                                            <!-- include table component -->
                                            <?php echo $__env->make('admin.buyers.components.edit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            <?php echo $__env->make('admin.buyers.components.delete', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            <?php echo $__env->make('admin.buyers.components.delete_selected', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-center">
                                        <?php echo $buyers->links("pagination::bootstrap-4"); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </main>

            <!-- footer is here -->
            <?php echo $__env->make('admin.layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\wamp64\www\abraa-dash\resources\views/admin/buyers/index.blade.php ENDPATH**/ ?>