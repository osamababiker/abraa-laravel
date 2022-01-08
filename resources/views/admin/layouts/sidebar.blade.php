 

<nav id="sidebar" class="sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="/">
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
                y="0px" width="20px" height="20px" viewBox="0 0 20 20" enable-background="new 0 0 20 20"
                xml:space="preserve">
                <path d="M19.4,4.1l-9-4C10.1,0,9.9,0,9.6,0.1l-9,4C0.2,4.2,0,4.6,0,5s0.2,0.8,0.6,0.9l9,4C9.7,10,9.9,10,10,10s0.3,0,0.4-0.1l9-4
        C19.8,5.8,20,5.4,20,5S19.8,4.2,19.4,4.1z" />
                <path d="M10,15c-0.1,0-0.3,0-0.4-0.1l-9-4c-0.5-0.2-0.7-0.8-0.5-1.3c0.2-0.5,0.8-0.7,1.3-0.5l8.6,3.8l8.6-3.8c0.5-0.2,1.1,0,1.3,0.5
        c0.2,0.5,0,1.1-0.5,1.3l-9,4C10.3,15,10.1,15,10,15z" />
                <path d="M10,20c-0.1,0-0.3,0-0.4-0.1l-9-4c-0.5-0.2-0.7-0.8-0.5-1.3c0.2-0.5,0.8-0.7,1.3-0.5l8.6,3.8l8.6-3.8c0.5-0.2,1.1,0,1.3,0.5
        c0.2,0.5,0,1.1-0.5,1.3l-9,4C10.3,20,10.1,20,10,20z" />
            </svg>
            <span class="align-middle mr-3">Abraa.com</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-item">
                <a href="#settings" data-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="settings"></i> <span class="align-middle">Configs</span>
                </a>
                <ul id="settings" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('configs.index') }}">Website Config</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('countries.index') }}">Website Countries</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('states.index') }}">Countries States</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('currencies.index') }}">Website Currencies</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('units.index') }}">Website Units</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('paymentOptions.index') }}">Payment Options</a></li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a href="#suppliers" data-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="users"></i> <span class="align-middle">Suppliers</span>
                </a>
                <ul id="suppliers" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('suppliers.index') }}">All suppliers</a></li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a href="#admins" data-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="lock"></i> <span class="align-middle">Admin Users</span>
                </a>
                <ul id="admins" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('users.index') }}"> Admins</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('moderators.index') }}"> moderators</a></li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a href="#home_items" data-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="home"></i> <span class="align-middle"> Home Items </span>
                </a>
                <ul id="home_items" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('services.index') }}"> Services</a></li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a href="#buyers" data-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="users"></i> <span class="align-middle">Buyers</span>
                </a>
                <ul id="buyers" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('buyers.index') }}">All buyers</a></li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a href="#shippers" data-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="users"></i> <span class="align-middle">Shippers</span>
                </a>
                <ul id="shippers" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('shippers.index') }}">All shippers</a></li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a href="#stores" data-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="home"></i> <span class="align-middle">Stores</span>
                </a>
                <ul id="stores" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('stores.index') }}">All stores</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('stores.active.index') }}">Active Stores</a>
                    </li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('stores.pending.index') }}">Waiting Stores</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('stores.bulk.index') }}">Bulk Stores</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('stores.rejected.index') }}">Rejected Stores</a></li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a href="#products" data-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="list"></i> <span class="align-middle">Products</span>
                </a>
                <ul id="products" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('items.index') }}">All Products</a></li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a href="#categories" data-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="list"></i> <span class="align-middle">Categories</span>
                </a>
                <ul id="categories" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('categories.index') }}">All Categories</a></li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a href="#rfq" data-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="list"></i> <span class="align-middle">Quotation </span>
                </a>
                <ul id="rfq" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('rfqInvoices.index') }}">Rfq Invoices</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('rfqs.index') }}">Pending Rfq</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('globalRfqs.index') }}">Global Rfq</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('productRfqs.index') }}">Product Rfq</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="pages-pricing.html">Closed Buying Quotation</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="pages-pricing.html">Abandoned  Buying Quotation</a></li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a href="#members" data-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="users"></i> <span class="align-middle">Members</span>
                </a>
                <ul id="members" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('members.index') }}">Users Activites</a></li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a href="#advertisement" data-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="flag"></i> <span class="align-middle">Advertisement</span>
                </a>
                <ul id="advertisement" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('homeSliders.index') }}">Home Slider</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('homeBanners.index') }}"> Home Banners </a> </li>
                    <li class="sidebar-item"><a class="sidebar-link" href="charts-apexcharts.html"> RFQ Slider </a> </li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('adsCategories.index') }}"> Ads Area </a> </li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('ads.index') }}"> Ads </a> </li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a href="#memberships" data-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="users"></i> <span class="align-middle">Memberships</span>
                </a>
                <ul id="memberships" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('membershipsPlans.index') }}"> Plans </a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="#"> Subscriptions </a> </li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('membershipsTransactions.index') }}"> Transactions </a> </li>
                    <li class="sidebar-item"><a class="sidebar-link" href="#"> Call Requests </a> </li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a href="#charts" data-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="pie-chart"></i> <span class="align-middle">Reports</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="#">
                    <i class="align-middle" data-feather="bell"></i> <span class="align-middle">Notifications</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="#">
                    <i class="align-middle" data-feather="trash"></i> <span class="align-middle">Clear Cache</span>
                </a>
            </li>
        </ul>

        <div class="sidebar-cta">
            <div class="sidebar-cta-content">
                <strong class="d-inline-block mb-2">Monthly Sales Report</strong>
                <div class="mb-3 text-sm">
                    Your monthly sales report is ready for download!
                </div>
                <a href="https://themes.getbootstrap.com/product/appstack-responsive-admin-template/"
                    class="btn btn-primary btn-block" target="_blank">Download</a>
            </div>
        </div>
    </div>
</nav>
