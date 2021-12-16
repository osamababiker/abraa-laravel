<div class="modal fade" id="delete_buyer_{{ $buyer->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="/buyers/{{ $buyer->id }}/destroy" id="delete_buyer_form_{{ $buyer->id }}" method="DELETE">
            </form>
            <div class="modal-header">
                <h5 class="modal-title">Archive - {{ $buyer->full_name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body m-3">
                <p class="mb-0">Are you Sure you want to move , {{ $buyer->full_name }} to archive ??</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" form="delete_buyer_form_{{ $buyer->id }}" class="btn btn-danger">Yes Sure</button>
            </div>
        </div>
    </div>
</div>
