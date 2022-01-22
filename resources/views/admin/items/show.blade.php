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
									<h5 class="card-title"> <i class="fa fa-eye"></i> Item: #{{ $item->id }} </h5>
								</div>
								<table class="table show-details-table">
									<tbody>
										<tr class="table-success">
											<th>Id</th>
											<td>{{ $item->id }}</td>
										</tr>
                                        <tr class="table-success">
											<th>Category</th>
											<td>
												@if($item->category)
													{{  $item->category->en_title  }}
												@endif
											</td>
										</tr>
                                        <tr class="table-success">
											<th>User</th>
											<td>
												@if($item->supplier)
													{{ $item->supplier->full_name }}
												@endif
											</td>
										</tr>
                                        <tr class="table-success">
											<th>item Title</th>
											<td>{{ $item->title }}</td>
										</tr>
                                        <tr class="table-success">
											<th>item Slug</th>
											<td>{{ $item->slug }}</td>
										</tr>
                                        <tr class="table-success">
											<th>item Details</th>
											<td>{{ $item->details }}</td>
										</tr>
                                        <tr class="table-success">
											<th>item Price</th>
											<td>{{ $item->price }}</td>
										</tr>
                                        <tr class="table-success">
											<th>item Old Price</th>
											<td>{{ $item->old_price }}</td>
										</tr>
                                        <tr class="table-success">
											<th>item Currency</th>
											<td>
												@if($item->item_currency)
													{{ $item->item_currency->name_en }}
												@endif
											</td>
										</tr>
                                        <tr class="table-success">
											<th>item Unit</th>
											<td>
												@if($item->item_unit)	
													{{ $item->item_unit->unit_en }}
												@endif 
											</td>
										</tr>
                                        <tr class="table-success">
											<th>Phone</th>
											<td>{{ $item->phone }}</td>
										</tr>
                                        <tr class="table-success">
											<th>State</th>
											<td>{{ $item->state }}</td>
										</tr>
                                        <tr class="table-success">
											<th>item Added By</th>
											<td>
												@if($item->user)	
													{{ $item->user->name }}
												@endif
											</td>
										</tr>
                                        <tr class="table-success">
											<th>Youtube Video</th>
											<td> <a target="_blank" href="{{ $item->youtube_video }}"> {{ $item->youtube_video }} </a> </td>
										</tr>
										<tr class="table-success">
											<th>Deliver Per</th>
											<td>
												@if($item->deliver_per == 1)
												<p>Peer Week</p>
												@elseif($item->deliver_per == 2)
												<p>Peer Month</p>
												@elseif($item->deliver_per == 3)
												<p>Peer Year</p>
												@elseif($item->deliver_per == 4)
												<p>One Time</p>
												@endif
											</td>
										</tr>
										<tr class="table-success">
											<th>Ttem Type</th>
											<td>{{ $item->item_type }}</td>
										</tr>
										<tr class="table-success">
											<th>Quantity</th>
											<td>{{ $item->quantity }}</td>
										</tr>
										<tr class="table-success">
											<th>Manufacture Country</th>
											<td>
												@if($item->manufacture_country)
													{{ $item->manufacture_country->en_name }}
												@endif
											</td>
										</tr>
										<tr class="table-success">
											<th>Part Number</th>
											<td>{{ $item->part_number }}</td>
										</tr>
										<tr class="table-success">
											<th>Item Visits</th>
											<td>{{ $item->visits }}</td>
										</tr>
										<tr class="table-success">
											<th>Item Added Date</th>
											<td>{{ $item->added }}</td>
										</tr>
										<tr class="table-success">
											<th>Item Expire Date</th>
											<td>{{ $item->expire }}</td>
										</tr>
										<tr class="table-success">
											<th>Is Expired</th>
											<td>
												@if($item->expired == 1)
													<i class="fa fa-times" style="color: red">Expired</i>
												@else 
													<i class="fa fa-check" style="color: green">Not Expired</i>
												@endif
											</td>
										</tr>
										<tr class="table-success">
											<th>Is Active</th>
											<td>
												@if($item->active == 1)
													<i class="fa fa-check" style="color: green">Is Active</i>
												@else 
													<i class="fa fa-times" style="color: red">Not Active</i>
												@endif
											</td>
										</tr>
										<tr class="table-success">
											<th>Status</th>
											<td>
												@if($item->status == 1)
													<i class="fa fa-check" style="color: green"></i>
												@else 
													<i class="fa fa-times" style="color: red"></i>
												@endif
											</td>
										</tr>
										<tr class="table-success">
											<th>Is Rejected</th>
											<td>
												@if($item->rejected == 1)
													<i class="fa fa-times" style="color: red">Rejected</i>
												@else 
													<i class="fa fa-check" style="color: green">Not Rejected</i>
												@endif
											</td>
										</tr>
										<tr class="table-success">
											<th>Is Sold</th>
											<td>
												@if($item->is_sold == 1)
													<i class="fa fa-check" style="color: green">Is Sold</i>
												@else 
													<i class="fa fa-times" style="color: red">Not Sold</i>
												@endif
											</td>
										</tr>
										<tr class="table-success">
											<th>Is Featured</th>
											<td>
												@if($item->featured == 1)
													<i class="fa fa-check" style="color: green">Is Featured</i>
												@else 
													<i class="fa fa-times" style="color: red">Not Featured</i>
												@endif
											</td>
										</tr>
										<tr class="table-success">
											<th>Is Accepting offers</th>
											<td>
												@if($item->accept_offers == 1)
													<i class="fa fa-check" style="color: green">Yes</i>
												@else 
													<i class="fa fa-times" style="color: red">No</i>
												@endif
											</td>
										</tr>
										<tr class="table-success">
											<th>Item Sort Order</th>
											<td>{{ $item->sort_order }}</td>
										</tr>
										<tr class="table-success">
											<th>Item Meta Keywords</th>
											<td>{{ $item->meta_keyword }}</td>
										</tr>
										<tr class="table-success">
											<th>Item Meta Description</th>
											<td>{{ $item->meta_description }}</td>
										</tr>
										<tr class="table-success">
											<th>Lat</th>
											<td>{{ $item->lat }}</td>
										</tr>
										<tr class="table-success">
											<th>Lng</th>
											<td>{{ $item->lon }}</td>
										</tr>
										<tr class="table-success">
											<th>Phone Count</th>
											<td>{{ $item->phone_count }}</td>
										</tr>
										<tr class="table-success">
											<th>Email Count</th>
											<td>{{ $item->email_count }}</td>
										</tr>
										<tr class="table-success">
											<th>Chat Count</th>
											<td>{{ $item->chat_count }}</td>
										</tr>
										<tr class="table-success">
											<th>Min Order</th>
											<td>{{ $item->min_order }}</td>
										</tr>
										<tr class="table-success">
											<th>Default Image</th>
											<td> <img src="{{ $item->default_image }}" width="250" height="250" alt="{{ $item->title }}"> </td>
										</tr>
										<tr class="table-success">
											<th>Rating</th>
											<td>{{ $item->rating }}</td>
										</tr>
										<tr class="table-success">
											<th>Is Approved</th>
											<td>
												@if($item->approved == 1)
													<i class="fa fa-check" style="color: green">Yes</i>
												@else 
													<i class="fa fa-times" style="color: red">No</i>
												@endif
											</td>
										</tr>
										<tr class="table-success">
											<th>Added Date</th>
											<td>{{ $item->date_added }}</td>
										</tr>
										<tr class="table-success">
											<th>Is Approved</th>
											<td>{{ $item->rating }}</td>
										</tr>
										<tr class="table-success">
											<th>Added By</th>
											<td>  </td>
										</tr>
										<tr class="table-success">
											<th>Updated Date</th>
											<td>{{ $item->date_updated }}</td>
										</tr>
										<tr class="table-success">
											<th>Updated By</th>
											<td>  </td>
										</tr>
										<tr class="table-success">
											<th>Relist Date</th>
											<td>{{ $item->relist_date }}</td>
										</tr>
										<tr class="table-success">
											<th>Is Cutomized Item</th>
											<td>
												@if($item->is_customized == 1)
													<i class="fa fa-check" style="color: green">Yes</i>
												@else 
													<i class="fa fa-times" style="color: red">No</i>
												@endif
											</td>
										</tr>
										<tr class="table-success">
											<th>Is Global Item</th>
											<td>
												@if($item->is_global == 1)
													<i class="fa fa-check" style="color: green">Yes</i>
												@else 
													<i class="fa fa-times" style="color: red">No</i>
												@endif
											</td>
										</tr>
										<tr class="table-success">
											<th>Is Bulk Item</th>
											<td>
												@if($item->is_bulk == 1)
													<i class="fa fa-check" style="color: green">Yes</i>
												@else 
													<i class="fa fa-times" style="color: red">No</i>
												@endif
											</td>
										</tr>
									</tbody>
								</table>
                                <div class="m-4">
                                    <a href="{{ route('items.index') }}" class="btn btn-secondary"> Back </a>
                                </div>
							</div>
						</div>
                    </div>

                </div>
            </main>

			@include('admin.layouts.scripts')
            <!-- footer is here -->
            @include('admin.layouts.footer')
