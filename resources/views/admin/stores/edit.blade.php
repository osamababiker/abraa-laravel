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

					<h1 class="h3 mb-3 ml-4"> <i class="fa fa-edit"></i> Edit Store </h1>
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
										<a class="nav-link custom_active" href="#change_password" data-toggle="tab"
											role="tab">
											Change Password <i class="align-middle" data-feather="lock"></i>
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link custom_active" href="#membership" data-toggle="tab"
											role="tab">
											Store Membership <i class="align-middle" data-feather="users"></i>
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link custom_active" href="#store_settings" data-toggle="tab"
											role="tab">
											Store Settings <i class="align-middle" data-feather="settings"></i>
										</a>
									</li>
								</ul>
								<form action="{{ route('stores.update') }}" method="post" enctype='multipart/form-data'>
									@csrf
									<input type="hidden" name="store_id" value="{{ $store->id }}">
									<div class="tab-content">
										<!-- update account info tab --> 
										<div class="tab-pane active" id="account_info" role="tabpanel">
											<h4 class="tab-title">Update Account Info</h4>
											<div class="form-row">
												<div class="form-group col-md-4">
													<label for="full_name">Full Name</label>
													<input type="text" class="form-control"
														value="{{ $store->user->full_name }}" name="full_name"
														id="full_name">
												</div>
												<div class="form-group col-md-4">
													<label for="email">Email</label>
													<input type="text" class="form-control"
														value="{{ $store->user->email }}" name="email" id="email">
												</div>
												<div class="form-group col-md-4">
													<label for="phone">Phone</label>
													<input type="tel" class="form-control"
														value="{{ $store->user->phone }}" name="phone" id="phone">
												</div>
											</div>
											<div class="row">
												<div class="form-group col-md-12">
													<label for="interested_keywords">interested
														Keywords</label>
													<select multiple="multiple" name="interested_keywords[]" id="interested_keywords"
														class="form-control select2">
														<option selected
															value="{{ $store->user->interested_keywords }}">
															{{ $store->user->interested_keywords }}</option>
													</select>
												</div>
											</div>
											<div class="form-row">
												<div class="form-group col-md-6">
													<label for="country">Country</label>
													<select name="country" id="country" class="form-control select2">
														@if($store->user->supplier_country)
														<option selected
															value="{{ $store->user->supplier_country->co_code }}">
															{{ $store->user->supplier_country->en_name }}
														</option>
														@else
														<option value=""></option>
														@endif
														@foreach($countries as $country)
														<option value="{{ $country->co_code }}">{{
															$country->en_name }}</option>
														@endforeach
													</select>
												</div>
												<div class="form-group col-md-6">
													<label for="city">City</label>
													<select name="city" id="city" class="form-control select2">
														@if($store->user->supplier_city)
														<option selected value="{{ $store->user->supplier_city->id }}">
															{{
															$store->user->supplier_city->en_name }}</option>
														@else
														<option value=""></option>
														@endif
														@foreach($states as $state)
														<option value="{{ $state->id }}">{{ $state->en_name
															}}</option>
														@endforeach
													</select>
												</div>
											</div>
											<div class="form-row d-flex justify-content-center">
												<button type="submit" class="btn btn-success">Save
													Changes</button>
												&nbsp; &nbsp;
												<a href="{{ route('stores.index') }}" type="button"
													class="btn btn-primary">Go Back</a>
											</div>
										</div>
										<!-- update store info tab -->
										<div class="tab-pane" id="store_info" role="tabpanel">
											<h4 class="tab-title">Update Store Info</h4>
											<div class="form-row">
												<div class="form-group col-md-4">
													<label for="store_name">Store Name</label>
													<input type="text" class="form-control" value="{{ $store->name }}"
														name="store_name" id="store_name">
												</div>
												<div class="form-group col-md-4">
													<label for="company_email">Company Email</label>
													<input type="text" class="form-control"
														value="{{ $store->company_email }}" name="company_email"
														id="company_email">
												</div>
												<div class="form-group col-md-4">
													<label for="company_mobile">Company Mobile</label>
													<input type="tel" class="form-control"
														value="{{ $store->company_mobile }}" name="company_mobile"
														id="company_mobile">
												</div>
											</div>
											<div class="form-row">
												<div class="form-group col-md-4">
													<label for="company_whatsapp">Company Whatsapp</label>
													<input type="tel" class="form-control"
														value="{{ $store->company_whatsapp }}" name="company_whatsapp"
														id="company_whatsapp">
												</div>
												<div class="form-group col-md-4">
													<label for="is_whatsapp_contact">Is Whatsapp Contact
														?</label>
													<select name="is_whatsapp_contact" id="is_whatsapp_contact"
														class="form-control select2">
														@if($store->is_whatsapp_contact == 1)
														<option selected value="1">Yes</option>
														<option value="0">No</option>
														@else
														<option selected value="0">No</option>
														<option value="1">Yes</option>
														@endif
													</select>
												</div>
												<div class="form-group col-md-4">
													<label for="sub_domain">Sub Domain</label>
													<input type="text" class="form-control"
														value="{{ $store->sub_domain }}" name="sub_domain"
														id="sub_domain">
												</div>
											</div>
											<div class="form-row">
												<div class="form-group col-md-12">
													<label for="contact_address">Contact Address</label>
													<textarea name="contact_address" id="contact_address" cols="8"
														rows="8"
														class="form-control">{{ $store->contact_address }}</textarea>
												</div>
											</div>
											<div class="form-row">
												<div class="form-group col-md-12">
													<label for="weburl">Website Url</label>
													<input type="text" name="weburl" value="{{ $store->weburl }}"
														class="form-control" id="weburl">
												</div>
											</div>
											<div class="form-row">
												<div class="form-group col-md-12">
													<label for="aboutpage">About Store</label>
													<textarea name="aboutpage" id="aboutpage" cols="8" rows="8"
														class="form-control">{{ $store->aboutpage }}</textarea>
												</div>
											</div>
											<div class="form-row">
												<div class="form-group col-md-4">
													<label for="facebook_url">Facebook Url</label>
													<input type="text" class="form-control"
														value="{{ $store->facebook_url }}" name="facebook_url"
														id="facebook_url">
												</div>
												<div class="form-group col-md-4">
													<label for="twitter_url">Twitter Url</label>
													<input type="text" class="form-control"
														value="{{ $store->twitter_url }}" name="twitter_url"
														id="twitter_url">
												</div>
												<div class="form-group col-md-4">
													<label for="instagram_url">Instagram Url</label>
													<input type="text" class="form-control"
														value="{{ $store->instagram_url }}" name="instagram_url"
														id="instagram_url">
												</div>
											</div>
											<div class="form-row">
												<div class="form-group col-md-12">
													<label for="meta_keywords">Meta Keywords</label>
													<select name="meta_keywords[]" id="meta_keywords" multiple="multiple"
														class="form-control select2">
														<option selected value="{{ $store->meta_keywords }}">{{
															$store->meta_keywords }}</option>
													</select>
												</div>
											</div>
											<div class="form-row">
												<div class="form-group col-md-12">
													<label for="meta_title">Meta Title</label>
													<textarea name="meta_title" id="meta_title" cols="4" rows="4"
														class="form-control">{{ $store->meta_title }}</textarea>
												</div>
											</div>
											<div class="form-row">
												<div class="form-group col-md-12">
													<label for="meta_description">Meta Description</label>
													<textarea name="meta_description" id="meta_description" cols="8"
														rows="8"
														class="form-control">{{ $store->meta_description }}</textarea>
												</div>
											</div>
											<div class="form-row d-flex justify-content-center">
												<button type="submit" class="btn btn-success">Save
													Changes</button>
												&nbsp; &nbsp;
												<a href="{{ route('stores.index') }}" type="button"
													class="btn btn-primary">Go Back</a>
											</div>
										</div>
										<!-- to change store logo -->
										<div class="tab-pane" id="change_logo" role="tabpanel">
											<h4 class="tab-title">Change Store Logo</h4>
											<div class="form-row">
												<div class="col-md-12">
													<div class="file-drop-area">
														<span class="choose-file-button">Choose Logo
															File</span>
														<input type="file" value="{{ $store->logo_url }}" name="logo"
															id="logo-input" class="file-input"
															accept=".jfif,.jpg,.jpeg,.png,.gif">
													</div>
													<div id="logo_preview"></div>
												</div>
											</div>
											<div class="form-row d-flex justify-content-center">
												<button type="submit" class="btn btn-success">Save
													Changes</button>
												&nbsp; &nbsp;
												<a href="{{ route('stores.index') }}" type="button"
													class="btn btn-primary">Go Back</a>
											</div>
										</div>
										<!-- to update store banners -->
										<div class="tab-pane" id="change_banners" role="tabpanel">
											<h4 class="tab-title">Update Store Banners</h4>
											<div class="form-row">
												<div class="col-md-12">
													<div class="file-drop-area">
														<span class="choose-file-button">Choose Banner 1
															Files</span>
														<input type="file" value="{{ $store->banner_url }}"
															name="banner1" id="banner1-input" class="file-input"
															accept=".jfif,.jpg,.jpeg,.png,.gif">
													</div>
													<div id="banner1_preview"></div>
												</div>
												<div class="col-md-12">
													<div class="file-drop-area">
														<span class="choose-file-button">Choose Banner 2
															Files</span>
														<input type="file" value="{{ $store->banner_url1 }}"
															name="banner2" id="banner2-input" class="file-input"
															accept=".jfif,.jpg,.jpeg,.png,.gif">
													</div>
													<div id="banner2_preview"></div>
												</div>
												<div class="col-md-12">
													<div class="file-drop-area">
														<span class="choose-file-button">Choose Banner 3
															Files</span>
														<input type="file" value="{{ $store->banner_url2 }}"
															name="banner3" id="banner3-input" class="file-input"
															accept=".jfif,.jpg,.jpeg,.png,.gif">
													</div>
													<div id="banner3_preview"></div>
												</div>
											</div>
											<div class="form-row d-flex justify-content-center">
												<button type="submit" class="btn btn-success">Save
													Changes</button>
												&nbsp; &nbsp;
												<a href="{{ route('stores.index') }}" type="button"
													class="btn btn-primary">Go Back</a>
											</div>
										</div>
										<!-- to update password tab -->
										<div class="tab-pane" id="change_password" role="tabpanel">
											<h4 class="tab-title">Update Password</h4>
											<div class="form-row">
												<div class="form-group col-md-12">
													<label for="password">Password</label>
													<input type="password" 
														class="form-control" name="password" id="password">
												</div>
												<div class="form-group col-md-12">
													<label class="custom-control custom-checkbox">
														<input type="checkbox" name="send_password_to_email"
															class="custom-control-input">
														<span class="custom-control-label"> Send New
															Password to Email </span>
													</label>
												</div>
											</div>
											<div class="form-row d-flex justify-content-center">
												<button type="submit" class="btn btn-success">Save
													Changes</button>
												&nbsp; &nbsp;
												<a href="{{ route('stores.index') }}" type="button"
													class="btn btn-primary">Go Back</a>
											</div>
										</div>
										<!-- to update store membership -->
										<div class="tab-pane" id="membership" role="tabpanel">
											<h4 class="tab-title">Update Store Membership</h4>
											<div class="form-row" id="membership_date">
												<div class="form-group col-md-6">
													<label class="form-label">Start Date</label>
													<input class="form-control datepicker" name="membership_start_date"
														type="text" name="datesingle" />
												</div>
												<div class="form-group col-md-6">
													<label class="form-label">End Date</label>
													<input class="form-control datepicker" name="membership_end_date"
														type="text" name="datesingle" />
												</div>
											</div>
											<div class="form-row">
												<label class="custom-control custom-radio">
													<input name="membership" id="basic_membership" value="basic"
														type="radio" class="custom-control-input" checked>
													<span class="custom-control-label">Basic</span>
												</label>
												&nbsp; &nbsp;
												<label class="custom-control custom-radio">
													<input name="membership" id="silver_membership" value="silver"
														type="radio" class="custom-control-input">
													<span class="custom-control-label">Silver</span>
												</label>
												&nbsp; &nbsp;
												<label class="custom-control custom-radio">
													<input name="membership" id="gold_membership" value="gold"
														type="radio" class="custom-control-input">
													<span class="custom-control-label">Gold</span>
												</label>
												&nbsp; &nbsp;
												<label class="custom-control custom-radio">
													<input name="membership" id="platinum_membership" value="platinum"
														type="radio" class="custom-control-input">
													<span class="custom-control-label">Platinum</span>
												</label>
											</div>
											<div class="form-row d-flex justify-content-center">
												<button type="submit" class="btn btn-success">Save
													Changes</button>
												&nbsp; &nbsp;
												<a href="{{ route('stores.index') }}" type="button"
													class="btn btn-primary">Go Back</a>
											</div>
										</div>
										<!-- to update store settings -->
										<div class="tab-pane" id="store_settings" role="tabpanel">
											<h4 class="tab-title">Update Store Settings</h4>
											<div class="form-row">
												<div class="col-md-4 form-group">
													<label for="trash">Disable the Store</label>
													<select name="trash" id="trash" class="form-control select2">
														@if($store->trash == 1)
														<option selected value="1">Store Disabled</option>
														<option value="0">Store Not Disable</option>
														@else
														<option selected value="0">Store Not Disable
														</option>
														<option value="1">Store Disabled</option>
														@endif
													</select>
												</div>
												<div class="col-md-4 form-group">
													<label for="store_verified">Store Verified</label>
													<select name="store_verified" id="store_verified"
														class="form-control select2">
														@if($store->store_verified == 1)
														<option selected value="1">Store Verified</option>
														<option value="0">Store Not Verified</option>
														@else
														<option selected value="0">Store Not Verified
														</option>
														<option value="1">Store Verified</option>
														@endif
													</select>
												</div>
												<div class="col-md-4 form-group">
													<label for="show_homepage">Show on Home Page</label>
													<select name="show_homepage" id="show_homepage"
														class="form-control select2">
														@if($store->show_homepage == 1)
														<option selected value="1">Show Home Page</option>
														<option value="0">Not Show On Home Page</option>
														@else
														<option selected value="0">Not Show On Home Page
														</option>
														<option value="1">Show Home Page</option>
														@endif
													</select>
												</div>
											</div>
											<div class="form-row d-flex justify-content-center">
												<button type="submit" class="btn btn-success">Save
													Changes</button>
												&nbsp; &nbsp;
												<a href="{{ route('stores.index') }}" type="button"
													class="btn btn-primary">Go Back</a>
											</div>
										</div>
									</div>
								</form>
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
		<script src="{{ asset('js/add_store.js') }}"></script>
		<!-- footer is here -->
		@include('admin.layouts.footer')