
<div class="modal fade" id="edit_product_<?php echo e($product->id); ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> Edit Product Data </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body m-3">
            <form method="post" action="<?php echo e(route('vendors.create_product')); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="mb-3 col-sm-6 pb-2">
                    <label class="form-label" for="product_name"> اسم المنتج  </label>
                    <input class="form-control" value="<?php echo e($product->product_name); ?>" name="product_name" type="text" id="product_name">
                    <div class="form-text"> اقصى حد مسموح به هو 100 حرف </div>
                    </div>
                    <div class="mb-3 col-sm-6 pb-2">
                    <label class="form-label" for="product_type"> نوع المنتج  </label>
                    <select name="product_type" id="product_type" class="form-select">
                        <option value=""> قم باختيار نوع المنتج </option>
                        <option value="1"> عطور </option>
                    </select>
                    </div>
                </div>
                <div class="file-drop-area mb-3">
                  <div class="file-drop-icon"></div><span class="file-drop-message"> اسحب وافلت صور المنتج هنا </span>
                  <input name="product_images[]" multiple class="file-drop-input" type="file">
                  <button class="file-drop-btn btn btn-primary btn-sm mb-2" type="button"> او قم باختيار ملف  </button>
                  <div class="form-text">1000 x 800px انسب عرض</div>
                </div>
                <div class="mb-3 py-2">
                  <label class="form-label" for="product_description"> وصف المنتج  </label>
                  <textarea class="form-control" name="product_description" rows="6" id="product_description"><?php echo e($product->product_description); ?></textarea>
                </div>
                <div class="row">
                  <div class="col-sm-6 mb-3">
                    <label class="form-label" for="selling_price"> سعر البيع للمنتج </label>
                    <div class="input-group">
                      <input class="form-control" value="<?php echo e($product->selling_price); ?>" name="selling_price" type="number" id="selling_price">
                    </div>
                    <div class="form-text"> قم بادخال سعر البيع للمنتح </div>
                  </div>
                  <div class="col-sm-6 mb-3">
                    <label class="form-label" for="price"> سعر العرض </label>
                    <div class="input-group">
                      <input class="form-control" value="<?php echo e($product->price); ?>" type="number" name="price" id="price">
                    </div>
                    <div class="form-text"> قم بادخال سعر العرض هنا </div>
                  </div>
                </div>
                <div class="mb-3 py-2">
                  <label class="form-label" for="product_tags"> الكلمات المفتاحية  </label>
                  <select name="product_tags[]" class="form-control select2" multiple="multiple" id="product_tags">
                      <option value=""> اكتب الكلمة هنا </option>
                      <option value=""></option>
                  </select>
                  <div class="form-text"> قم بادخال 10 كلمات مفتاحية لوصف المنتج </div>
                </div>
                <button class="btn btn-primary d-block w-100" type="submit"><i class="ci-cloud-upload fs-lg me-2"></i> اضافة المنتج </button>
              </form>
            </div>
            <div class="modal-footer form-row d-flex justify-content-center">
                <div class="">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    &nbsp; &nbsp;
                    <button type="button" class="btn btn-success">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
</div>


<?php /**PATH C:\wamp64\www\dronz\resources\views/vendors/components/editProduct.blade.php ENDPATH**/ ?>