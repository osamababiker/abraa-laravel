@include('admin.layouts.header')


<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-behavior="sticky">
    <div class="wrapper">
        
        @include('admin.layouts.loader')

        <!-- main sidebar here -->
        @include('admin.layouts.sidebar')

        <div class="main">

            <!-- main nav here -->
            @include('admin.layouts.nav') 

            <main class="content">
                <div class="container-fluid p-0"> 

                    <h1 class="h3 mb-3">Home Ads Categories Table</h1>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header"> 
                                    <h5 class="card-title"> You have <span id="adsCategories_counter"></span> Ads Category in this table  </h5>
                                    <div class="row">
                                        <button class="btn btn-primary"> <i class="fa fa-plus"></i> Add New  </button>
                                        &nbsp; &nbsp;
                                        <button type="button"  data-toggle="modal" data-target="#delete_selected_confirm" class="btn btn-danger">  <i class="fa fa-trash"></i> Archive Selected  </button>
                                        &nbsp; &nbsp;
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Tools
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="{{ route('adsCategories.export.excel') }}" target="_blank">Export to excel</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">

                                    <div class="row mb-2 m-1">
                                        <div class="col-md-4 form-group">
                                            <label for="ads_category_name">Ads Category Name</label>
                                            <input type="text" name="ads_category_name" id="ads_category_name" class="filter_data_table form-control" aria-label="Search">
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label for="filter_by_category">Filter By Category</label>
                                            <select name="filter_by_category" multiple="multiple" id="filter_by_category" class="filter_data_table form-control select2">
                                                @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->en_title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label for="rows_numbers">Numbers of rows</label>
                                            <select name="rows_numbers" id="rows_numbers" class="filter_data_table form-control select2">
                                                <option value="10"> 10 </option>
                                                <option value="100"> 100 </option>
                                                <option value="500"> 500 </option>
                                                <option value="1000"> 1000 </option>
                                            </select>
                                        </div>
                                    </div>

                                    <table id="datatables-reponsive" class="table table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th> <input type="checkbox" class="select_all_colums"> </th>
                                                <th>Name</th>
                                                <th>Category</th>
                                                <th>Ads</th>
                                                <th>Is Active</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="ads_categories_table_body">
                            
                                        </tbody>
                                    </table>
                                    @include('admin.home.adsCategories.components.delete_selected')
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </main>

            <!-- scripts is here -->
            @include('admin.layouts.scripts')
            <script src="{{ asset('js/dataTables/adsCategoriesDataTable.js') }}"></script>
            <!-- footer is here -->
            @include('admin.layouts.footer')
