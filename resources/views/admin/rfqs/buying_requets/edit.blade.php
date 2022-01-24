@include('admin.layouts.header')


<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-behavior="sticky">
    <div class="wrapper">

        <!-- main sidebar here -->
        @include('admin.layouts.sidebar')

        <div class="main">

            <!-- main nav here -->
            @include('admin.layouts.nav')

            <main class="content">
                <div class="container-fluid p-0">

                    <h1 class="h3 mb-3"> <i class="fa fa-edit"></i> Edit Buying Request </h1>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <form method="post" action="{{ route('rfqs.update') }}">
                                        @csrf
                                        <input type="hidden" name="rfq_id" value="{{ $rfq->id }}">
                                        <div class="form-row">
                                            <div class="form-group col-md-12 autocomplete autocomplete-buyer">
                                                <label for="buyer_search">Select Buyer</label>
                                                <input type="hidden" value="{{ $rfq->buyer_id }}" name="buyer_id" id="buyer_id">
                                                @if($rfq->buyer)
                                                    <input name="buyer_search" value="{{ $rfq->buyer->full_name }}" type="text" class="form-control" id="buyer_search">
                                                @else 
                                                    <input name="buyer_search" type="text" class="form-control" id="buyer_search">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12 autocomplete autocomplete-product">
                                                <label for="product_search">Select Product</label>
                                                <input type="hidden" value="{{ $rfq->item_id }}" name="item_id" id="item_id">
                                                @if($rfq->item)
                                                    <input name="product_search" value="{{ $rfq->item->title }}" type="text" class="form-control" id="product_search">
                                                @else 
                                                    <input name="product_search" type="text" class="form-control" id="product_search">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="product_name">Product Name</label>
                                                <input name="product_name" value="{{ $rfq->product_name }}" type="text" class="form-control" id="product_name">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="quantity">Quantity</label>
                                                <input name="quantity" type="number" value="{{ $rfq->quantity }}" class="form-control" id="quantity">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="product_detail">Product Details</label>
                                                <textarea name="product_detail" id="product_detail" cols="30" rows="10" class="form-control">{{ $rfq->product_detail }}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="unit_id">Select Unit</label>
                                                <select name="unit_id" id="unit_id" class="form-control select2">
                                                    @if($rfq->unit)
                                                        <option selected value="{{  $rfq->unit->id  }}">{{ $rfq->unit->unit_en }}</option>
                                                    @else 
                                                        <option value=""></option>
                                                    @endif
                                                    @foreach($units as $unit)
                                                        <option value="{{ $unit->id }}">{{ $unit->unit_en }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="buying_frequency_id">Buying Frequency</label>
                                                <select name="buying_frequency_id" id="buying_frequency_id" class="form-control select2">
                                                    @if($rfq->buying_frequency)
                                                        <option selected value="{{  $rfq->buying_frequency->id  }}">{{ $rfq->buying_frequency->buying_frequency_en }}</option>
                                                    @else 
                                                        <option value=""></option>
                                                    @endif
                                                    <option value=""></option>
                                                    @foreach($buying_frequencies as $buying_frequency)
                                                        <option value="{{ $buying_frequency->id }}">{{ $buying_frequency->buying_frequency_en }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div> 
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="reference_url">Reference URL</label>
                                                <input type="text" value="{{ $rfq->reference_url }}" class="form-control" name="reference_url" id="reference_url">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="target_price">Target Price</label>
                                                <input name="target_price" type="text" value="{{ $rfq->target_price }}" class="form-control" id="target_price">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="validity">Validity</label>
                                                <input name="validity" type="text" value="{{ $rfq->validity }}" class="form-control ymd_datepicker" id="validity">
                                            </div>
                                        </div>
                                        <div class="form-row d-flex justify-content-center">
                                            <a href="{{ route('rfqs.index') }}" class="btn btn-secondary">Go Back</a>
                                            &nbsp;&nbsp;
                                            <button type="submit" class="btn btn-success">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </main>
            @if(session()->has('feedback'))
                @include('admin.layouts.feedback')
            @endif
            @include('admin.layouts.scripts')
            <script src="{{ asset('js/add_buying_request.js') }}"></script>
            <!-- footer is here -->
            @include('admin.layouts.footer')
