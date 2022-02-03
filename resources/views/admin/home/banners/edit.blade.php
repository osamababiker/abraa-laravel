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
 
                    <h1 class="h3 mb-3"> <i class="fa fa-edit"></i> Update banner </h1>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <form method="post" action="{{ route('homebanners.update') }}" enctype="multipart/form-data">
                                        @csrf 
                                        <input type="hidden" name="banner_id" id="banner_id" value="{{ $banner->id }}">
                                        <div class="form-row mt-4">
                                            <div class="col-md-6">
                                                <div class="file-drop-area"> 
                                                    <span class="choose-file-button">Choose banner Image</span> 
                                                    <input type="file"  name="slider" id="banner-input" class="file-input" accept=".jfif,.jpg,.jpeg,.png,.gif"> 
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div id="banner_preview"></div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <label for="link">banner Link</label>
                                                <input type="text" value="{{ $banner->link }}" class="form-control" name="link" id="link">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="title">Alt Text</label>
                                                <input type="text" value="{{ $banner->title }}" class="form-control" name="title" id="title">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <label for="region"> Select Language </label>
                                                <select name="region" id="region" class="form-control select2">
                                                    <option selected value="{{ $banner->language->code }}">{{ $banner->language->name }}</option>
                                                    @foreach($languages as $language)
                                                        <option value="{{ $language->code }}">{{ $language->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="status"> Choose Status </label>
                                                <select name="status" id="status" class="form-control select2">
                                                    @if($banner->status == 1)
                                                        <option selected value="1">Active</option>
                                                        <option value="0">Not Active</option>
                                                    @else 
                                                        <option selected value="0">Not Active</option>
                                                        <option value="1">Active</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row mt-5 d-flex justify-content-center">
                                            <button type="submit" class="btn btn-success">Save Changes</button>
                                            &nbsp; &nbsp;
                                            <a href="{{ route('homeBanners.index') }}" type="button" class="btn btn-primary">Go Back</a>
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
            <script src="{{ asset('js/add_banner.js') }}"></script>
            <!-- footer is here -->
            @include('admin.layouts.footer')
