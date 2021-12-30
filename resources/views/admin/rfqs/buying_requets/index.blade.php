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

                    <h1 class="h3 mb-3">Manage Pending Quotes Table</h1>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title"> You have <span id="buying_request_counter"></span>
                                        Quotes in this table </h5>
                                    <div class="row">
                                        <button class="btn btn-primary"> <i class="fa fa-plus"></i> Add New </button>
                                        &nbsp; &nbsp;
                                        <button type="button" data-toggle="modal"
                                            data-target="#approve_selected_confirm" class="btn btn-success">
                                            Approve Selected </button>
                                        &nbsp; &nbsp;
                                        <button type="button" data-toggle="modal" data-target="#delete_selected_confirm"
                                            class="btn btn-danger"> <i class="fa fa-trash"></i> Delete Selected
                                        </button>
                                        &nbsp; &nbsp;
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                Tools
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="{{ route('rfqInvoices.export.excel') }}"
                                                    target="_blank">Export to excel</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">

                                    <div class="row mb-2 m-1">
                                        <div class="col-md-2 form-group">
                                            <label for="product_name">Product Name</label>
                                            <input type="text" name="product_name" id="product_name"
                                                class="filter_data_table form-control" aria-label="Search">
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <label for="buying_request_status">Filter by Status</label>
                                            <select name="buying_request_status" id="buying_request_status"
                                                class="filter_data_table form-control select2">
                                                <option value=""> </option>
                                                <option value="pending"> Pending request </option>
                                                <option value="approved"> Approved request </option>
                                                <option value="completed"> Completed request </option>
                                                <option value="lost"> Losted request </option>
                                                <option value="canceled"> Canceled request </option>
                                            </select>
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <label for="shipping_country"> Shipping Country</label>
                                            <select name="shipping_country[]" multiple="multiple" id="shipping_country"
                                                class="filter_data_table form-control select2">
                                                <option value=""> choose country </option>
                                                @foreach($countries as $country)
                                                <option value="{{ $country->co_code }}">{{ $country->en_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <label for="request_type">Filter Request Type</label>
                                            <select name="request_type" id="request_type"
                                                class="filter_data_table form-control select2">
                                                <option value=""> </option>
                                                <option value="global"> Global Request </option>
                                                <option value="normal"> Normal Request </option>
                                            </select>
                                        </div>
                                        <div class="col-md-2 form-group">
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

                                    <form action="{{ route('rfqs.actions') }}" id="buying_request_actions_form" method="post">
                                        @csrf
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
                                                            <th>Type</th>
                                                            <th>Buyer Name</th>
                                                            <th>Phone</th>
                                                            <th>Country</th>
                                                            <th>Buyer Email</th>
                                                            <th>Category</th>
                                                            <th>Product</th>
                                                            <th>Quantity</th>
                                                            <th>Unit</th>
                                                            <th>Status</th> 
                                                            <th> Date Added </th>
                                                            <th> Actions </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="buying_requests_table_body">

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        @if(session()->has('feedback'))
                                            @include('admin.rfqs.buying_requets.components.feedback')
                                        @endif
                                        @include('admin.rfqs.buying_requets.components.delete_selected')
                                        @include('admin.rfqs.buying_requets.components.approve_selected')
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </main>

            <!-- scripts is here -->
            @include('admin.layouts.scripts')
            <script src="{{ asset('js/dataTables/rfqsDataTable.js') }}"></script>
            <!-- footer is here -->
            @include('admin.layouts.footer')


