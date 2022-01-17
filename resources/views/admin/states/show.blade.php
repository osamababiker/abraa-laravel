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
									<h5 class="card-title"> <i class="fa fa-eye"></i> state: #{{ $state->id }} </h5>
								</div>
								<table class="table show-details-table">
									<tbody>
										<tr class="table-info">
											<th>state Country</th>
                                            <td>{{ $state->country->en_name }}</td>
										</tr>
                                        <tr class="table-warning">
                                            <th>state English Name</th>
                                            <td>{{ $state->en_name }}</td>
                                        </tr>
                                        <tr class="table-danger">
                                            <th>state Arabic Name</th>
                                            <td>{{ $state->ar_name }}</td>
                                        </tr>
                                        <tr class="table-primary">
                                            <th>state Turkish Name</th>
                                            <td>{{ $state->tr_name }}</td>
                                        </tr>
                                        <tr class="table-info">
                                            <th>state Russian Name</th>
                                            <td>{{ $state->ru_name }}</td>
                                        </tr>
									</tbody>
								</table>
                                <div class="m-4">
                                    <a href="{{ route('states.index') }}" class="btn btn-secondary"> Back </a>
                                </div>
							</div>
						</div>
                    </div>

                </div>
            </main>

			@include('admin.layouts.scripts')
            <!-- footer is here -->
            @include('admin.layouts.footer')
