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

                    <h1 class="h3 mb-3">Manage Suppliers Table</h1>

                    <div class="row">
                    <div class="col-12 col-xl-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Users: #58741 </h5>
								</div>
								<table class="table show-details-table">
									<tbody>
										<tr class="table-primary">
											<td>id</td>
											<td>2458</td>
										</tr>
                                        <tr class="table-default">
											<td>Full Name</td>
											<td>Omer Alhamra</td>
										</tr>
                                        <tr class="table-success">
											<td>Email</td>
											<td>omer@abraa.com</td>
										</tr>
                                        <tr class="table-default">
											<td>Profile Picture</td>
											<td> <img src="img/avatars/avatar-5.jpg"
                                                class="avatar img-fluid rounded-circle" alt="Ashley Briggs">
                                            </td>
										</tr>
                                        <tr class="table-info">
											<td>Phone</td>
											<td>0542178966</td>
										</tr>
                                        <tr class="table-default">
											<td>Date Registered</td>
											<td>2021-12-05 09:01:04 </td>
										</tr>
                                        <tr class="table-primary">
											<td>Verified</td>
											<td> Yes </td>
										</tr>
                                        <tr class="table-default">
											<td>Search Log</td>
											<td>  </td>
										</tr>
                                        <tr class="table-secondary">
											<td>Country</td>
											<td> UAE </td>
										</tr>
                                        <tr class="table-default">
											<td>City</td>
											<td> Dubai  </td>
										</tr>
                                        <tr class="table-danger">
											<td>Company</td>
											<td> Proverde Cleaning Equipment Trading LLC  </td>
										</tr>
                                        <tr class="table-default">
											<td>Is Organic</td>
											<td> Yes </td>
										</tr>
                                        <tr class="table-primary">
											<td>Source</td>
											<td>  </td>
										</tr>
                                        <tr class="table-default">
											<td>Interested Keywords</td>
											<td> Proverde,SINTAN  </td>
										</tr>
                                        <tr class="table-success">
											<td>Disabled</td>
											<td> No </td>
										</tr>
                                        <tr class="table-default">
											<td>Prod Count</td>
											<td> 0 </td>
										</tr>
                                        <tr class="table-secondary">
											<td>External</td>
											<td> No </td>
										</tr>
                                        <tr class="table-default">
											<td>Reference Url</td>
											<td>  </td>
										</tr>
                                        <tr class="table-info">
											<td>External Categories</td>
											<td>  </td>
										</tr>
                                        <tr class="table-default">
											<td>Lead Assigned</td>
											<td>  0 </td>
										</tr>
                                        <tr class="table-danger">
											<td>External Buyer</td>
											<td>  0 </td>
										</tr>
                                        <tr class="table-default">
											<td>Date Added</td>
											<td>   	2021-12-05 09:01:04  </td>
										</tr>
                                        <tr class="table-success">
											<td>Added By</td>
											<td>   </td>
										</tr>
                                        <tr class="table-default">
											<td>Date Updated</td>
											<td>  2021-12-05 10:34:18  </td>
										</tr>
                                        <tr class="table-info">
											<td>Updated By</td>
											<td>  </td>
										</tr>
									</tbody>
								</table>
                                <div class="m-4">
                                    This user doesn't sent a buy request till now
                                    <button class="btn btn-secondary"> Back </button>
                                </div>
							</div>
						</div>
                    </div>

                </div>
            </main>

            <!-- footer is here -->
            @include('admin.layouts.footer')
