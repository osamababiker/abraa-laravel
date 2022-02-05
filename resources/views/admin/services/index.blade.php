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

                    <h1 class="h3 mb-3">services Table</h1>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header ml-3">
                                    <h5 class="card-title"> You have <span id="services_counter"></span>
                                        service in this table </h5>
                                    <div class="row">
                                        <a href="{{ route('services.create') }}" target="_blanck"  class="btn btn-primary"> <i class="fa fa-plus"></i> Add New </a>
                                        &nbsp; &nbsp;
                                        <button type="button" data-target="#delete_selected_confirm"
                                            class="btn btn-danger action_btn"> <i class="fa fa-trash"></i> Archive Selected
                                        </button>
                                        &nbsp; &nbsp;
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                Tools
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item"
                                                    href="{{ route('services.export.excel') }}"
                                                    target="_blank">Export to excel</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">

                                    <div class="row mb-2 m-1">
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

                                    <div class="table-container">
                                        <table id="" class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th> <input type="checkbox" class="select_all_colums"> </th>
                                                    <th>Id</th>
                                                    <th> Name </th>
                                                    <th> Slug </th>
                                                    <th> Type </th>
                                                    <th> Page Image </th>
                                                    <th> Status </th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody id="services_table_body">

                                            </tbody>
                                        </table>
                                        <div id="pagination" class="d-flex justify-content-center">
                                        </div>
                                    </div>
                                    @if(session()->has('feedback'))
                                        @include('admin.layouts.feedback')
                                    @endif
                                    @include('admin.services.components.delete_selected')
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
            <script>
                $('.action_btn').on('click', function(e){
                    var target_modal = $(this).attr('data-target');
                    e.preventDefault();
                    var checkbox = $('.selected_items');
                    if(!checkbox.is(":checked")){
                        $('#not_checked_modal_title').text("Plase Select the Services First");
                        $('#not_checked_modal').modal('show');
                    }else {
                        $(target_modal).modal('show');
                    }
                });
                $("form").submit(function(e){
                    var checkbox = $('.selected_items');
                    if(!checkbox.is(":checked")){
                        e.preventDefault();
                        $('#not_checked_modal_title').text("Plase Select the Services First");
                        $('#not_checked_modal').modal('show');
                    }
                });
            </script>
            <script src="{{ asset('js/dataTables/servicesDataTable.js') }}"></script>
            <!-- footer is here -->
            @include('admin.layouts.footer')