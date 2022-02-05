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

                    <h1 class="h3 mb-3">Manage Abandoned Requests  Table</h1>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header ml-3">
                                    <h5 class="card-title"> You have <span id="buying_request_counter"></span>
                                    Abandoned Requests in this table </h5>
                                    <div class="row">
                                        <a href="{{ route('abandonedRfqs.create') }}" target="_blanck" class="btn btn-primary"> <i class="fa fa-plus"></i> Add New </a>
                                        &nbsp; &nbsp;
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                Tools
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="{{ route('abandonedRfqs.export.excel') }}"
                                                    target="_blank">Export to excel</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">

                                    <div class="row mb-2 m-1">
                                        <div class="col-md-4 form-group">
                                            <label for="product_name">Product Name</label>
                                            <input type="text" name="product_name" id="product_name"
                                                class="filter_data_table form-control" aria-label="Search">
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label for="countries"> Filter By Country</label>
                                            <select name="countries[]" multiple="multiple" id="countries"
                                                class="filter_data_table form-control select2">
                                                <option value=""> choose country </option>
                                                @foreach($countries as $country)
                                                <option value="{{ $country->en_name }}">{{ $country->en_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4 form-group">
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

                                    <form action="{{ route('abandonedRfqs.actions') }}" id="buying_request_actions_form" method="post">
                                        @csrf
                                        <div class="table-container">
                                            <table id="" class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th> <input type="checkbox" class="select_all_colums"> </th>
                                                        <th>Id</th>
                                                        <th>Buyer Name</th>
                                                        <th>Buyer Phone</th>
                                                        <th>Buyer Country</th>
                                                        <th>Item Link</th>
                                                        <th>Product Name</th>
                                                        <th>Product Details</th>
                                                        <th>Quantity</th>
                                                        <th>Unit</th>
                                                        <th>Buying Frequency</th>
                                                        <th>Date Added</th> 
                                                        <th>Last Updated </th>
                                                        <th> Actions </th>
                                                    </tr>
                                                </thead>
                                                <tbody id="buying_requests_table_body">

                                                </tbody>
                                            </table> 
                                            <div id="pagination" class="d-flex justify-content-center">
                                            </div>
                                        </div>
                                        @if(session()->has('feedback'))
                                            @include('admin.layouts.feedback')
                                        @endif
                                        @include('admin.rfqs.abandoned_buying_requets.components.delete_selected')
                                        @include('admin.rfqs.abandoned_buying_requets.components.approve_selected')
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </main>

            <!-- scripts is here -->
            @include('admin.layouts.scripts')
            <script type="text/javascript">var csrf_token = "<?= csrf_token() ?>";</script>
            <script type="text/javascript">var public_url = "<?= config('global.public_url') ?>";</script>
              
            @include('admin.layouts.select_feedback')
            <script>
                $('.action_btn').on('click', function(e){
                    var target_modal = $(this).attr('data-target');
                    e.preventDefault();
                    var checkbox = $('.selected_items');
                    if(!checkbox.is(":checked")){
                        $('#not_checked_modal_title').text("Plase Select the Payment Option First");
                        $('#not_checked_modal').modal('show');
                    }else {
                        $(target_modal).modal('show');
                    }
                });
                $("form").submit(function(e){
                    var checkbox = $('.selected_items');
                    if(!checkbox.is(":checked")){
                        e.preventDefault();
                        $('#not_checked_modal_title').text("Plase Select Buying Request First");
                        $('#not_checked_modal').modal('show');
                    }
                });
            </script>
            <script src="{{ asset('js/dataTables/abandonedRfqsDataTable.js') }}"></script>
            <!-- footer is here -->
            @include('admin.layouts.footer')


