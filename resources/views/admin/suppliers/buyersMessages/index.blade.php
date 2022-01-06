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

                    <h1 class="h3 mb-3">{{ $supplier->full_name }} buyers messagess Table</h1>

                    <form action="{{ route('suppliers.buyersMessagess.actions',['id' => $supplier->id]) }}" id="supplier_buyersMessagess_actions_form" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title"> {{ $supplier->full_name }} Has <span id="buyersMessagess_counter"></span> buyersMessages  </h5>
                                        <div class="row">
                                            <a href="{{ route('suppliers.buyersMessagess.create',['id' => $supplier->id]) }}" class="btn btn-primary"> <i class="fa fa-plus"></i> Add New
                                            </a>
                                            &nbsp; &nbsp;
                                            <button type="button" data-toggle="modal"
                                                data-target="#delete_selected_confirm" class="btn btn-danger"> <i
                                                    class="fa fa-trash"></i> Delete Selected </button>
                                            &nbsp; &nbsp;
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    Tools
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-supplier_buyersMessages" href="{{ route('suppliers.buyersMessagess.export.excel',['id' => $supplier->id]) }}"
                                                        target="_blank">Export to excel</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">

                                        <div class="row mb-2 m-1">
                                            <div class="col-md-2 form-group">
                                                <label for="buyersMessages_name">buyersMessages Name</label>
                                                <input type="text" name="buyersMessages_name" id="buyersMessages_name"
                                                    class="filter_data_table form-control" aria-label="Search">
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
                                                        <th>Registered Email</th>
                                                        <th>buyersMessages Name</th>
                                                        <th>Sub Domain</th>
                                                        <th>Visits</th>
                                                        <th>buyersMessages Verified</th>
                                                        <th>Contact Count</th>
                                                        <th>Date Added </th>
                                                        <th>Reminders Sent</th>
                                                        <th> Actions </th>
                                                    </tr>
                                                </thead>
                                                <tbody id="buyersMessagess_table_body">

                                                </tbody>
                                            </table>
                                        </div>
                                        @include('admin.suppliers.buyersMessagess.components.delete_selected')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </main>

            <!-- scripts is here -->
            @include('admin.layouts.scripts')
            <script type="text/javascript">var supplier_id = "<?= $supplier->id ?>";</script>
            <script type="text/javascript">var csrf_token = "<?= csrf_token() ?>";</script>
            <script src="{{ asset('js/dataTables/supplierbuyersMessagessDataTable.js') }}"></script>
            <!-- footer is here -->
            @include('admin.layouts.footer')