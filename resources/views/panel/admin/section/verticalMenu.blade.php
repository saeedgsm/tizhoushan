<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">منو</li>


                <li>
                    <a href="{{ route('admin.dashboard') }}" class="waves-effect">
                        <div class="d-inline-block mr-1"><i class="uim uim-airplay"></i></div>
                        <span>داشبرد</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <div class="d-inline-block mr-1"><i class="uim uim-calender"></i></div>
                        <span> دوره ها</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <router-link :to="{name : 'Courses'}"> دوره ها</router-link>
                        </li>

                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <div class="d-inline-block mr-1"><i class="uim uim-vector-square-alt"></i></div>
                        <span>  مدیریت آموزش</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false" style="background: aliceblue;">
                        <li><router-link :to="{name : 'AllBases'}">پایه های آموزشی</router-link></li>
                        <li><router-link :to="{name : 'Books'}">کتاب ها</router-link></li>
                        <li style="background: beige;"><a href="javascript: void(0);" class="has-arrow" aria-expanded="true">پایه ها</a>
                            <ul class="sub-menu mm-collapse" aria-expanded="true" style="">
                                @foreach(\App\EducationalBase::latest()->take(3)->get() as $item)
                                    <li><a href="javascript: void(0);">{{ $item->base_title }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <div class="d-inline-block mr-1"><i class="uim uim-document-layout-center"></i></div>
                        <span> کاربران</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false" style="background: aliceblue;">
                        <li><router-link :to="{name : 'Students'}">دانش آموزان</router-link></li>
                        <li><a href="{{ route('admin.student.profile.unchecked') }}">بررسی پروفایل دانش آموزان</a></li>
                    </ul>
                </li>
                <li >
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <div class="d-inline-block mr-1"><i class="uim uim-circle-layer"></i></div>
                        <span> ساختار</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false" style="background: aliceblue;">
                        <li>
                            <router-link :to="{name : 'ActiveCourseStudents'}">دانش آموزان دوره فعال</router-link>
                        </li>


                        <li style="background: beige;">
                            <a href="javascript: void(0);" class="has-arrow " aria-expanded="false" >
                                <div class="d-inline-block mr-1"><i class="uim uim-box"></i></div>
                                <strong>سفارش سازی</strong>
                            </a>
                            <ul class="sub-menu mm-collapse" aria-expanded="false" style="">
                                <li>
                                    <router-link :to="{name : 'Fields'}">سفارش سازی فیلد ها</router-link>
                                </li>
                                <li><a href="{{ route('admin.fields.index') }}"> فیلد های ثابت</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <div class="d-inline-block mr-1"><i class="uim uim-check-circle"></i></div>
                        <span>آزمون</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><router-link :to="{name : 'Azmoons'}">آزمون ها</router-link></li>


                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <div class="d-inline-block mr-1"><i class="mdi mdi-tag-outline"></i></div>
                        <span>فروشگاه</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.productCategories.index') }}">دسته بندی</a></li>
                        <li><a href="{{ route('admin.products.index') }}">محصولات</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <div class="d-inline-block icons-sm mr-1"><i class="mdi mdi-ticket"></i></div>
                        <span>پشتیبانی تیکت</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.ticketCategories.index') }}">دسته بندی</a></li>
                        <li><a href="{{ route('admin.tickets.index') }}">تیکت ها</a></li>
                    </ul>
                </li>
                @can('role-edit')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <div class="d-inline-block icons-sm mr-1"><i
                                        class="mdi mdi-card-bulleted-settings-outline"></i></div>
                            <span>تنظیمات سایت</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><router-link :to="{name : 'TariffBases'}">تعرفه ثبت نام پایه ها</router-link></li>
                            <li><router-link :to="{name : 'SMSGroupClasses'}">پیامک گروهی</router-link></li>
                            <li><a href="{{ route('admin.setting.all') }}">تنظیمات</a></li>
                            <li><a href="{{ route('admin.roles.index') }}">سطح دسترسی</a></li>
                            <li><a href="{{ route('admin.defaultCovers.index') }}">کاور پیش فرض</a></li>
                        </ul>
                    </li>
                @endcan

            </ul>

        </div>
        <!-- Sidebar -->
    </div>
</div>
