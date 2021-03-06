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
 
                    <h1 class="h3 mb-3"> <i class="fa fa-plus"></i> Add New country </h1>

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
                                <form method="post" action="{{ route('countries.store') }}">
                                        @csrf 
                                        <div class="form-row mt-4">
                                            <div class="col-md-4 required form-group">
                                                <label for="co_code">country Code</label>
                                                <input type="text" name="co_code" id="co_code" class="form-control">
                                            </div>
                                            <div class="col-md-4 required form-group">
                                                <label for="ph_code">country Phone Code</label>
                                                <input type="number" name="ph_code" id="ph_code" class="form-control">
                                            </div>
                                            <div class="col-md-4 required form-group">
                                                <label for="currency_code">country Currency Code</label>
                                                <input type="text" name="currency_code" id="currency_code" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6 required form-group">
                                                <label for="ar_name">country Arabic Name</label>
                                                <input type="text" name="ar_name" id="ar_name" class="form-control">
                                            </div>
                                            <div class="col-md-6 required form-group">
                                                <label for="en_name">country English Name</label>
                                                <input type="text" name="en_name" id="en_name" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6 form-group">
                                                <label for="tr_name">country Turkish Name</label>
                                                <input type="text" name="tr_name" id="tr_name" class="form-control">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="ru_name">country Russian Name</label>
                                                <input type="text" name="ru_name" id="ru_name" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-row mt-5 d-flex justify-content-center">
                                            <button type="submit" class="btn btn-success">Save Country</button>
                                            &nbsp; &nbsp;
                                            <a href="{{ route('countries.index') }}" type="button" class="btn btn-primary">Go Back</a>
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
