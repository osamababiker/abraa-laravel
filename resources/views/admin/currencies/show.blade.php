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
									<h5 class="card-title"> <i class="fa fa-eye"></i> Currencies: #{{ $currency->id }} </h5>
								</div>
								<table class="table show-details-table">
									<tbody>
										<tr class="table-info">
											<th>currency Code</th>
                                            <td>{{ $currency->code }}</td>
										</tr>
                                        <tr class="table-info">
											<th>currency Status</th>
                                            <td>
                                                @if($currency->status == 1)
                                                    <i class="fa fa-check" style="color: green"></i> مفعل 
                                                @else 
                                                    <i class="fa fa-times" style="color: red"></i> غير مفعل
                                                @endif
                                            </td>
										</tr>
                                        <tr class="table-warning">
                                            <th>currency English Name</th>
                                            <td>{{ $currency->name_en }}</td>
                                        </tr>
                                        <tr class="table-danger">
                                            <th>currency Arabic Name</th>
                                            <td>{{ $currency->name_ar }}</td>
                                        </tr>
                                        <tr class="table-primary">
                                            <th>currency Turkish Name</th>
                                            <td>{{ $currency->name_tr }}</td>
                                        </tr>
                                        <tr class="table-info">
                                            <th>currency Russian Name</th>
                                            <td>{{ $currency->name_ru }}</td>
                                        </tr>
									</tbody>
								</table>
                                <div class="m-4">
                                    <a href="{{ route('currencies.index') }}" class="btn btn-secondary"> Back </a>
                                </div>
							</div>
						</div>
                    </div>

                </div>
            </main>

			@include('admin.layouts.scripts')
            <!-- footer is here -->
            @include('admin.layouts.footer')
