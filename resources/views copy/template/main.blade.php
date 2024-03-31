<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark"  data-sidebar-size="lg" data-sidebar-image="none">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="description" content="DBMS">
		<meta name="keywords" content="DBMS">
        <meta name="author" content="DBMS">
        <meta name="robots" content="noindex, nofollow">
		<meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ $title }}</title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/img/favicon.png')}}">
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/fontawesome.min.css')}}">
    	<link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/all.min.css')}}">

		<!-- Lineawesome CSS -->
        <link rel="stylesheet" href="{{asset('assets/css/line-awesome.min.css')}}">
		<link rel="stylesheet" href="{{asset('assets/css/material.css')}}">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="{{asset('assets/css/font-awesome.min.css')}}">
		
		<!-- Lineawesome CSS -->
        <link rel="stylesheet" href="{{asset('assets/css/line-awesome.min.css')}}">
		
		<!-- Chart CSS -->
		<link rel="stylesheet" href="{{asset('assets/plugins/morris/morris.css')}}">
		<link rel="stylesheet" href="{{asset('assets/css/select2.min.css')}}">
		<!-- Main CSS -->
		<link rel="stylesheet" href="{{asset('assets/css/dataTables.bootstrap4.min.css')}}">
		<link rel="stylesheet" href="{{asset('assets/plugins/sweetalert2/sweetalert2.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
	
    </head>
	
    <body>
		<!-- Main Wrapper -->
        <div class="main-wrapper">
			@include('include.navbar')
			@include('include.sidebar')
			<!-- Page Wrapper -->
            <div class="page-wrapper">
				<!-- Page Content -->
                <div class="content container-fluid">
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title">{{$page}}</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item active">{{ $subpage}}</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					@yield('content')
				</div>
				<!-- /Page Content -->
            </div>
			<!-- /Page Wrapper -->
        </div>
		<!-- /Main Wrapper -->
		
		@include('include.script')
    </body>
</html>