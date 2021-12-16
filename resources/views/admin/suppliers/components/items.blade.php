<div class="modal fade" id="supplier_items_{{ $supplier->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $supplier->full_name }} Items </h5>
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
                @if($supplier->items)
                @foreach($supplier->items as $item)
                <div class="row">
                    <div class="col-md-4 text-center">
                        <div class="border">
                            <div class="card-body">
                                {{ $item->id }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="border">
                            <div class="card-body">
                                {{ $item->title }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="border">
                            <div class="card-body">
                                <a href="#" type="button" data-toggle="modal" data-target="#edit_supplier_{{ $supplier->id }}"><i class="align-middle" data-feather="edit-2"></i></a>
                                <a href="#"><i class="align-middle" data-toggle="modal" data-target="#delete_supplier_{{ $supplier->id }}" data-feather="trash"></i></a>
                                <a href="#"><i class="align-middle" data-toggle="modal" data-target="#view_supplier_{{ $supplier->id }}" data-feather="eye"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
