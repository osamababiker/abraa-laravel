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
									<h5 class="card-title"> <i class="fa fa-eye"></i> Shipper: #{{ $shipper->id }} </h5>
								</div>
								<table class="table show-details-table">
									<tbody>
										<tr class="table-primary">
											<td>id</td>
											<td>{{ $shipper->id }}</td>
										</tr>
                                        <tr class="table-default">
											<td>Full Name</td>
											<td>{{ $shipper->full_name }}</td>
										</tr>
                                        <tr class="table-success">
											<td>Email</td>
											<td>{{ $shipper->email }}</td>
										</tr>
                                        <tr class="table-info">
											<td>Phone</td>
											<td>{{ $shipper->phone }}</td>
										</tr>
                                        <tr class="table-default">
											<td>Date Registered</td>
											<td>{{ $shipper->register_on }}</td>
										</tr>
                                        <tr class="table-primary">
											<td>Is Verified</td>
											<td>
												@if($shipper->verified == 1)
													<i class="fa fa-check" style="color: green"></i> Yes
												@else 
													<i class="fa fa-times" style="color: red"></i> No
												@endif
											</td>
										</tr>
                                        <tr class="table-default">
											<td>Search Log</td>
											<td> {{ $shipper->search_log }} </td>
										</tr>
                                        <tr class="table-secondary">
											<td>Country</td>
											<td>
												@if($shipper->shipper_country)
													$shipper->shipper_country->en_name
												@endif
											</td>
										</tr>
                                        <tr class="table-default">
											<td>City</td>
											<td>
												@if($shipper->shipper_city)
													$shipper->shipper_city->en_name
												@endif
											</td>
										</tr>
                                        <tr class="table-danger">
											<td>Company</td>
											<td> {{ $shipper->company_name }}  </td>
										</tr>
                                        <tr class="table-default">
											<td>Is Organic</td>
											<td>
												@if($shipper->is_organic == 1)
													<i class="fa fa-check" style="color: green"></i> Yes
												@else 
													<i class="fa fa-times" style="color: red"></i> No
												@endif
											</td>
										</tr>
                                        <tr class="table-primary">
											<td>Source</td>
											<td> {{ $shipper->getUserSource($shipper->user_source) }} </td>
										</tr>
                                        <tr class="table-default">
											<td>Interested Keywords</td>
											<td> {{ $shipper->interested_keywords }}  </td>
										</tr>
                                        <tr class="table-success">
											<td>Is Active</td>
											<td>
												@if($shipper->active == 1)
													<i class="fa fa-check" style="color: green"></i> Is Active
												@else 
													<i class="fa fa-times" style="color: red"></i> Not Active
												@endif
											</td>
										</tr>
                                        <tr class="table-default">
											<td>Date Added</td>
											<td>  {{ $shipper->date_added }}  </td>
										</tr>
                                        <tr class="table-success">
											<td>Added By</td>
											<td> 
												@if($shipper->added_by) 
													{{ $shipper->added_by->name }}
												@endif 
											</td>
										</tr>
                                        <tr class="table-default">
											<td>Date Updated</td>
											<td> {{ $shipper->date_updated }} </td>
										</tr>
									</tbody>
								</table>
                                <div class="m-4">
                                    <a href="{{ route('shippers.index') }}" class="btn btn-secondary"> Back </a>
                                </div>
							</div>
						</div>
                    </div>

                </div>
            </main>

			@include('admin.layouts.scripts')
            <!-- footer is here -->
            @include('admin.layouts.footer')
