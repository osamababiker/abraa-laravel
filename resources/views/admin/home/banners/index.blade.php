@include('admin.layouts.header')


<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-behavior="sticky">
    <div class="wrapper">

        @include('admin.layouts.loader')

        <!-- main sidebar here -->
        @include('admin.layouts.sidebar')

        <div class="main">

            <!-- main nav here -->
            @include('admin.layouts.nav')

            <main class="content">
                <div class="container-fluid p-0">

                    <h1 class="h3 mb-3">Home banners Table</h1>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header ml-3">
                                    <h5 class="card-title"> You have <span id="home_banners_counter"></span> banner in
                                        this table </h5>
                                    <div class="row">
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                Tools
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="{{ route('homeBanners.export.excel') }}"
                                                    target="_blank">Export to excel</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">

                                    <div class="row mb-2 m-1">
                                        <div class="col-md-6 form-group">
                                            <label for="banner_title">banner Title</label>
                                            <input type="text" name="banner_title" id="banner_title"
                                                class="filter_data_table form-control" aria-label="Search">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="rows_numbers">Numbers of rows</label>
                                            <select name="rows_numbers" id="rows_numbers"
                                                class="filter_data_table form-control select2">
                                                <option value="10"> 10 </option>
                                                <option value="100"> 100 </option>
                                                <option value="500"> 500 </option>
                                                <option value="1000"> 1000 </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="table-container">
                                        <table id="" class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th> <input type="checkbox" class="select_all_colums"> </th>
                                                    <th>banner</th>
                                                    <th>Link</th>
                                                    <th>Alt Text</th>
                                                    <th>For language</th>
                                                    <th>Created at</th>
                                                    <th> Added by </th>
                                                    <th> Status </th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody id="home_banners_table_body">

                                            </tbody>
                                        </table>
                                    </div>
                                    @if(session()->has('feedback'))
                                        @include('admin.layouts.feedback')
                                    @endif
                                    @include('admin.home.banners.components.delete_selected')
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </main>

            <!-- scripts is here -->
            @include('admin.layouts.scripts')
            <script type="text/javascript">var csrf_token = "<?= csrf_token() ?>";</script>
            <script type="text/javascript">var public_url = "<?= config('global.public_url') ?>";</script>
            <script src="{{ asset('js/dataTables/homeBannersDataTable.js') }}"></script>
            <!-- footer is here -->
            @include('admin.layouts.footer')