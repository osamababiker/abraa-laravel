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
									<h5 class="card-title"> <i class="fa fa-eye"></i> page: #{{ $page->id }} </h5>
								</div>
								<table class="table show-details-table">
									<tbody>
										<tr class="table-default">
											<th>Type</th>
                                            <td>{{ $page->sub_of }}</td>
										</tr>
                                        <tr class="table-default">
											<th>Sort ID</th>
                                            <td>{{ $page->sort_id }}</td>
										</tr>
                                        <tr class="table-default">
											<th>Title (Ar)</th>
                                            <td>{{ $page->ar_title }}</td>
										</tr>
                                        <tr class="table-default">
											<th>Visits (Ar)</th>
                                            <td>{{ $page->ar_visits }}</td>
										</tr>
                                        <tr class="table-default">
											<th>Content (Ar)</th>
                                            <td>{!! $page->ar_content !!}</td>
										</tr>
                                        <tr class="table-default">
											<th>Title (En)</th>
                                            <td>{{ $page->en_title }}</td>
										</tr>
                                        <tr class="table-default">
											<th>Visits (En)</th>
                                            <td>{{ $page->en_visits }}</td>
										</tr>
                                        <tr class="table-default">
											<th>Content (En)</th>
                                            <td>{!! $page->en_content !!}</td>
										</tr>
                                        <tr class="table-default">
											<th>Title (Cn)</th>
                                            <td>{{ $page->cn_title }}</td>
										</tr>
                                        <tr class="table-default">
											<th>Visits (Cn)</th>
                                            <td>{{ $page->cn_visits }}</td>
										</tr>
                                        <tr class="table-default">
											<th>Content (Cn)</th>
                                            <td>{!! $page->cn_content !!}</td>
										</tr>
                                        <tr class="table-default">
											<th>Title (Ru)</th>
                                            <td>{{ $page->ru_title }}</td>
										</tr>
                                        <tr class="table-default">
											<th>Visits (Ru)</th>
                                            <td>{{ $page->ru_visits }}</td>
										</tr>
                                        <tr class="table-default">
											<th>Content (Ru)</th>
                                            <td>{!! $page->ru_content !!}</td>
										</tr>
                                        <tr class="table-default">
											<th>Title (Tr)</th>
                                            <td>{{ $page->tr_title }}</td>
										</tr>
                                        <tr class="table-default">
											<th>Visits (Tr)</th>
                                            <td>{{ $page->tr_visits }}</td>
										</tr>
                                        <tr class="table-default">
											<th>Content (Tr)</th>
                                            <td>{!! $page->tr_content !!}</td>
										</tr>
                                        <tr class="table-default">
											<th>Title (Pr)</th>
                                            <td>{{ $page->pr_title }}</td>
										</tr>
                                        <tr class="table-default">
											<th>Visits (Pr)</th>
                                            <td>{{ $page->pr_visits }}</td>
										</tr>
                                        <tr class="table-default">
											<th>Content (Pr)</th>
                                            <td>{!! $page->pr_content !!}</td>
										</tr>
                                        <tr class="table-default">
											<th>Slug</th>
                                            <td>{{ $page->slug }}</td>
										</tr>
                                        <tr class="table-default">
											<th>Meta Title</th>
                                            <td>{{ $page->meta_title }}</td>
										</tr>
                                        <tr class="table-default">
											<th>Meta Description</th>
                                            <td>{{ $page->meta_description }}</td>
										</tr>
                                        <tr class="table-default">
											<th>Meta Keyword</th>
                                            <td>{{ $page->meta_keyword }}</td>
										</tr>
									</tbody>
								</table>
                                <div class="m-4">
                                    <a href="{{ route('pages.index') }}" class="btn btn-secondary"> Back </a>
                                </div>
							</div>
						</div>
                    </div>

                </div>
            </main>

			@include('admin.layouts.scripts')
            <!-- footer is here -->
            @include('admin.layouts.footer')
