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

                    <h1 class="h3 mb-3"> <i class="fa fa-plus"></i> Add New Buying Request </h1>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <form method="post" action="{{ route('rfqs.store') }}">
                                        @csrf
                                        <div class="form-row">
                                            <div class="form-group col-md-12 autocomplete autocomplete-buyer">
                                                <label for="buyer_search">Select Buyer</label>
                                                <input type="hidden" name="buyer_id" id="buyer_id">
                                                <input name="buyer_search" type="text" class="form-control" id="buyer_search">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12 autocomplete autocomplete-product">
                                                <label for="product_search">Select Product</label>
                                                <input type="hidden" name="item_id" id="item_id">
                                                <input name="product_search" type="text" class="form-control" id="product_search">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="product_name">Product Name</label>
                                                <input name="product_name" type="text" class="form-control" id="product_name">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="quantity">Quantity</label>
                                                <input name="quantity" type="number" class="form-control" id="quantity">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="product_detail">Product Details</label>
                                                <textarea name="product_detail" id="product_detail" cols="30" rows="10" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="unit_id">Select Unit</label>
                                                <select name="unit_id" id="unit_id" class="form-control select2">
                                                    <option value=""></option>
                                                    @foreach($units as $unit)
                                                        <option value="{{ $unit->id }}">{{ $unit->unit_en }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="buying_frequency_id">Buying Frequency</label>
                                                <select name="buying_frequency_id" id="buying_frequency_id" class="form-control select2">
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
                                                <input type="text" class="form-control" name="reference_url" id="reference_url">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="target_price">Target Price</label>
                                                <input name="target_price" type="text" class="form-control" id="target_price">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="validity">Validity</label>
                                                <input name="validity" type="text" class="form-control ymd_datepicker" id="validity">
                                            </div>
                                        </div>
                                        <div class="form-row d-flex justify-content-center">
                                            <a href="{{ route('rfqs.index') }}" class="btn btn-secondary">Go Back</a>
                                            &nbsp;&nbsp;
                                            <button type="submit" class="btn btn-success">Save Buying Request</button>
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
