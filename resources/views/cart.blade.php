@extends("layouts.master")
@section("title", "سبد خرید")
<style>
    .lds-ellipsis {
        display: inline-block;
        position: relative;
        width: 80px;
        height: 80px;
        margin-right:40%;

    }
    .lds-ellipsis div {
        position: absolute;
        top: 33px;
        width: 13px;
        height: 13px;
        border-radius: 50%;
        background: #c7c7c7;
        animation-timing-function: cubic-bezier(0, 1, 1, 0);
    }
    .lds-ellipsis div:nth-child(1) {
        left: 8px;
        animation: lds-ellipsis1 0.6s infinite;
    }
    .lds-ellipsis div:nth-child(2) {
        left: 8px;
        animation: lds-ellipsis2 0.6s infinite;
    }
    .lds-ellipsis div:nth-child(3) {
        left: 32px;
        animation: lds-ellipsis2 0.6s infinite;
    }
    .lds-ellipsis div:nth-child(4) {
        left: 56px;
        animation: lds-ellipsis3 0.6s infinite;
    }
    @keyframes lds-ellipsis1 {
        0% {
            transform: scale(0);
        }
        100% {
            transform: scale(1);
        }
    }
    @keyframes lds-ellipsis3 {
        0% {
            transform: scale(1);
        }
        100% {
            transform: scale(0);
        }
    }
    @keyframes lds-ellipsis2 {
        0% {
            transform: translate(0, 0);
        }
        100% {
            transform: translate(24px, 0);
        }
    }

</style>
@section("content")

    @if(! empty($foods_cart))
            <div class="row" id="main">





                <aside class="col-lg-8 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table table-borderless table-shopping-cart">
                                <thead class="text-muted">
                                <tr class="small text-uppercase">
                                    <th scope="col" class="row-cols-1">محصول</th>
                                    <th scope="col" class="row-cols-2">اسم</th>
                                    <th scope="col" class="row-cols-1 text-center">تعداد</th>
                                    <th scope="col" class="row-cols-3 w-25 text-center">قیمت</th>
                                    <th scope="col" class="text-right d-none pull-left" width="200"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $total = 0;
                                @endphp
                                @foreach($foods_cart as $food)

                                    @if (auth()->check())
                                        @php
                                            $cart = \App\Models\Cart::where("user_id",auth()->user()->id )->where("food_id",$food["id"])->first();
                                        @endphp
                                    @else
                                        @php

                                            $cart = \App\Models\Cart::where("user_ip",$_SERVER['REMOTE_ADDR'] )->where("food_id",$food["id"])->first();
                                        @endphp
                                    @endif
                                    @php
                                        $total += (int) $cart->count * $food['price']
                                    @endphp

                                    <tr id="{{$food['id']}}">
                                        <td>
                                            <figure class="itemside align-items-center">
                                                <div class="aside inline">
                                                    <img src="/upload/foods/{{json_decode($food["images"])[0]}}" class=" img-size-64 rounded-3">

                                                </div>
                                            </figure>
                                        </td>
                                        <td>
                                            <p class="title text-dark" data-abc="true">{{$food['name']}}</p>

                                        </td>
                                        <td id="tdcount{{$cart->id}}">
                                            <div id="count{{$cart->id}}">
                                                <div class="col-md-12 col-lg-12 col-xl-12 d-flex">
                                                    <button type="button" class="btn btn-link px-2"
                                                            onclick="setDown(this,`{{$cart->id}}`,`{{$food['price']}}`)">
                                                        <i class="fa fa-minus"></i>
                                                    </button>


                                                    <input id="c{{$cart->id}}" min="1" max="99" name="count[{{$food['id']}}]"
                                                           style="-moz-appearance: textfield;"
                                                           value="{{$cart->count}}" type="number"
                                                           class="numberinput form-control form-control form-control-lg text-center"/>

                                                    <button type="button" class="btn btn-link px-2"
                                                            onclick="setUp(this,`{{$cart->id}}`, `{{$food['price']}}`)">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="lds-ellipsis " id="load{{$cart->id}}" style="display:none;height: 40px;width: 40px;margin-right: 50%;margin-top: 10px"><div style="top: 0"></div><div style="top: 0"></div><div style="top: 0;"></div><div style="top: 0"></div></div>
                                        <td>
                                            <div class="price-wrap text-center"> <var id="price{{$cart->id}}">{{number_format($food['price'] * $cart->count)}}</var> <small class="text-muted ltr">=<span id="single-count{{$cart->id}}">{{$cart->count}}</span>x{{number_format($food['price'])}}</small> </div>
                                        </td>
                                        <td class="text-righ pull-left">
                                            {{--                                                <a data-original-title="Save to Wishlist" title="" href="" class="btn btn-light" data-toggle="tooltip" data-abc="true">--}}
                                            {{--                                                    <i class="fa fa-heart"></i>--}}
                                            {{--                                                </a>--}}
{{--                                            <a class="fa fa-trash fa-2x fa-lg text-danger delete" data-key="{{ $food["id"] }}" data-route="{{ route('cart.destroy',$food->id) }}"></a>--}}

                                            <button type="button" class="btn btn-danger delete" onclick="remove_food(`{{ route('cart.destroy',$cart->id) }}`, `{{$food['id']}}`)">
                                                حذف
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>

            </aside>

            <aside class="col-lg-4 col-md-12 col-sm-12">
                    <div class="row">
                        <div class="card col-lg-12 col-md-5 mr-auto">
                            <div class="card-body mr-3">
                                <dl class="dlist-align">
                                    <dt>مبلغ کل:</dt>
                                    <dd class="text-left" id="total">{{number_format($total)}} تومان</dd>
                                </dl>
                                <hr>
                                <div class="row">

                                    <div class="col-lg-7 col-md-7 col-sm-4">

                                        <a href="{{route("cart.profile-details")}}" type="submit" class="btn btn-out btn-success mt-2 w-100" data-abc="true">تایید و ادامه</a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>

    @else
        <div class="media">
            <div class="media-body text-center">
                <h1 class="text-sm">هنوز محصولی اضافه نکرده اید</h1>
            </div>
        </div>
    @endif

