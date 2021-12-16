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

                    <form id="suppliers_actions_form" action="{{ route('suppliers.actions') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title"> You have {{ $suppliers_count }} supplier in this table </h5>
                                        <div class="row">
                                            <a href="{{ route('suppliers.create') }}" class="btn btn-primary"> <i class="fa fa-plus"></i> Add New  </a>
                                            &nbsp; &nbsp;
                                            <button type="button" data-toggle="modal" data-target="#delete_selected_confirm" class="btn btn-danger"> <i class="fa fa-trash"></i> Archive Selected  </button>
                                            &nbsp; &nbsp;
                                            <button type="button" name="send_email_multiple" class="btn btn-info"> <i class="fa fa-envelope"></i> Send Email  </button>
                                            &nbsp; &nbsp;
                                            <button type="button" name="send_sms_multiple" class="btn btn-success"> <i class="fa fa-phone"></i> Send SMS  </button>
                                            &nbsp; &nbsp;
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Tools
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="#">Export to excel</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <table id="datatables-reponsive" class="table table-striped" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th> <input type="checkbox" name="all_colums" class="select_all_colums"> </th>
                                                    <th>Id</th>
                                                    <th>Full Name</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>Date Registered</th>
                                                    <th>Verified</th>
                                                    <th>Country</th>
                                                    <th>Company</th>
                                                    <th>Is Organic</th>
                                                    <th>User Source </th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead> 
                                            <tbody>
                                                @foreach($suppliers as $supplier)
                                                <tr>
                                                    <td> <input type="checkbox" name="supplier_id[]" value="{{ $supplier->id }}" id=""> </td>
                                                    <td>{{ $supplier->id }}</td>
                                                    <td>{{ $supplier->full_name }}</td>
                                                    <td>{{ $supplier->email }}</td>
                                                    <td>{{ $supplier->phone }}</td>
                                                    <td>{{ $supplier->date_added }}</td>
                                                    <td> 
                                                        @if($supplier->verified)
                                                            <i class="fa fa-check" style="color: green;"></i> 
                                                        @else 
                                                            <i class="fa fa-times" style="color: red;"></i>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($supplier->supplier_country)
                                                        {{ $supplier->supplier_country->en_name }}
                                                        @endif
                                                    </td>
                                                    <td> {{ $supplier->company }} </td>
                                                    <td> 
                                                        @if($supplier->is_organic)
                                                            <i class="fa fa-check" style="color: green;"></i> 
                                                        @else 
                                                            <i class="fa fa-times" style="color: red;"></i>
                                                        @endif
                                                    </td>
                                                    <td> {{ $supplier->getUserSource($supplier->user_source)  }} </td>
                                                    <td class="table-action">
                                                        <a href="#" type="button" data-toggle="modal" data-target="#edit_supplier_{{ $supplier->id }}"><i class="align-middle" data-feather="edit-2"></i></a>
                                                        <a href="#"><i class="align-middle" data-toggle="modal" data-target="#delete_supplier_{{ $supplier->id }}" data-feather="trash"></i></a>
                                                        <a class="dropdown">
                                                            <a class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                <a class="dropdown-item" type="button" data-toggle="modal" data-target="#supplier_items_{{ $supplier->id }}"><i class="align-middle">Items</a>
                                                                <a class="dropdown-item" href="#">Users store</a>
                                                                <a class="dropdown-item" href="#">Buying request suppliers</a>
                                                                <a class="dropdown-item" href="#">Users files</a>
                                                                <a class="dropdown-item" href="#">Buy request views</a>
                                                                <a class="dropdown-item" href="#">Buying request invoice</a>
                                                                <a class="dropdown-item" href="#">Marketing store activities </a>
                                                                <a class="dropdown-item" href="#">Call center activities</a>
                                                                <a class="dropdown-item" href="#">Rfq pending suppliers</a>
                                                                <a class="dropdown-item" href="#">Store marketing docs</a>
                                                                <a class="dropdown-item" href="#">Rfq supplier log</a>
                                                                <a class="dropdown-item" href="#">Supplier verification</a>
                                                            </div>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <!-- include table component -->
                                                @include('admin.suppliers.components.items')
                                                @include('admin.suppliers.components.edit')
                                                @include('admin.suppliers.components.delete')
                                                @include('admin.suppliers.components.delete_selected')
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div class="d-flex justify-content-center">
                                            {!! $suppliers->links("pagination::bootstrap-4") !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </main>

            <!-- footer is here -->
            @include('admin.layouts.footer')
