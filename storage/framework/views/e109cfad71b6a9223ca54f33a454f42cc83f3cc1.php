<div class="modal fade" id="delete_category_<?php echo e($category->id); ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete - <?php echo e($category->en_title); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body m-3">
                <p class="mb-0">Are you Sure you want to delete , <?php echo e($category->en_title); ?> ??</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger">Yes Sure</button>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\wamp64\www\abraa-dash\resources\views/admin/categories/components/delete.blade.php ENDPATH**/ ?>