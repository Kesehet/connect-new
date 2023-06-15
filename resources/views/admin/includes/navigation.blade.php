<header class="topbar" data-navbarbg="skin5">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header" data-logobg="skin5">
            <!-- This is for the sidebar toggle which is visible on mobile only -->
            <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>

            <a class="navbar-brand" href="{{route('dashboard')}}">
                <b class="logo-icon p-l-10">
                    <!--<img src="{{asset('admin-panel/assets/images/logo-icon.png')}}" alt="homepage" class="light-logo" />-->
                    <img src="{{asset('admin-panel/assets/images/logo_thinknyx.png')}}" alt="homepage" class="light-logo"/>
                </b>
                <span class="logo-text">
                    <!-- dark Logo text -->
                    <!--<img src="{{asset('admin-panel/assets/images/logo-text.png')}}" alt="homepage" class="light-logo" />-->
                </span>
            </a>
            <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
        </div>

        <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
            <ul class="navbar-nav float-left mr-auto">
                <!--<li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>-->
                <!--<li class="nav-item search-box"> <a class="nav-link waves-effect waves-dark" href="javascript:void(0)"><i class="ti-search"></i></a>
                    <form class="app-search position-absolute">
                        <input type="text" class="form-control" placeholder="Search &amp; enter"> <a class="srh-btn"><i class="ti-close"></i></a>
                    </form>
                </li>-->
            </ul>
            <ul class="navbar-nav float-right">
                
                <li class="nav-item dropdown">
                    <div class="breadcrumb-item active" style="padding-top: 12px;font-size: 12px; color: #27a9e3; ">
                        <form action="{{route('user.changefy')}}" method="post" class="form-horizontal">
                            @csrf
                            <select type="text" name="fy_year" class="form-control" id="fy_year" onchange="this.form.submit();$('#fy_year').attr('disabled',true);">
							
                            @foreach ($fyears as $key => $value)
                            <option value="{{ $key }}" {{ (Session::get('CFY') == $key?'selected':'') }}>{{ $value }}</option>
                            @endforeach
                            </select>
                        </form>
                    </div>  
                </li>

                <li class="nav-item dropdown">
                    <div class="breadcrumb-item active" style="font-size: 12px; color: #27a9e3; padding: 23px 10px 0 10px;"><b>EMS 1.0.1</b></div>  
                </li>
                
                <li class="nav-item dropdown">
                    <div class="breadcrumb-item active" style="font-size: 12px; color: #27a9e3; padding: 12px 10px 0 10px;">&nbsp;&nbsp;Welcome<b><br>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</b></div>  
                </li>

                <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @if(Auth::user()->image)
                        <img src="{{ asset('uploads/gallery/' . Auth::user()->image) }}" alt="user" class="rounded-circle" width="31" height="31">
                        @else
                        <img src="{{asset('admin-panel/assets/images/users/1.jpg')}}" alt="user" class="rounded-circle" width="31">
                        @endif
                      </a>
                      <div class="dropdown-menu dropdown-menu-right user-dd animated">
                        <a class="dropdown-item" href="{{route('profile')}}"><i class="ti-user m-r-5 m-l-5"></i> My Profile</a>

                        {{--<a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-power-off m-r-5 m-l-5"></i> Logout</a>--}}

                        <a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="dropdown-item">
                            <i class="fa fa-power-off m-r-5 m-l-5"></i>
                            Logout
                        </a>
                        <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
                            @csrf
                        </form>

                        <div class="dropdown-divider"></div>
                        <div class="p-l-30 p-10"><a href="{{route('profile')}}" class="btn btn-sm btn-success btn-rounded">View Profile</a></div>
                    </div>
                </li>
                
            </ul>
        </div>
    </nav>
</header>