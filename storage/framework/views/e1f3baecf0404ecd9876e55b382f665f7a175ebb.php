
<div class="modal fade" id="edit_category_<?php echo e($category->id); ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> Edit - Omer Alhamra , info </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body m-3">
                <form>
                    <div class="form-row d-flex justify-content-center mt-4">
                        <div class="form-group">
                            <label class="custom-control custom-checkbox m-0">
                                <input type="checkbox" class="custom-control-input">
                                <span class="custom-control-label"> Manufactuer </span>
                            </label>
                        </div>
                        &nbsp; &nbsp;
                        <div class="form-group">
                            <label class="custom-control custom-checkbox m-0">
                                <input type="checkbox" class="custom-control-input">
                                <span class="custom-control-label"> Brand Owner </span>
                            </label>
                        </div>
                        &nbsp; &nbsp;
                        <div class="form-group">
                            <label class="custom-control custom-checkbox m-0">
                                <input type="checkbox" class="custom-control-input">
                                <span class="custom-control-label"> Reseller </span>
                            </label>
                        </div>
                    </div>
                    <div class="form-row mt-4">
                        <div class="form-group col-md-6">
                            <label for="business_name">Business Name</label>
                            <input type="text" class="form-control" id="business_name"
                                placeholder="business_name">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="counter">Country</label>
                            <select name="country" id="country" class="form-control select2">
                                <option value="">Select country</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="business_keywords">Business keyword</label>
                            <select name="business_keywords" id="business_keywords" multiple="multiple" class="form-control select2">
                                <option value="">Select country</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="primary_name">Primary Contact Person</label>
                            <input type="text" name="primary_name" class="form-control" id="primary_name">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="primary_email">Primary Contact Person</label>
                            <input type="text" name="primary_email" class="form-control" id="primary_email">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="primary_m_phone">Primary Mobile Number</label>
                            <input type="number" name="primary_m_phone" class="form-control" id="primary_m_phone">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="position">Position</label>
                            <select id="position" name="position" class="form-control select2">
                                <option value=""> Select position </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="primary_whatsapp">WhatsApp Number</label>
                            <input type="number" name="primary_whatsapp" class="form-control" id="primary_whatsapp">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="primary_line_number">Land Line Number</label>
                            <input type="number" name="primary_line_number" class="form-control" id="primary_line_number">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="custom-control custom-checkbox m-0">
                            <input type="checkbox" class="custom-control-input">
                            <span class="custom-control-label">Contact Supplier For Premium Membership </span>
                        </label>
                    </div>
                </form>
            </div>
            <div class="modal-footer form-row d-flex justify-content-center">
                <div class="">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    &nbsp; &nbsp;
                    <button type="button" class="btn btn-success">Save Supplier</button>
                    &nbsp; &nbsp;
                    <button type="button" class="btn btn-primary">Add Secondary Contact Person</button>
                </div>
            </div>
        </div>
    </div>
</div>


<?php /**PATH C:\wamp64\www\abraa-dash\resources\views/admin/categories/components/edit.blade.php ENDPATH**/ ?>