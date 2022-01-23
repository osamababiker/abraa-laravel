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

                    <h1 class="h3 mb-3"> <i class="fa fa-edit"></i> Edit Shipping Company </h1>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <form method="post" action="{{ route('shipping.update') }}">
                                        @csrf 
                                        <input type="hidden" name="shipping_id" value="{{ $shipper->id }}">
                                        <div class="form-row mt-4">
                                            <div class="col-md-6 form-group">
                                                <label for="company_name">Company Name</label>
                                                <input type="text" value="{{ $shipper->company_name }}" name="company_name" id="company_name" class="form-control">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="sub_of">Select Shipper</label>
                                                <select name="sub_of" id="sub_of" class="form-control select2">
                                                    @if($shipper->shipper)
                                                        <option selected value="{{ $shipper->shipper->id }}">{{ $shipper->shipper->full_name }}</option>
                                                    @else 
                                                        <option value=""></option>
                                                    @endif
                                                    @foreach($shippers as $user_shipper)
                                                        <option value="{{ $user_shipper->id }}">{{ $user_shipper->full_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6 form-group">
                                                <label for="email">Company Email</label>
                                                <input type="email" value="{{ $shipper->email }}" name="email" id="email" class="form-control">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="phone_number">Phone Number</label>
                                                <input type="text" value="{{ $shipper->phone_number }}" name="phone_number" id="phone_number" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6 form-group">
                                                <label for="shipping_from">Shipping From</label>
                                                <select name="shipping_from" id="shipping_from" class="form-control select2">
                                                    @if($shipper->shipping_from_country)
                                                        <option selected value="{{ $shipper->shipping_from_country->co_code }}">{{ $shipper->shipping_from_country->en_name }}</option>
                                                    @else 
                                                        <option selected value="all">All</option>
                                                    @endif
                                                    @foreach($countries as $country)
                                                        <option value="{{ $country->co_code }}">{{ $country->en_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="shipping_to">Shipping To</label>
                                                <select name="shipping_to" id="shipping_to" class="form-control select2">
                                                    @if($shipper->shipping_to_country)
                                                        <option selected value="{{ $shipper->shipping_to_country->id }}">{{ $shipper->shipping_to_country->en_name }}</option>
                                                    @else 
                                                        <option selected value="all">All</option>
                                                    @endif
                                                    @foreach($countries as $country)
                                                        <option value="{{ $country->id }}">{{ $country->en_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12 form-group">
                                                <label for="shipping_methods">Shipping Methods</label>
                                                <select name="shipping_methods" id="shipping_methods" class="form-control select2">
                                                    <option selected value="{{ $shipper->shipping_methods }}"></option>
                                                    <option value="7">All</option>
                                                    <option value="1">Sea</option>
                                                    <option value="2">Air</option>
                                                    <option value="3">Land</option>
                                                    <option value="4">Sea & Air</option>
                                                    <option value="5">Sea & Land</option>
                                                    <option value="6">Air & Land</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-4 form-group">
                                                <label for="clearance">clearance</label>
                                                <select name="clearance" id="clearance" class="form-control select2">
                                                    @if($shipper->clearance == 1)
                                                        <option selected value="1">Yes</option>
                                                        <option value="0">No</option>
                                                    @else 
                                                        <option selected value="0">No</option>
                                                        <option value="1">Yes</option>
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <label for="doortodoor">Door To Door</label>
                                                <select name="doortodoor" id="doortodoor" class="form-control select2">
                                                    @if($shipper->doortodoor == 1)
                                                        <option selected value="1">Yes</option>
                                                        <option value="0">No</option>
                                                    @else 
                                                        <option selected value="0">No</option>
                                                        <option value="1">Yes</option>
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <label for="status">Is Active</label>
                                                <select name="status" id="status" class="form-control select2">
                                                    @if($shipper->doortodoor == 1)
                                                        <option selected value="1">Active</option>
                                                        <option value="0">Not Active</option>
                                                    @else 
                                                        <option selected value="0">Not Active</option>
                                                        <option value="1">Active</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row mt-5 d-flex justify-content-center">
                                            <button type="submit" class="btn btn-success">Save Changes</button>
                                            &nbsp; &nbsp;
                                            <a href="{{ route('shipping.index') }}" type="button" class="btn btn-primary">Go Back</a>
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
            <!-- footer is here -->
            @include('admin.layouts.footer')
