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

                    <div class="row mb-2 mb-xl-3">
                        <div class="col-auto d-none d-sm-block">
                            <h3>Dashboard</h3>
                        </div>

                        <div class="col-auto ml-auto text-right mt-n1">
                            <span class="dropdown mr-2">
                                <button class="btn btn-light bg-white shadow-sm dropdown-toggle" id="day"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="align-middle mt-n1" data-feather="calendar"></i> Today
                                </button>
                                <div class="dropdown-menu" aria-labelledby="day">
                                    <h6 class="dropdown-header">Settings</h6>
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Separated link</a>
                                </div>
                            </span>

                            <button class="btn btn-primary shadow-sm">
                                <i class="align-middle" data-feather="filter">&nbsp;</i>
                            </button>
                            <button class="btn btn-primary shadow-sm">
                                <i class="align-middle" data-feather="refresh-cw">&nbsp;</i>
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-3 d-flex">
                            <div class="card illustration flex-fill">
                                <div class="card-body p-0 d-flex flex-fill">
                                    <div class="row no-gutters w-100">
                                        <div class="col-6">
                                            <div class="illustration-text p-3 m-1">
                                                <h4 class="illustration-text">Welcome Back , {{ Auth::user()->name }}</h4>
                                                <p class="mb-0">Abraa Dashboard</p>
                                            </div>
                                        </div>
                                        <div class="col-6 align-self-end text-right">
                                            <img src="img/illustrations/customer-support.png" alt="Customer Support"
                                                class="img-fluid illustration-img">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-3 d-flex">
                            <div class="card flex-fill">
                                <div class="card-body py-4">
                                    <div class="media">
                                        <div class="media-body">
                                            <h3 class="mb-2">{{ $pending_stores_count }}</h3> 
                                            <p class="mb-2"> Store Waiting for Approval </p>
                                            <h3 class="mb-2"> {{ $approved_stores_count }} </h3>
                                            <p class="mb-2"> Total Approved Store </p>
                                            <div class="mb-0">
                                                <span class="badge badge-soft-success mr-2"> <i
                                                        class="mdi mdi-arrow-bottom-right"></i> +5 </span>
                                                <span class="text-muted">This Month</span>
                                            </div>
                                        </div>
                                        <div class="d-inline-block ml-3">
                                            <div class="stat">
                                                <i class="align-middle text-success" data-feather="home"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-3 d-flex">
                            <div class="card flex-fill">
                                <div class="card-body py-4">
                                    <div class="media">
                                        <div class="media-body">
                                            <h3 class="mb-2">{{ $pending_items_count }}</h3>
                                            <p class="mb-2">Pending Products</p>
                                            <h3 class="mb-2">{{ $approved_items_count }}</h3>
                                            <p class="mb-2">Total Approved Products</p>
                                            <div class="mb-0">
                                                <span class="badge badge-soft-success mr-2"> <i
                                                        class="mdi mdi-arrow-bottom-right"></i> +120 </span>
                                                <span class="text-muted">This month</span>
                                            </div>
                                        </div>
                                        <div class="d-inline-block ml-3">
                                            <div class="stat">
                                                <i class="align-middle text-success" data-feather="shopping-bag"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-3 d-flex">
                            <div class="card flex-fill">
                                <div class="card-body py-4">
                                    <div class="media">
                                        <div class="media-body">
                                            <h3 class="mb-2">$ 18.700</h3>
                                            <p class="mb-2">Total Revenue</p>
                                            <div class="mb-0">
                                                <span class="badge badge-soft-success mr-2"> <i
                                                        class="mdi mdi-arrow-bottom-right"></i> +6305 </span>
                                                <span class="text-muted">Since last day</span>
                                            </div>
                                        </div>
                                        <div class="d-inline-block ml-3">
                                            <div class="stat">
                                                <i class="align-middle text-success" data-feather="dollar-sign"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-3 d-flex">
                            <div class="card flex-fill">
                                <div class="card-body py-4">
                                    <div class="media">
                                        <div class="media-body">
                                            <h3 class="mb-2">{{ $pending_buying_requests_count }}</h3>
                                            <p class="mb-2">Pending Products RFQ</p>
                                            <h3 class="mb-2">{{ $total_buying_requests_count }}</h3>
                                            <p class="mb-2">Total RFQ</p>
                                            <div class="mb-0">
                                                <span class="badge badge-soft-success mr-2"> <i
                                                        class="mdi mdi-arrow-bottom-right"></i> +20 </span>
                                                <span class="text-muted">This month</span>
                                            </div>
                                        </div>
                                        <div class="d-inline-block ml-3">
                                            <div class="stat">
                                                <i class="align-middle text-success" data-feather="link"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-3 d-flex">
                            <div class="card flex-fill">
                                <div class="card-body py-4">
                                    <div class="media">
                                        <div class="media-body">
                                            <h3 class="mb-2">{{ $pending_global_buying_requests_count }}</h3>
                                            <p class="mb-2">Pending Global RFQ</p>
                                            <h3 class="mb-2">{{ $total_global_buying_requests_count }}</h3>
                                            <p class="mb-2">Total RFQ</p>
                                            <div class="mb-0">
                                                <span class="badge badge-soft-success mr-2"> <i
                                                        class="mdi mdi-arrow-bottom-right"></i> +20 </span>
                                                <span class="text-muted">This month</span>
                                            </div>
                                        </div>
                                        <div class="d-inline-block ml-3">
                                            <div class="stat">
                                                <i class="align-middle text-success" data-feather="link"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-3 d-flex">
                            <div class="card flex-fill">
                                <div class="card-body py-4">
                                    <div class="media">
                                        <div class="media-body">
                                            <h3 class="mb-2">4300</h3>
                                            <p class="mb-2">Call Request</p>
                                            <div class="mb-0">
                                                <span class="badge badge-soft-success mr-2"> <i
                                                        class="mdi mdi-arrow-bottom-right"></i> +20 </span>
                                                <span class="text-muted">This month</span>
                                            </div>
                                        </div>
                                        <div class="d-inline-block ml-3">
                                            <div class="stat">
                                                <i class="align-middle text-success" data-feather="link"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-3 d-flex">
                            <div class="card flex-fill">
                                <div class="card-body py-4">
                                    <div class="media">
                                        <div class="media-body">
                                            <h3 class="mb-2">50</h3>
                                            <p class="mb-2">Unread Message</p>
                                        </div>
                                        <div class="d-inline-block ml-3">
                                            <div class="stat">
                                                <i class="align-middle text-success" data-feather="message"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-lg-8 d-flex">
                            <div class="card flex-fill w-100">
                                <div class="card-header">
                                    <div class="card-actions float-right">
                                        <div class="dropdown show">
                                            <a href="#" data-toggle="dropdown" data-display="static">
                                                <i class="align-middle" data-feather="more-horizontal"></i>
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#">Action</a>
                                                <a class="dropdown-item" href="#">Another action</a>
                                                <a class="dropdown-item" href="#">Something else here</a>
                                            </div>
                                        </div>
                                    </div>
                                    <h5 class="card-title mb-0">Sales / Revenue</h5>
                                </div>
                                <div class="card-body d-flex w-100">
                                    <div class="align-self-center chart chart-lg">
                                        <canvas id="chartjs-dashboard-bar"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 col-xl-4 d-flex">
                            <div class="card flex-fill">
                                <div class="card-header">
                                    <div class="card-actions float-right">
                                        <div class="dropdown show">
                                            <a href="#" data-toggle="dropdown" data-display="static">
                                                <i class="align-middle" data-feather="more-horizontal"></i>
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#">Action</a>
                                                <a class="dropdown-item" href="#">Another action</a>
                                                <a class="dropdown-item" href="#">Something else here</a>
                                            </div>
                                        </div>
                                    </div>
                                    <h5 class="card-title mb-0">Calendar</h5>
                                </div>
                                <div class="card-body d-flex">
                                    <div class="align-self-center w-100">
                                        <div class="chart">
                                            <div id="datetimepicker-dashboard"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            
            @include('admin.layouts.scripts')
            <!-- footer is here -->
            @include('admin.layouts.footer')

