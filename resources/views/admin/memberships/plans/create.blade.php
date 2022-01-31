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
 
                    <h1 class="h3 mb-3"> <i class="fa fa-plus"></i> Add New Membership Plans </h1>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <form method="post" action="{{ route('membershipsPlans.store') }}">
                                        @csrf 
                                        <div class="form-row mt-4">
                                            <div class="col-md-6 form-group">
                                                <label for="name">Plan Name</label>
                                                <input type="text" name="name" id="name" class="form-control">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="code">Plan Code</label>
                                                <input type="text" name="code" id="code" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-row mt-4">
                                            <div class="col-md-6 form-group">
                                                <label for="package_price">Plan Price</label>
                                                <input type="text" name="package_price" id="package_price" class="form-control">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="duration">Plan Duration</label>
                                                <input type="text" name="duration" id="duration" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-row mt-4">
                                            <div class="col-md-6 form-group">
                                                <label for="sales">Sales</label>
                                                <select name="sales" id="sales" class="form-control select2">
                                                    <option value="1">Yes</option>
                                                    <option value="0">No</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="country_code">Country Code</label>
                                                <select name="country_code" id="country_code" class="form-control select2">
                                                    <option value=""></option>
                                                    @foreach($countries as $country)
                                                        <option value="{{ $country->co_code }}">{{ $country->co_code }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12 form-group">
                                                <label for="short_description">Plan Shor Description</label>
                                                <textarea name="short_description" cols="3" rows="3" id="short_description" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-row mt-5 d-flex justify-content-center">
                                            <button type="submit" class="btn btn-success">Save Plan</button>
                                            &nbsp; &nbsp;
                                            <a href="{{ route('membershipsPlans.index') }}" type="button" class="btn btn-primary">Go Back</a>
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
