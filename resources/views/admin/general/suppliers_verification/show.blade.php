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
									<h5 class="card-title"> <i class="fa fa-eye"></i> verification: #{{ $verification->id }} </h5>
								</div>
								<table class="table show-details-table">
									<tbody>
										<tr class="table-default">
											<th>Id</th>
                                            <td>{{ $verification->id }}</td>
										</tr>
                                        <tr class="table-default">
											<th>Supplier Name</th>
                                            <td>
                                                @if($verification->supplier)
                                                    {{ $verification->supplier->full_name }}
                                                @endif
                                            </td>
										</tr>
                                        <tr class="table-default">
											<th>Document Uploaded</th>
                                            <td>{{ $verification->document_uploaded }}</td>
										</tr>
                                        <tr class="table-default">
											<th>About Company</th>
                                            <td>{{ $verification->about_company }}</td>
										</tr>
                                        <tr class="table-default">
                                            <th>Youtube Link</th>
                                            <td> <a target="_blank" href="{{ $verification->youtube_link }}">{{ $verification->youtube_link }}</a> </td>
                                        </tr>
                                        <tr class="table-default">
                                            <th>Is Paid</th>
                                            <td>
                                                @if($verification->paid == 1)
                                                    <i class="fa fa-check" style="color: green"></i> Yes
                                                @else 
                                                    <i class="fa fa-times" style="color: red"></i> No
                                                @endif
                                            </td>
                                        </tr>
                                        <tr class="table-default">
											<th>Date & Time</th>
                                            <td>{{ $verification->date_time }}</td>
										</tr>
									</tbody>
								</table>
                                <div class="m-4">
                                    <a href="{{ route('suppliersVerification.index') }}" class="btn btn-secondary"> Back </a>
                                </div>
							</div>
						</div>
                    </div>

                </div>
            </main>

			@include('admin.layouts.scripts')
            <!-- footer is here -->
            @include('admin.layouts.footer')
