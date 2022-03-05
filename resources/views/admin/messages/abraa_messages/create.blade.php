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
 
                    <h1 class="h3 mb-3"> <i class="fa fa-plus"></i> Add New message </h1>

                    
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
                                    <form method="post" action="{{ route('abraaMessages.store') }}">
                                        @csrf 
                                        <div class="form-row mt-4">
                                            <div class="col-md-6 form-group autocomplete-user">
                                                <label for="search_user">Search User</label>
                                                <input type="text" name="search_user" id="search_user" class="form-control">
                                                <input type="hidden" name="user_email" id="user_email">
                                                <input type="hidden" name="user_id" id="user_id">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="subject">Subject</label>
                                                <input type="text" name="subject" id="subject" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="message">Message</label>
                                                <textarea name="message" id="message" cols="30" rows="10" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-row mt-5 d-flex justify-content-center">
                                            <button type="submit" class="btn btn-success">Save message</button>
                                            &nbsp; &nbsp;
                                            <a href="{{ route('abraaMessages.index') }}" type="button" class="btn btn-primary">Go Back</a>
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
            <script src="{{ asset('js/add_message.js') }}"></script>
            <!-- footer is here -->
            @include('admin.layouts.footer')
