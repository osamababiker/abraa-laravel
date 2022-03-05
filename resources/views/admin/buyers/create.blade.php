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

                    <h1 class="h3 mb-3"> <i class="fa fa-plus"></i> Add New Buyer </h1>

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
                                    <form method="post" action="{{ route('buyers.store') }}">
                                        @csrf
                                        <div class="form-row">
                                            <div class="form-group required col-md-12">
                                                <label for="full_name">Full Name</label>
                                                <input name="full_name" type="text" class="form-control" id="full_name">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group required col-md-6">
                                                <label for="email">Email</label>
                                                <input name="email" type="email" class="form-control" id="email">
                                            </div>
                                            <div class="form-group required col-md-6">
                                                <label for="password">Password</label>
                                                <input name="password" type="password" class="form-control" id="password">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group required col-md-6">
                                                <label for="counter">Country</label>
                                                <select name="country" id="country" class="form-control select2">
                                                    <option value="">Select country</option>
                                                    @foreach($countries as $country)
                                                        <option value="{{ $country->id }}">{{ $country->en_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group required col-md-6">
                                                <label for="city">City</label>
                                                <select name="city" id="city" class="form-control select2">
                                                    <option value="">Select city</option>
                                                </select>
                                            </div>
                                        </div> 
                                        <div class="form-row">
                                            <div class="form-group required col-md-6">
                                                <label for="phone">Phone</label>
                                                <input type="number" class="form-control" name="phone" id="phone">
                                            </div>
                                            <div class="form-group required col-md-6">
                                                <label for="company">Company</label>
                                                <input type="text" class="form-control" name="company" id="company">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group required col-md-12">
                                                <label for="primary_name">Interested Products</label>
                                                <select name="interested_keywords[]" id="interested_keywords" multiple="multiple" class="form-control select2">
                                                    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group required col-md-6">
                                                <label for="verified">Is Verified</label>
                                                <select name="verified" id="verified" class="form-control select2">
                                                    <option value="1">Yes</option>
                                                    <option value="0">No</option>
                                                </select>
                                            </div>
                                            <div class="form-group required col-md-6">
                                                <label for="active">Is Actived</label>
                                                <select name="active" id="active" class="form-control select2">
                                                    <option value="1">Yes</option>
                                                    <option value="0">No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row d-flex justify-content-center">
                                            <button type="submit" class="btn btn-success">Save Buyer</button>
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
            <script src="{{ asset('js/add_buyer.js') }}"></script>
            <!-- footer is here -->
            @include('admin.layouts.footer')
