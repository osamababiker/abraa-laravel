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

					<h1 class="h3 mb-3 ml-4"> <i class="fa fa-eye"></i> View Order </h1>
					<div class="col-12">
						<div class="col-12 col-lg-12">
							<div class="tab">
								<ul class="nav nav-tabs" role="tablist">
									<li class="nav-item">
										<a class="nav-link active" href="#user_info" data-toggle="tab" role="tab">
											User Info <i class="align-middle" data-feather="user"></i>
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link custom_active" href="#order_details" data-toggle="tab"
											role="tab">
											Order Details <i class="align-middle" data-feather="shopping-cart"></i>
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link custom_active" href="#product_details" data-toggle="tab"
											role="tab">
											Product Details <i class="align-middle" data-feather="image"></i>
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link custom_active" href="#shipping_details" data-toggle="tab"
											role="tab">
											Shipping Details <i class="align-middle" data-feather="home"></i>
										</a>
									</li>
								</ul>
								<div class="tab-content">
									<!-- User Info tab -->
									<div class="tab-pane active" id="user_info" role="tabpanel">
										<h4 class="tab-title">User Info</h4> 
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
													<td>@if($order->user){{ $order->user->full_name }}@endif</td>
													<td>@if($order->user){{ $order->user->email }}@endif</td>
													<td>@if($order->user){{ $order->user->phone }}@endif</td>
													<td>@if($order->user){{ $order->user->interested_keywords }}@endif</td>
													<td>
														@if($order->user && $order->user->buyer_country)
															{{ $order->user->buyer_country->en_name }}
														@endif
													</td>
													<td>
														@if($order->user && $order->user->buyer_city)
															{{ $order->user->buyer_city->en_name }}
														@endif
													</td>
												</tr>
											</tbody>
										</table>
									</div>
									<!-- Order Details tab -->
									<div class="tab-pane" id="order_details" role="tabpanel">
										<h4 class="tab-title"> Order Details </h4>
										<table class="table table-striped">
											<thead>
												<tr>
													<th>Order Id</th>
													<th>Sub Total (AED)</th>
													<th>Sub Total (Dollar)</th>
													<th>Shipping Cost</th>
													<th>Total Price</th>
													<th>Payment Link</th>
													<th>Currency</th>
													<th>Payment Gateway</th>
													<th>Bank Recipt</th>
													<th>Payment Status</th>
													<th>Order Status</th>
													<th>Created At</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>{{ $order->id }}</td>
													<td>{{ $order->price_aed }}</td>
													<td>{{ $order->price_dlr }}</td>
													<td>{{ $order->shipping_price }}</td>
													<td>{{ $order->total_price }}</td>
													<td> <a target="_blank" href="{{ $order->payment_link }}">{{ $order->payment_link }}</a> </td>
													<td>
														@if($order->currency)
															{{ $order->currency->name_en }}
														@endif
													</td>
													<td>
														{{ $order->getPaymentGeteway($order->payment_gate) }}
													</td>
													<td>{{ $order->bank_reciept }}</td>
													<td>{{ $order->payment_status }}</td>
													<td>
														@if($order->status)
															{{ $order->status->title }}
														@endif
													</td>
													<td>{{ $order->date_created }}</td>
												</tr>
											</tbody>
										</table>
									</div>
									<!-- Product Details -->
									<div class="tab-pane" id="product_details" role="tabpanel">
										<h4 class="tab-title">Product Details</h4>
										<table class="table table-striped">
											<thead>
												<tr>
													<th>Id</th>
													<th>Product Name</th>
													<th>Store</th>
													<th>Quantity</th>
													<th>Total Price</th>
													<th>Status</th>
												</tr>
											</thead>
											<tbody>
												@if($order->order_item)
													@foreach($order->order_item as $order_item)
													<tr>
														<td>
															@if($order_item->item)
																{{ $order_item->item->id }}
															@endif
														</td>
														<td>
															@if($order_item->item)
																{{ $order_item->item->title }}
															@endif
														</td>
														<td>
															@if($order_item->item)
																@if($order_item->item->supplier)
																	<a target="_blank" href="{{ config('global.public_url') }}store/{{ $order_item->item->supplier->id }}">{{ config('global.public_url') }}store/{{ $order_item->item->supplier->id }}</a>
																@endif
															@endif
														</td>
														<td>
															{{ $order_item->quantity }}
														</td>
														<td>
															{{ $order_item->final_price }}
														</td>
														<td>
															@if($order_item->status == 1)
																<!-- <i class="fa fa-check" style="color: green"></i> -->
															@else 
															@endif
														</td>
													</tr>
													@endforeach
												@endif
											</tbody>
										</table>
									</div>
									<!-- Shipping Details -->
									<div class="tab-pane" id="shipping_details" role="tabpanel">
										<h4 class="tab-title"> Shipping Address </h4>
										<table class="table table-striped">
											<thead>
												<tr>
													<th>Full Name</th>
													<th>Email</th>
													<th>Phone</th>
													<th>Address</th>
													<th>Country</th>
													<th>City</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>
														@if($order->user)
															{{ $order->user->full_name }}
														@endif
													</td>
													<td>
														@if($order->user)
															{{ $order->user->email }}
														@endif
													</td>
													<td>
														@if($order->user)
															{{ $order->user->phone }}
														@endif
													</td>
													<td></td>
													<td>
														@if($order->user && $order->buyer_country)
															{{ $order->user->buyer_country->en_name }}
														@endif
													</td>
													<td>
														@if($order->user && $order->buyer_city)
															{{ $order->user->buyer_city->en_name }}
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