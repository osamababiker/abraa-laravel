@include('admin.layouts.header')

<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-behavior="sticky">
	<div class="main d-flex justify-content-center w-100">
		<main class="content d-flex p-0">
			<div class="container d-flex flex-column">
				<div class="row h-100">
					<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
						<div class="d-table-cell align-middle">

							<div class="text-center mt-4">
								<h1 class="h2">Get started</h1>
								<p class="lead">
									Start creating the best possible user experience for you customers.
								</p>
							</div>

							<div class="card">
								<div class="card-body">
									@if(session()->has('error'))
										<div class="alert alert-danger alert-dismissible" id="successAlert" role="alert">
											<div class="alert-message">
												<strong> {{session()->get('error')}}
											</div>
										</div>
									@endif
									@if ($errors->any())
										<div class="alert alert-danger">
											@foreach ($errors->all() as $error)
												<div class="alert-message">
													<strong> {{ $error }}
												</div>
											@endforeach
										</div>
									@endif
									<div class="m-sm-4">
										<form method="post" action="{{ route('register') }}">
                                            @csrf
											<div class="form-group">
												<label>Name</label>
												<input class="form-control form-control-lg" type="text" name="name"
													placeholder="Enter your name" />
											</div>
											<div class="form-group">
												<label>Username</label>
												<input class="form-control form-control-lg" type="text" name="username"
													placeholder="Enter your username" />
											</div>
											<div class="form-group">
												<label>Email</label>
												<input class="form-control form-control-lg" type="email" name="email"
													placeholder="Enter your email" />
											</div>
											<div class="form-group">
												<label>Password</label>
												<input class="form-control form-control-lg" type="password"
													name="password" placeholder="Enter password" />
											</div>
											<div class="form-group">
												<label>Password Confirmation</label>
												<input class="form-control form-control-lg" type="password"
													name="password_confirmation" placeholder="Re-Enter password" />
											</div>
											<div class="text-center mt-3">
												<button type="submit" class="btn btn-lg btn-primary">Sign up</button>
											</div>
										</form>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</main>
	</div>

	<script src="{{ asset('js/app.js') }}"></script>

</body>

</html>