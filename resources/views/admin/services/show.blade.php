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
									<h5 class="card-title"> <i class="fa fa-eye"></i> service: #{{ $service['id'] }} </h5>
								</div>
								<table class="table show-details-table">
									<tbody>
										<tr class="table-default">
											<th>name</th>
                                            <td>{{ $service['name'] }}</td>
										</tr>
                                        <tr class="table-default">
											<th>Slug</th>
                                            <td>{{ $service['slug'] }}</td>
										</tr>
                                        <tr class="table-default">
											<th>Type</th>
                                            <td>{{ $service['stype'] }}</td>
										</tr>
                                        <tr class="table-default">
											<th>Meta title</th>
                                            <td>{{ $service['meta-title'] }}</td>
										</tr>
                                        <tr class="table-default">
											<th>Meta description</th>
                                            <td>{{ $service['meta-description'] }}</td>
										</tr>
                                        <tr class="table-default">
											<th>Service Description</th>
                                            <td>{{ $service['description'] }}</td>
										</tr>
                                        <tr class="table-default">
											<th>Page Content</th>
                                            <td>{{ $service['pagecontent'] }}</td>
										</tr>
                                        <tr class="table-default">
											<th>Is Active</th>
                                            <td>
                                                @if($service['active'] == 1)
                                                    <i class="fa fa-check" style="color: green"></i> Is Active
                                                @else 
                                                    <i class="fa fa-times" style="color: red"></i> Not Active
                                                @endif
                                            </td>
										</tr>
                                        <tr class="table-default">
											<th>Page Image</th>
                                            <td>
                                                <img src="{{ $service['page_image'] }}" alt="">
                                            </td>
										</tr>
									</tbody>
								</table>
                                <div class="m-4">
                                    <a href="{{ route('services.index') }}" class="btn btn-secondary"> Back </a>
                                </div>
							</div>
						</div>
                    </div>

                </div>
            </main>

			@include('admin.layouts.scripts')
            <!-- footer is here -->
            @include('admin.layouts.footer')
