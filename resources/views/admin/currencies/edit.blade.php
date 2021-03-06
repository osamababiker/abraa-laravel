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
 
                    <h1 class="h3 mb-3"> <i class="fa fa-edit"></i> Updated currency </h1>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                <form method="post" action="{{ route('currencies.update') }}">
                                        @csrf 
                                        <input type="hidden" name="currency_id" value="{{ $currency->id }}">
                                        <div class="form-row mt-4">
                                            <div class="col-md-4 form-group">
                                                <label for="code">Currency Code</label>
                                                <input type="text" value="{{ $currency->code }}" name="code" id="code" class="form-control">
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <label for="conversion_rate">Currency Conversion Rate</label>
                                                <input type="text" value="{{ $currency->conversion_rate }}" name="conversion_rate" id="conversion_rate" class="form-control">
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <label for="status">Currency status</label>
                                                <select name="status" id="status" class="form-control select2">
                                                    @if($currency->status == 1)
                                                        <option selected value="1">Active</option>
                                                        <option value="0"> Not Active </option>
                                                    @else 
                                                        <option selected value="0"> Not Active </option>
                                                        <option value="1">Active</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6 form-group">
                                                <label for="name_ar">currency Arabic Name</label>
                                                <input type="text" value="{{ $currency->name_ar }}" name="name_ar" id="name_ar" class="form-control">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="name_en">currency English Name</label>
                                                <input type="text" value="{{ $currency->name_en }}" name="name_en" id="name_en" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6 form-group">
                                                <label for="name_tr">currency Turkish Name</label>
                                                <input type="text" value="{{ $currency->name_tr }}" name="name_tr" id="name_tr" class="form-control">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="name_ru">currency Russian Name</label>
                                                <input type="text" value="{{ $currency->name_ru }}" name="name_ru" id="name_ru" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-row mt-5 d-flex justify-content-center">
                                            <button type="submit" class="btn btn-success">Save Changes</button>
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
