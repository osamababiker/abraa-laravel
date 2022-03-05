@include('admin.layouts.header')


<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-behavior="sticky">
    <div class="wrapper">

        <!-- main sidebar here -->
        @include('admin.layouts.sidebar')

        <div class="main"> 
 
            <!-- main nav here -->
            @include('admin.layouts.nav')

            <main class="content">
                <div class="container-fluid p-0">
 
                    <h1 class="h3 mb-3"> <i class="fa fa-plus"></i> Add New Membership Transaction </h1>

                    
                    @if ($errors->any())
                        <div class="alert alert-danger pt-2">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif 

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <form method="post" action="{{ route('membershipsTransactions.store') }}">
                                        @csrf 
                                        <div class="form-row mt-4">
                                            <div class="col-md-6 required form-group autocomplete-user">
                                                <label for="search_user">Search For User</label>
                                                <input required type="text" name="search_user" id="search_user" class="form-control">
                                                <input type="hidden" name="user_id" id="user_id">
                                            </div>
                                            <div class="col-md-6 required form-group">
                                                <label for="plan_id">Select Plan</label>
                                                <select required name="plan_id" id="plan_id" class="form-control select2">
                                                    <option value=""></option>
                                                    @foreach($plans as $plan)
                                                        <option value="{{ $plan->id }}">{{ $plan->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-4 required form-group">
                                                <label for="transaction_id">Transaction Id</label>
                                                <input required type="text" name="transaction_id" id="transaction_id" class="form-control">
                                            </div>
                                            <div class="col-md-4 required form-group">
                                                <label for="lead_id">Lead Id</label>
                                                <input required type="number" name="lead_id" id="lead_id" class="form-control">
                                            </div>
                                            <div class="col-md-4 required form-group">
                                                <label for="total_amount">Total Amount</label>
                                                <input required type="text" name="total_amount" id="total_amount" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-4 required form-group">
                                                <label for="payment_status">Payment Status</label>
                                                <select required name="payment_status" id="payment_status" class="form-control select2">
                                                    <option value="Pending">Pending</option>
                                                    <option value="Completed">Completed</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4 required form-group">
                                                <label for="payment_link">Payment Link</label>
                                                <input required type="text" name="payment_link" class="form-control" id="payment_link">
                                            </div>
                                            <div class="col-md-4 required form-group">
                                                <label for="subscription_status">Subscription Status</label>
                                                <select required name="subscription_status" id="subscription_status" class="form-control select2">
                                                    <option value="Pending">Pending</option>
                                                    <option value="Completed">Completed</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-4 required form-group">
                                                <label for="start_date">Start Date</label>
                                                <input required type="text" name="start_date" id="start_date" class="form-control ymd_datepicker">
                                            </div>
                                            <div class="col-md-4 required form-group">
                                                <label for="end_date">End Date</label>
                                                <input required type="text" name="end_date" id="end_date" class="form-control ymd_datepicker">
                                            </div>
                                            <div class="col-md-4 required form-group">
                                                <label for="payment_date">Payment Date</label>
                                                <input required type="text" name="payment_date" id="payment_date" class="form-control ymd_datepicker">
                                            </div>
                                        </div>
                                        <div class="form-row mt-5 d-flex justify-content-center">
                                            <button type="submit" class="btn btn-success">Save Transaction</button>
                                            &nbsp; &nbsp;
                                            <a href="{{ route('membershipsTransactions.index') }}" type="button" class="btn btn-primary">Go Back</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </main>

            @if(session()->has('feedback'))
                @include('admin.layouts.feedback')
            @endif
            @include('admin.layouts.scripts')
            <script src="{{ asset('js/add_transaction.js') }}"></script>
            <!-- footer is here -->
            @include('admin.layouts.footer')
