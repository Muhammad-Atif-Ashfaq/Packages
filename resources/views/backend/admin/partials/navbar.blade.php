<nav id="sidebar" style="background-color:black;">
    <div class="sidebar_blog_1">
        <div class="sidebar-header">
            <div class="logo_section">
                <a href="index.html"><img class="logo_icon img-responsive"
                        src="{{ asset('assets/images/logo/logo_icon.png')}}" alt="#" /></a>
            </div>
        </div>
        <div class="sidebar_user_info" style="background-color:black;">
            <div class="icon_setting"></div>
            <div class="user_profle_side">
                <div class="user_img"><img class="img-responsive"
                        src="{{ asset('assets/images/layout_img/user_img.jpg')}}" alt="#" /></div>
                <div class="user_info">
                    <h6>{{ auth()->user()->name }}</h6>
                    <p><span class="online_animation"></span> Online</p>
                </div>
            </div>
        </div>
    </div>
    <div class="sidebar_blog_2">
        <h4 style="border-bottom:solid white;background-color:black;">General</h4>
        <ul class="list-unstyled components">
            <li class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
                <a href="{{route('admin.dashboard')}}" ><i
                        class="fa fa-dashboard white_color"></i> <span>Dashboard</span></a>
            </li>
            <li class="{{ request()->is('admin/investment_packages') ? 'active' : '' }}"><a href="{{route('admin.investment_packages.index')}}"><i class="fa fa-clock-o white_color"></i> <span>Investment Packages</span></a></li>
            <li class="{{ request()->is('admin/referrel_packages') ? 'active' : '' }}"><a href="{{route('admin.referrel_packages.index')}}"><i class="fa fa-clock-o white_color"></i> <span>Referral Packages</span></a></li>
            <li class="{{ request()->is('admin/all/users') ? 'active' : '' }}"><a href="{{route('admin.users')}}"><i class="fa fa-users white_color"></i> <span>Users</span></a></li>
            <li class="{{ request()->is('admin/withdraw/confirm') ? 'active' : '' }}"><a href="{{route('admin.withdrawConfirm')}}"><i class="fa fa-money white_color"></i> <span>Direct Withdrawals</span></a></li>
            <li class="{{ request()->is('admin/transactions') ? 'active' : '' }}"><a href="{{route('admin.transactions')}}"><i class="fa fa-book white_color"></i> <span>Transactions</span></a></li>
            <li class="{{ request()->is('admin/contact/us') ? 'active' : '' }}"><a href="{{route('admin.contactUs')}}"><i class="fa fa-paper-plane white_color"></i> <span>Messages</span></a></li>
            <li><a href="{{route('admin.logout')}}"><i class="fa fa-map white_color2"></i> <span>Logout</span></a></li>
        </ul>
    </div>
</nav>
