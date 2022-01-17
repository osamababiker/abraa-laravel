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
									<h5 class="card-title"> <i class="fa fa-eye"></i> country: #{{ $country->id }} </h5>
								</div>
								<table class="table show-details-table">
									<tbody>
										<tr class="table-info">
											<th>Country Code</th>
                                            <td>{{ $country->co_code }}</td>
										</tr>
                                        <tr class="table-success">
											<th>Country Phone Code</th>
                                            <td>{{ $country->ph_code }}</td>
										</tr>
                                        <tr class="table-warning">
                                            <th>Country English Name</th>
                                            <td>{{ $country->en_name }}</td>
                                        </tr>
                                        <tr class="table-danger">
                                            <th>Country Arabic Name</th>
                                            <td>{{ $country->ar_name }}</td>
                                        </tr>
                                        <tr class="table-primary">
                                            <th>Country Turkish Name</th>
                                            <td>{{ $country->tr_name }}</td>
                                        </tr>
                                        <tr class="table-info">
                                            <th>Country Russian Name</th>
                                            <td>{{ $country->ru_name }}</td>
                                        </tr>
									</tbody>
								</table>
                                <div class="m-4">
                                    <a href="{{ route('countries.index') }}" class="btn btn-secondary"> Back </a>
                                </div>
							</div>
						</div>
                    </div>

                </div>
            </main>

			@include('admin.layouts.scripts')
            <!-- footer is here -->
            @include('admin.layouts.footer')
