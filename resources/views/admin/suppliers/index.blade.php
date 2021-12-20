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

                    <h1 class="h3 mb-3">Manage Suppliers Table</h1>

                    <form id="suppliers_actions_form" action="{{ route('suppliers.actions') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title"> You have <span id="suppliers_counter"></span> supplier in this table </h5>
                                         
                                        <div class="row ml-1">
                                            <a href="{{ route('suppliers.create') }}" class="btn btn-primary"> <i class="fa fa-plus"></i> Add New  </a>
                                            &nbsp; &nbsp;
                                            <button type="button" data-toggle="modal" data-target="#delete_selected_confirm" class="btn btn-danger"> <i class="fa fa-trash"></i> Archive Selected  </button>
                                            &nbsp; &nbsp;
                                            <a target="_blank" href="{{ route('mail.editor') }}"  class="btn btn-info"> <i class="fa fa-envelope"></i> Send Email  </a>
                                            &nbsp; &nbsp;
                                            <button type="button" name="send_sms_multiple" class="btn btn-success"> <i class="fa fa-phone"></i> Send SMS  </button>
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
                                            <div class="col-md-2 form-group">
                                                <label for="search_by_name">Search suppliers by Name</label>
                                                <input type="text" name="search_query" id="supplier_name" class="filter_data_table form-control" aria-label="Search">
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <label for="filter_by_country">Filter by Country</label>
                                                <select name="country[]" multiple="multiple" id="filter_by_country" class="filter_data_table form-control select2">
                                                    <option value=""> choose country </option>
                                                    @foreach($countries as $country)
                                                        <option value="{{ $country->co_code }}">{{ $country->en_name }}</option>
                                                    @endforeach 
                                                </select>
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <label for="filter_by_keywords">Filter by Keywords</label>
                                                <select name="keywords[]" multiple="multiple" id="filter_by_keywords" class="filter_data_table form-control select2">
                                                    <option value=""> enter keywords </option>
                                                </select>
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <label for="filter_by_level">Filter by level</label>
                                                <select name="level[]" multiple="multiple" id="filter_by_level" class="filter_data_table form-control select2">
                                                    <option value=""> choose level </option>
                                                </select>
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <label for="filter_by_products_title">Filter by products title</label>
                                                <select name="products_title[]" multiple="multiple" id="filter_by_products_title" class="filter_data_table form-control select2">
                                                    <option value=""> enter words </option>
                                                </select>
                                            </div>
                                            <div class="col-md-2 form-group">
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
                                                    <th> <input type="checkbox" name="all_colums" class="select_all_colums"> </th>
                                                    <th>Id</th>
                                                    <th>Full Name</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>Date Registered</th>
                                                    <th>Verified</th>
                                                    <th>Country</th>
                                                    <th>Company</th>
                                                    <th>Is Organic</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead> 
                                            <tbody id="suppliers_table_body">
                                                
                                            </tbody>
                                        </table>
                                        
                                        @include('admin.suppliers.components.delete_selected')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </main>

            <!-- footer is here -->
            @include('admin.layouts.footer')
