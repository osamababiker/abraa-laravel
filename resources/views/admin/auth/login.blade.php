@include('admin.layouts.header')

<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-behavior="sticky">
	<div class="main d-flex justify-content-center w-100">
		<main class="content d-flex p-0">
			<div class="container d-flex flex-column">
				<div class="row h-100">
					<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
						<div class="d-table-cell align-middle">

							<div class="text-center mt-4">
								<h1 class="h2">Welcome back</h1>
								<p class="lead">
									Sign in to your account to continue
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
									<div class="m-sm-4">
										<div class="text-center">
											<img src="{{ asset('img/avatars/avatar.jpg') }}" alt="User Avatar"
												class="img-fluid rounded-circle" width="132" height="132" />
										</div>
										<form method="post" action="{{ route('login') }}">
											@csrf
											<div class="form-group">
												<label>Username</label>
												<input class="form-control form-control-lg" type="text" name="username"
													placeholder="Enter your username" />
											</div>
											<div class="form-group">
												<label>Password</label>
												<input class="form-control form-control-lg" type="password"
													name="password" placeholder="Enter your password" />
												<small>
													<a href="pages-reset-password.html">Forgot password?</a>
												</small>
											</div>
											<div>
												<div class="custom-control custom-checkbox align-items-center">
													<input type="checkbox" class="custom-control-input"
														value="remember-me" name="remember-me" checked>
													<label class="custom-control-label text-small">Remember me next
														time</label>
												</div>
											</div>
											<div class="text-center mt-3">
												<button type="submit" class="btn btn-lg btn-primary">Sign in</button>
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