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

                    <h1 class="h3 mb-3">Manage Buyers Table</h1>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title"> You have <span id="buyers_counter"></span> buyer in this
                                        table </h5>
                                    <div class="row">
                                        <button class="btn btn-primary"> <i class="fa fa-plus"></i> Add New </button>
                                        &nbsp; &nbsp;
                                        <button class="btn btn-secondary"> Send Questionnaire </button>
                                        &nbsp; &nbsp;
                                        <button class="btn btn-info"> Send Reminder </button>
                                        &nbsp; &nbsp;
                                        <button type="button" data-toggle="modal" data-target="#delete_selected_confirm"
                                            class="btn btn-danger"> <i class="fa fa-trash"></i> Archive Selected
                                        </button>
                                        &nbsp; &nbsp;
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                Tools
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="{{ route('buyers.export.excel') }}"
                                                    target="_blank">Export to excel</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">

                                    <div class="row mb-2 m-1">
                                        <div class="col-md-3 form-group">
                                            <label for="buyer_name">Search Buyers by Name</label>
                                            <input type="text" name="buyer_name" id="buyer_name"
                                                class="filter_data_table form-control" aria-label="Search">
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label for="filter_by_country">Filter by Country</label>
                                            <select name="country[]" multiple="multiple" id="filter_by_country"
                                                class="filter_data_table form-control select2">
                                                <option value=""> choose country </option>
                                                @foreach($countries as $country)
                                                <option value="{{ $country->co_code }}">{{ $country->en_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label for="filter_by_keywords">Filter by Keywords</label>
                                            <select name="keywords[]" multiple="multiple" id="filter_by_keywords"
                                                class="filter_data_table form-control select2">
                                                <option value=""> enter keywords </option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label for="rows_numbers">Numbers of rows</label>
                                            <select name="rows_numbers" id="rows_numbers"
                                                class="filter_data_table form-control select2">
                                                <option value="10"> 10 </option>
                                                <option value="100"> 100 </option>
                                                <option value="500"> 500 </option>
                                                <option value="1000"> 1000 </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="table_wrapper_1">
                                        <div class="table_div_1"></div>
                                    </div>
                                    <div class="table_wrapper_2">
                                        <div class="table_div_2">
                                            <table id="" class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th> <input type="checkbox" class="select_all_colums"> </th>
                                                        <th>Id</th>
                                                        <th>Full name</th>
                                                        <th>Email</th>
                                                        <th>Phone</th>
                                                        <th>Date Registered</th>
                                                        <th>Verified</th>
                                                        <th>Country</th>
                                                        <th>Company</th>
                                                        <th>Is Organic</th>
                                                        <th>Source</th>
                                                        <th> Actions </th>
                                                    </tr>
                                                </thead>
                                                <tbody id="buyers_table_body">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    @include('admin.buyers.components.delete_selected')
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </main>

            <!-- scripts is here -->
            @include('admin.layouts.scripts')
            <script src="{{ asset('js/dataTables/buyersDataTable.js') }}"></script>
            <!-- footer is here -->
            @include('admin.layouts.footer')