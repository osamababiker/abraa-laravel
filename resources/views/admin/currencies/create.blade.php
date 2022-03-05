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
 
                    <h1 class="h3 mb-3"> <i class="fa fa-plus"></i> Add New currency </h1>

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
                                <form method="post" action="{{ route('currencies.store') }}">
                                        @csrf 
                                        <div class="form-row mt-4">
                                            <div class="col-md-4 required form-group">
                                                <label for="code">Currency Code</label>
                                                <input type="text" name="code" id="code" class="form-control">
                                            </div>
                                            <div class="col-md-4 required form-group">
                                                <label for="conversion_rate">Currency Conversion Rate</label>
                                                <input type="text" name="conversion_rate" id="conversion_rate" class="form-control">
                                            </div>
                                            <div class="col-md-4 required form-group">
                                                <label for="status">Currency status</label>
                                                <select name="status" id="status" class="form-control select2">
                                                    <option value="1">Active</option>
                                                    <option value="0">Not Active</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6 required form-group">
                                                <label for="name_ar">currency Arabic Name</label>
                                                <input type="text" name="name_ar" id="name_ar" class="form-control">
                                            </div>
                                            <div class="col-md-6 required form-group">
                                                <label for="name_en">currency English Name</label>
                                                <input type="text" name="name_en" id="name_en" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6 required form-group">
                                                <label for="name_tr">currency Turkish Name</label>
                                                <input type="text" name="name_tr" id="name_tr" class="form-control">
                                            </div>
                                            <div class="col-md-6 required form-group">
                                                <label for="name_ru">currency Russian Name</label>
                                                <input type="text" name="name_ru" id="name_ru" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-row mt-5 d-flex justify-content-center">
                                            <button type="submit" class="btn btn-success">Save currency</button>
                                            &nbsp; &nbsp;
                                            <a href="{{ route('currencies.index') }}" type="button" class="btn btn-primary">Go Back</a>
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
