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
    <div class="sidebar_blog_2" >
        <h4 style="border-bottom:solid white;background-color:black;">Balance: ${{auth()->user()->deposit_amount}}</h4>
        <ul class="list-unstyled components">
            <li class="{{ request()->is('user/dashboard') ? 'active' : '' }}">
                <a href="{{route('user.dashboard')}}" ><i
                        class="fa fa-dashboard yellow_color"></i> <span>Dashboard</span></a>
            </li>

            <li class="{{ request()->is('user/packages') ? 'active' : '' }}"><a href="{{ route('user.packages') }}"><i class="fa fa-clock-o orange_color"></i> <span>Packages</span></a>
            <li class="{{ request()->is('user/wallet') ? 'active' : '' }}"><a href="{{ route('user.wallet') }}"><i class="fa fa-briefcase blue1_color"></i> <span>Wallet</span></a>
            <li class="{{ request()->is('user/referrals') ? 'active' : '' }}"><a href="{{route('user.referrals')}}"><i class="fa fa-users "></i> <span>Referrals</span></a></li>
            <li class="{{ request()->is('user/withdraw/fees') ? 'active' : '' }}"><a href="{{route('user.withdrawFees')}}"><i class="fa fa-money "></i> <span>Withdraw Fees</span></a></li>
            <li><a href="{{route('user.logout')}}"><i class="fa fa-map purple_color2"></i> <span>Logout</span></a></li>
            </li>
        </ul>
    </div>
</nav>






