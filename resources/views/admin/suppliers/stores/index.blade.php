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

                    <h1 class="h3 mb-3">{{ $supplier->full_name }} stores Table</h1>

                    <form action="{{ route('suppliers.stores.actions',['id' => $supplier->id]) }}" id="supplier_stores_actions_form" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title"> {{ $supplier->full_name }} Has <span id="stores_counter"></span> store  </h5>
                                        <div class="row">
                                            <a href="{{ route('suppliers.stores.create',['id' => $supplier->id]) }}" class="btn btn-primary"> <i class="fa fa-plus"></i> Add New
                                            </a>
                                            &nbsp; &nbsp;
                                            <button type="button" data-target="#delete_selected_confirm" class="btn btn-danger action_btn"> <i
                                                    class="fa fa-trash"></i> Delete Selected </button>
                                            &nbsp; &nbsp;
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    Tools
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-supplier_store" href="{{ route('suppliers.stores.export.excel',['id' => $supplier->id]) }}"
                                                        target="_blank">Export to excel</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">

                                        <div class="row mb-2 m-1">
                                            <div class="col-md-2 form-group">
                                                <label for="store_name">Store Name</label>
                                                <input type="text" name="store_name" id="store_name"
                                                    class="filter_data_table form-control" aria-label="Search">
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <label for="stores_status">Filter by Status</label>
                                                <select name="stores_status" id="stores_status"
                                                    class="filter_data_table form-control select2">
                                                    <option value=""> All Stores </option>
                                                    <option value="active"> Active Stores </option>
                                                    <option value="pending"> Pending Stores </option>
                                                    <option value="rejected"> Rejected Stores </option>
                                                    <option value="home"> Bulk Stores </option>
                                                </select>
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <label for="store_country"> Filter by Country</label>
                                                <select name="store_country[]" multiple="multiple" id="store_country"
                                                    class="filter_data_table form-control select2">
                                                    <option value=""> choose country </option>
                                                    @foreach($countries as $country)
                                                    <option value="{{ $country->co_code }}">{{ $country->en_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <label for="meta_keyword">Filter by Keywords</label>
                                                <select name="meta_keyword[]" multiple="multiple" id="meta_keyword"
                                                    class="filter_data_table form-control select2">

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

                                        <div class="table-container">
                                            <table id="" class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th> <input type="checkbox" name="all_colums"
                                                                class="select_all_colums"> </th>
                                                        <th>Id</th>
                                                        <th>Registered Email</th>
                                                        <th>Store Name</th>
                                                        <th>Sub Domain</th>
                                                        <th>Visits</th>
                                                        <th>Store Verified</th>
                                                        <th>Contact Count</th>
                                                        <th>Date Added </th>
                                                        <th>Reminders Sent</th>
                                                        <th> Actions </th>
                                                    </tr>
                                                </thead>
                                                <tbody id="stores_table_body">

                                                </tbody>
                                            </table>
                                            <div id="pagination" class="d-flex justify-content-center">
                                            </div>
                                        </div>
                                        @include('admin.suppliers.stores.components.delete_selected')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </main>

            <!-- scripts is here -->
            @if(session()->has('feedback'))
                @include('admin.layouts.feedback')
            @endif
            
            @include('admin.layouts.select_feedback')
            
            <!-- scripts is here -->
            @include('admin.layouts.scripts')
            <script type="text/javascript">var supplier_id = "<?= $supplier->id ?>";</script>
            <script type="text/javascript">var csrf_token = "<?= csrf_token() ?>";</script>
            <script>
                $('.action_btn').on('click', function(e){
                    var target_modal = $(this).attr('data-target');
                    e.preventDefault();
                    var checkbox = $('.selected_items');
                    if(!checkbox.is(":checked")){
                        $('#not_checked_modal_title').text("Plase Select the Stores First");
                        $('#not_checked_modal').modal('show');
                    }else {
                        $(target_modal).modal('show');
                    }
                });
                $("form").submit(function(e){
                    var checkbox = $('.selected_items');
                    if(!checkbox.is(":checked")){
                        e.preventDefault();
                        $('#not_checked_modal_title').text("Plase Select the Stores First");
                        $('#not_checked_modal').modal('show');
                    }
                });
            </script>
            <script src="{{ asset('js/dataTables/supplierStoresDataTable.js') }}"></script>
            <!-- footer is here -->
            @include('admin.layouts.footer')