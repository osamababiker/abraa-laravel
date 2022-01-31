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
 
                    <h1 class="h3 mb-3"> <i class="fa fa-edit"></i> Edit Ads </h1>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card"> 
                                <div class="card-body">
                                <form method="post" action="{{ route('ads.update') }}" enctype="multipart/form-data">
                                        @csrf 
                                        <input type="hidden" name="ads_id" value="{{ $ads->id }}">
                                        <div class="form-row mt-4">
                                            <div class="col-md-6 form-group">
                                                <label for="name">Ad Name</label>
                                                <input type="text" value="{{ $ads->name }}" name="name" id="name" class="form-control">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="sub_of">Ad Category</label>
                                                <select name="sub_of" id="sub_of" class="form-control select2">
                                                    <option selected value="{{ $ads->category->id }}">{{ $ads->category->name }}</option>
                                                    @foreach($adsCategories as $category)
                                                        <option value="{{ $category->name }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <label for="ad_type">Ad Type</label>
                                                <input type="text" value="{{ $ads->ad_type }}" name="ad_type" class="form-control" id="ad_type">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="link">Ad Link</label>
                                                <input type="text" value="{{ $ads->link }}" name="link" id="link" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-row mt-4">
                                            <div class="col-md-12">
                                                <div class="file-drop-area"> 
                                                    <span class="choose-file-button">Choose Add Image</span> 
                                                    <input type="file" name="pic_url" id="pic-url-input" class="file-input" accept=".jfif,.jpg,.jpeg,.png,.gif"> 
                                                </div>
                                                <div id="ads_preview"></div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <label for="ad_code">Ad Code</label>
                                                <input type="text" value="{{ $ads->ad_code }}" class="form-control" name="ad_code" id="ad_code">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="alt_txt">Add Alt Text</label>
                                                <input type="text" value="{{ $ads->alt_txt }}" class="form-control" name="alt_txt" id="alt_txt">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <label for="start_on">Ad Start On </label>
                                                <input type="text" value="{{ $ads->start_on }}" class="form-control ymd_datepicker" name="start_on" id="start_on">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="expire_on">Add Expire On</label>
                                                <input type="text" value="{{ $ads->expire_on }}" class="form-control ymd_datepicker" name="expire_on" id="expire_on">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <label for="lang"> Select Language </label>
                                                <select name="lang" id="lang" class="form-control select2">
                                                    <option selected value="{{ $ads->language->code }}">{{ $ads->language->name }}</option>
                                                    @foreach($languages as $language)
                                                        <option value="{{ $language->code }}">{{ $language->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="active"> Choose Status </label>
                                                <select name="active" id="active" class="form-control select2">
                                                    @if($ads->active == 1)
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
                                            <a href="{{ route('ads.index') }}" type="button" class="btn btn-primary">Go Back</a>
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
            <script src="{{ asset('js/add_ads.js') }}"></script>
            <!-- footer is here -->
            @include('admin.layouts.footer')
