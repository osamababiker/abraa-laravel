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
									<h5 class="card-title"> <i class="fa fa-eye"></i> Home Page buyer: #{{ $buyer->id }} </h5>
								</div>
								<table class="table show-details-table">
									<tbody>
										<tr class="table-default">
											<th>buyer Name</th>
                                            <td>{{ $buyer->buyername }}</td>
										</tr>
                                        <tr class="table-default">
                                            <th>buyer link</th>
                                            <td>
                                                <a target="_blank" href="{{ $buyer->buyer_link }}">{{ $buyer->buyer_link }}</a>
                                            </td>
                                        </tr>
                                        <tr class="table-default">
                                            <th>buyer logo</th>
                                            <td>
                                                <a target="_blank" href="{{ $buyer->buyer_logo }}">
                                                <img src="{{ $buyer->buyer_logo }}" alt="{{ $buyer->buyername }}">
                                                </a>
                                            </td>
                                        </tr>
                                        <tr class="table-default">
                                            <th>buyer Status</th>
                                            <td>
                                                @if($buyer->status == 1)
                                                    <i class="fa fa-check" style="color: green"></i>
                                                @else 
                                                    <i class="fa fa-times" style="color: red"></i>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr class="table-default">
                                            <th>Added By</th>
                                            <td>
                                                @if($buyer->added_by_admin)
                                                    {{ $buyer->added_by_admin->name }}
                                                @endif
                                            </td>
                                        </tr>
                                        <tr class="table-default">
                                            <th>Added date</th>
                                            <td>{{ $buyer->added_date }}</td>
                                        </tr>
									</tbody>
								</table>
                                <div class="m-4">
                                    <a href="{{ route('homePageBuyers.index') }}" class="btn btn-secondary"> Back </a>
                                </div>
							</div>
						</div>
                    </div>

                </div>
            </main>

			@include('admin.layouts.scripts')
            <!-- footer is here -->
            @include('admin.layouts.footer')
