 

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
                <a href="#suppliers" data-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="users"></i> <span class="align-middle">Suppliers</span>
                </a>
                <ul id="suppliers" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="<?php echo e(route('suppliers.index')); ?>">All supplier</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="<?php echo e(route('suppliers.organic')); ?>">Suppliers (Organic)</a>
                    </li>
                    <li class="sidebar-item"><a class="sidebar-link" href="pages-clients.html">Suppliers (No
                            Keywords)</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="pages-invoice.html">Suppliers Visits</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="pages-pricing.html">Pricing</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="pages-tasks.html">Suppliers By Category /
                            Country</a></li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a href="#buyers" data-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="users"></i> <span class="align-middle">Buyers</span>
                </a>
                <ul id="buyers" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="<?php echo e(route('buyers.index')); ?>">All buyers</a></li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a href="#shippers" data-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="users"></i> <span class="align-middle">Shippers</span>
                </a>
                <ul id="shippers" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="<?php echo e(route('shippers.index')); ?>">All shippers</a></li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a href="#stores" data-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="home"></i> <span class="align-middle">Stores</span>
                </a>
                <ul id="stores" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="<?php echo e(route('stores.index')); ?>">All stores</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="pages-settings.html">Active Stores</a>
                    </li>
                    <li class="sidebar-item"><a class="sidebar-link" href="pages-clients.html">Waiting Stores</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="pages-invoice.html">Bulk Stores</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="pages-pricing.html">Rejected Stores</a></li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a href="#products" data-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="list"></i> <span class="align-middle">Products</span>
                </a>
                <ul id="products" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="<?php echo e(route('items.index')); ?>">All Products</a></li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a href="#categories" data-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="list"></i> <span class="align-middle">Categories</span>
                </a>
                <ul id="categories" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="<?php echo e(route('categories.index')); ?>">All Categories</a></li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a href="#rfq" data-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="list"></i> <span class="align-middle">Request For Quotation</span>
                </a>
                <ul id="rfq" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="<?php echo e(route('rfq.index')); ?>">All Quotation</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="pages-clients.html">Global Quotation</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="pages-invoice.html">Product Buying Quotation</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="pages-pricing.html">Closed Buying Quotation</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="pages-pricing.html">Abandoned  Buying Quotation</a></li>
                </ul>
            </li>

            <li class="sidebar-item">
                <a href="#charts" data-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="pie-chart"></i> <span class="align-middle">Charts</span>
                </a>
                <ul id="charts" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="charts-chartjs.html">Chart.js</a>
                    </li>
                    <li class="sidebar-item"><a class="sidebar-link" href="charts-apexcharts.html">ApexCharts
                </ul>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="notifications.html">
                    <i class="align-middle" data-feather="bell"></i> <span class="align-middle">Notifications</span>
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
<?php /**PATH C:\wamp64\www\abraa-dash\resources\views/admin/layouts/sidebar.blade.php ENDPATH**/ ?>