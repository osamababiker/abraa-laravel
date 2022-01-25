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
 
                    <h1 class="h3 mb-3"> <i class="fa fa-edit"></i> Update verification </h1>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                <form method="post" action="{{ route('suppliersVerification.update') }}">
                                        @csrf 
                                        <input type="hidden" name="verification_id" value="{{ $verification->id }}">
                                        <div class="form-row mt-4">
                                            <div class="col-md-12 form-group autocomplete-supplier">
                                                <label for="search_supplier">Search Supplier</label>
                                                @if($verification->supplier)
                                                    <input type="text" name="search_supplier" value="{{ $verification->supplier->full_name }}" id="search_supplier" class="form-control">
                                                @else 
                                                    <input type="text" placeholder="Search for supplier" name="search_supplier" id="search_supplier" class="form-control">
                                                @endif
                                                <input type="hidden" value="{{ $verification->user_id }}" name="user_id" value="user_id">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6 form-group">
                                                <label for="document_uploaded">Document Uploaded</label>
                                                <select name="document_uploaded" id="document_uploaded" class="form-control select2">
                                                    @if($verification->document_uploaded > 0)
                                                        <option selected value="1">Yes</option>
                                                        <option value="0">No</option>
                                                    @else
                                                        <option selected value="0">No</option>
                                                        <option value="1">Yes</option>
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="paid">Is Paid</label>
                                                <select name="paid" id="paid" class="form-control select2">
                                                    @if($verification->paid == 1)
                                                        <option selected value="1">Yes</option>
                                                        <option value="0">No</option>
                                                    @else
                                                        <option selected value="0">No</option>
                                                        <option value="1">Yes</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12 form-group">
                                                <label for="youtube_link">Youtube Link</label>
                                                <input type="text" value="{{ $verification->youtube_link }}" name="youtube_link" id="youtube_link" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12 form-group">
                                                <label for="about_company">About Company</label>
                                                <textarea name="about_company" class="form-control" id="about_company" cols="30" rows="10">{{ $verification->about_company }}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-row mt-5 d-flex justify-content-center">
                                            <button type="submit" class="btn btn-success">Save Changes</button>
                                            &nbsp; &nbsp;
                                            <a href="{{ route('suppliersVerification.index') }}" type="button" class="btn btn-primary">Go Back</a>
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
            <script src="{{ asset('js/add_verification.js') }}"></script>
            <!-- footer is here -->
            @include('admin.layouts.footer')
