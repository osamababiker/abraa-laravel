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

                    <h1 class="h3 mb-3"> <i class="fa fa-plus"></i> Add New Shipper </h1>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <form method="post" action="{{ route('shippers.store') }}">
                                        @csrf 
                                        <div class="form-row mt-4">
                                            <div class="col-md-6 form-group">
                                                <label for="full_name">Full Name</label>
                                                <input type="text" name="full_name" id="full_name" class="form-control">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="email">Email</label>
                                                <input type="text" name="email" id="email" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6 form-group">
                                                <label for="country">Country</label>
                                                <select name="country" id="country" class="form-control select2">
                                                    <option value=""></option>
                                                    @foreach($countries as $country)
                                                        <option value="{{ $country->co_code }}">{{ $country->en_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="city">City</label>
                                                <select name="city" id="city" class="form-control select2">
                                                    <option value=""></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6 form-group">
                                                <label for="phone">Phone</label>
                                                <input type="tel" name="phone" class="form-control" id="phone">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="password">Password</label>
                                                <input type="password" name="password" class="form-control" id="password">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12 form-group">
                                                <label for="verified">Is Verified</label>
                                                <select name="verified" id="verified" class="form-control select2">
                                                    <option selected value="0">No</option>
                                                    <option value="1">Yes</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row mt-5 d-flex justify-content-center">
                                            <button type="submit" class="btn btn-success">Save Shipper</button>
                                            &nbsp; &nbsp;
                                            <a href="{{ route('shippers.index') }}" type="button" class="btn btn-primary">Go Back</a>
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
            <script src="{{ asset('js/add_shipper.js') }}"></script>
            <!-- footer is here -->
            @include('admin.layouts.footer')
