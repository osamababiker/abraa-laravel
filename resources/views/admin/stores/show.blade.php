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

					<h1 class="h3 mb-3 ml-4"> <i class="fa fa-eye"></i> View Store </h1>
					<div class="col-12">
						<div class="col-12 col-lg-12">
							<div class="tab">
								<ul class="nav nav-tabs" role="tablist">
									<li class="nav-item">
										<a class="nav-link active" href="#account_info" data-toggle="tab" role="tab">
											Account Info <i class="align-middle" data-feather="user"></i>
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link custom_active" href="#store_info" data-toggle="tab"
											role="tab">
											Store Info <i class="align-middle" data-feather="home"></i>
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link custom_active" href="#change_logo" data-toggle="tab"
											role="tab">
											Store Logo <i class="align-middle" data-feather="image"></i>
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link custom_active" href="#change_banners" data-toggle="tab"
											role="tab">
											Store Banners <i class="align-middle" data-feather="image"></i>
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link custom_active" href="#store_settings" data-toggle="tab"
											role="tab">
											Store Settings <i class="align-middle" data-feather="settings"></i>
										</a>
									</li>
								</ul>
								<div class="tab-content">
									<!-- account info tab -->
									<div class="tab-pane active" id="account_info" role="tabpanel">
										<h4 class="tab-title"> Account Info</h4> 
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
													<td>@if($store->user){{ $store->user->full_name }}@endif</td>
													<td>@if($store->user){{ $store->user->email }}@endif</td>
													<td>@if($store->user){{ $store->user->phone }}@endif</td>
													<td>@if($store->user){{ $store->user->interested_keywords }}@endif</td>
													<td>
														@if($store->user && $store->user->supplier_country)
															{{ $store->user->supplier_country->en_name }}
														@endif
													</td>
													<td>
														@if($store->user && $store->user->supplier_city)
															{{ $store->user->supplier_city->en_name }}
														@endif
													</td>
												</tr>
											</tbody>
										</table>
									</div>
									<!-- store info tab -->
									<div class="tab-pane" id="store_info" role="tabpanel">
										<h4 class="tab-title"> Store Info</h4>
										<table class="table table-striped">
											<thead>
												<tr>
													<th>Store Name</th>
													<th>Company Email</th>
													<th>Company Mobile</th>
													<th>Company Whatsapp</th>
													<th>Sub Domain</th>
													<th>Contact Address</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>{{ $store->name }}</td>
													<td>{{ $store->company_email }}</td>
													<td>{{ $store->company_mobile }}</td>
													<td>{{ $store->company_whatsapp }}</td>
													<td>
														@if($store->user)
															<a target="_blank" href="{{ config('global.public_url') }}store/{{ $store->user->id }}">
																{{ config('global.public_url') }}store/{{ $store->user->id }}
															</a>
														@endif
													</td>
													<td>{{ $store->contact_address }}</td>
												</tr>
											</tbody>
										</table>
									</div>
									<!-- store logo -->
									<div class="tab-pane" id="change_logo" role="tabpanel">
										<h4 class="tab-title">Store Logo</h4>
										<img style="width: 250px; height: 250px" src="{{ $store->logo_url }}" alt="{{ $store->name }}">
									</div>
									<!-- store banners -->
									<div class="tab-pane" id="change_banners" role="tabpanel">
										<h4 class="tab-title"> Store Banners 1</h4>
										<img style="width: 250px; height: 250px" src="{{ $store->banner_url }}" alt="{{ $store->name }}">
										<hr>

										<h4 class="tab-title"> Store Banners 2</h4>
										<img style="width: 250px; height: 250px" src="{{ $store->banner_url1 }}" alt="{{ $store->name }}">
										<hr>

										<h4 class="tab-title"> Store Banners 3</h4>
										<img style="width: 250px; height: 250px" src="{{ $store->banner_url2 }}" alt="{{ $store->name }}">
									</div>
									<!-- store settings -->
									<div class="tab-pane" id="store_settings" role="tabpanel">
										<h4 class="tab-title"> Store Settings</h4>
										<table class="table table-striped">
											<thead>
												<tr>
													<th>Store Disabled</th>
													<th>Store Verified</th>
													<th>Show on Home Page</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>
														@if($store->trash == 1)
															<i class="fa fa-check" style="color: green"></i>
														@else 
															<i class="fa fa-times" style="color: red"></i>
														@endif
													</td>
													<td>
														@if($store->store_verified == 1)
															<i class="fa fa-check" style="color: green"></i>
														@else 
															<i class="fa fa-times" style="color: red"></i>
														@endif
													</td>
													<td>
														@if($store->show_homepage == 1)
															<i class="fa fa-check" style="color: green"></i>
														@else 
															<i class="fa fa-times" style="color: red"></i>
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
		@include('admin.stores.components.feedback')
		@endif
		@include('admin.layouts.scripts')
		<!-- footer is here -->
		@include('admin.layouts.footer')