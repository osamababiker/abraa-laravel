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

                    <h1 class="h3 mb-3"> <i class="fa fa-plus"></i> Add New Shipping Company </h1>

                    
                    @if ($errors->any())
                        <div class="alert alert-danger pt-2">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif 

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <form method="post" action="{{ route('shipping.store') }}">
                                        @csrf 
                                        <div class="form-row mt-4">
                                            <div class="col-md-6 required form-group">
                                                <label for="company_name">Company Name</label>
                                                <input type="text" name="company_name" id="company_name" class="form-control">
                                            </div>
                                            <div class="col-md-6 required form-group">
                                                <label for="sub_of">Select Shipper</label>
                                                <select name="sub_of" id="sub_of" class="form-control select2">
                                                    <option value=""></option>
                                                    @foreach($shippers as $shipper)
                                                        <option value="{{ $shipper->id }}">{{ $shipper->full_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6 required form-group">
                                                <label for="email">Company Email</label>
                                                <input type="email" name="email" id="email" class="form-control">
                                            </div>
                                            <div class="col-md-6 required form-group">
                                                <label for="phone_number">Phone Number</label>
                                                <input type="tel" name="phone_number" id="phone_number" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6 required form-group">
                                                <label for="shipping_from">Shipping From</label>
                                                <select name="shipping_from" id="shipping_from" class="form-control select2">
                                                    <option value="all">All</option>
                                                    @foreach($countries as $country)
                                                        <option value="{{ $country->co_code }}">{{ $country->en_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6 required form-group">
                                                <label for="shipping_to">Shipping To</label>
                                                <select name="shipping_to" id="shipping_to" class="form-control select2">
                                                    <option value="all">All</option>
                                                    @foreach($countries as $country)
                                                        <option value="{{ $country->id }}">{{ $country->en_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12 required form-group">
                                                <label for="shipping_methods">Shipping Methods</label>
                                                <select name="shipping_methods" id="shipping_methods" class="form-control select2">
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
                                            <div class="col-md-4 required form-group">
                                                <label for="clearance">clearance</label>
                                                <select name="clearance" id="clearance" class="form-control select2">
                                                    <option selected value="0">No</option>
                                                    <option value="1">Yes</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4 required form-group">
                                                <label for="doortodoor">Door To Door</label>
                                                <select name="doortodoor" id="doortodoor" class="form-control select2">
                                                    <option selected value="0">No</option>
                                                    <option value="1">Yes</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4 required form-group">
                                                <label for="status">Is Active</label>
                                                <select name="status" id="status" class="form-control select2">
                                                    <option selected value="0">Not Active</option>
                                                    <option value="1">Active</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row mt-5 d-flex justify-content-center">
                                            <button type="submit" class="btn btn-success">Save Shipping Company</button>
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
