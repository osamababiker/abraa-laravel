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
 
                    <h1 class="h3 mb-3"> <i class="fa fa-plus"></i> Add New Home Page Buyer </h1>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <form method="post" action="{{ route('homePageBuyers.store') }}" enctype="multipart/form-data">
                                        @csrf 
                                        <div class="form-row mt-4">
                                            <div class="col-md-6 form-group">
                                                <label for="buyername">Buyer Name</label>
                                                <input type="text" name="buyername" id="buyername" class="form-control">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="buyer_link">Buyer Link</label>
                                                <input type="text" name="buyer_link" id="buyer_link" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <div class="file-drop-area"> 
                                                    <span class="choose-file-button">Choose buyer Logo</span> 
                                                    <input type="file" name="buyer_logo" id="buyer-input" class="file-input" accept=".jfif,.jpg,.jpeg,.png,.gif"> 
                                                </div>
                                                <div id="buyer_preview"></div>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="status"> Choose Status </label>
                                                <select name="status" id="status" class="form-control select2">
                                                    <option value=""></option>
                                                    <option value="1">Active</option>
                                                    <option value="0">Not Active</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row mt-5 d-flex justify-content-center">
                                            <button type="submit" class="btn btn-success">Save Buyer</button>
                                            &nbsp; &nbsp;
                                            <a href="{{ route('homePageBuyers.index') }}" type="button" class="btn btn-primary">Go Back</a>
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
            <script src="{{ asset('js/add_home_buyer.js') }}"></script>
            <!-- footer is here -->
            @include('admin.layouts.footer')
