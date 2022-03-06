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

                    <h1 class="h3 mb-3">Items Files Table</h1>

                    <form action="{{ route('itemsFiles.actions') }}" id="files_actions_form" method="post">
                        <div class="row">
                            @csrf
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header ml-3">
                                        <h5 class="card-title"> You have <span id="files_counter"></span> file
                                            in
                                            this table </h5>
                                        <div class="row">
                                            <a href="{{ route('itemsFiles.create') }}" target="_blanck"
                                                class="btn btn-primary"> <i class="fa fa-plus"></i> Add New </a>
                                            &nbsp; &nbsp;
                                            <button type="button" 
                                                data-target="#delete_selected_confirm" class="btn btn-danger action_btn"> <i
                                                    class="fa fa-trash"></i> Archive Selected
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
                                                        href="{{ route('itemsFiles.export.excel') }}"
                                                        target="_blank">Export to excel</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">

                                        <div class="row mb-2 m-1">
                                            <div class="col-md-6 form-group">
                                                <label for="item_title">Filter By Item Title</label>
                                                <input type="text" name="item_title" id="item_title"
                                                    class="filter_data_table form-control" aria-label="Search">
                                            </div>
                                            <div class="col-md-6 form-group">
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
                                                        <th>item Title</th>
                                                        <th>Image</th>
                                                        <th>is Main Image</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="items_files_table_body">

                                                </tbody>
                                            </table>
                                        </div>
                                        <hr><div id="pagination" class="d-flex justify-content-center"></div>
                                        @if(session()->has('feedback'))
                                        @include('admin.layouts.feedback')
                                        @endif
                                        @include('admin.items.files.components.delete_selected')
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
            <script>
                $('.action_btn').on('click', function(e){
                    var target_modal = $(this).attr('data-target');
                    e.preventDefault();
                    var checkbox = $('.selected_items');
                    if(!checkbox.is(":checked")){
                        $('#not_checked_modal_title').text("Plase Select the files First");
                        $('#not_checked_modal').modal('show');
                    }else {
                        $(target_modal).modal('show');
                    }
                });
                $("form").submit(function(e){
                    var checkbox = $('.selected_items');
                    if(!checkbox.is(":checked")){
                        e.preventDefault();
                        $('#not_checked_modal_title').text("Plase Select the Files First");
                        $('#not_checked_modal').modal('show');
                    }
                });
            </script>
            <script src="{{ asset('js/dataTables/itemsFilesDataTable.js') }}"></script>
            <!-- footer is here -->
            @include('admin.layouts.footer')