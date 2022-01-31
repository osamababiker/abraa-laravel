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
                    <div class="row">
                    <div class="col-12 col-xl-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title"> <i class="fa fa-eye"></i> Membership Transaction: #{{ $transaction->id }} </h5>
								</div>
								<table class="table show-details-table">
									<tbody>
										<tr class="table-default">
											<th>Id</th>
                                            <td>{{ $transaction->id }}</td>
										</tr>
                                        <tr class="table-default">
											<th>User</th>
                                            <td>
                                                @if($transaction->user)
                                                    {{ $transaction->user->full_name }}
                                                @endif
                                            </td>
										</tr>
                                        <tr class="table-default">
											<th>Plan</th>
                                            <td>
                                                @if($transaction->plan)
                                                    {{ $transaction->plan->name }}
                                                @endif
                                            </td>
										</tr>
                                        <tr class="table-default">
											<th>Transaction Id</th>
                                            <td>{{ $transaction->transaction_id }}</td>
										</tr>
                                        <tr class="table-default">
											<th>Lead Id</th>
                                            <td>{{ $transaction->lead_id }}</td>
										</tr>
                                        <tr class="table-default">
											<th>Total Amount</th>
                                            <td>{{ $transaction->total_amount }}</td>
										</tr>
                                        <tr class="table-default">
											<th>Payment Status</th>
                                            <td>
                                                {{ $transaction->payment_status }}
                                            </td>
										</tr>
                                        <tr class="table-default">
											<th>Subscription Status</th>
                                            <td>{{ $transaction->subscription_status }}</td>
										</tr>
                                        <tr class="table-default">
											<th>Is Receipt Uploaded</th>
                                            <td>
                                                @if($transaction->is_receipt_uploaded == 1)
                                                    <i class="fa fa-check" style="color: green"></i> Yes
                                                @else 
                                                    <i class="fa fa-times" style="color: red"></i> No
                                                @endif
                                            </td>
										</tr>
                                        <tr class="table-default">
											<th>Payment Link</th>
                                            <td>
                                                <a target="_blank" href="{{ $transaction->payment_link }}">{{ $transaction->payment_link }}</a>
                                            </td>
										</tr>
                                        <tr class="table-default">
											<th>Start Date</th>
                                            <td>{{ $transaction->start_date }}</td>
										</tr>
                                        <tr class="table-default">
											<th>End Date</th>
                                            <td>{{ $transaction->end_date }}</td>
										</tr>
                                        <tr class="table-default">
											<th>Payment Date</th>
                                            <td>{{ $transaction->payment_date }}</td>
										</tr>
                                        <tr class="table-default">
											<th>Modified Date</th>
                                            <td>{{ $transaction->modified_date }}</td>
										</tr>
									</tbody>
								</table>
                                <div class="m-4">
                                    <a href="{{ route('membershipsTransactions.index') }}" class="btn btn-secondary"> Back </a>
                                </div>
							</div>
						</div>
                    </div>

                </div>
            </main>

			@include('admin.layouts.scripts')
            <!-- footer is here -->
            @include('admin.layouts.footer')
