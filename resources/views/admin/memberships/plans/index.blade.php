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

                    <h1 class="h3 mb-3">Manage memberships plans Table</h1>

                    <form id="membershipsPlans_actions_form" action="{{ route('membershipsPlans.actions') }}"
                        method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title"> You have <span id="memberships_plans_counter"></span>
                                            memberships Plan in this table </h5>

                                        <div class="row ml-1">
                                            <a href="{{ route('membershipsPlans.create') }}" class="btn btn-primary"> <i
                                                    class="fa fa-plus"></i> Add New </a>
                                            &nbsp; &nbsp;
                                            <button type="button" data-toggle="modal"
                                                data-target="#delete_selected_confirm" class="btn btn-danger"> <i
                                                    class="fa fa-trash"></i> Archive Selected </button>
                                            &nbsp; &nbsp;
                                            <button type="button" data-toggle="modal"
                                                data-target="#send_emails_to_selected" class="btn btn-info"> <i
                                                    class="fa fa-envelope"></i> Send Email </button>
                                            &nbsp; &nbsp;
                                            <button type="button" name="send_sms_multiple" class="btn btn-success"> <i
                                                    class="fa fa-phone"></i> Send SMS </button>
                                            &nbsp; &nbsp;
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    Tools
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item"
                                                        href="{{ route('membershipsPlans.export.excel') }}"
                                                        target="_blank">Export to excel</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">

                                        <div class="row mb-2 m-1">
                                            <div class="col-md-6 form-group">
                                                <label for="memberships_plan_name">Search memberships Plans by
                                                    Name</label>
                                                <input type="text" name="memberships_plan_name"
                                                    id="memberships_plan_name" class="filter_data_table form-control"
                                                    aria-label="Search">
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

                                        <div class="table_wrapper_1">
                                            <div class="table_div_1"></div>
                                        </div>
                                        <div class="table_wrapper_2">
                                            <div class="table_div_2">
                                                <table id="" class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th> <input type="checkbox" name="all_colums"
                                                                    class="select_all_colums"> </th>
                                                            <th>Id</th>
                                                            <th>Code</th>
                                                            <th>Name</th>
                                                            <th>Short Description</th>
                                                            <th>Price</th>
                                                            <th>Duration</th>
                                                            <th>Sales</th>
                                                            <th> Country </th>
                                                            <th>Created at</th>
                                                            <th>Updated at</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="memberships_plans_table_body">

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        @include('admin.memberships.plans.components.delete_selected')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </main>

            <!-- scripts is here -->
            @include('admin.layouts.scripts')
            <script src="{{ asset('js/dataTables/membershipsPlansDataTable.js') }}"></script>
            <!-- footer is here -->
            @include('admin.layouts.footer')