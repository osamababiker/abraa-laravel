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

					<h1 class="h3 mb-3 ml-4"> <i class="fa fa-eye"></i> View Message </h1>
					<div class="col-12">
						<div class="col-12 col-lg-12">
							<div class="tab">
								<ul class="nav nav-tabs" role="tablist">
									<li class="nav-item">
										<a class="nav-link active" href="#buyer_info" data-toggle="tab" role="tab">
											Buyer Info <i class="align-middle" data-feather="buyer"></i>
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link custom_active" href="#supplier_info" data-toggle="tab"
											role="tab">
											Supplier Info <i class="align-middle" data-feather="buyer"></i>
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link custom_active" href="#message_details" data-toggle="tab"
											role="tab">
											Message Details <i class="align-middle" data-feather="message"></i>
										</a>
									</li>
								</ul>
								<div class="tab-content">
									<!-- Buyer Info tab -->
									<div class="tab-pane active" id="buyer_info" role="tabpanel">
										<h4 class="tab-title"> Buyer Info</h4> 
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
													<td>@if($message->buyer){{ $message->buyer->full_name }}@endif</td>
													<td>@if($message->buyer){{ $message->buyer->email }}@endif</td>
													<td>@if($message->buyer){{ $message->buyer->phone }}@endif</td>
													<td>@if($message->buyer){{ $message->buyer->interested_keywords }}@endif</td>
													<td>
														@if($message->buyer && $message->buyer->buyer_country)
															{{ $message->buyer->buyer_country->en_name }}
														@endif
													</td>
													<td>
														@if($message->buyer && $message->buyer->buyer_city)
															{{ $message->buyer->buyer_city->en_name }}
														@endif
													</td>
												</tr>
											</tbody>
										</table>
									</div>
									<!-- Supplier Info  tab -->
									<div class="tab-pane" id="supplier_info" role="tabpanel">
										<h4 class="tab-title"> Supplier Info </h4> 
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
													<td>@if($message->supplier){{ $message->supplier->full_name }}@endif</td>
													<td>@if($message->supplier){{ $message->supplier->email }}@endif</td>
													<td>@if($message->supplier){{ $message->supplier->phone }}@endif</td>
													<td>@if($message->supplier){{ $message->supplier->interested_keywords }}@endif</td>
													<td>
														@if($message->supplier && $message->supplier->supplier_country)
															{{ $message->supplier->supplier_country->en_name }}
														@endif
													</td>
													<td>
														@if($message->supplier && $message->supplier->supplier_city)
															{{ $message->supplier->supplier_city->en_name }}
														@endif
													</td>
												</tr>
											</tbody>
										</table>
									</div>
									<!-- Message Details tab -->
									<div class="tab-pane" id="message_details" role="tabpanel">
										<h4 class="tab-title"> Message Details </h4>
										<table class="table table-striped">
											<thead>
												<tr>
													<th>Message From</th>
													<th>Item</th>
													<th>Message</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>
														@if($message->message_from == 1)
															<p>Buyer</p>
														@elseif($message->message_from == 2)
															<p>Supplier</p>
														@endif
													</td>
													<td>
														@if($message->item)
															{{ $message->item->title }}
														@endif
													</td>
													<td>{{ $message->message }}</td>
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