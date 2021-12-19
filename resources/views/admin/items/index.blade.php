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

                    <h1 class="h3 mb-3">Items Table</h1>

                    <form action="{{ route('items.actions') }}" id="items_actions_form" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title"> You have <span id="filter_counter"></span> item in this table  </h5>
                                        <div class="row">
                                            <button class="btn btn-primary"> <i class="fa fa-plus"></i> Add New  </button>
                                            &nbsp; &nbsp;
                                            <button type="button"  data-toggle="modal" data-target="#delete_selected_confirm" class="btn btn-danger"> <i class="fa fa-trash"></i> Delete Selected  </button>
                                            &nbsp; &nbsp;
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Tools
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="#">Export to excel</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">

                                    <div class="row mb-2 m-1">
                                            <div class="col-md-3 form-group">
                                                <label for="product_name">Search Product Name</label>
                                                <input type="text" name="product_name" id="product_name" class="filter_data_table form-control" aria-label="Search">
                                            </div>
                                            <div class="col-md-3 form-group">
                                                <label for="manufacture_country">Filter by manufacturer Country</label>
                                                <select name="manufacture_country[]" multiple="multiple" id="manufacture_country" class="filter_data_table form-control select2">
                                                    <option value=""> choose country </option>
                                                    @foreach($countries as $country)
                                                        <option value="{{ $country->co_code }}">{{ $country->en_name }}</option>
                                                    @endforeach 
                                                </select>
                                            </div>
                                            <div class="col-md-3 form-group">
                                                <label for="meta_keyword">Filter by Keywords</label>
                                                <select name="meta_keyword[]" multiple="multiple" id="meta_keyword" class="filter_data_table form-control select2">
               
                                                </select>
                                            </div>
                                            <div class="col-md-3 form-group">
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
                                                    <th>Id</th>
                                                    <th>Title</th>
                                                    <th>Category</th>
                                                    <th>Link</th>
                                                    <th>Created at</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody id="items_table_body">
                                              
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </main>

            <!-- footer is here -->
            @include('admin.layouts.footer')
