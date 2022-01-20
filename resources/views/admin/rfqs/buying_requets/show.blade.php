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

					<h1 class="h3 mb-3 ml-4"> <i class="fa fa-eye"></i> View Abandoned RFQ  </h1>
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
                                                    <td>@if($rfq->buyer){{ $rfq->buyer->id }}@endif</td>
													<td>@if($rfq->buyer){{ $rfq->buyer->full_name }}@endif</td>
													<td>@if($rfq->buyer){{ $rfq->buyer->email }}@endif</td>
													<th>
														@if($rfq->buyer)
														@if(rfq->buyer->verified == 1)
															<i class="fa fa-check" style="color: green"></i>
														@else 
															<i class="fa fa-times" style="color: red"></i>
														@endif
													</th>
													<td>@if($rfq->buyer){{ $rfq->buyer->phone }}@endif</td>
													<td>@if($rfq->buyer){{ $rfq->buyer->register_on }}@endif</td>
													<td>@if($rfq->buyer){{ $rfq->buyer->last_login }}@endif</td>
													<td>
														@if($rfq->buyer && $rfq->buyer->country)
														{{ $rfq->buyer->country->en_name }}
														@endif
													</td>
													<td>
														@if($rfq->buyer && $rfq->buyer->city)
														{{ $rfq->buyer->city->en_name }}
														@endif
													</td>
													<td>@if($rfq->buyer){{ $rfq->buyer->company }}@endif</td>
													<td>
														@if($rfq->buyer)
															@if($rfq->buyer->subscription_id == 0)
																<p>Basic</p>
															@elseif($rfq->buyer->subscription_id == 1)
																<p>Silver</p>
															@elseif($rfq->buyer->subscription_id == 2)
																<p>Gold</p>
															@elseif($rfq->buyer->subscription_id == 3)
																<p>Platinum</p>
															@elseif($rfq->buyer->subscription_id == 9)
																<p>Old Gold</p>
															@else 
																<p></p>
															@endif
															@endif
														@endif
													</td>
													<th>
														@if($rfq->buyer)
														@if(rfq->buyer->active == 1)
															<i class="fa fa-check" style="color: green"></i>
														@else 
															<i class="fa fa-times" style="color: red"></i>
														@endif
													</th>
												</tr>
											</tbody>
										</table>
									</div>
									<!-- RFQ Information tab -->
									<div class="tab-pane" id="rfq_info" role="tabpanel">
										<h4 class="tab-title"> RFQ Information </h4>
										<table class="table table-striped">
											<thead>
												<tr>
                                                    <th>Id</th>
													<th>Category</th>
													<th>Product Name</th>
													<th>Product Details</th>
													<th>Quantity</th>
													<th>Unit</th>
													<th>Buying Frequency</th>
													<th>Target Price</th>
													<th>Validity</th>
													<th>Shipping Request</th>
													<th>Source</th>
													<th>Status</th>
                                                    <th>Date Added</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>{{ $rfq->id }}</td>
													<td>{{ $rfq->category->en_title }}</td>
													<td>{{ $rfq->product_name }}</td>
													<td>{{ $rfq->product_details }}</td>
													<td>{{ $rfq->quantity }}</td>
                                                    <td>
                                                        @if($rfq->unit)
                                                            {{ $rfq->unit->unit_en }}
                                                        @endif
                                                    </td>
                                                    <td>{{ $rfq->buying_frequency_id }}</td>
													<td>{{ $rfq->target_price }}</td>
													<td>@if($rfq->validity > 0) {{ $rfq->validity }} @endif</td>
													<td>{{ $rfq->shipping_request }}</td>
													<td>{{ $rfq->source_url }}</td>
												
                                                    <td>{{ $rfq->date_added }}</td>
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