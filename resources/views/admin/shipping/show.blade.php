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

					<h1 class="h3 mb-3 ml-4"> <i class="fa fa-eye"></i> View Shipping Company </h1>
					<div class="col-12">
						<div class="col-12 col-lg-12">
							<div class="tab">
								<ul class="nav nav-tabs" role="tablist">
									<li class="nav-item">
										<a class="nav-link active" href="#shipper_info" data-toggle="tab" role="tab">
											Shipper Info <i class="align-middle" data-feather="shipper"></i>
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link custom_active" href="#company_info" data-toggle="tab"
											role="tab">
											Company Info <i class="align-middle" data-feather="home"></i>
										</a>
									</li>
								</ul>
								<div class="tab-content">
									<!-- Shipper Info  tab -->
									<div class="tab-pane active" id="shipper_info" role="tabpanel">
										<h4 class="tab-title"> Shipper Info  </h4> 
										<table class="table table-striped">
											<thead>
												<tr>
													<th>Full Name</th>
													<th>Email</th>
													<th>Phone Number</th>
													<th>interested Keywords</th>
													<th>Country</th>
													<th>City</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>@if($shipping->shipper){{ $shipping->shipper->full_name }}@endif</td>
													<td>@if($shipping->shipper){{ $shipping->shipper->email }}@endif</td>
													<td>@if($shipping->shipper){{ $shipping->shipper->phone }}@endif</td>
													<td>@if($shipping->shipper){{ $shipping->shipper->interested_keywords }}@endif</td>
													<td>
														@if($shipping->shipper && $shipping->shipper->shipper_country)
															{{ $shipping->shipper->shipper_country->en_name }}
														@endif
													</td>
													<td>
														@if($shipping->shipper && $shipping->shipper->shipper_city)
															{{ $shipping->shipper->shipper_city->en_name }}
														@endif
													</td>
												</tr>
											</tbody>
										</table>
									</div>
									<!-- Company Info tab -->
									<div class="tab-pane" id="company_info" role="tabpanel">
										<h4 class="tab-title"> Company Info </h4>
										<table class="table table-striped">
											<thead>
												<tr>
													<th>Company Name</th>
													<th>Email</th>
													<th>Mobile</th>
													<th>Shipping Methods</th>
													<th>Shipping From</th>
													<th>Shipping To</th>
													<th>Status</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>{{ $shipping->company_name }}</td>
													<td>{{ $shipping->email }}</td>
													<td>{{ $shipping->phome_number }}</td>
													<td>
														@if($shipping->shipping_from_country && $shipping->shipping_from != 'all')
															{{ $shipping->shipping_from_country->en_name }}
														@else 
															{{ $shipping->shipping_from }}
														@endif
													</td>
													<td>
														@if($shipping->shipping_to_country && $shipping->shipping_to != 'all')
															{{ $shipping->shipping_to_country->en_name }}
														@else 
															{{ $shipping->shipping_to }}
														@endif
													</td>
													<td>
														@if($shipping->status == 1)
															<i class="fa fa-check" style="color: green"></i> Active
														@else
															<i class="fa fa-times" style="color: red"></i> DisActive
														@endif
													</td>
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