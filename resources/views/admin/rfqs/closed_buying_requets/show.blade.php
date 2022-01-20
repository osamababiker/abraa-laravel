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

					<h1 class="h3 mb-3 ml-4"> <i class="fa fa-eye"></i> View Closed Buying Request  </h1>
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
													<th>Phone Number</th>
													<th>Country</th>
												</tr>
											</thead>
											<tbody>
												<tr> 
                                                    <td>@if($rfq->buyer){{ $rfq->buyer->id }}@endif</td>
													<td>@if($rfq->buyer){{ $rfq->buyer->full_name }}@endif</td>
													<td>@if($rfq->buyer){{ $rfq->buyer->email }}@endif</td>
													<td>@if($rfq->buyer){{ $rfq->buyer->phone }}@endif</td>
													<td>
														@if($rfq->buyer && $rfq->buyer->buyer_country)
														{{ $rfq->buyer->buyer_country->en_name }}
														@endif
													</td>
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
													<th>Item Link</th>
													<th>Product Name</th>
													<th>Product Details</th>
													<th>Quantity</th>
													<th>Unit</th>
													<th>Reference Url</th>
													<th>Buying Frequency</th>
                                                    <th>Date Added</th>
                                                    <th>Last Updated</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>{{ $rfq->id }}</td>
													<td>
                                                        <a target="_blank" href="{{ config('global.public_url') }}item/{{ $rfq->item_id }}"> {{ config('global.public_url') }}item/{{ $rfq->item_id }} </a>
                                                    </td>
													<td>{{ $rfq->product_name }}</td>
													<td>{{ $rfq->product_details }}</td>
													<td>{{ $rfq->quantity }}</td>
                                                    <td>
                                                        @if($rfq->unit)
                                                            {{ $rfq->unit->unit_en }}
                                                        @endif
                                                    </td>
													<td>{{ $rfq->reference_url }}</td>
                                                    <td>{{ $rfq->buying_frequency_id }}</td>
                                                    <td>{{ $rfq->date_added }}</td>
                                                    <td>{{ $rfq->last_updated }}</td>
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