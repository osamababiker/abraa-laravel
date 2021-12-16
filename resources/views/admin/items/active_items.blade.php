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

                    <h1 class="h3 mb-3">Items Table</h1>

                    <form action="{{ route('items.actions') }}" id="items_actions_form" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title"> You have {{ $items_count }} item in this table  </h5>
                                        <div class="row">
                                            <button class="btn btn-primary"> <i class="fa fa-plus"></i> Add New  </button>
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
                                                    <th>Title</th>
                                                    <th>Category</th>
                                                    <th>Link</th>
                                                    <th>Created at</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($items as $item)
                                                <tr>
                                                    <td> <input type="checkbox" name="item_id[]" value="{{ $item->id }}" id=""> </td>
                                                    <td>{{ $item->id }}</td>
                                                    <td> {{ $item->title }} </td>
                                                    <td>{{ $item->sub_of }}</td>
                                                    <td>  
                                                        <a href="{{ $item->slug }}">{{ $item->slug }}</a>
                                                    </td>
                                                    <td>{{ $item->date_added }}</td>
                                                    <td class="table-action">
                                                        <a href="#" type="button" data-toggle="modal" data-target="#view_item_{{ $item->id }}"><i class="align-middle" data-feather="eye"></i></a>
                                                        <a href="#" type="button" data-toggle="modal" data-target="#edit_item_{{ $item->id }}"><i class="align-middle" data-feather="edit-2"></i></a>
                                                        <a href="#"><i class="align-middle" data-toggle="modal" data-target="#delete_item_{{ $item->id }}" data-feather="trash"></i></a>
                                                    </td>
                                                </tr>
                                                <!-- include table component -->
                                                @include('admin.items.components.edit')
                                                @include('admin.items.components.delete')
                                                @include('admin.items.components.delete_selected')
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div class="d-flex justify-content-center">
                                            {!! $items->links("pagination::bootstrap-4") !!}
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
