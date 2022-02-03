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
									<h5 class="card-title"> <i class="fa fa-eye"></i> Item file: #{{ $file->id }} </h5>
								</div>
								<table class="table show-details-table">
									<tbody>
										<tr class="table-default">
											<th>Item</th>
                                            <td>
                                                @if($file->item)
                                                    {{ $file->item->title }}
                                                @endif
                                            </td>
										</tr>
                                        <tr class="table-default">
                                            <th>Item Image</th>
                                            <td>
                                                <a target="_blank" href="{{ $file->file_url }}">
                                                    <img src="{{ $file->file_url }}" alt="file_url">
                                                </a>
                                            </td>
                                        </tr>
                                        <tr class="table-default">
                                            <th>Is Main Image</th>
                                            <td>
                                                @if($file->main == 1)
                                                    <i class="fa fa-check" style="color: green"></i>
                                                @else 
                                                    <i class="fa fa-times" style="color: red"></i>
                                                @endif
                                            </td>
                                        </tr>
									</tbody>
								</table>
                                <div class="m-4">
                                    <a href="{{ route('itemsFiles.index') }}" class="btn btn-secondary"> Back </a>
                                </div>
							</div>
						</div>
                    </div>

                </div>
            </main>

			@include('admin.layouts.scripts')
            <!-- footer is here -->
            @include('admin.layouts.footer')
