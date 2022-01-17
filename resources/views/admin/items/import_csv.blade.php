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

                    <h1 class="h3 mb-3"> <i class="fa fa-upload"></i> Import Items From CSV File </h1>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ route('items.import.excel') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-row">
                                            <div class="form-group col-md-6 autocomplete-supplier">
                                                <label for="supplier_search">Search For Supplier</label>
                                                <input type="text" id="supplier_search" class="form-control autocomplete">
                                            </div>
                                            <div class="form-group col-md-6 autocomplete-category">
                                                <label for="category_search">Search For Category</label>
                                                <input type="text" id="category_search" class="form-control autocomplete">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="csv_file">Choose File</label>
                                                <input type="file" name="csv_file" class="form-control" id="csv_file">
                                            </div>
                                        </div>
                                        
                                        <input type="hidden" name="supplier_id" id="supplier_id">
                                        <input type="hidden" name="category_id" id="category_id">

                                        <div class="form-row d-flex justify-content-center">
                                            <button type="submit" class="btn btn-primary">Import</button>
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
            <script src="{{ asset('js/import_items.js') }}"></script>
            <!-- footer is here -->
            @include('admin.layouts.footer')
