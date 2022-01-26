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

                    <h1 class="h3 mb-3">Send Messages to Suppliers & Buyers</h1>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row mb-2 m-1">
                                        <div class="col-md-3 form-group">
                                            <label for="keywords">By KeyWords</label>
                                            <select name="keywords" multiple="multiple" id="keywords" class="form-control filter_data_table select2">
                                            </select>
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label for="buyer_name">Filter By Buyer</label>
                                            <input type="text" name="buyer_name" id="buyer_name" class="form-control filter_data_table">
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label for="supplier_name">Search Supplier</label>
                                            <input name="supplier_name" id="supplier_name" class="form-control filter_data_table">
                                        </div>
                                        <div class="col-md-3 form-group">
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

                                    <form action="{{ route('abraaMessages.send') }}"  method="post">
                                        @csrf
                                        <table id="" class="table table-striped">
                                            <thead> 
                                                <tr>
                                                    <th> <input type="checkbox" class="select_all_colums"> </th>
                                                    <th>Store Name (For Suppliers)</th>
                                                    <th>Contact Person</th>
                                                    <th>User Email</th>
                                                    <th>User Phone</th>
                                                    <th>country</th>
                                                    <th>Subscription</th>
                                                    <th>Already Sent</th>
                                                </tr>
                                            </thead>
                                            <tbody id="send_abraa_messages_table_body">

                                            </tbody>
                                        </table>
                                        <div id="pagination" class="d-flex justify-content-center">
                                        </div><br>

                                        <div class="form-row mt-4">
                                            <div class="col-md-12 form-group">
                                                <label for="subject">Message Subject</label>
                                                <input type="text" name="subject" id="subject" class="form-control">
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label for="message">Message </label>
                                                <textarea name="message" id="message" cols="30" rows="10" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class="" style="justify-content: center;">
                                            <button type="submit" name="send_message_btn" class="btn btn-secondary" id="">Send Message</button>
                                            <button class="btn btn-secondary" type="submit" name="send_to_all_suppliers_btn">Send to all Suppliers</button>
                                            <button class="btn btn-secondary" type="submit" name="send_to_all_buyers_btn">Send to all Buyers</button>
                                            <a href="{{ route('abraaMessages.index') }}" class="btn btn-secondary" id="">Cancel</a>
                                        </div>
                                        @if(session()->has('feedback'))
                                            @include('admin.layouts.feedback')
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
            <script src="{{ asset('js/dataTables/sendAbraaMessagesDataTable.js') }}"></script>
            <script type="text/javascript">var csrf_token = "<?= csrf_token() ?>";</script>
            <!-- footer is here -->
            @include('admin.layouts.footer')


