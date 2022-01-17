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
 
                    <h1 class="h3 mb-3"> <i class="fa fa-edit"></i> Update config </h1>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                <form method="post" action="{{ route('configs.update') }}">
                                        @csrf 
                                        <input type="hidden" name="config_id" value="{{ $config->id }}">
                                        <div class="form-row mt-4">
                                            <div class="col-md-12 form-group">
                                                <label for="config_name">Config Name</label>
                                                <input type="text" name="config_name" value="{{ $config->config_name }}" id="config_name" class="form-control">
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label for="config_value">Config Value</label>
                                                <textarea name="config_value" cols="3" rows="3" id="config_value" class="form-control">{{ $config->config_value }}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-row mt-5 d-flex justify-content-center">
                                            <button type="submit" class="btn btn-success">Save Changes</button>
                                            &nbsp; &nbsp;
                                            <a href="{{ route('configs.index') }}" type="button" class="btn btn-primary">Go Back</a>
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
            <!-- footer is here -->
            @include('admin.layouts.footer')
