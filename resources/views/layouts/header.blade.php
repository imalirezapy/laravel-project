@php
    if (auth()->check()) {
        $foods_cart = \App\Models\User::find(auth()->user()->id)->foods;
    } else{
        $foods_cart = \App\Models\Cart::where("user_ip", $_SERVER['REMOTE_ADDR'])->get()->toArray();
        $foods_cart = array_map(fn($i)=>\App\Models\Food::find($i['food_id']), $foods_cart);
    }
    $count = count($foods_cart);
@endphp


<nav class="main-header navbar navbar-expand bg-white navbar-light border-bottomn " style="z-index: 1000">
    <!-- Left navbar links -->
    <ul class="navbar-nav d-block d-lg-block d-md-block d-sm-none d-xl-none">
{{--        <li class="nav-item list" style="width: 10%">--}}
{{--            <a href="/" class="nav-link">--}}
{{--                <span>--}}
{{--                     <a class="" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>--}}
{{--                </span>--}}
{{--            </a>--}}
{{--        </li>--}}
        <li class="nav-item list  d-sm-inline-block">
            <a href="/" class="nav-link" data-widget="pushmenu">
                <span class="icon">
                    <ion-icon name="menu"></ion-icon>
                </span>
            </a>
        </li>

        <li class="nav-item list  d-sm-inline-block active">
            <a href="/" class="nav-link">
                <span class="icon">خانه</span>
            </a>
        </li>
        <li class="nav-item list  d-sm-inline-block">
            <a href="{{route("shop")}}" class="nav-link">
                <span class="icon">فروشگاه</span>

{{--                <span class="fa fa-shopping-bag"></span>--}}
            </a>
        </li>
        <li class="nav-item list  d-sm-inline-block">
            <a href="{{route("favorites.index")}}" class="nav-link">
                <span class="icon"><small> علاقه مندی ها</small></span>

                {{--                <span class="fa fa-shopping-cart"></span>--}}
            </a>
        </li>
        <li class="nav-item list  d-sm-inline-block">
            <a href="{{route("cart.index")}}" class="nav-link">
                <span class="icon">سبد خرید</span>

{{--                <span class="fa fa-shopping-cart"></span>--}}
            </a>
        </li>

        @if(! auth()->check())
            <li class="nav-item list  d-sm-inline-block">
                <a href="{{route("login")}}" class="nav-link">
                    <span class="icon font-weight-bolder">ورود</span>

{{--                    <span class="fa fa-sign-in nav-icon"></span>--}}
                </a>
            </li>
            <li class="nav-item  list  d-sm-inline-block">
                <a href="{{route("register")}}" class="nav-link">
                    <span class="icon">ثبت نام</span>

{{--                    <span class="fa fa-vcard nav-icon"></span>--}}

                </a>
            </li>
        @else
        <li class="nav-item list  d-sm-inline-block">
            <form action="{{route('logout')}}" method="post">
                @csrf
                <button class="nav-link btn-navbar " style="background: none">خروج</button>
            </form>
        </li>
        @endif
        <div class="indicator">

        </div>
    </ul>
    <ul class="navbar-nav d-none d-lg-none d-md-none d-sm-block d-xl-block">
{{--        <li class="nav-item list" style="width: 10%">--}}
{{--            <a href="/" class="nav-link">--}}
{{--                <span>--}}
{{--                     <a class="" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>--}}
{{--                </span>--}}
{{--            </a>--}}
{{--        </li>--}}
        <li class="nav-item list  d-sm-inline-block">
            <a href="/" class="nav-link" data-widget="pushmenu">
                <span class="icon">
                    <ion-icon name="menu"></ion-icon>
                </span>
            </a>
        </li>

        <li class="nav-item list  d-sm-inline-block active">
            <a href="/" class="nav-link">
                <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
            </a>
        </li>
        <li class="nav-item list  d-sm-inline-block">
            <a href="{{route("shop")}}" class="nav-link">
                <span class="icon"><ion-icon name="bag-outline"></ion-icon></span>

{{--                <span class="fa fa-shopping-bag"></span>--}}
            </a>
        </li>
        <li class="nav-item list  d-sm-inline-block">
            <a href="{{route("favorites.index")}}" class="nav-link">
                <span class="icon"><ion-icon name="heart-outline"></ion-icon></span>

                {{--                <span class="fa fa-shopping-cart"></span>--}}
            </a>
        </li>
        <li class="nav-item list  d-sm-inline-block">
            <a href="{{route("cart.index")}}" class="nav-link">
                <span class="icon"><ion-icon name="cart-outline"></ion-icon></span>

