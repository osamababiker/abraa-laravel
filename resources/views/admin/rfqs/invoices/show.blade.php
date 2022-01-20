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

					<h1 class="h3 mb-3 ml-4"> <i class="fa fa-eye"></i> View Buying Request Invoice </h1>
					<div class="col-12">
						<div class="col-12 col-lg-12">
							<div class="tab">
								<ul class="nav nav-tabs" role="tablist">
									<li class="nav-item">
										<a class="nav-link active" href="#account_info" data-toggle="tab" role="tab">
                                            Buyer Information <i class="align-middle" data-feather="user"></i>
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link custom_active" href="#rfq_info" data-toggle="tab"
											role="tab">
											RFQ Information <i class="align-middle" data-feather="info"></i>
										</a>
									</li>
								</ul>
								<div class="tab-content">
									<!-- Buyer Information tab -->
									<div class="tab-pane active" id="account_info" role="tabpanel">
										<h4 class="tab-title"> Buyer Information</h4> 
										<table class="table table-striped">
											<thead>
												<tr>
                                                    <th>Buyer Id</th>
													<th>Full Name</th>
													<th>Email</th>
													<th>Email Verified</th>
													<th>Phone Number</th>
													<th>Register On</th>
													<th>Last Login</th>
													<th>Country</th>
													<th>City</th>
													<th>Company</th>
													<th>Subscription</th>
													<th>Status</th>
												</tr>
											</thead>
											<tbody> 
												<tr> 
                                                    <td>@if($rfq->buying_request->buyer){{ $rfq->buying_request->buyer->id }}@endif</td>
													<td>@if($rfq->buying_request->buyer){{ $rfq->buying_request->buyer->full_name }}@endif</td>
													<td>@if($rfq->buying_request->buyer){{ $rfq->buying_request->buyer->email }}@endif</td>
													<th>
														@if($rfq->buying_request->buyer)
															@if($rfq->buying_request->buyer->verified == 1)
																<i class="fa fa-check" style="color: green"></i>
															@else 
																<i class="fa fa-times" style="color: red"></i>
															@endif
														@endif
													</th>
													<td>@if($rfq->buying_request->buyer){{ $rfq->buying_request->buyer->phone }}@endif</td>
													<td>@if($rfq->buying_request->buyer){{ $rfq->buying_request->buyer->register_on }}@endif</td>
													<td>@if($rfq->buying_request->buyer){{ $rfq->buying_request->buyer->last_login }}@endif</td>
													<td>
														@if($rfq->buying_request->buyer)
															@if($rfq->buying_request->buyer->buyer_country)
																{{ $rfq->buying_request->buyer->buyer_country->en_name }}
															@endif
														@endif
													</td>
													<td>
														@if($rfq->buying_request->buyer && $rfq->buying_request->buyer->city)
															{{ $rfq->buying_request->buyer->city->en_name }}
														@endif
													</td>
													<td>@if($rfq->buying_request->buyer){{ $rfq->buying_request->buyer->company }}@endif</td>
													<td>
														@if($rfq->buying_request->buyer)
															@if($rfq->buying_request->buyer->subscription_id == 0)
																<p>Basic</p>
															@elseif($rfq->buying_request->buyer->subscription_id == 1)
																<p>Silver</p>
															@elseif($rfq->buying_request->buyer->subscription_id == 2)
																<p>Gold</p>
															@elseif($rfq->buying_request->buyer->subscription_id == 3)
																<p>Platinum</p>
															@elseif($rfq->buying_request->buyer->subscription_id == 9)
																<p>Old Gold</p>
															@else 
																<p></p>
															@endif
														@endif
													</td>
													<th>
														@if($rfq->buying_request->buyer)
															@if($rfq->buying_request->buyer->active == 1)
																<i class="fa fa-check" style="color: green"></i>
															@else 
																<i class="fa fa-times" style="color: red"></i>
															@endif
														@endif
													</th>
												</tr>
											</tbody>
										</table>
									</div>
									<!-- RFQ Information tab -->
									<div class="tab-pane" id="rfq_info" role="tabpanel">
										<h4 class="tab-title"> Buying Request Invoice </h4>
										<table class="table table-striped">
											<thead>
												<tr>
                                                    <th>Id</th>
													<th>Buying Request</th>
													<th>Supplier Name</th>
													<th>Supplier Phone</th>
													<th>Quantity</th>
													<th>Unit</th>
													<th>Price</th>
													<th>Total Price</th>
													<th>Currency</th>
													<th>Message</th>
													<th>Type</th>
													<th>Is Confirmed</th>
													<th>Vat</th>
                                                    <th>Date Added</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>{{ $rfq->id }}</td>
													<td>
														@if($rfq->buying_request)
															{{ $rfq->buying_request->product_name }}
														@endif
													</td>
													<td>
														@if($rfq->supplier)
															{{ $rfq->supplier->full_name }}
														@endif
													</td>
													<td>
														@if($rfq->supplier)
															{{ $rfq->supplier->phone }}
														@endif
													</td>
													<td>{{ $rfq->quantity }}</td>
                                                    <td>
                                                        @if($rfq->unit)
                                                            {{ $rfq->unit->unit_en }}
                                                        @endif
                                                    </td>
                                                    <td>{{ $rfq->price }}</td>
													<td>{{ $rfq->total_price }}</td>
													<td>
                                                        @if($rfq->currency)
                                                            {{ $rfq->currency->name_en }}
                                                        @endif
                                                    </td>
													<td>
														@if($rfq->type == 1)
															<p>Quote</p>
														@elseif($rfq->type == 2)
															<p>Offer</p>
														@elseif($rfq->type == 3)
															<p>Invoice</p>
														@else 
															<p></p>
														@endif
													</td>
													<td>
														@if($rfq->confirmed == 1)
															<i class="fa fa-check" style="color: green"></i>
														@else
															<i class="fa fa-times" style="color: red"></i>
														@endif
													</td>
                                                    <td>{{ $rfq->vat }}</td>
													<td>{{ $rfq->datetime }}</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
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
		<!-- footer is here -->
		@include('admin.layouts.footer')