<div class="modal fade" id="delete_item_<?php echo e($item->id); ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="/items/<?php echo e($item->id); ?>/destroy" id="delete_item_form_<?php echo e($item->id); ?>" method="DELETE">
            </form>
            <div class="modal-header">
                <h5 class="modal-title">Delete - <?php echo e($item->title); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body m-3">
                <p class="mb-0">Are you Sure you want to delete , <?php echo e($item->title); ?> ??</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" form="delete_item_form_<?php echo e($item->id); ?>" class="btn btn-danger">Yes Sure</button>
            </div>
        </div> 
    </div>
</div>
<?php /**PATH C:\wamp64\www\abraa-dash\resources\views/admin/items/components/delete.blade.php ENDPATH**/ ?>