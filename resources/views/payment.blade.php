@extends("layouts.master")
@section("title", "تکمیل اطلاعات")
@section("content")
    <style>
        .line{
            /*content: "";*/
            height: 0.5px;

            background-color: #9f9e9e;
            display: block;
            margin-top: 10px;
        }
        .myactive {
            color: red;
        }
        .myactive div{
            font-size: 30px;
        }
        .border-radius{
            height: 100%;
            padding: 4%;
            border-radius: 10px
        }
        .row{
            margin: 4px;
        }
        input[type="radio"]:checked ~ .fa {
            color: #19bfd3;
            transition: 0.1s;
            font-size: 20px;
        }

    </style>

    <div class="row" >
        <div class="col-12">
            <div class="d-flex flex-row justify-content-between border border-radius">
                <div class="justify-content-center text-black-50">
                    <div class="fa fa-shopping-cart text-lg mr-3 "></div><br>
                    <span>سبد خرید</span>
                </div>


                <div class="flex-1 justify-content-center line"></div>


                <div class="justify-content-center text-black-50">
                    <div class="fa fa-truck text-lg" style="margin-right: 50%"></div><br>
                    <small>تکمیل اطلاعات و نحوه ارسال</small>
                </div>


                <div class="flex-1 justify-content-center line"></div>


                <div class="justify-content-center  myactive">
                    <div class="fa fa-money text-lg mr-3 "></div><br>
                    <span>پرداخت</span>
                </div>

            </div>
        </div>
    </div>


    <div class="row">
        <aside class="col-lg-6 col-md-12 col-sm-12">
            <div class="">
                <div class=" row  border border-radius" style="--padding:4%">
                    <div class="col-12 d-flex justify-content-between" style="margin-bottom: 20px;">
                        <h6>انتخاب روش پرداخت</h6>
                        <img src="/defaults/paypal.png" class="img-size-64">
                    </div>

                        @csrf
                        <style>
                            input[type="radio"]:checked ~ .fa {
                                color: #19bfd3;
                                transition: 0.1s;
                                font-size: 20px;
                            }
                        </style>

                        <label class="col-12">
                            <input type="radio" name="gateway" value="online" {{$factor->gateway=="online"?'checked':''}} form="coupon">
                            <span class="fa fa-credit-card"></span>
                            <span style="font-weight: normal;font-size:15px">پرداخت اینترنتی</span>
                        </label>
                        <hr style="width: 90%">
                        <label class="col-12">
                            <input type="radio" name="gateway" value="credit-card" {{$factor->gateway=="credit-card"?'checked':''}} form="coupon">
                            <span class="fa fa-home"></span>
                            <span style="font-weight: normal;font-size:15px">پرداخت در محل (با کارت بانکی)</span>
                        </label>
                        <hr style="width: 90%">
                        <label class="col-12">
                            <input type="radio" name="gateway" value="paypal" {{$factor->gateway=="paypal"?'checked':''}} form="coupon">
                            <span class="fa fa-paypal"></span>
                            <span style="font-weight: normal;font-size:15px">پرداخت اعتباری</span>
                        </label>


                </div>

            </div>


            <div class="">
                <div class=" row  border border-radius" style="--padding:4%">
                    <div class="col-12 d-flex " style="margin-bottom: 20px;">
                        <span class="fa fa-percent text-sm">
                        <span> کد تخفیف دارید؟</span>
                    </div>
                    @if (is_null($factor->coupon))
                    <form id="coupon" action="{{route("coupon.use")}}" method="post" class="form-group d-flex">
                        @csrf
                        @method('put')
                        <input type="text" class="form-control " placeholder="CODE" style="border-radius: 0px 10px 10px 0px;text-transform: uppercase;letter-spacing: 1px" name="code" >

                        <button type="submit" class="btn btn-primary" style="border-radius: 10px 0px 0px 10px" form="coupon">اعمال</button>
                    </form>
                    @else
                        <div class="form-group d-flex" style="width: 272px; height: 38px" >
                            @csrf
                            <div type="text" class="form-control bg-gray" style="border-radius: 0px 10px 10px 0px;text-transform: uppercase;letter-spacing: 1px">
                                {{$factor->coupon->code}}
                            </div>

                            <span type="button" class="btn btn-default" style="border-radius: 10px 0px 0px 10px">اعمال</span>
                        </div>
                    @endif

                    @error("code")
                        <div class="col-12">
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        </div>

                    @enderror
                </div>

            </div>

            <div class="">
                <div class="justify-content-center">
                    <div class="row border border-radius" style="--padding:4%">
                        <div class="col-12" style="margin-bottom: 10px">
                            <span class="mt-1 ml-2">خلاصه سفارش</span>
                        </div>
                        <div class="d-flex flex-1 col-12" style="margin-bottom: 10px">
                            <div class="" style="border-radius: 13px;font-size: 15px;height: 30p;color: gray">
                                <span class="fa fa-truck d-flex  px-2 mt-2"></span>
                            </div>
                            <span class="mt-1 ml-2">{{$delivery}}</span>
                            <div class="border" style="border-radius: 13px;font-size: 10px;height: 30px;background: #e5e5e5;">
                                <span class=" d-flex  px-2 mt-2">{{(new \App\Helpers\JalaliDate())->english_to_persian($count)}} کالا</span>
                            </div>
                        </div>

                        <div class="col-12 ">
                            <style>
                                div.scrollmenu {
                                    overflow: hidden;
                                    white-space: nowrap;
                                    cursor: grab;
                                }

                                div.scrollmenu div {
                                    display: inline-block;

                                    text-align: center;
                                    padding: 14px;
                                    text-decoration: none;
                                    /*height: 1vh;*/
                                }


                            </style>


                            <div class="scrollmenu" >
                                @foreach($factor->user->foods as $food)
                                    @php
                                        $cart = \App\Models\Cart::where("user_id",auth()->user()->id)->where("food_id",$food["id"])->first();

                                    @endphp

                                    <div>
                                        <figure class="itemside align-items-center ">
                                            <img src="/foods/{{$food->image}}" class=" img-size-64 rounded-3">
                                            <figcaption>
                                                <div class=" flex-row ">
                                                    <small><span class="  px-2 mt-2 text-black">x{{(new \App\Helpers\JalaliDate())->english_to_persian($cart->count)}}</span></small>
                                                    <span class="text-black" >{{$food->name}}</span>
                                                </div>
                                            </figcaption>
                                        </figure>
                                    </div>
                                @endforeach

                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </aside>
        <aside class="col-lg-6 col-md-12 col-sm-12">
            <div class="">
                <div class="justify-content-center">
                    <div class="row border border-radius" style="--padding:4%">
                        <div class="d-flex justify-content-between col-12" style="margin-bottom: 10px;">
                            <span class="mt-1 ml-2">قیمت کالاها <small>({{$count}})</small></span>

                                <span class=" d-flex  px-2 mt-2">{{(new \App\Helpers\JalaliDate())->english_to_persian(number_format($factor->total))}}</span>

                        </div>


                        <div class="col-12 ">

                            <div class="col-lg-12 col-md-5 mr-auto">
                                <hr>
                                <dl class="dlist-align">
                                    <span>هزینه ارسال</span>
                                    <dd class="text-left">تومان{{(new \App\Helpers\JalaliDate())->english_to_persian(number_format(15000))}}</dd>
                                </dl>
                                <hr>
                                @php

                                    $percent = is_null($factor->coupon)?0:$factor->coupon->percent;
                                @endphp
                                <div class="d-flex justify-content-between col-12" style="margin-bottom: 10px;">
                                    <span class="mt-1 ml-2">جمع کل </span>
                                    <span class=" d-flex  px-2 mt-2">{{(new \App\Helpers\JalaliDate())->english_to_persian(number_format($factor->total +15000))}}</span>
                                </div>

                                <hr>
                                <div class="d-flex justify-content-between col-12" style="margin-bottom: 10px; color: red">
                                    <small class="mt-1 ml-2">سود شما از خرید</small>
                                    <span class=" d-flex  px-2 mt-2" ><span class="mt-1 ml-1" style="font-size: 11px;font-weight: bold">{{(new \App\Helpers\JalaliDate())->english_to_persian("(".$percent."%)")}}</span>{{(new \App\Helpers\JalaliDate())->english_to_persian(number_format($factor->total-$factor->final_total))}}</span>

                                </div>
                                <div class="d-flex justify-content-between col-12" style="margin-bottom: 10px;color: limegreen">
                                    <small class="mt-1 ml-2">قابل پرداخت</small>
                                    <span class=" d-flex  px-2 mt-2" >{{(new \App\Helpers\JalaliDate())->english_to_persian(number_format($factor->final_total))}}</span>

                                </div>

                            </div>


                                <div class="col-12">
                                    <form action="{{route("coupon.index")}}" method="post" >
                                        @csrf

                                        <button class="btn btn-out btn-success btn-square btn-main mt-2 w-50" type="submit" data-abc="true" >انتقال به صفحه پرداخت</button>
                                    </form>
                                </div>

                        </div>

                    </div>

                </div>
            </div>

        </aside>
    </div>

    <script>
        const slider = document.querySelector('.scrollmenu');
        let isDown = false;
        let startX;
        let scrollLeft;

        slider.addEventListener('mousedown', (e) => {
            isDown = true;
            slider.classList.add('active');
            startX = e.pageX - slider.offsetLeft;
            scrollLeft = slider.scrollLeft;
        });
        slider.addEventListener('mouseleave', () => {
            isDown = false;
            slider.classList.remove('active');
        });
        slider.addEventListener('mouseup', () => {
            isDown = false;
            slider.classList.remove('active');
        });
        slider.addEventListener('mousemove', (e) => {
            if(!isDown) return;
            e.preventDefault();
            const x = e.pageX - slider.offsetLeft;
            const walk = (x - startX) * 3; //scroll-fast
            slider.scrollLeft = scrollLeft - walk;
            console.log(walk);
        });
    </script>
@endsection
