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

                    <h1 class="h3 mb-3">Manage Pending Quotes Table</h1>

                    <div class="row">
                        <div class="col-12"> 
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title"> You have {{ $buying_requests_count }} Quotes in this table  </h5>
                                    <div class="row">
                                        <button class="btn btn-primary"> <i class="fa fa-plus"></i> Add New  </button>
                                        &nbsp; &nbsp;
                                        <button type="button" data-toggle="modal" data-target="#approve_selected_buying_request" class="btn btn-success"> Approve Selected  </button>
                                        &nbsp; &nbsp;
                                        <button type="button"  data-toggle="modal" data-target="#delete_selected_confirm" class="btn btn-danger"> <i class="fa fa-trash"></i> Delete Selected  </button>
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
                                                <th> <input type="checkbox" class="select_all_colums"> </th>
                                                <th>Id</th>
                                                <th> Product name </th>
                                                <th>Category</th>
                                                <th>Buying Request</th>
                                                <th>Supplier</th>
                                                <th>Supplier Email</th>
                                                <th>Quantity</th>
                                                <th>Unit</th>
                                                <th>Price</th>
                                                <th>Total price</th>
                                                <th>Currency </th>
                                                <th>Message</th>
                                                <th>Confirmed</th>
                                                <th>Datetime</th>
                                                <th>Vat</th>
                                                <th> Actions </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($buying_requests as $buying_request)
                                            <tr>
                                                <td> <input type="checkbox" name="buying_request_id[]" value="{{ $buying_request->id }}" id=""> </td>
                                                <td> {{ $buying_request->id }} </td>
                                                <td> {{ $buying_request->product_name }} </td>
                                                <td> 
                                                    @if($buying_request->category)
                                                    {{ $buying_request->category->en_title }} 
                                                    @endif
                                                </td>
                                                <td>  </td>
                                                <td>  </td>
                                                <td>  </td>
                                                <td> {{ $buying_request->quantity }} </td>
                                                <td> 
                                                    @if($buying_request->unit)
                                                    {{ $buying_request->unit->unit_en }} 
                                                    @endif
                                                </td>
                                                <td> {{ $buying_request->target_price }} </td>
                                                <td> {{ $buying_request->target_price * $buying_request->quantity }} </td>
                                                <td>  </td>
                                                <td> <a type="button" data-toggle="modal" data-target="#buying_message_{{ $buying_request->id }}"><i class="align-middle" href="javascript:;"> <i class="fa fa-ellipsis-h"></i> </a> </td>
                                                <td>
                                                    <i class="fa fa-check" style="color: green"></i>
                                                </td>
                                                <td> {{ $buying_request->date_added }} </td>
                                                <td>  </td>
                                                <td class="table-action">
                                                    <a href="#" type="button" data-toggle="modal" data-target="#view_buying_request_{{ $buying_request->id }}"><i class="align-middle" data-feather="eye"></i></a>
                                                    <a href="#" type="button" data-toggle="modal" data-target="#edit_buying_request_{{ $buying_request->id }}"><i class="align-middle" data-feather="edit-2"></i></a>
                                                    <a href="#"><i class="align-middle" data-toggle="modal" data-target="#delete_buying_request_{{ $buying_request->id }}" data-feather="trash"></i></a>
                                                </td>
                                            </tr>
                                            <!-- include table component -->
                                            @include('admin.rfq.components.edit')
                                            @include('admin.rfq.components.delete')
                                            @include('admin.rfq.components.buying_message')
                                            @include('admin.rfq.components.approve')
                                            @include('admin.rfq.components.delete_selected')
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-center">
                                        {!! $buying_requests->links("pagination::bootstrap-4") !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </main>

            <!-- footer is here -->
            @include('admin.layouts.footer')
