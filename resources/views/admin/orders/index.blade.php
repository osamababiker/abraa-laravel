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

                    <h1 class="h3 mb-3">orders Table</h1>

                    <form action="{{ route('orders.actions') }}" id="orders_actions_form" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header ml-3">
                                        <h5 class="card-title"> You have <span id="orders_counter"></span> order in this
                                            table </h5>
                                        <div class="row"> 
                                            <button type="button"
                                                data-target="#delete_selected_confirm" class="btn btn-danger action_btn"> <i
                                                    class="fa fa-trash"></i> Delete Selected </button>
                                            &nbsp; &nbsp;
                                            <button type="button" data-target="#approve_selected_confirm"
                                                class="btn btn-success action_btn"> <i class="fa fa-check"></i> Approve Selected
                                            </button> 
                                            &nbsp; &nbsp;
                                            <button type="button" data-target="#reject_selected_confirm"
                                                class="btn btn-warning action_btn"> <i class="fa fa-times"></i> Reject Selected
                                            </button>  
                                            &nbsp; &nbsp; 
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    Tools
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-order" href="{{ route('orders.export.excel') }}"
                                                        target="_blank">Export to excel</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">

                                        <div class="row mb-2 m-1">
                                            <div class="col-md-2 form-group">
                                                <label for="user_name">Filter By User Name</label>
                                                <input type="text" name="user_name" id="user_name"
                                                    class="filter_data_table form-control" aria-label="Search">
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <label for="order_type">Filter by Order Type</label>
                                                <select name="order_type" id="order_type"
                                                    class="filter_data_table form-control select2">
                                                    <option value="">  </option>
                                                    <option value="1"> Product Order </option>
                                                    <option value="2"> Buy Request Order </option>
                                                    <option value="3"> Plans Order </option>
                                                </select>
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <label for="order_status">Filter by Order Status</label>
                                                <select name="order_status" id="order_status"
                                                    class="filter_data_table form-control select2">
                                                    <option value="">  </option>
                                                    @foreach($order_statuses as $status)
                                                        <option value="{{ $status->id }}">{{ $status->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <label for="countries"> Filter By Country</label>
                                                <select name="countries[]" multiple="multiple"
                                                    id="countries"
                                                    class="filter_data_table form-control select2">
                                                    <option value="">  </option>
                                                    @foreach($countries as $country)
                                                    <option value="{{ $country->co_code }}">{{ $country->en_name }}</option>
                                                    @endforeach
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

                                        <div class="table-container">
                                            <table id="" class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th> <input type="checkbox" class="select_all_colums"> </th>
                                                        <th>Id</th>
                                                        <th>Approve/Reject</th>
                                                        <th>Full Name</th>
                                                        <th>Email</th>
                                                        <th>Phone</th>
                                                        <th>Country</th>
                                                        <th>Sub Total (AED)</th>
                                                        <th>Total Price </th>
                                                        <th>Shipping Cost </th>
                                                        <th>Currency</th>
                                                        <th>Payment Gateway</th>
                                                        <th>Payment Status</th>
                                                        <th>Order Status</th>
                                                        <th>Created at</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="orders_table_body">

                                                </tbody>
                                            </table>
                                            <div id="pagination" class="d-flex justify-content-center">
                                            </div>
                                        </div>
                                        @include('admin.orders.components.delete_selected')
                                        @include('admin.orders.components.approve_selected')
                                        @include('admin.orders.components.reject_selected')
                                        @if(session()->has('feedback'))
                                            @include('admin.layouts.feedback')
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

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
                        $('#not_checked_modal_title').text("Plase Select the Orders First");
                        $('#not_checked_modal').modal('show');
                    }else {
                        $(target_modal).modal('show');
                    }
                });
                $("form").submit(function(e){
                    var checkbox = $('.selected_items');
                    if(!checkbox.is(":checked")){
                        e.preventDefault();
                        $('#not_checked_modal_title').text("Plase Select the Orders First");
                        $('#not_checked_modal').modal('show');
                    }
                });
            </script>
            <script src="{{ asset('js/dataTables/ordersDataTable.js') }}"></script>
            <!-- footer is here -->
            @include('admin.layouts.footer')