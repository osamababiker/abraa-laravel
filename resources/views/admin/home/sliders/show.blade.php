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
									<h5 class="card-title"> <i class="fa fa-eye"></i> Home Page slider: #{{ $slider->id }} </h5>
								</div>
								<table class="table show-details-table">
									<tbody>
										<tr class="table-default">
											<th>Alt Text</th>
                                            <td>{{ $slider->title }}</td>
										</tr>
                                        <tr class="table-default">
                                            <th>slider link</th>
                                            <td>
                                                <a target="_blank" href="{{ $slider->link }}">{{ $slider->link }}</a>
                                            </td>
                                        </tr>
                                        <tr class="table-default">
                                            <th>slider logo</th>
                                            <td>
                                                <a target="_blank" href="{{ $slider->slider }}">
                                                <img src="{{ $slider->slider }}" alt="{{ $slider->title }}">
                                                </a>
                                            </td>
                                        </tr>
                                        <tr class="table-default">
                                            <th>Slider Status</th>
                                            <td>
                                                @if($slider->status == 1)
                                                    <i class="fa fa-check" style="color: green"></i>
                                                @else 
                                                    <i class="fa fa-times" style="color: red"></i>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr class="table-default">
                                            <th>For Language</th>
                                            <td>
                                                @if($slider->language)
                                                    {{ $slider->language->name }}
                                                @endif
                                            </td>
                                        </tr>
                                        <tr class="table-default">
                                            <th>Added By</th>
                                            <td>
                                                @if($slider->user)
                                                    {{ $slider->user->name }}
                                                @endif
                                            </td>
                                        </tr>
                                        <tr class="table-default">
                                            <th>Added date</th>
                                            <td>{{ $slider->date_added }}</td>
                                        </tr>
									</tbody>
								</table>
                                <div class="m-4">
                                    <a href="{{ route('homeSliders.index') }}" class="btn btn-secondary"> Back </a>
                                </div>
							</div>
						</div>
                    </div>

                </div>
            </main>

			@include('admin.layouts.scripts')
            <!-- footer is here -->
            @include('admin.layouts.footer')
