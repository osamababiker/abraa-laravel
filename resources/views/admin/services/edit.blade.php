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

                    <h1 class="h3 mb-3"> <i class="fa fa-edit"></i> Edit Service </h1>

                    @if ($errors->any())
                        <div class="alert alert-danger pt-2">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <form method="post" action="{{ route('services.update') }}" enctype='multipart/form-data'>
                                        @csrf
                                        <input type="hidden" name="service_id" value="{{ $service['id'] }}">
                                        <div class="form-group col-md-12 required">
                                            <label>Name</label>
                                            <input class="form-control form-control-lg"  value="{{ $service['name'] }}" id="name" type="text" name="name"/>
                                        </div>
                                        <div class="form-group col-md-12 required">
                                            <label>Meta title</label>
                                            <textarea cols="4" rows="4" class="form-control form-control-lg" id="meta-title" name="meta_title">{{ $service['meta-title'] }}</textarea>
                                        </div>
                                        <div class="form-group col-md-12 required">
                                            <label for="meta_keywords">Meta keywords</label>
                                            <select multiple="multiple" name="meta_keywords" id="meta_keywords" class="form-control select2">
                                                <option selected value="{{ $service['meta-keywords'] }}">{{ $service['meta-keywords'] }}</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12 required">
                                            <label id="meta_description">Meta Description</label>
                                            <textarea cols="4" rows="4" class="form-control form-control-lg" id="meta_description" name="meta_description">{{ $service['meta-description'] }}</textarea>
                                        </div>
                                        <div class="form-group col-md-12 required">
                                            <label id="pagecontent">Page Content</label>
                                            <textarea cols="4" rows="4" class="form-control form-control-lg" id="pagecontent" name="pagecontent">{{ $service['pagecontent'] }}</textarea>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6 required">
                                                <label>Service Type</label>
                                                <input id="stype" class="form-control form-control-lg" type="text"
                                                    name="stype" value="{{ $service['stype'] }}"/>
                                            </div>
                                            <div class="form-group col-md-6 required">
                                                <label for="active"> Service status </label>
                                                <select name="active" id="active" class="form-control select2">
                                                    @if($service['active'] == 1)
                                                        <option selected value="1">Active</option>
                                                        <option value="0">Not Active</option>
                                                    @else 
                                                        <option selected value="0">Not Active</option>
                                                        <option value="1">Active</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="file-drop-area"> 
                                                <span class="choose-file-button">Choose Service Image</span> 
                                                <input type="file" name="service_image" id="service_image_input" class="file-input" accept=".jfif,.jpg,.jpeg,.png,.gif"> 
                                            </div>
                                            <div id="service_image_preview"></div>
                                        </div>
                                        <div class="form-group col-md-12 required">
                                            <label for="description">Service description</label>
                                            <textarea name="description" class="form-control" id="description" cols="30" rows="10">{{ $service['description'] }}</textarea>
                                        </div>
                                        <div class="text-center mt-3">
                                            <button type="submit" class="btn btn-lg btn-primary">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </main>
            
            @if(session()->has('feedback'))
                @include('admin.layouts.feedback')
            @endif
            @include('admin.layouts.scripts')
            <script scr="{{ asset('js/add_service.js') }}"></script>
            <!-- footer is here -->
            @include('admin.layouts.footer')
