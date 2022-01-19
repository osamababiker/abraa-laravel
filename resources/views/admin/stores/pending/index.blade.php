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

                    <form id="stores_actions_form" action="{{ route('stores.actions') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header ml-3">
                                        <h5 class="card-title"> You have <span id="stores_counter"></span> pending store in this
                                            table </h5>
                                        <div class="row">
                                            <a href="{{ route('stores.create') }}" target="_blank" class="btn btn-primary"> <i class="fa fa-plus"></i> Add New </a>
                                            &nbsp; &nbsp;
                                            <button class="btn btn-secondary"> Send Questionnaire </button>
                                            &nbsp; &nbsp;
                                            <button class="btn btn-info"> Send Reminder </button>
                                            &nbsp; &nbsp;
                                            <button type="button" data-toggle="modal" data-target="#approve_selected_confirm"
                                                class="btn btn-success"> <i class="fa fa-check"></i> Approve Selected
                                            </button>
                                            &nbsp; &nbsp;
                                            <button type="button" data-toggle="modal" data-target="#reject_selected_confirm"
                                                class="btn btn-warning"> <i class="fa fa-times"></i> Reject Selected
                                            </button>
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
                                                    <a class="dropdown-item" href="{{ route('pendingStores.export.excel') }}"
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
                                                <label for="external">Show External</label>
                                                <select name="external" id="external"
                                                    class="filter_data_table form-control select2">
                                                    <option value="0"></option>
                                                    <option value="1">show</option>
                                                    <option value="0">hide</option>
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
                                                        <th>Approve/Reject</th>
                                                        <th>Registered Email</th>
                                                        <th>Store Name</th>
                                                        <th>Sub Domain</th>
                                                        <th>Logo</th>
                                                        <th>Visiters</th>
                                                        <th>Is Verified</th>
                                                        <th>Register On</th>
                                                        <th> Actions </th>
                                                    </tr>
                                                </thead>
                                                <tbody id="stores_table_body">

                                                </tbody>
                                            </table>
                                        </div>
                                        @if(session()->has('feedback'))
                                            @include('admin.layouts.feedback')
                                        @endif
                                        @include('admin.stores.pending.components.approve_selected')
                                        @include('admin.stores.pending.components.delete_selected')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </main>

            <!-- scripts is here -->
            @include('admin.layouts.scripts')
            <script type="text/javascript">var csrf_token = "<?= csrf_token() ?>";</script>
            <script type="text/javascript">var public_url = "<?= config('global.public_url') ?>";</script>
            <script src="{{ asset('js/dataTables/pendingStoresDataTable.js') }}"></script>
            <!-- footer is here -->
            @include('admin.layouts.footer')