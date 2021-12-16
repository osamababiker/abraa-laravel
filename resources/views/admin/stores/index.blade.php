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

                    <h1 class="h3 mb-3">Manage Stores Table</h1>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title"> You have {{ $stores_count }} store in this table   </h5>
                                    <div class="row">
                                        <button class="btn btn-primary"> <i class="fa fa-plus"></i> Add New  </button>
                                        &nbsp; &nbsp;
                                        <button class="btn btn-secondary">  Send Questionnaire  </button>
                                        &nbsp; &nbsp;
                                        <button class="btn btn-info">  Send Reminder  </button>
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
                                                <th> <input type="checkbox" name="all_colums" class="select_all_colums"> </th>
                                                <th>Id</th>
                                                <th>Registered Email</th>
                                                <th>Store Name</th>
                                                <th>Sub Domain</th>
                                                <th>Logo</th>
                                                <th>Visits</th>
                                                <th>Store Verified</th>
                                                <th>Contact Count</th>
                                                <th>Date Added </th>
                                                <th>Products</th>
                                                <th>Reminders Sent</th>
                                                <th> Actions </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($stores as $store)
                                            <tr>
                                                <td> <input type="checkbox" name="store_id[]" value="{{ $store->id }}" id=""> </td>
                                                <td>{{ $store->id }}</td>
                                                <td> {{ $store->user->email }}  </td>
                                                <td> {{ $store->name }} </td>
                                                <td> <a target="_blank" href="https://www.abraa.com/store/{{ $store->id }}"> https://www.abraa.com/store/{{ $store->id }} </a> </td>
                                                <td>
                                                    @if($store->logo_url)
                                                    <a target="_blank" href="{{ asset('upload/stores/'. $store->logou_url) }}"> <img width="100" height="100" src="{{ asset('upload/stores/'. $store->logou_url) }}" alt="">  </a>
                                                    @endif
                                                </td>
                                                <td> {{ $store->noofvisits }} </td>
                                                <td>
                                                    @if($store->store_verified == 1)
                                                        <i class="fa fa-check" style="color: green"></i>
                                                    @else 
                                                        <i class="fa fa-times" style="color: red"></i>
                                                    @endif
                                                </td>
                                                <td> {{ $store->contact_count }} </td>
                                                <td> {{ $store->date_added }}  </td>
                                                <td> 
                                                    @if($store->items)
                                                    <a target="_blank" href=""> {{ $store->items->count() }} </a> 
                                                    @endif
                                                </td>
                                                <td> 
                                                   
                                                </td>
                                                <td class="table-action">
                                                    <a href="#" type="button" data-toggle="modal" data-target="#view_store_{{ $store->id }}"><i class="align-middle" data-feather="eye"></i></a>
                                                    <a href="#" type="button" data-toggle="modal" data-target="#edit_store_{{ $store->id }}"><i class="align-middle" data-feather="edit-2"></i></a>
                                                    <a href="#"><i class="align-middle" data-toggle="modal" data-target="#delete_store_{{ $store->id }}" data-feather="trash"></i></a>
                                                </td>
                                            </tr>
                                            <!-- include table component -->
                                            @include('admin.stores.components.edit')
                                            @include('admin.stores.components.delete')
                                            @include('admin.stores.components.delete_selected')
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-center">
                                        {!! $stores->links("pagination::bootstrap-4") !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </main>

            <!-- footer is here -->
            @include('admin.layouts.footer')
