<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4 ">
    <!--         Brand Logo -->
{{--    <a href="index3.html" class="brand-link">--}}
{{--        <img src="/foods/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"--}}
{{--             style="opacity: .8"--}}
{{--        <span class="brand-text font-weight-light">پنل مدیریت</span>--}}
{{--    </a>--}}

    <!--         Sidebar -->
    <div class="sidebar" >
        <div>
            <!--                 Sidebar user panel (optional)-->
            <a href="{{auth()->check()?route("profile.index"):route("login")}}" >
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="/defaults/profile.png" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <span class="d-block">{{auth()->check()?auth()->user()->name:"وارد شوید"}}</span>
                </div>
            </div>
            </a>
            <nav class="mt-2" style="background-color: #343a40;">
                <ul class="nav nav-pills nav-sidebar flex-column" style="background-color: #343a40;" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item has-treeview menu-open">
                        <a href="#" class="nav-link active">
                            <p>
                                لینک ها
                                <i class="right fa fa-link"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route("home")}}" class="nav-link">

                                    <i class="fa fa-home nav-icon"></i>
                                    <p>خانه</p>

                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route("shop")}}" class="nav-link">
                                    <i class="fa fa-shopping-bag nav-icon"></i>
                                    <p>فروشگاه</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route("cart.index")}}" class="nav-link">
                                    <i class="fa fa-shopping-cart nav-icon"></i>
                                    <p>سبد خرید</p>
                                </a>
                            </li>
                            @if(! auth()->check())
                                <li class="nav-item">
                                    <a href="{{route("login")}}" class="nav-link">
                                        <i class="fa fa-sign-in nav-icon"></i>
                                        <p>ورود</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route("register")}}" class="nav-link">
                                        <i class="fa fa-vcard nav-icon"></i>
                                        <p>ثبت نام</p>
                                    </a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <form action="{{route('logout')}}" method="post">
                                        @csrf


                                        <a><button class="nav-link btn-navbar border-0 hover" style="background: none">
                                                <i class="fa fa-sign-out nav-icon"></i>خروج</button></a>
                                    </form>
                                </li>
                            @endif


                        </ul>
                    </li>

                    @if(auth()->check() && auth()->user()->isAdmin)
                    <li class="nav-item has-treeview ">
                        <a href="#" class="nav-link bg-primary-gradient" style=  "background: #007bff;
                           background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #007bff), color-stop(1, #3395ff));
                           background: -ms-linear-gradient(bottom, #007bff, #3395ff);
                           background: -moz-linear-gradient(center bottom, #007bff 0%, #3395ff 100%);
                           background: -o-linear-gradient(#3395ff, #007bff);
                           color: #ffffff">
                            <i class="nav-icon fa fa-dashboard"></i>
                            <p>
                                داشبوردها
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ">
                            <li class="nav-item bg-secondary-gradient rounded">
                                <a href="{{route("users.index")}}" class="nav-link">
                                    <i class="fa fa-users nav-icon"></i>
                                    <p>کاربران</p>
                                </a>
                            </li>
                            <li class="nav-item bg-secondary-gradient rounded">
                                <a href="{{route("foods.index")}}" class="nav-link">
                                    <i class="fa fa-shopping-bag nav-icon"></i>
                                    <p>مدیریت محصولات</p>
                                </a>
                            </li>
                            <li class="nav-item bg-secondary-gradient rounded">
                                <a href="{{route("coupons.create")}}" class="nav-link">
                                    <i class="fa fa-percent nav-icon"></i>
                                    <p>مدیریت کدتخفیف ها</p>
                                </a>
                            </li>
                            <li class="nav-item bg-secondary-gradient rounded">
                                <a href="{{route("email.create")}}" class="nav-link">
                                    <i class="fa fa-percent nav-icon"></i>
                                    <p>ارسال ایمیل</p>
                                </a>
                            </li>
                        </ul>

                    </li>
                    @endif

                </ul>
            </nav>

        </div>
    </div>
    <!--         /.sidebar -->
</aside>
<!-- /Main Sidebar Container -->
