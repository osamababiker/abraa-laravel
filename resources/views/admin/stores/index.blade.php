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

                    <h1 class="h3 mb-3">Manage Stores Table</h1>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header ml-3">
                                    <h5 class="card-title"> You have <span id="stores_counter"></span> store in this
                                        table </h5>
                                    <div class="row">
                                        <a href="{{ route('stores.create') }}" target="_blank" class="btn btn-primary"> <i class="fa fa-plus"></i> Add New </a>
                                        &nbsp; &nbsp;
                                        <button class="btn btn-secondary"> Send Questionnaire </button>
                                        &nbsp; &nbsp;
                                        <button class="btn btn-info"> Send Reminder </button>
                                        &nbsp; &nbsp;
                                        <button type="button" data-target="#delete_selected_confirm"
                                            class="btn btn-danger action_btn"> <i class="fa fa-trash"></i> Delete Selected
                                        </button>
                                        &nbsp; &nbsp;
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                Tools
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="{{ route('stores.export.excel') }}"
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
                                                <option value=""> Select Status </option>
                                                <option value="active"> Active Stores </option>
                                                <option value="pending"> Pending Stores </option>
                                                <option value="rejected"> Rejected Stores </option>
                                                <option value="bulk"> Bulk Stores </option>
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
                                            <label for="subscription">Filter by Subscription</label>
                                            <select name="subscription" id="subscription"
                                                class="filter_data_table form-control select2">
                                                <option value=""></option> 
                                                <option value="3">Platinum</option>
                                                <option value="9">Old Gold</option>
                                                <option value="2">Gold</option>
                                                <option value="1">Silver</option>
                                                <option value="0">Basic</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <label for="date_range">Filter By Date</label>
                                            <input class="filter_data_table form-control ymd_datepicker_range" id="date_range" type="text" name="date_range[]"/>
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

                                    <div class="table-container table-parent-wrapper">
                                        <table class="table table-striped table-child-wrapper">
                                            <thead>
                                                <tr>
                                                    <th> <input type="checkbox" name="all_colums"
                                                            class="select_all_colums"> </th>
                                                    <th>Id</th>
                                                    <th>Registered Email</th>
                                                    <th>Store Name</th>
                                                    <th>Sub Domain</th>
                                                    <th>visiters</th>
                                                    <th>Store Verified</th>
                                                    <th>Contact Count</th>
                                                    <th>Date Added </th>
                                                    <th>Reminders Sent</th>
                                                    <th>Products</th>
                                                    <th> Actions </th>
                                                </tr>
                                            </thead>
                                            <tbody id="stores_table_body">

                                            </tbody>
                                        </table>
                                    </div>
                                    <hr><div id="pagination" class="d-flex justify-content-center"></div>
                                    @if(session()->has('feedback'))
                                        @include('admin.layouts.feedback')
                                    @endif
                                    @include('admin.stores.components.delete_selected')
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </main>

            @include('admin.layouts.select_feedback')
            <!-- scripts is here -->
            @include('admin.layouts.scripts')
            <script type="text/javascript">var csrf_token = "<?= csrf_token() ?>";</script>
            <script type="text/javascript">var public_url = "<?= config('global.public_url') ?>";</script>
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
            <script src="{{ asset('js/dataTables/storesDataTable.js') }}"></script>
            <!-- footer is here -->
            @include('admin.layouts.footer')