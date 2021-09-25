<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box" style="background: #4865d8;">
                <a href="/" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="{{ asset('imgs/logo-panel.png') }}" alt="" height="22">
                                </span>
                    <span class="logo-lg">
                                    <img src="{{ asset('imgs/logo-panel.png') }}" alt="" height="40">
                                </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                <i class="mdi mdi-backburger"></i>
            </button>
        </div>



        <div class="d-flex">
            @can('role-edit')
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-flag-dropdown"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="" src="{{ asset('imgs/logo-panel.png') }}" alt="Header Language" height="54" style="
    border-radius: 10px;">
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <!-- item-->
                    <a href="{{ route('admin.cadres.index',['level'=>'agency']) }}" class="dropdown-item notify-item">
                        <img src="{{ asset('assets/images/map.png') }}" alt="user-image" class="mr-2" height="42"><span class="align-middle">نمایندگان</span>
                    </a>
                    <!-- item-->
                    <a href="{{ route('admin.cadres.index',['level'=>'teacher']) }}" class="dropdown-item notify-item">
                        <img src="{{ asset('assets/images/professors.png') }}" alt="user-image" class="mr-2" height="42"><span class="align-middle">اساتید</span>
                    </a>

                    <!-- item-->
                    <a href="{{ route('admin.cadres.index',['level'=>'admin']) }}" class="dropdown-item notify-item">
                        <img src="{{ asset('assets/images/staff.png') }}" alt="user-image" class="mr-2" height=42"><span class="align-middle">کارکنان مجموعه</span>
                    </a>


                </div>
            </div>
            <div class="dropdown d-inline-block d-lg-none ml-2">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="mdi mdi-magnify"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
                     aria-labelledby="page-header-search-dropdown">

                    <form class="p-3">
                        <div class="form-group m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @endcan


            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="{{ asset(auth()->user()->userAvatar()) }}" alt="Header Avatar">
                    <span class="d-none d-sm-inline-block ml-1">{{ auth()->user()->first_name ?? '' }} {{ auth()->user()->last_name ?? '' }}</span>
                    <i class="mdi mdi-chevron-down d-none d-sm-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <!-- item-->
                    <a class="dropdown-item" href="{{ route('admin.panel') }}"><i class="mdi mdi-face-profile font-size-16 align-middle mr-1"></i> ناحیه کاربری</a>

                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}"><i class="mdi mdi-logout font-size-16 align-middle mr-1"></i> خروج</a>
                </div>
            </div>

        </div>
    </div>
</header>
