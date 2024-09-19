<div class="topbar" style="background-color:black;">
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color:black;">
        <div class="full" >
            <button type="button" id="sidebarCollapse" class="sidebar_toggle" style="background-color:black;"><i class="fa fa-bars"></i></button>
            <div class="logo_section">
                <a href="index.html"><img class="img-responsive" src="{{ asset('assets/images/logo/logo.png')}}" alt="#" /></a>
            </div>
            <div class="right_topbar">
                <div class="icon_info">
                    <ul class="user_profile_dd">
                        <li style="background-color:black;">
                            <a class="dropdown-toggle" data-toggle="dropdown"><img class="img-responsive rounded-circle"
                                    src="{{ asset('assets/images/layout_img/user_img.jpg')}}" alt="#" /><span class="name_user">{{auth()->user()->name}}</span></a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('admin.profile') }}">My Profile</a>
                                <a class="dropdown-item" href="{{ route('admin.logout') }}"><span>Log Out</span> <i
                                        class="fa fa-sign-out"></i></a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</div>
