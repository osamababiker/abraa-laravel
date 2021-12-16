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

                    <h1 class="h3 mb-3">Manage Buyers Table</h1>

                    <div class="row">
                        <div class="col-12"> 
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title"> You have {{ $buyers_count }} buyer in this table  </h5>
                                    <div class="row">
                                        <button class="btn btn-primary"> <i class="fa fa-plus"></i> Add New  </button>
                                        &nbsp; &nbsp;
                                        <button class="btn btn-secondary">  Send Questionnaire  </button>
                                        &nbsp; &nbsp;
                                        <button class="btn btn-info">  Send Reminder  </button>
                                        &nbsp; &nbsp;
                                        <button type="button"  data-toggle="modal" data-target="#delete_selected_confirm" class="btn btn-danger"> <i class="fa fa-trash"></i> Archive Selected  </button>
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
                                                <th>Full name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Date Registered</th>
                                                <th>Verified</th>
                                                <th>Country</th>
                                                <th>Company</th>
                                                <th>Is Organic</th>
                                                <th>Source</th>
                                                <th> Actions </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($buyers as $buyer)
                                            <tr>
                                                <td> <input type="checkbox" name="buyer_id[]" value="{{ $buyer->id }}" id=""> </td>
                                                <td> {{ $buyer->id }} </td>
                                                <td> {{ $buyer->full_name }} </td>
                                                <td> {{ $buyer->email }} </td>
                                                <td> {{ $buyer->phone }} </td>
                                                <td> {{ $buyer->date_added }} </td>
                                                <td>
                                                    @if($buyer->verified == 1) 
                                                        <i class="fa fa-check" style="color: green"></i>
                                                    @else 
                                                        <i class="fa fa-times" style="color: red"></i>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($buyer->buyer_country)
                                                    {{ $buyer->buyer_country->en_name }}
                                                    @endif
                                                </td>
                                                <td> {{ $buyer->company }} </td>
                                                <td> 
                                                    @if($buyer->is_organic)
                                                        <i class="fa fa-check" style="color: green;"></i> 
                                                    @else 
                                                        <i class="fa fa-times" style="color: red;"></i>
                                                    @endif
                                                </td>
                                                <td> {{ $buyer->getUserSource($buyer->user_source)  }} </td>
                                                <td class="table-action">
                                                    <a href="#" type="button" data-toggle="modal" data-target="#view_buyer_{{ $buyer->id }}"><i class="align-middle" data-feather="eye"></i></a>
                                                    <a href="#" type="button" data-toggle="modal" data-target="#edit_buyer_{{ $buyer->id }}"><i class="align-middle" data-feather="edit-2"></i></a>
                                                    <a href="#"><i class="align-middle" data-toggle="modal" data-target="#delete_buyer_{{ $buyer->id }}" data-feather="trash"></i></a>
                                                </td>
                                            </tr>
                                            <!-- include table component -->
                                            @include('admin.buyers.components.edit')
                                            @include('admin.buyers.components.delete')
                                            @include('admin.buyers.components.delete_selected')
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-center">
                                        {!! $buyers->links("pagination::bootstrap-4") !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </main>

            <!-- footer is here -->
            @include('admin.layouts.footer')
