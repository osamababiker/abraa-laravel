<div class="modal fade" id="supplier_items_<?php echo e($supplier->id); ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo e($supplier->full_name); ?> Items </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body m-3">
                <div class="row">
                    <div class="col-md-4 text-center">
                        <div class="bg-light border">
                            <div class="card-body">
                                Id
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="bg-light border">
                            <div class="card-body">
                                Title
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="bg-light border">
                            <div class="card-body">
                                Actions
                            </div>
                        </div>
                    </div>
                </div>
                <?php if($supplier->items): ?>
                <?php $__currentLoopData = $supplier->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="row">
                    <div class="col-md-4 text-center">
                        <div class="border">
                            <div class="card-body">
                                <?php echo e($item->id); ?>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="border">
                            <div class="card-body">
                                <?php echo e($item->title); ?>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="border">
                            <div class="card-body">
                                <a href="#" type="button" data-toggle="modal" data-target="#edit_supplier_<?php echo e($supplier->id); ?>"><i class="align-middle" data-feather="edit-2"></i></a>
                                <a href="#"><i class="align-middle" data-toggle="modal" data-target="#delete_supplier_<?php echo e($supplier->id); ?>" data-feather="trash"></i></a>
                                <a href="#"><i class="align-middle" data-toggle="modal" data-target="#view_supplier_<?php echo e($supplier->id); ?>" data-feather="eye"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\wamp64\www\abraa-dash\resources\views/admin/suppliers/components/items.blade.php ENDPATH**/ ?>