@endsection
@section('script')
    <script>
        function sleep(ms) {
            return new Promise(resolve => setTimeout(resolve, ms));
        }
        function remove_food(route, id) {
            $.ajax({
                method: 'POST',
                url: route,
                dataType: 'json',
                data: {_token: `{{ csrf_token() }}`, _method: `delete`},
                success: function (response) {
                    console.log(response);
                    if (response.msg === 'deleted') {
                        // document.getElementById(id).remove();
                        // location.reload();
                    }
                },
                complete: function () {
                    var load = '<td colspan="5"><div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div></td>';
                    document.getElementById(id).innerHTML = load;
                    sleep(1000).then(() => {
                        document.getElementById(id).remove();
                    });

                },
                timeout: 3000,

            });
        }

    </script>
    <script>
        function apply(input, count, id, price) {


            $.ajax({
                method: 'POST',
                url: 'cart/'+id,
                dataType: 'json',
                data: {_token: `{{ csrf_token() }}`, _method:`put`, value: count},
                success: function (response) {
                    input.attr("count", (response['count']))
                },
                complete: function () {
                    sleep(1000).then(() => {
                        var single_price_obj = document.getElementById('price' + id);
                        var number1 = parseInt(input.value) * parseInt(price);
                        single_price_obj.innerHTML = new Intl.NumberFormat('ja-JP', {maximumSignificantDigits: 3}).format(number1);
                        var single_count = document.getElementById('single-count'+id);
                        single_count.innerHTML = input.value;
                        $('#count' + id).show();
                        $('#load' + id).hide();
                    });

                }
            });
        }
        function setUp(element, id, price) {

            $('#count' + id).hide();
            $('#load' + id).show();
            var input = element.parentNode.querySelector('input[type=number]');
            var temp = input.value;
            input.stepUp();

            if (temp !== input.value) {
                var number = parseInt(total.innerHTML.replace('تومان','').replace(',', '')) + parseInt(price);
                total.innerHTML = new Intl.NumberFormat('ja-JP', {maximumSignificantDigits: 3}).format(number) + " تومان";
            }

            apply(input, input.value, id, price);

        }

        function setDown(element, id, price){

            var total = document.getElementById('total');

            $('#count' + id).hide();
            $('#load' + id).show();
            var input = element.parentNode.querySelector('input[type=number]');
            var temp = input.value;
            input.stepDown();

            if (temp !== input.value) {
                var number = parseInt(total.innerHTML.replace('تومان','').replace(',', '')) - parseInt(price);
                total.innerHTML = new Intl.NumberFormat('ja-JP', {maximumSignificantDigits: 3}).format(number) + " تومان";
            }

            apply(input, input.value, id, price);


        }
    </script>
@endsection
