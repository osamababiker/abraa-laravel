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
 
                    <h1 class="h3 mb-3"> <i class="fa fa-edit"></i> Edit pavillion </h1>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <form method="post" action="{{ route('pavillions.update') }}" enctype="multipart/form-data">
                                        @csrf 
                                        <input type="hidden" name="pavillion_id" value="{{ $pavillion->id }}">
                                        <div class="form-row mt-4">
                                            <div class="col-md-12 form-group">
                                                <label for="name">Pavillion Name</label>
                                                <input name="name" value="{{ $pavillion->name }}" type="text" class="form-control" id="name">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="file-drop-area"> 
                                                    <span class="choose-file-button">Choose Pavillion Logo</span> 
                                                    <input type="file" name="logo" id="logo-input" class="file-input" accept=".jfif,.jpg,.jpeg,.png,.gif"> 
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div id="logo_preview"></div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="file-drop-area"> 
                                                    <span class="choose-file-button">Choose Main Banner </span> 
                                                    <input type="file" name="main_banner" id="main-banner-input" class="file-input" accept=".jfif,.jpg,.jpeg,.png,.gif"> 
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div id="main-banner-preview"></div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="file-drop-area"> 
                                                    <span class="choose-file-button">Choose Right Banner 1</span> 
                                                    <input type="file" name="right_banner_1" id="right-banner-1-input" class="file-input" accept=".jfif,.jpg,.jpeg,.png,.gif"> 
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div id="right-banner-1-preview"></div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="file-drop-area"> 
                                                    <span class="choose-file-button">Choose Right Banner 2</span> 
                                                    <input type="file" name="right_banner_2" id="right-banner-2-input" class="file-input" accept=".jfif,.jpg,.jpeg,.png,.gif"> 
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div id="right-banner-2-preview"></div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="file-drop-area"> 
                                                    <span class="choose-file-button">Choose Left Banner </span> 
                                                    <input type="file" name="left_banner" id="left-banner-input" class="file-input" accept=".jfif,.jpg,.jpeg,.png,.gif"> 
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div id="left-banner-preview"></div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <label for="bio">Pavillion Bio</label>
                                            <textarea name="bio" id="bio" cols="30" rows="8" class="form-control">{{ $pavillion->bio }}</textarea>
                                        </div>
                                        <div class="form-row mt-5 d-flex justify-content-center">
                                            <button type="submit" class="btn btn-success">Save Changes</button>
                                            &nbsp; &nbsp;
                                            <a href="{{ route('pavillions.index') }}" type="button" class="btn btn-primary">Go Back</a>
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
            <script src="{{ asset('js/add_pavillion.js') }}"></script>
            <!-- footer is here -->
            @include('admin.layouts.footer')
