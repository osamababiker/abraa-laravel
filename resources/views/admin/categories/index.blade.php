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

                    <h1 class="h3 mb-3">Categories Table</h1>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title"> You have {{ $categories_count }} category in this table  </h5>
                                    <div class="row">
                                        <button class="btn btn-primary"> <i class="fa fa-plus"></i> Add New  </button>
                                        &nbsp; &nbsp;
                                        <button type="button"  data-toggle="modal" data-target="#delete_selected_confirm" class="btn btn-danger">  <i class="fa fa-trash"></i> Archive Selected  </button>
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
                                                <th>Parent</th>
                                                <th>Title</th>
                                                <th>Status</th>
                                                <th>Home Category</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($categories as $category)
                                            <tr>
                                                <td> <input type="checkbox" name="category_id[]" value="{{ $category->id }}" id=""> </td>
                                                <td>{{ $category->id }}</td>
                                                <td> 
                                                    @if($category->parentCategory)
                                                    {{ $category->parentCategory->en_title  }} 
                                                    @endif
                                                </td>
                                                <td>{{ $category->en_title }}</td>
                                                <td>  
                                                    @if($category->status == 1)
                                                        <i class="fa fa-check" style="color: green"></i>
                                                    @else 
                                                        <i class="fa fa-times" style="color: red"></i>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($category->is_home_thumb == 1)
                                                        <i class="fa fa-check" style="color: green"></i>
                                                    @else 
                                                        <i class="fa fa-times" style="color: red"></i>
                                                    @endif
                                                </td>
                                                <td class="table-action">
                                                    <a href="#" type="button" data-toggle="modal" data-target="#view_category_{{ $category->id }}"><i class="align-middle" data-feather="eye"></i></a>
                                                    <a href="#" type="button" data-toggle="modal" data-target="#edit_category_{{ $category->id }}"><i class="align-middle" data-feather="edit-2"></i></a>
                                                    <a href="#"><i class="align-middle" data-toggle="modal" data-target="#delete_category_{{ $category->id }}" data-feather="trash"></i></a>
                                                </td>
                                            </tr>
                                            <!-- include table component -->
                                            @include('admin.categories.components.edit')
                                            @include('admin.categories.components.delete')
                                            @include('admin.categories.components.delete_selected')
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-center">
                                        {!! $categories->links("pagination::bootstrap-4") !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </main>

            <!-- footer is here -->
            @include('admin.layouts.footer')
