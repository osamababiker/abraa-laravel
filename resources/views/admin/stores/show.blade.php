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
									</div>
									<!-- store info tab -->
									<div class="tab-pane" id="store_info" role="tabpanel">
										<h4 class="tab-title"> Store Info</h4>
									</div>
									<!-- store logo -->
									<div class="tab-pane" id="change_logo" role="tabpanel">
										<h4 class="tab-title">Store Logo</h4>
									</div>
									<!-- store banners -->
									<div class="tab-pane" id="change_banners" role="tabpanel">
										<h4 class="tab-title"> Store Banners</h4>
									</div>
									<!-- store settings -->
									<div class="tab-pane" id="store_settings" role="tabpanel">
										<h4 class="tab-title"> Store Settings</h4>
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