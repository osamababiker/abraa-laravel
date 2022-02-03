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
 
                    <h1 class="h3 mb-3"> <i class="fa fa-plus"></i> Add New Item File </h1>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                <form method="post" action="{{ route('itemsFiles.store') }}" enctype="multipart/form-data">
                                        @csrf 
                                        <div class="form-row mt-4">
                                            <div class="col-md-6 autocomplete-item">
                                                <label for="search_item">Search For item</label>
                                                <input type="hidden" name="item_id" id="item_id">
                                                <input type="text" class="form-control" name="search_item" id="search_item">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="is_main"> Is Main Image ? </label>
                                                <select name="is_main" id="is_main" class="form-control select2">
                                                    <option value=""></option>
                                                    <option value="1">Yes</option>
                                                    <option value="0">No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row mt-4">
                                            <div class="col-md-6">
                                                <div class="file-drop-area"> 
                                                    <span class="choose-file-button">Choose Image</span> 
                                                    <input type="file" name="file" id="file-input" class="file-input" accept=".jfif,.jpg,.jpeg,.png,.gif"> 
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div id="itme_file_preview"></div>
                                            </div>
                                        </div>
                                        <div class="form-row mt-5 d-flex justify-content-center">
                                            <button type="submit" class="btn btn-success">Save file</button>
                                            &nbsp; &nbsp;
                                            <a href="{{ route('itemsFiles.index') }}" type="button" class="btn btn-primary">Go Back</a>
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
            <script src="{{ asset('js/add_item_file.js') }}"></script>
            <!-- footer is here -->
            @include('admin.layouts.footer')
