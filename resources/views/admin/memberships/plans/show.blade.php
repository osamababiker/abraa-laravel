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
									<h5 class="card-title"> <i class="fa fa-eye"></i> Plan: #{{ $plan->id }} </h5>
								</div>
								<table class="table show-details-table">
									<tbody>
										<tr class="table-default">
											<th>Id</th>
                                            <td>{{ $plan->id }}</td>
										</tr>
                                        <tr class="table-default">
											<th>Code</th>
                                            <td>{{ $plan->code }}</td>
										</tr>
                                        <tr class="table-default">
											<th>Name</th>
                                            <td>{{ $plan->name }}</td>
										</tr>
                                        <tr class="table-default">
											<th>Short Description</th>
                                            <td>{{ $plan->short_description }}</td>
										</tr>
                                        <tr class="table-default">
											<th>Package Price</th>
                                            <td>{{ $plan->package_price }}</td>
										</tr>
                                        <tr class="table-default">
											<th>Duration</th>
                                            <td>{{ $plan->duration }}</td>
										</tr>
                                        <tr class="table-default">
											<th>Sales</th>
                                            <td>
                                                {{ $plan->sales }}
                                            </td>
										</tr>
                                        <tr class="table-default">
											<th>Created At</th>
                                            <td>{{ $plan->created_on }}</td>
										</tr>
                                        <tr class="table-default">
											<th>Updated At</th>
                                            <td>{{ $plan->modified_on }}</td>
										</tr>
                                        <tr class="table-default">
											<th>Country Code</th>
                                            <td>{{ $plan->country_code }}</td>
										</tr>
									</tbody>
								</table>
                                <div class="m-4">
                                    <a href="{{ route('membershipsPlans.index') }}" class="btn btn-secondary"> Back </a>
                                </div>
							</div>
						</div>
                    </div>

                </div>
            </main>

			@include('admin.layouts.scripts')
            <!-- footer is here -->
            @include('admin.layouts.footer')
