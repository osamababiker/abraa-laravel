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

                    <h1 class="h3 mb-3">Items Table</h1>

                    <form action="{{ route('items.actions') }}" id="items_actions_form" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header ml-3">
                                        <h5 class="card-title"> You have <span id="items_counter"></span> item in this
                                            table </h5>
                                        <div class="row"> 
                                            <a href="{{ route('items.create') }}" target="_blanck" class="btn btn-primary"> <i class="fa fa-plus"></i> Add New
                                            </a>
                                            &nbsp; &nbsp;
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
                                            <button type="button" data-target="#feature_selected_confirm"
                                                class="btn btn-success action_btn"> <i class="fa fa-star"></i> Feature Selected
                                            </button> 
                                            &nbsp; &nbsp;
                                            <button type="button" data-target="#unfeature_selected_confirm"
                                                class="btn btn-warning action_btn"> <i class="fa fa-star"></i> UnFeature Selected
                                            </button> 
                                            &nbsp; &nbsp;
                                            <button type="button" data-target="#select_pavillion_modal"
                                                class="btn btn-warning action_btn"> <i class="fa fa-flag"></i> Add to Pavillion
                                            </button> 
                                            &nbsp; &nbsp; 
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    Tools
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="{{ route('items.export.excel') }}"
                                                        target="_blank">Export to excel</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">

                                        <div class="row mb-2 m-1">
                                            <div class="col-md-2 form-group">
                                                <label for="product_name">Search Product Name</label>
                                                <input type="text" name="product_name" id="product_name"
                                                    class="filter_data_table form-control" aria-label="Search">
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <label for="item_status">Filter by Status</label>
                                                <select name="item_status" id="items_status"
                                                    class="filter_data_table form-control select2">
                                                    <option value="">  </option>
                                                    <option value="active"> Active Items </option>
                                                    <option value="pending"> Pending Items </option>
                                                    <option value="rejected"> Rejected Items </option>
                                                    <option value="home"> Home Items </option>
                                                    <option value="featured"> Featured Items </option>
                                                    <option value="no_image"> No Image Items</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <label for="store_status">Filter by Store Status</label>
                                                <select name="store_status" id="store_status"
                                                    class="filter_data_table form-control select2">
                                                    <option value="">  </option>
                                                    <option value="active_stores"> Active Stores </option>
                                                    <option value="pending_stores"> Pending Stores </option>
                                                </select>
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <label for="manufacture_country"> manufacturer Country</label>
                                                <select name="manufacture_country[]" multiple="multiple"
                                                    id="manufacture_country"
                                                    class="filter_data_table form-control select2">
                                                    <option value=""> choose country </option>
                                                    @foreach($countries as $country)
                                                    <option value="{{ $country->co_code }}">{{ $country->en_name }}
                                                    </option>
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
                                            <table id="" class="table table-striped table-child-wrapper">
                                                <thead>
                                                    <tr>
                                                        <th> <input type="checkbox" class="select_all_colums"> </th>
                                                        <th>Id</th>
                                                        <th>Title</th>
                                                        <th>Category</th>
                                                        <th>Link</th>
                                                        <th>Status</th>
                                                        <th>Created at</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="items_table_body">

                                                </tbody>
                                            </table>
                                        </div>
                                        <hr><div id="pagination" class="d-flex justify-content-center"></div>
                                        @include('admin.items.components.delete_selected')
                                        @include('admin.items.components.approve_selected')
                                        @include('admin.items.components.reject_selected')
                                        @include('admin.items.components.feature_selected')
                                        @include('admin.items.components.unfeature_selected')
                                        @include('admin.items.components.select_pavillion')
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
                        $('#not_checked_modal_title').text("Plase Select the Items First");
                        $('#not_checked_modal').modal('show');
                    }else {
                        $(target_modal).modal('show');
                    }
                });
                $("form").submit(function(e){
                    var checkbox = $('.selected_items');
                    if(!checkbox.is(":checked")){
                        e.preventDefault();
                        $('#not_checked_modal_title').text("Plase Select the Items First");
                        $('#not_checked_modal').modal('show');
                    }
                });
            </script>
            <script src="{{ asset('js/dataTables/itemsDataTable.js') }}"></script>
            <!-- footer is here -->
            @include('admin.layouts.footer')