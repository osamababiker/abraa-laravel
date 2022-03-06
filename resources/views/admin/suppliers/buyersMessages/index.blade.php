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

                    <form action="{{ route('suppliers.buyersMessages.actions',['id' => $supplier->id]) }}" id="supplier_buyersMessages_actions_form" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title"> {{ $supplier->full_name }} Has <span id="buyersMessages_counter"></span> buyersMessages  </h5>
                                        <div class="row">
                                            <button type="button" data-target="#delete_selected_confirm" class="btn btn-danger action_btn"> <i
                                                    class="fa fa-trash"></i> Delete Selected </button>
                                            &nbsp; &nbsp;
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    Tools
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-supplier_buyersMessages" href="{{ route('suppliers.buyersMessages.export.excel',['id' => $supplier->id]) }}"
                                                        target="_blank">Export to excel</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">

                                        <div class="row mb-2 m-1">
                                         
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
                                                        <th> <input type="checkbox" name="all_colums"
                                                                class="select_all_colums"> </th>
                                                        <th>Buyer Id</th>
                                                        <th>Buyer Name</th>
                                                        <th>Supplier Name</th>
                                                        <th>Message</th>
                                                        <th> Actions </th>
                                                    </tr>
                                                </thead>
                                                <tbody id="buyersMessages_table_body">

                                                </tbody>
                                            </table>
                                        </div>
                                        <hr><div id="pagination" class="d-flex justify-content-center"></div>
                                        @if(session()->has('feedback'))
                                            @include('admin.layouts.feedback')
                                        @endif
                                        @include('admin.suppliers.buyersMessages.components.delete_selected')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </main>


            <!-- scripts is here -->
            @if(session()->has('feedback'))
                @include('admin.layouts.feedback')
            @endif

            @include('admin.layouts.select_feedback')
            
            <!-- scripts is here -->
            @include('admin.layouts.scripts')
            <script type="text/javascript">var supplier_id = "<?= $supplier->id ?>";</script>
            <script type="text/javascript">var csrf_token = "<?= csrf_token() ?>";</script>
            <script>
                $('.action_btn').on('click', function(e){
                    var target_modal = $(this).attr('data-target');
                    e.preventDefault();
                    var checkbox = $('.selected_items');
                    if(!checkbox.is(":checked")){
                        $('#not_checked_modal_title').text("Plase Select the Messages First");
                        $('#not_checked_modal').modal('show');
                    }else {
                        $(target_modal).modal('show');
                    }
                });
                $("form").submit(function(e){
                    var checkbox = $('.selected_items');
                    if(!checkbox.is(":checked")){
                        e.preventDefault();
                        $('#not_checked_modal_title').text("Plase Select the Messages First");
                        $('#not_checked_modal').modal('show');
                    }
                });
            </script>
            <script src="{{ asset('js/dataTables/supplierBuyersMessagesDataTable.js') }}"></script>
            <!-- footer is here -->
            @include('admin.layouts.footer')