{{--                <span class="fa fa-shopping-cart"></span>--}}
            </a>
        </li>

        @if(! auth()->check())
            <li class="nav-item list  d-sm-inline-block">
                <a href="{{route("login")}}" class="nav-link">
                    <span class="icon font-weight-bolder"><ion-icon name="enter-outline"></ion-icon></span>

{{--                    <span class="fa fa-sign-in nav-icon"></span>--}}
                </a>
            </li>
            <li class="nav-item  list  d-sm-inline-block">
                <a href="{{route("register")}}" class="nav-link">
                    <span class="icon"><ion-icon name="person-add-outline"></ion-icon></span>

{{--                    <span class="fa fa-vcard nav-icon"></span>--}}

                </a>
            </li>
        @else
        <li class="nav-item list  d-sm-inline-block">
            <form action="{{route('logout')}}" method="post">
                @csrf
                <button class="nav-link btn-navbar " style="background: none">خروج</button>
            </form>
        </li>
        @endif
        <div class="indicator">

        </div>
    </ul>

    <!-- SEARCH FORM -->
    <!--        <form class="form-inline ml-3">-->
    <!--            <div class="input-group input-group-sm">-->
    <!--                <input class="form-control form-control-navbar" type="search" placeholder="جستجو" aria-label="Search">-->
    <!--                <div class="input-group-append">-->
    <!--                    <button class="btn btn-navbar" type="submit">-->
    <!--                        <i class="fa fa-search"></i>-->
    <!--                    </button>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </form>-->

    <!-- Right navbar links -->
    <ul class="navbar-nav mr-auto">
        <!-- cart -->

        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fa fa-cart-arrow-down" style="font-size: 20px"></i>
                <span class="badge badge-danger navbar-badge">{{$count}}</span>
            </a>
            <div class="dropdown-menu dropdown-menu dropdown-menu-left" style="width: 400px !important;">

                <div class="dropdown-divider"></div>


                @if(! empty($foods_cart))
                    @foreach ($foods_cart as $food)
                        @if (auth()->check())
                            @php
                                $cart = \App\Models\Cart::where("user_id",auth()->user()->id )->where("food_id",$food["id"])->first();
                            @endphp
                        @else
                            @php
                                $cart = \App\Models\Cart::where("user_ip",$_SERVER['REMOTE_ADDR'] )->where("food_id",$food["id"])->first();


                            @endphp
                        @endif
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="/upload/foods/{{json_decode($food['images'])[0]}}" alt="User Avatar" class="img-size-50 ml-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        {{$food['name']}}
                                        <span class="float-left text-sm text-muted">
                                            <i class="font-italic"> {{number_format($food['price'])}} تومان</i>
                                        </span>
                                        <span class="pull-left" style="margin-left: 5%;">
                                        {{(new \App\Helpers\JalaliDate)->english_to_persian($cart->count)}}
                                        <small> x </small>
                                        </span>
{{--                                        <span class="text-sm text-muted">--}}
{{--                                            {{(new \App\Helpers\JalaliDate)->english_to_persian($cart->count)}}--}}
{{--                                            <small>x </small>--}}
{{--                                        </span>--}}

                                        <br>
                                    </h3>
{{--                                    <p class="text-sm">{{substr($food["description"], 0, 50)}}</p>--}}
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                    @endforeach
                @else
                    <div class="media">
                        <div class="media-body text-center">
                            <h3 class="text-sm">هنوز محصولی اضافه نکرده اید</h3>
                        </div>
                    </div>
                @endif


                    <div class="dropdown-divider"></div>
                    <a href="{{route('cart.index')}}" class="dropdown-item dropdown-footer">مشاهده سبد خرید</a>
            </div>
        </li>
        <!-- cart -->

        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fa fa-bell-o"></i>
                <span class="badge badge-warning navbar-badge">15</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left">
                <span class="dropdown-item dropdown-header">15 نوتیفیکیشن</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fa fa-envelope ml-2"></i> 4 پیام جدید
                    <span class="float-left text-muted text-sm">3 دقیقه</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fa fa-users ml-2"></i> 8 درخواست دوستی
                    <span class="float-left text-muted text-sm">12 ساعت</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fa fa-file ml-2"></i> 3 گزارش جدید
                    <span class="float-left text-muted text-sm">2 روز</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">مشاهده همه نوتیفیکیشن</a>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
                    class="fa fa-th-large"></i></a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
