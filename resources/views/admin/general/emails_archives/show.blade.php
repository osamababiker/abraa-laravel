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
									<h5 class="card-title"> <i class="fa fa-eye"></i> email: #{{ $email->id }} </h5>
								</div>
								<table class="table show-details-table">
									<tbody>
										<tr class="table-default">
											<th>Sent To</th>
                                            <td>{{ $email->sent_to }}</td>
										</tr>
                                        <tr class="table-default">
                                            <th>Subject</th>
                                            <td>{{ $email->subject }}</td>
                                        </tr>
                                        <tr class="table-default">
                                            <th>Email Message</th>
                                            <td>{!! $email->msg !!}</td>
                                        </tr>
									</tbody>
								</table>
                                <div class="m-4">
                                    <a href="{{ route('emailsArchives.index') }}" class="btn btn-secondary"> Back </a>
                                </div>
							</div>
						</div>
                    </div>

                </div>
            </main>

			@include('admin.layouts.scripts')
            <!-- footer is here -->
            @include('admin.layouts.footer')
