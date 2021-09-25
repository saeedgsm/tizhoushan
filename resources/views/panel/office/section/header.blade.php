<header id="page-topbar">
    <div class="navbar-header">
        <div class="container-fluid">
            <div class="float-right">



                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="rounded-circle header-profile-user" src="{{ asset(auth()->user()->userAvatar()) }}" alt="Header Avatar">
                        <span class="d-none d-sm-inline-block ml-1">{{ auth()->user()->first_name ?? '' }} {{ auth()->user()->last_name }}</span>
                        <i class="mdi mdi-chevron-down d-none d-sm-inline-block"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <!-- item-->

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/logout"><i class="mdi mdi-logout font-size-16 align-middle mr-1"></i> خروج</a>
                    </div>
                </div>
            </div>

            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="/" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="{{ asset('assets/images/logo-mini.png') }}" alt="" height="22">
                                </span>
                    <span class="logo-lg">
                                    <img src="{{ asset('assets/images/logo.png') }}" alt="" height="20">
                                </span>
                </a>

                <a href="/" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="{{ asset('assets/images/logo-mini.png') }}" alt="" height="22">
                                </span>
                    <span class="logo-lg">
                                    <img src="{{ asset('assets/images/logo.png') }}" alt="" height="20">
                                </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm mr-2 font-size-16 d-lg-none header-item waves-effect waves-light" data-toggle="collapse" data-target="#topnav-menu-content">
                <i class="fa fa-fw fa-bars"></i>
            </button>

            @include('panel.office.section.verticalMenu')
        </div>
    </div>


</header>
