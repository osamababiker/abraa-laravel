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
									<h5 class="card-title"> <i class="fa fa-eye"></i> message: #{{ $message->id }} </h5>
								</div>
								<table class="table show-details-table">
									<tbody>
										<tr class="table-default">
											<th>Id</th>
                                            <td>{{ $message->id }}</td>
										</tr>
                                        <tr class="table-default">
											<th>User</th>
                                            <td>
												@if($message->user)
												{{ $message->user->full_name }}
												@endif
											</td>
										</tr>
                                        <tr class="table-default">
											<th>Subject</th>
                                            <td>{{ $message->subject }}</td>
										</tr>
										<tr class="table-default">
											<th>Message</th>
                                            <td>{{ $message->message }}</td>
										</tr>
										<tr class="table-default">
											<th>Datetime</th>
                                            <td>{{ $message->datetime }}</td>
										</tr>
										<tr class="table-default">
											<th>Message Read</th>
                                            <td>
												@if($message->message_read == 1)
													<i class="fa fa-check" style="color: green"></i>
												@else 
													<i class="fa fa-times" style="color: red"></i>
												@endif
											</td>
										</tr>
										<tr class="table-default">
											<th>Read At</th>
                                            <td>{{ $message->read_at }}</td>
										</tr>
										<tr class="table-default">
											<th>Sent By</th>
                                            <td>
												@if($message->sender)
												{{ $message->sender->name }}
												@endif
											</td>
										</tr>
									</tbody>
								</table>
                                <div class="m-4">
                                    <a href="{{ route('abraaMessages.index') }}" class="btn btn-secondary"> Back </a>
                                </div>
							</div>
						</div>
                    </div>

                </div>
            </main>

			@include('admin.layouts.scripts')
            <!-- footer is here -->
            @include('admin.layouts.footer')
