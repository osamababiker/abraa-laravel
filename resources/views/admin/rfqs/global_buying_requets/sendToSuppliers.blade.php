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

                    <h1 class="h3 mb-3">Send Buying Requests to Suppliers</h1>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title"> Product Name: {{ $rfq->product_name }} </h5>
                                </div>
                                <hr>
                                <div class="card-body">
                                    <div class="row mb-2 m-1">
                                        <div class="col-md-2 form-group">
                                            <label for="keywords">By KeyWords</label>
                                            <select name="keywords" multiple="multiple" id="keywords" class="form-control filter_data_table select2">
                                            </select>
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <label for="countries"> By Country</label>
                                            <select name="countries[]" multiple="multiple" id="countries"
                                                class="form-control filter_data_table select2">
                                                <option value=""> choose country </option>
                                                @foreach($countries as $country)
                                                <option value="{{ $country->co_code }}">{{ $country->en_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <label for="categories">By Category</label>
                                            <select name="categories[]" multiple="multiple" id="categories" class="form-control select2 filter_data_table">
                                            </select>
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <label for="products">By Product</label>
                                            <select name="products[]" multiple="multiple" id="products" class="form-control select2 filter_data_table">
                                            </select>
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <label for="supplier_name">By Supplier name</label>
                                            <input name="supplier_name" id="supplier_name" class="form-control filter_data_table">
                                        </div>
                                    </div>

                                    <form action="{{ route('globalRfqs.sendToSupploers', ['id' => $rfq->id]) }}"  method="post">
                                        @csrf
                                        <input type="hidden" name="rfq_id" value="{{ $rfq->id }}">
                                        <div class="table_wrapper_1">
                                            <div class="table_div_1"></div>
                                        </div>
                                        <div class="table_wrapper_2">
                                            <div class="table_div_2">
                                                <table id="" class="table table-striped">
                                                    <thead> 
                                                        <tr>
                                                            <th> <input type="checkbox" class="select_all_colums"> </th>
                                                            <th>Store Name</th>
                                                            <th>Contact Person</th>
                                                            <th>Supplier Email</th>
                                                            <th>Supplier Phone</th>
                                                            <th>Supplier Country</th>
                                                            <th>Category</th>
                                                            <th>Subscription</th>
                                                            <th>Sent Requests</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="send_to_suppliers_table_body">

                                                    </tbody>
                                                </table>
                                                <div class="" style="justify-content: center;">
                                                    <button type="submit" class="btn btn-secondary" id="">Send Request</button>
                                                    <button class="btn btn-secondary" id="">Send For Suppliers Verification</button>
                                                    <button class="btn btn-secondary" id="">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                        @if(session()->has('feedback'))
                                            @include('admin.rfqs.buying_requets.components.feedback')
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </main>

            <!-- scripts is here -->
            @include('admin.layouts.scripts')
            <script src="{{ asset('js/dataTables/sendRfqToSuppliersDataTable.js') }}"></script>
            <!-- footer is here -->
            @include('admin.layouts.footer')


