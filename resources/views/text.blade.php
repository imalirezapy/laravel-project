{{--<!-- Navbar -->--}}
{{--<!DOCTYPE html>--}}
{{--<html lang="en">--}}
{{--<head>--}}

{{--</head>--}}
{{--<style>--}}
{{--    * {--}}
{{--        margin: 0;--}}
{{--        padding: 0;--}}
{{--        box-sizing: border-box;--}}
{{--    }--}}
{{--    body {--}}
{{--        display: flex;--}}
{{--        justify-content: center;--}}
{{--        align-items: center;--}}
{{--        min-height: 100vh;--}}
{{--        background: #222327;--}}
{{--    }--}}
{{--    .navigation {--}}
{{--        height: 60px;--}}
{{--        position: relative;--}}
{{--        width: 400px;--}}
{{--        height: 60px;--}}
{{--        background: #fff;--}}
{{--        display: flex;--}}
{{--        justify-content: center;--}}
{{--        align-items: center;--}}
{{--        border-radius: 10px;--}}
{{--    }--}}
{{--    .custom-ul {--}}
{{--        display: flex;--}}
{{--        width:350px;--}}
{{--        /*background: #fff3cd;*/--}}
{{--    }--}}
{{--    .custom-ul li{--}}
{{--        list-style: none;--}}
{{--        position: relative;--}}
{{--        width: 70px;--}}
{{--        height: 60px;--}}
{{--        z-index: 2;--}}
{{--    }--}}
{{--    .custom-ul li a {--}}
{{--        position: relative;--}}
{{--        justify-content: center;--}}
{{--        display: flex;--}}
{{--        align-items: center;--}}
{{--        height: 100%;--}}
{{--        width: 100%;--}}
{{--    }--}}
{{--    .custom-ul li a .icon {--}}
{{--        position: relative;--}}
{{--        display: block;--}}
{{--        width: 55px;--}}
{{--        height: 55px;--}}

{{--        text-align: center;--}}
{{--        line-height: 65px;--}}
{{--        border-radius: 50%;--}}
{{--        color: #222327;--}}
{{--        font-size: 1.5em;--}}
{{--        transition: 0.6s;--}}
{{--    }--}}
{{--    .custom-ul li.active a .icon {--}}
{{--        background: var(--clr);--}}
{{--        color: #fff;--}}
{{--        transform: translateY(-27px);--}}
{{--    }--}}
{{--    .custom-ul li a .icon::before {--}}
{{--        content: '';--}}
{{--        position: absolute;--}}
{{--        top: 10px;--}}
{{--        left: 0;--}}
{{--        height: 100%;--}}
{{--        width: 100%;--}}
{{--        background: var(--clr);--}}
{{--        border-radius: 50%;--}}
{{--        filter: blur(5px);--}}
{{--        opacity: 0;--}}
{{--    }--}}
{{--    .custom-ul li.active a span::before {--}}
{{--        opacity: 0.5;--}}
{{--    }--}}
{{--    .indicator {--}}
{{--        position: absolute;--}}
{{--        top: -35px;--}}
{{--        width: 70px;--}}
{{--        height: 70px;--}}
{{--        background: #fff;--}}
{{--        border-radius: 50%;--}}
{{--        z-index: 1;--}}
{{--        transition: 0.5s;--}}
{{--    }--}}
{{--    .indicator::before {--}}
{{--        content: '';--}}
{{--        position: absolute;--}}
{{--        top: 5px;--}}
{{--        left: -28px;--}}
{{--        height: 30px;--}}
{{--        width: 30px;--}}
{{--        background: transparent;--}}
{{--        border-radius: 50%;--}}
{{--        box-shadow: 15px 18px #fff;--}}

{{--    }--}}
{{--    .indicator::after {--}}
{{--        content: '';--}}
{{--        position: absolute;--}}
{{--        top: 5px;--}}
{{--        right: -28px;--}}
{{--        height: 30px;--}}
{{--        width: 30px;--}}
{{--        background: transparent;--}}
{{--        border-radius: 50%;--}}
{{--        box-shadow: -15px 18px #fff;--}}
{{--    }--}}
{{--    .custom-ul li:nth-child(1).active ~ .indicator{--}}
{{--        transform: translateX(calc(70px * 0 ));--}}
{{--    }--}}
{{--    .custom-ul li:nth-child(2).active ~ .indicator{--}}
{{--        transform: translateX(calc(70px * 1 ));--}}
{{--    }--}}
{{--    .custom-ul li:nth-child(3).active ~ .indicator{--}}
{{--        transform: translateX(calc(70px * 2 ));--}}
{{--    }--}}
{{--    .custom-ul li:nth-child(4).active ~ .indicator{--}}
{{--        transform: translateX(calc(70px * 3 ));--}}
{{--    }--}}
{{--    .custom-ul li:nth-child(5).active ~ .indicator{--}}
{{--        transform: translateX(calc(70px * 4 ));--}}
{{--    }--}}
{{--</style>--}}
{{--<body>--}}

{{--<div class="navigation">--}}
{{--    <ul class="custom-ul">--}}

{{--        <li class="list active">--}}
{{--            <a href="#" class="" data-widget="pushmenu">--}}
{{--                    <span class="icon">--}}
{{--                        <ion-icon name="menu"></ion-icon>--}}
{{--                    </span>--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li class="list active" style="--clr:#f44336" id="1">--}}
{{--            <a href="#" onclick="sessionStorage.setItem('nav', '1')">--}}
{{--                <span class="icon"><ion-icon name="home-outline"></ion-icon></span>--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li class="list" style="--clr:#ffa117" id="2">--}}
{{--            <a href="#--}}{{--route("shop")--}}{{--" onclick="sessionStorage.setItem('nav', '2')">--}}
{{--                <span class="icon"><ion-icon name="bag-outline"></ion-icon></span>--}}

{{--                --}}{{--                    <span class="fa fa-shopping-bag"></span>--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li class="list" style="--clr:#0fc70f" id="3">--}}
{{--            <a href="--}}{{--route("cart.index")--}}{{--" onclick="sessionStorage.setItem('nav', '3')">--}}
{{--                <span class="icon"><ion-icon name="cart-outline"></ion-icon></span>--}}

{{--                --}}{{--                    <span class="fa fa-shopping-cart"></span>--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        @if(! auth()->check())--}}
{{--            <li class="list" style="--clr:#3662f4" id="4">--}}
{{--                <a href="--}}{{--route("login")--}}{{--" onclick="sessionStorage.setItem('nav', '4')">--}}
{{--                    <span class="icon font-weight-bolder"><ion-icon name="enter-outline"></ion-icon></span>--}}

{{--                    --}}{{--                        <span class="fa fa-sign-in nav-icon"></span>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <li class="list" style="--clr:#8c39b9" id="5">--}}
{{--                <a href="--}}{{--route("register")--}}{{--" onclick="sessionStorage.setItem('nav', '5')">--}}
{{--                    <span class="icon"><ion-icon name="person-add-outline"></ion-icon></span>--}}

{{--                    --}}{{--                        <span class="fa fa-vcard nav-icon"></span>--}}

{{--                </a>--}}
{{--            </li>--}}
{{--        @else--}}
{{--            <li class="nav-item list d-none d-sm-inline-block">--}}
{{--                <form action="{{route('logout')}}" method="post">--}}
{{--                    @csrf--}}
{{--                    <button class="nav-link btn-navbar " style="background: none">خروج</button>--}}
{{--                </form>--}}
{{--            </li>--}}
{{--        @endif--}}
{{--        <div class="indicator">--}}
{{--        </div>--}}
{{--    </ul>--}}
{{--</div>--}}
{{--<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>--}}
{{--<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>--}}
{{--<script>--}}
{{--    const lists = document.querySelectorAll('.list');--}}
{{--    const list = document.getElementById(sessionStorage.getItem("SessionName"));--}}

{{--    function activeLink() {--}}
{{--        lists.forEach((item) =>--}}
{{--            item.classList.remove('active'));--}}
{{--        this.classList.add('active')--}}
{{--    }--}}
{{--    lists.forEach((item) =>--}}
{{--    item.addEventListener('click', activeLink)--}}
{{--    )--}}
{{--    //--}}
{{--    // alert(sessionStorage.getItem("nav"))--}}
{{--</script>--}}
{{--</body>--}}
{{--</html>--}}
{{--@extends("layouts.master")--}}
<!-- Required meta tags -->
{{--@section("style")--}}
@extends("layouts.master")
@section("title", "سبد خرید")
@section("style")
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.css">--}}
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css">--}}

@endsection
<style>
    *,*:after, *:before {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }
    .multi-select-box {
        width: 400px;
        margin: 80px auto;

    }
    .multi-select-box select{
        width: 100%;
    }
    /*.multi-select-box button {*/
    /*    background-color: darkblue !important;*/
    /*    color: #fff !important;*/
    /*    padding: 15px 25px;*/
    /*}*/


</style>
@section("content")
    <div class="multi-select-box">
{{--        <button>nothing selected</button>--}}
        <select class="myselect" multiple>
            <optgroup label="Condiments" data-max-options="2">
                <option>Mustard</option>
                <option>Ketchup</option>
                <option>Relish</option>
            </optgroup>
            <optgroup label="Breads" data-max-options="2">
                <option>Plain</option>
                <option>Steamed</option>
                <option>Toasted</option>
            </optgroup>
        </select>

    </div>
@endsection
@section("script")

<script>
    import Button_order from "../../public/plugins/datatables/extensions/ColVis/examples/button_order.html";
    export default {
        components: {Button_order}
    }
</script>
{{--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">--}}

{{--<!-- Latest compiled and minified JavaScript -->--}}
{{--<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>--}}

{{--<!-- (Optional) Latest compiled and minified JavaScript translation files -->--}}
{{--<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>--}}
<script>

    // $(document).read(function () {
        $('.myselect').selectpicker();
    // });
</script>

@endsection
