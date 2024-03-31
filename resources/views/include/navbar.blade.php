<!-- Header -->
<div class="header">
			
    <!-- Logo -->
    <div class="header-left">
         <a href="/" class="logo">
            <img src="{{asset('assets/img/images.png')}}" width="110" height="50" alt="">
        </a>
        <a href="/" class="logo2">
            <img src="{{asset('assets/img/images.png')}}" width="110" height="50" alt="">
        </a>
    </div>
    <!-- /Logo -->
    
    <a id="toggle_btn" href="javascript:void(0);">
        <span class="bar-icon">
            <span></span>
            <span></span>
            <span></span>
        </span>
    </a>
                    
    <a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa fa-bars"></i></a>
    
    <!-- Header Menu -->
    <ul class="nav user-menu">
        <li class="nav-item dropdown has-arrow main-drop">
            <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                <span class="user-img"><img src="assets/img/profiles/avatar-21.jpg" alt="">
                <span class="status online"></span></span>
                <span>Admin</span>
            </a>
            <div class="dropdown-menu">
                {{-- <a class="dropdown-item" href="profile.html">My Profile</a> --}}
                <a class="dropdown-item" href="{{route('change_password')}}">Cange Password</a>
                <a class="dropdown-item" href="{{route('logout')}}">Logout</a>
            </div>
        </li>
    </ul>
    <!-- /Header Menu -->
    
    <!-- Mobile Menu -->
    <div class="dropdown mobile-user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
        <div class="dropdown-menu dropdown-menu-right">
            {{-- <a class="dropdown-item" href="profile.html">My Profile</a> --}}
            <a class="dropdown-item" href="{{route('change_password')}}">Cange Password</a>
                <a class="dropdown-item" href="{{route('logout')}}">Logout</a>
        </div>
    </div>
    <!-- /Mobile Menu -->
    
</div>
<!-- /Header -->
