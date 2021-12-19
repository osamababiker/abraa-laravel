<div class="modal fade" id="delete_store_<?php echo e($store->id); ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="/stores/<?php echo e($store->id); ?>/destroy" id="delete_store_form_<?php echo e($store->id); ?>" method="DELETE">
            </form>
            <div class="modal-header">
                <h5 class="modal-title">Archive - <?php echo e($store->name); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body m-3">
                <p class="mb-0">Are you Sure you want to move , <?php echo e($store->name); ?> to archive ??</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" form="delete_store_form_<?php echo e($store->id); ?>" class="btn btn-danger">Yes Sure</button>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\wamp64\www\abraa-dash\resources\views/admin/stores/components/delete.blade.php ENDPATH**/ ?>