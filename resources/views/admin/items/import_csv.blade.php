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
                                            <div class="form-group col-md-6">
                                                <label for="supplier_id">Select Supplier</label>
                                                <select name="supplier_id" id="supplier_id" class="form-control select2">
                                                    <option value=""></option>
                                                    
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="category_id">Select Category</label>
                                                <select name="category_id" id="category_id" class="form-control select2">
                                                    <option value=""></option>
                                                   
                                                </select>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="csv_file">Choose File</label>
                                                <input type="file" name="csv_file" class="form-control" id="csv_file">
                                            </div>
                                        </div>

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
                @include('admin.items.components.feedback')
            @endif
            @include('admin.layouts.scripts') 
            <!-- footer is here -->
            @include('admin.layouts.footer')
