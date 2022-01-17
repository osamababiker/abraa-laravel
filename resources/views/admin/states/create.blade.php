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
 
                    <h1 class="h3 mb-3"> <i class="fa fa-plus"></i> Add New state </h1>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                <form method="post" action="{{ route('states.store') }}">
                                        @csrf 
                                        <div class="form-row mt-4">
                                            <div class="col-md-6 form-group">
                                                <label for="capital">Is Capital</label>
                                                <select name="capital" id="capital" class="form-control select2">
                                                    <option value="1">is capital</option>
                                                    <option value="0">not capital</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="sub_of">Select Country</label>
                                                <select name="sub_of" id="sub_of" class="form-control select2">
                                                    <option value=""></option>
                                                    @foreach($countries as $country)
                                                        <option value="{{ $country->id }}">{{ $country->en_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6 form-group">
                                                <label for="ar_name">state Arabic Name</label>
                                                <input type="text" name="ar_name" id="ar_name" class="form-control">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="en_name">state English Name</label>
                                                <input type="text" name="en_name" id="en_name" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6 form-group">
                                                <label for="tr_name">state Turkish Name</label>
                                                <input type="text" name="tr_name" id="tr_name" class="form-control">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="ru_name">state Russian Name</label>
                                                <input type="text" name="ru_name" id="ru_name" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-row mt-5 d-flex justify-content-center">
                                            <button type="submit" class="btn btn-success">Save State</button>
                                            &nbsp; &nbsp;
                                            <a href="{{ route('states.index') }}" type="button" class="btn btn-primary">Go Back</a>
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
