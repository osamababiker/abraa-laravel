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

                    <h1 class="h3 mb-3">Manage memberships transactions Table</h1>

                    <form id="memberships_transactions_actions_form"
                        action="{{ route('membershipsTransactions.actions') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header ml-3">
                                        <h5 class="card-title"> You have <span
                                                id="memberships_transactions_counter"></span> memberships Plan in this
                                            table </h5>

                                        <div class="row ml-1">
                                            <a href="{{ route('membershipsTransactions.create') }}" target="_blank"
                                                class="btn btn-primary"> <i class="fa fa-plus"></i> Add New </a>
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
                                                        href="{{ route('membershipsTransactions.export.excel') }}"
                                                        target="_blank">Export to excel</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">

                                        <div class="row mb-2 m-1">
                                            <div class="col-md-4 form-group">
                                                <label for="payment_status">Filter By Payment Status</label>
                                                <select name="payment_status" id="payment_status"
                                                    class="filter_data_table form-control select2">
                                                    <option value="">Choose Status</option>
                                                    <option value="pending"> pending </option>
                                                </select>
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <label for="subscription_status">Filter By subscription Status</label>
                                                <select name="subscription_status" id="subscription_status"
                                                    class="filter_data_table form-control select2">
                                                    <option value="">Choose Status</option>
                                                    <option value="pending"> pending </option>
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

                                        <div class="table-container">
                                            <table id="" class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th> <input type="checkbox" name="all_colums"
                                                                class="select_all_colums"> </th>
                                                        <th>Id</th>
                                                        <th>User</th>
                                                        <th>Plan</th>
                                                        <th>Total Amount</th>
                                                        <th>Payment Status</th>
                                                        <th>Subscription Status</th>
                                                        <th>Start Date</th>
                                                        <th> End Date </th>
                                                        <th>Payment Date</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="memberships_transactions_table_body">

                                                </tbody>
                                            </table>
                                            <div id="pagination" class="d-flex justify-content-center">
                                            </div>
                                        </div>
                                        @if(session()->has('feedback'))
                                            @include('admin.layouts.feedback')
                                        @endif
                                        @include('admin.memberships.transactions.components.delete_selected')
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
            <script src="{{ asset('js/dataTables/membershipsTransactionsDataTable.js') }}"></script>
            <!-- footer is here -->
            @include('admin.layouts.footer')