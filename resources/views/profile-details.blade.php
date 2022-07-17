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

    </style>

    <div class="row" >
        <div class="col-12">
            <div class="d-flex flex-row justify-content-between border border-radius">
                <div class="justify-content-center text-black-50">
                    <div class="fa fa-shopping-cart text-lg mr-3 "></div><br>
                    <span>سبد خرید</span>
                </div>


                <div class="flex-1 justify-content-center line"></div>


                <div class="justify-content-center myactive">
                    <div class="fa fa-truck text-lg" style="margin-right: 50%;"></div><br>
                    <small>تکمیل اطلاعات و نحوه ارسال</small>
                </div>


                <div class="flex-1 justify-content-center line"></div>


                <div class="justify-content-center text-black-50">
                    <div class="fa fa-money text-lg mr-3 "></div><br>
                    <span>پرداخت</span>
                </div>

            </div>
        </div>
    </div>


        <div class="row">
            <aside class="col-lg-6 col-md-12 col-sm-12">
                <div class="">
                    <div class="d-flex flex-row justify-content-between border border-radius" style="--padding:4%">
                        <form id="details" action="{{route("cart.profile-details.create")}}" method="post">

                        <h3 class="text-black-50">مشخصات گیرنده</h3><br>
                            @csrf
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label class="labels">نام</label><span class="text-danger">*</span><input type="text" class="form-control border"  value="{{$user['name']}}" name="name">
                                    @error("name")
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="labels">ایمیل</label><span class="text-danger">*</span><input type="text" class="form-control" value="{{$user['email']}}" name="email">
                                    @error("email")
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label class="labels">شماره موبایل</label><span class="text-danger">*</span><input type="text" class="form-control" placeholder="0900000000" value="{{$profile['phone']}}" name="phone">
                                    @error("phone")
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label class="labels">استان</label><span class="text-danger">*</span>


                                    <select class="js-example-theme-single w-100 form-control" name="state" >
                                        <option value="" >
                                            انتخاب استان
                                        </option>
                                    @foreach(\App\Models\State::orderBy("id", "desc")->get() as $state)
    {{--                                    {{$state->name}}--}}
                                            <option value="{{$state->id}}" {{$profile["state"]==$state->id?"selected":""}}>
                                                {{$state->name}}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error("state")
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label class="labels">کدپستی</label><span class="text-danger">*</span><input type="text" class="form-control" placeholder="" value="{{$profile['post']}}" name="post">
                                    @error("post")
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>

                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <label class="labels"><input type="radio" name="address" value="{{$profile['address']}}" checked>
                                        آدرس گیرنده </label><span class="text-danger">*</span><textarea type="text" class="form-control" placeholder="" name="address">{{$profile['address']}}</textarea>
                                    @error("address")
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                @foreach($profile_details as $profile_detail)
                                    @if($profile_detail['address']!=$profile['address'])
                                        <lable class="col-12" style="margin-top: 10px;" >
                                        <input type="radio" name="address" value="{{$profile_detail['address']}}">
                                            {{empty($profile_detail['address'])?$profile['address']:$profile_detail['address']}}
                                        </lable>
                                    @endif
                                @endforeach

                             </form>

    {{--                    <div class="col-md-12"><label class="labels">Area</label><input type="text" class="form-control" placeholder="enter address line 2" value=""></div>--}}
                                {{--                    <div class="col-md-12"><label class="labels">Email ID</label><input type="text" class="form-control" placeholder="enter email id" value=""></div>--}}
                                {{--                    <div class="col-md-12"><label class="labels">Education</label><input type="text" class="form-control" placeholder="education" value=""></div>--}}
                            </div>
                            {{--                <div class="row mt-3">--}}
                            {{--                    <div class="col-md-6"><label class="labels">Country</label><input type="text" class="form-control" placeholder="country" value=""></div>--}}
                            {{--                    <div class="col-md-6"><label class="labels">State/Region</label><input type="text" class="form-control" value="" placeholder="state"></div>--}}
                            {{--                </div>--}}



                    </div>

            </aside>
            <aside class="col-lg-6 col-md-12 col-sm-12">
                <div class="">
                    <div class="justify-content-center">
                        <div class="row border border-radius" style="--padding:4%">
                            <div class="d-flex flex-1 col-12" style="margin-bottom: 10px;">
                                <span class="mt-1 ml-2">سبد خرید</span>
                                <div class="border" style="border-radius: 13px;font-size: 10px;height: 30px;background: #e5e5e5;">
                                    <span class=" d-flex  px-2 mt-2">{{(new \App\Helpers\JalaliDate())->english_to_persian(count($foods->toArray()))}} کالا</span>
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
                                @php
                                    $total = 0;
                                @endphp


                                <div class="scrollmenu" >
                                    @foreach($foods as $food)
                                        @php
                                            $cart = \App\Models\Cart::where("user_id",auth()->user()->id)->where("food_id",$food["id"])->first();
                                            $total += (int) $cart->count * $food['price'];

                                        @endphp


                                        <div>
                                            <figure class="itemside align-items-center ">
                                                <img src="/upload/foods/{{json_decode($food->images)[0]}}" class=" img-size-64 rounded-3">
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
                                <div class="col-lg-12 col-md-5 mr-auto">

                                    <dl class="dlist-align">
                                        <dt>مبلغ کل:</dt>
                                        <dd class="text-left">{{number_format($total)}} تومان</dd>
                                    </dl>
                                    <hr>
                                    <div class="row">

                                        <div class="col-12">

                                            <button class="btn btn-out btn-success btn-square btn-main mt-2 w-50" type="submit" data-abc="true" form="details">تایید اطلاعات و ادامه</button>

                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>

                    </div>
                </div>


                <div class="">
                    <div class="justify-content-center">
                        <div class="row border border-radius" style="--padding:4%">
                            <div class="d-flex flex-1 col-12" style="margin-bottom: 10px">
                                <div class="" style="border-radius: 13px;font-size: 15px;height: 30p;color: gray">
                                    <span class="fa fa-truck d-flex  px-2 mt-2"></span>
                                </div>
                                <span class="mt-1 ml-2">نحوه ارسال</span>

                            </div>
                            <div class="col-12 ">
                                <div>
                                    <label>
                                        <input type="radio" name="delivery" class="custom-radio" value="tipax" form="details" checked>
                                        تیپاکس
                                    </label><br>
                                    <label>
                                        <input type="radio" name="delivery" value="special-delivery" form="details">
                                        پست پیشتاز
                                    </label><br>
                                    <label>
                                        <input type="radio" name="delivery" value="normal-delivery" form="details">
                                        ارسال عادی
                                    </label>
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
