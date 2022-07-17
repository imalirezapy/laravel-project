@section('style')
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: #222327;
        }

        .navigation {
            height: 60px;
            position: relative;
            width: 400px;
            height: 60px;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 10px;
        }

        .custom-ul {
            display: flex;
            width: 350px;
            /*background: #fff3cd;*/
        }

        .custom-ul li {
            list-style: none;
            position: relative;
            width: 70px;
            height: 60px;
            z-index: 2;
        }

        .custom-ul li a {
            position: relative;
            justify-content: center;
            display: flex;
            align-items: center;
            height: 100%;
            width: 100%;
        }

        .custom-ul li a .icon {
            position: relative;
            display: block;
            width: 55px;
            height: 55px;

            text-align: center;
            line-height: 65px;
            border-radius: 50%;
            color: #222327;
            font-size: 1.5em;
            transition: 0.6s;
        }

        .custom-ul li.active a .icon {
            background: var(--clr);
            color: #fff;
            transform: translateY(-27px);
        }

        .custom-ul li a .icon::before {
            content: '';
            position: absolute;
            top: 10px;
            left: 0;
            height: 100%;
            width: 100%;
            background: var(--clr);
            border-radius: 50%;
            filter: blur(5px);
            opacity: 0;
        }

        .custom-ul li.active a span::before {
            opacity: 0.5;
        }

        .indicator {
            position: absolute;
            top: -35px;
            width: 70px;
            height: 70px;
            background: #fff;
            border-radius: 50%;
            z-index: 1;
            transition: 0.5s;
        }

        .indicator::before {
            content: '';
            position: absolute;
            top: 5px;
            left: -28px;
            height: 30px;
            width: 30px;
            background: transparent;
            border-radius: 50%;
            box-shadow: 15px 18px #fff;

        }

        .indicator::after {
            content: '';
            position: absolute;
            top: 5px;
            right: -28px;
            height: 30px;
            width: 30px;
            background: transparent;
            border-radius: 50%;
            box-shadow: -15px 18px #fff;
        }

        .custom-ul li:nth-child(1).active ~ .indicator {
            transform: translateX(calc(-70px * 0));
        }

        .custom-ul li:nth-child(2).active ~ .indicator {
            transform: translateX(calc(-70px * 1));
        }

        .custom-ul li:nth-child(3).active ~ .indicator {
            transform: translateX(calc(-70px * 2));
        }

        .custom-ul li:nth-child(4).active ~ .indicator {
            transform: translateX(calc(-70px * 3));
        }

        .custom-ul li:nth-child(5).active ~ .indicator {
            transform: translateX(calc(-70px * 4));
        }
    </style>
@append
@php
    $array=[
        ['icon'=>'home-outline','route'=>'home'],
        ['icon'=>'bag-outline','route'=>'shop'],
        ['icon'=>'cart-outline','route'=>'cart.index'],
        ['icon'=>'enter-outline','route'=>'login'],
        ['icon'=>'person-add-outline','route'=>'register'],
    ]
@endphp
<div class="navigation">
    <ul class="custom-ul">

        {{--        <li class="list active">--}}
        {{--            <a href="#" class="" data-widget="pushmenu">--}}
        {{--                    <span class="icon">--}}
        {{--                        <ion-icon name="menu"></ion-icon>--}}
        {{--                    </span>--}}
        {{--            </a>--}}
        {{--        </li>--}}
        @foreach($array as $item)
            <li class="list {{ ($route==$item['route'])?'active':'' }}" style="--clr:#f44336" id="1">
                <a href="{{ route($item['route']) }}">
                    <span class="icon"><ion-icon name="{{ $item['icon'] }}"></ion-icon></span>
                </a>
            </li>
        @endforeach
        <div class="indicator">
        </div>
    </ul>
</div>

@section('script')
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
@append
