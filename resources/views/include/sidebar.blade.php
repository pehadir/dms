<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul class="sidebar-vertical">
                    <li class="menu-title"> 
                        <span>Main</span>
                    </li>
                    <li>
                        <a href="{{route('dashboard')}}"><i class="la la-dashboard"></i> <span> Dashboard</span></a>
                    </li>
                    <li>
                        <a href="{{route('data-archive')}}"><i class="la la-file"></i> <span> Data Archive</span></a>
                    </li>
                    
                    <li class="submenu">
                        <a href="#" class="noti-dot"><i class="la la-gear"></i> <span> Setting</span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="{{route('branches.index')}}">Branch</a></li>
                            @if(auth()->user()->type == 'admin' || auth()->user()->type == 'company')
                            <li><a href="{{route('user')}}">User</a></li>
                            @endif
                            @if(auth()->user()->type == 'company')
                            <li><a href="{{route('setup-company')}}">Company</a></li>
                            @endif
                        </ul>
                    </li>
                    
            </ul>
            
        </div>
    </div>
</div>
<!-- /Sidebar -->