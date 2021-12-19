<div class="modal fade" id="delete_buyer_<?php echo e($buyer->id); ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="/buyers/<?php echo e($buyer->id); ?>/destroy" id="delete_buyer_form_<?php echo e($buyer->id); ?>" method="DELETE">
            </form>
            <div class="modal-header">
                <h5 class="modal-title">Archive - <?php echo e($buyer->full_name); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body m-3">
                <p class="mb-0">Are you Sure you want to move , <?php echo e($buyer->full_name); ?> to archive ??</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" form="delete_buyer_form_<?php echo e($buyer->id); ?>" class="btn btn-danger">Yes Sure</button>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\wamp64\www\abraa-dash\resources\views/admin/buyers/components/delete.blade.php ENDPATH**/ ?>