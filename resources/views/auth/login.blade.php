<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="description" content="DBMS">
		<meta name="keywords" content="DBMS">
        <meta name="author" content="DBMS">
        <meta name="robots" content="noindex, nofollow">
        <title>DMS</title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">

		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    	<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

		<!-- Lineawesome CSS -->
        <link rel="stylesheet" href="assets/css/line-awesome.min.css">
		<link rel="stylesheet" href="assets/css/material.css">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
		
		<!-- Lineawesome CSS -->
        <link rel="stylesheet" href="assets/css/line-awesome.min.css">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="assets/css/style.css">

    </head>
    <body class="account-page">
	
		<!-- Main Wrapper -->
        <div class="main-wrapper">
			<div class="account-content">
				<div class="container">
				
					<!-- Account Logo -->
					
					<div class="account-box">
						<div class="account-wrapper">
							<div class="d-flex justify-content-center mt-3 mb-3">
								<img src="{{asset('assets/img/images.png')}}" width="150" alt="pehadir">
							</div>
							<h4>DOCUMENT MANAGEMENT SYSTEM</h4>
                            @if (Session::get('failed'))
                                <div class="alert alert-info alert-dismissible fade show" role="alert">
                                    <strong>{{Session::get('failed')}}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    </button>
                                </div>
                            @endif
							
							<!-- Account Form -->
                            <form action="{{ route('login') }}" method="POST">
                                @csrf
								<div class="form-group">
                                    <label>Email Address</label>
                                    <input class="form-control" type="email" name="email">
        
                                    @if ($errors->has('email'))
                                    <div class="text-danger" role="alert">
                                        <small><strong>{{ $errors->get('email')[0] }}</strong></small>
                                    </div>
                                    @endif
        
                                </div>
								<div class="form-group">
									<div class="row">
										<div class="col">
											<label>Password</label>
										</div>
										<div class="col-auto">
											<a class="text-muted" href="forgot-password.html">
												Forgot password?
											</a>
										</div>
									</div>
                                    
									<div class="position-relative">
                                        <input class="form-control" id="password" type="password" name="password">
										<span class="fa fa-eye-slash" id="toggle-password"></span>
									</div>

                                    @if ($errors->has('password'))
                                        <div class="text-danger" role="alert">
                                        <small><strong>{{ $errors->get('password')[0] }}</strong></small>
                                        </div>
                                    @endif
								</div>
								<div class="form-group text-center">
									<button class="btn btn-primary account-btn" type="submit">Login</button>
								</div>
							</form>
							<!-- /Account Form -->
							
						</div>
					</div>
				</div>
			</div>
        </div>
		<!-- /Main Wrapper -->
		

		<!-- jQuery -->
        <script src="assets/js/jquery-3.6.0.min.js"></script>
		
		<!-- Bootstrap Core JS -->
        <script src="assets/js/bootstrap.bundle.min.js"></script>
		
		 <!-- Theme Settings JS -->
		<script src="assets/js/layout.js"></script>
		<script src="assets/js/theme-settings.js"></script>
		<script src="assets/js/greedynav.js"></script>
		<!-- Custom JS -->
		<script src="assets/js/app.js"></script>
		
    </body>
</html>