<div class="modal fade" id="add_to_pavillion_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Suppliers to Pavillion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body m-3">
                <div class="form-group">
                    <label for="pavillion_id">Select Pavillion</label>
                    <select name="pavillion_id" id="pavillion_id" class="form-control select2">
                        <option value=""></option>
                        @foreach($pavillions as $pavillion)
                            <option value="{{ $pavillion->id }}">{{ $pavillion->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer" style="justify-content: center;">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="add_suppliers_to_pavillion" form="suppliers_actions_form" class="btn btn-success">Save Changes</button>
            </div>
        </div>
    </div>
</div>
