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
									<h5 class="card-title"> <i class="fa fa-eye"></i> Supplier: #{{ $supplier->id }} </h5>
								</div>
								<table class="table show-details-table">
									<tbody>
										<tr class="table-primary">
											<th>id</th>
											<td>{{ $supplier->id }}</td>
										</tr>
                                        <tr class="table-default">
											<th>Full Name</th>
											<td>{{ $supplier->full_name }}</td>
										</tr>
                                        <tr class="table-success">
											<th>Email</th>
											<td>{{ $supplier->email }}</td>
										</tr>
                                        <tr class="table-default">
											<th>Profile Picture</th>
											<td> <img src="{{ $supplier->pic_url }}"
                                                class="avatar img-fluid rounded-circle" alt="{{ $supplier->full_name }}">
                                            </td>
										</tr>
                                        <tr class="table-info">
											<th>Phone</th>
											<td>{{ $supplier->phone }}</td>
										</tr>
                                        <tr class="table-default">
											<th>Date Registered</th>
											<td> {{ $supplier->date_added }} </td>
										</tr>
                                        <tr class="table-primary">
											<th>Verified</th>
											<td>
												@if($supplier->verified == 1)
													<i class="fa fa-check" style="color: green"></i>
												@else 
													<i class="fa fa-times" style="color: red"></i>
												@endif
											</td>
										</tr>
                                        <tr class="table-default">
											<th>Search Log</th>
											<td> {{ $supplier->search_log }} </td>
										</tr>
                                        <tr class="table-secondary">
											<th>Country</th>
											<td> 
												@if($supplier->supplier_country)
												{{ $supplier->supplier_country->en_name }} 
												@endif
											</td>
										</tr>
                                        <tr class="table-default">
											<th>City</th>
											<td> 
												@if($supplier->supplier_city)
												{{ $supplier->supplier_city->en_name }} 
												@endif 
											</td>
										</tr>
                                        <tr class="table-danger">
											<th>Company</th>
											<td> {{ $supplier->company }}  </td>
										</tr>
                                        <tr class="table-default">
											<th>Is Organic</th>
											<td>
												@if($supplier->is_organic == 1)
													<i class="fa fa-check" style="color: green"></i>
												@else 	
													<i class="fa fa-times" style="color: red"></i>
												@endif
											</td>
										</tr>
                                        <tr class="table-primary">
											<th>Source</th> 
											<td> {{ $supplier->getUserSource($supplier->user_source) }} </td>
										</tr>
                                        <tr class="table-default">
											<th>Interested Keywords</th>
											<td> {{ $supplier->interested_keywords }}  </td>
										</tr>
                                        <tr class="table-success">
											<th>Disabled</td>
											<td>
												@if($supplier->active == 1)
													<i class="fa fa-check" style="color: green"></i>
												@else 	
													<i class="fa fa-times" style="color: red"></i>
												@endif
											</td>
										</tr>
                                        <tr class="table-default">
											<th>Prod Count</th>
											<td> {{ $supplier->prod_count }} </td>
										</tr>
                                        <tr class="table-secondary">
											<th>External</th>
											<td>
												@if($supplier->external == 1)
													<i class="fa fa-check" style="color: green"></i>
												@else 
													<i class="fa fa-times" style="color: red"></i>
												@endif
											</td>
										</tr>
                                        <tr class="table-default">
											<th>Reference Url</th>
											<td> <a target="_blank" href="{{ $supplier->reference_url }}"> {{ $supplier->reference_url }} </a> </td>
										</tr>
                                        <tr class="table-info">
											<th>External Categories</th>
											<td> 
												@if($supplier->external_categories == 1)
													<i class="fa fa-check" style="color: green"></i>
												@else 	
													<i class="fa fa-times" style="color: red"></i>
												@endif
											</td>
										</tr>
                                        <tr class="table-default">
											<th>Lead Assigned</th>
											<td> 
												@if($supplier->lead_assigned == 1)
													<i class="fa fa-check" style="color: green"></i>
												@else 	
													<i class="fa fa-times" style="color: red"></i>
												@endif
											</td>
										</tr>
                                        <tr class="table-danger">
											<th>External Buyer</th>
											<td> 
												@if($supplier->external_buyer == 1)
													<i class="fa fa-check" style="color: green"></i>
												@else 	
													<i class="fa fa-times" style="color: red"></i>
												@endif
											</td>
										</tr>
                                        <tr class="table-default">
											<td>Date Added</td>
											<td>  {{ $supplier->date_added }}  </td>
										</tr>
                                        <tr class="table-success">
											<td>Added By</td>
											<td> 
												@if($supplier->added_by > 0)
												{{ \App\Models\User::find($supplier->added_by)->full_name }}  
												@endif
											</td>
										</tr>
                                        <tr class="table-default">
											<td>Date Updated</td>
											<td> {{ $supplier->date_updated }} </td>
										</tr>
                                        <tr class="table-info">
											<td>Updated By</td>
											<td> 
												@if($supplier->updated_by > 0)
												{{ \App\Models\User::find($supplier->updated_by)->full_name }} 
												@endif
											</td>
										</tr>
									</tbody>
								</table>
                                <div class="m-4">
                                    <p>This user doesn't sent a buy request till now</p>
                                    <a href="{{ route('suppliers.index') }}" class="btn btn-secondary"> Back </a>
                                </div>
							</div>
						</div>
                    </div>

                </div>
            </main>

			@include('admin.layouts.scripts')
            <!-- footer is here -->
            @include('admin.layouts.footer')
