<div class="modal fade" id="approve_buying_request_" tabindex="-1" role="dialog" aria-hidden="false" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Approve Selected buying requests</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body m-3">
            <div class="form-row mt-4">
                    <div class="form-group col-md-12">
                        <label for="category_search">Suppliers by Category</label>
                        <input type="text" name="category_search" class="form-control" id="category_search"
                            placeholder="category_search">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="product_search">Suppliers by Products</label>
                        <input type="text" name="product_search" class="form-control" id="product_search"
                            placeholder="product_search">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="buyer_name">Buyer Name</label>
                        <input type="text" name="buyer_name" class="form-control" id="buyer_name"
                            placeholder="buyer_name">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="buyer_phone">Buyer Phone</label>
                        <input type="text" name="buyer_phone" class="form-control" id="buyer_phone">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="buyer_keywords">Buyer Keywords</label>
                        <select name="buyer_keywords" multiple="multiple" id="buyer_keywords" class="form-control select2">
                            <option value=""></option>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="rfq_name">RFQ Name</label>
                        <input type="text" name="rfq_name" class="form-control" id="rfq_name">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="rfq_details">RFQ Details</label>
                        <textarea rows="4" cols="4" name="rfq_details" class="form-control" id="rfq_details">
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="justify-content: center;">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" name="approve_btn"  class="btn btn-success">Approve</button>
            </div>
        </div>
    </div>
</div>
