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

                    <h1 class="h3 mb-3"> <i class="fa fa-plus"></i> Add New Admin </h1>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <form method="post" action="{{ route('users.store') }}">
                                        @csrf
                                        <div class="form-group required">
                                            <label>Name</label>
                                            <input class="form-control form-control-lg" type="text" name="name"
                                                placeholder="Enter your name" />
                                        </div>
                                        <div class="form-group required">
                                            <label>Username</label>
                                            <input class="form-control form-control-lg" type="text" name="username"
                                                placeholder="Enter your username" />
                                        </div>
                                        <div class="form-group required">
                                            <label>Email</label>
                                            <input class="form-control form-control-lg" type="email" name="email"
                                                placeholder="Enter your email" />
                                        </div>
                                        <div class="form-group required">
                                            <label>Password</label>
                                            <input class="form-control form-control-lg" type="password"
                                                name="password" placeholder="Enter password" />
                                        </div>
                                        <div class="form-group required">
                                            <label>Password Confirmation</label>
                                            <input class="form-control form-control-lg" type="password"
                                                name="password_confirmation" placeholder="Re-Enter password" />
                                        </div>
                                        <div class="form-group">
                                            <label for="user_level"> Users Level </label>
                                            <select name="user_level" id="userlevel" class="form-control select2">
                                                <option value=""></option>
                                                @foreach($users_level as $level)
                                                    <option value="{{ $level->type }}"> {{ $level->levelname }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="text-center mt-3">
                                            <button type="submit" class="btn btn-lg btn-primary">Add Admin</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </main>

            @include('admin.layouts.scripts')
            <!-- footer is here -->
            @include('admin.layouts.footer')
