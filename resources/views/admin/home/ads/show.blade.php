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
									<h5 class="card-title"> <i class="fa fa-eye"></i> Ads: #{{ $ads->id }} </h5>
								</div>
								<table class="table show-details-table">
									<tbody>
										<tr class="table-success">
											<th>Is Sub Of</th>
											<td>{{ $ads->category->name }}</td>
										</tr>
                                        <tr class="table-success">
											<th>Name</th>
											<td>{{ $ads->name }}</td>
										</tr>
                                        <tr class="table-success">
											<th>Ads Picture</th>
											<td> <img src="{{ $ads->pic_url }}" alt=""> </td>
										</tr>
                                        <tr class="table-success">
											<th>Ads Link</th>
											<td> <a target="_blank" href="{{ config('global.public_url') . $ads->link }}"> {{ config('global.public_url') . $ads->link }} </a> </td>
										</tr>
                                        <tr class="table-success">
											<th>Ads Code</th>
											<td>{{ $ads->ad_code }}</td>
										</tr>
                                        <tr class="table-success">
											<th>Ads Start On</th>
											<td>{{ $ads->start_on }}</td>
										</tr>
                                        <tr class="table-success">
											<th>Ads Expired On</th>
											<td>{{ $ads->expired_on }}</td>
										</tr>
                                        <tr class="table-success">
											<th>Ads Views</th>
											<td>{{ $ads->views }}</td>
										</tr>
                                        <tr class="table-success">
											<th>Ads Clicks</th>
											<td>{{ $ads->clicks }}</td>
										</tr>
                                        <tr class="table-success">
											<th>Ads Alt Text</th>
											<td>{{ $ads->alt_txt }}</td>
										</tr>
                                        <tr class="table-success">
											<th>Ads Language</th>
											<td>{{ $ads->language->name }}</td>
										</tr>
                                        <tr class="table-success">
											<th>Ads Added Date</th>
											<td>{{ $ads->date_added }}</td>
										</tr>
                                        <tr class="table-success">
											<th>Ads Added By</th>
											<td>{{ $ads->user->name }}</td>
										</tr>
                                        <tr class="table-success">
											<th>Ads Updated date</th>
											<td>{{ $ads->date_updated }}</td>
										</tr>
									</tbody>
								</table>
                                <div class="m-4">
                                    <a href="{{ route('ads.index') }}" class="btn btn-secondary"> Back </a>
                                </div>
							</div>
						</div>
                    </div>

                </div>
            </main>

			@include('admin.layouts.scripts')
            <!-- footer is here -->
            @include('admin.layouts.footer')
