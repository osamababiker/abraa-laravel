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

                    <h1 class="h3 mb-3">moderators Table</h1>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header ml-3">
                                    <h5 class="card-title"> You have <span id="moderators_counter"></span> moderator in
                                        this table </h5>
                                    <div class="row">
                                        <a href="{{ route('moderators.create') }}" target="_blank" class="btn btn-primary"> <i class="fa fa-plus"></i> Add New </a>
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
                                                <a class="dropdown-item" href="{{ route('moderators.export.excel') }}"
                                                    target="_blank">Export to excel</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">

                                    <div class="row mb-2 m-1">
                                        <div class="col-md-4 form-group">
                                            <label for="moderator_name">Search moderator by Name</label>
                                            <input type="text" name="moderator_name" id="moderator_name"
                                                class="filter_data_table form-control" aria-label="Search">
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label for="countries">Filter by Country</label>
                                            <select name="countries[]" multiple="multiple" id="countries"
                                                class="filter_data_table form-control select2">
                                                <option value=""> choose country </option>
                                                @foreach($countries as $country)
                                                <option value="{{ $country->co_code }}">{{ $country->en_name }}
                                                </option>
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

                                    <div class="table-container table-parent-wrapper">
                                        <table id="" class="table table-striped table-child-wrapper">
                                            <thead>
                                                <tr>
                                                    <th> <input type="checkbox" class="select_all_colums"> </th>
                                                    <th>Id</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>Registration Date</th>
                                                    <th>is Verified</th>
                                                    <th>Country</th>
                                                    <th>Company</th>
                                                    <th>is Organic</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody id="moderators_table_body">

                                            </tbody>
                                        </table>
                                    </div>
                                    <hr><div id="pagination" class="d-flex justify-content-center"></div>
                                    @if(session()->has('feedback'))
                                        @include('admin.layouts.feedback')
                                    @endif
                                    @include('admin.moderators.components.delete_selected')
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </main>


            <!-- scripts is here -->
            @include('admin.layouts.scripts')
            <script type="text/javascript">var csrf_token = "<?= csrf_token() ?>";</script>
            <script>
                $('.action_btn').on('click', function(e){
                    var target_modal = $(this).attr('data-target');
                    e.preventDefault();
                    var checkbox = $('.selected_items');
                    if(!checkbox.is(":checked")){
                        $('#not_checked_modal_title').text("Plase Select the Moderators First");
                        $('#not_checked_modal').modal('show');
                    }else {
                        $(target_modal).modal('show');
                    }
                });
                $("form").submit(function(e){
                    var checkbox = $('.selected_items');
                    if(!checkbox.is(":checked")){
                        e.preventDefault();
                        $('#not_checked_modal_title').text("Plase Select the Moderators First");
                        $('#not_checked_modal').modal('show');
                    }
                });
            </script>
            <script src="{{ asset('js/dataTables/moderatorsDataTable.js') }}"></script>
            <!-- footer is here -->
            @include('admin.layouts.footer')