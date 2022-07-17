@extends("layouts.master")
@section("title", "علاقه مندی ها")
@section("content")
    <script>
        import State_save from "../../public/plugins/datatables/extensions/ColReorder/examples/state_save.html";
        import Option from "../../public/plugins/datatables/extensions/Responsive/examples/initialisation/option.html";
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result)
                        .width(150)
                        .height(200);
                };
                <?php $_SESSION['image-uploaded'] = true?>
                reader.readAsDataURL(input.files[0]);
            }
        }
        export default {
            components: {Option, State_save}
        }
    </script>

    <style>

        /* https://css-tricks.com/styling-cross-browser-compatible-range-inputs-css/ */

        .range-slider {
            position: relative;
            width: 100%;
            height: 35px;
            text-align: center;
        }

        .range-slider input {
            pointer-events: none;
            position: absolute;
            overflow: hidden;
            left: 0;
            top: 15px;
            width: 100%;
            outline: none;
            height: 18px;
            margin: 0;
            padding: 0;
        }

        .range-slider input::-webkit-slider-thumb {
            pointer-events: all;
            position: relative;
            z-index: 1;
            outline: 0;
        }

        .range-slider input::-moz-range-thumb {
            pointer-events: all;
            position: relative;
            z-index: 10;
            -moz-appearance: none;
            width: 9px;
        }

        .range-slider input::-moz-range-track {
            position: relative;
            z-index: -1;
            background-color: rgba(0, 0, 0, 1);
            border: 0;
        }

        .range-slider input:last-of-type::-moz-range-track {
            -moz-appearance: none;
            background: none transparent;
            border: 0;
        }

        .range-slider input[type=range]::-moz-focus-outer {
            border: 0;
        }

        .rangeValue {
            width: 30px;
        }

        .output {
            position: absolute;
            border:1px solid #999;
            width: 70px;
            height: 30px;
            text-align: center;
            color: #999;
            border-radius: 4px;
            display: inline-block;
            font: bold 15px/30px Helvetica, Arial;
            bottom: 75%;
            left: 50%;
            transform: translate(-50%, 0);
        }

        .output.outputTwo {
            left: 100%;
        }


        .container {
            position: absolute;
            top: 50%;
            left: 50%;
            -webkit-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
        }

        input[type=range] {
            -webkit-appearance: none;
            background: none;
        }

        input[type=range]::-webkit-slider-runnable-track {
            height: 5px;
            border: none;
            border-radius: 3px;
            background: transparent;
        }

        input[type=range]::-ms-track {
            height: 5px;
            background: transparent;
            border: none;
            border-radius: 3px;
        }

        input[type=range]::-moz-range-track {
            height: 5px;
            background: transparent;
            border: none;
            border-radius: 3px;
        }

        input[type=range]::-webkit-slider-thumb  {
            -webkit-appearance: none;
            border: none;
            height: 16px;
            width: 16px;
            border-radius: 50%;
            background: #555;
            margin-top: -5px;
            position: relative;
            z-index: 10000;
        }


        input[type=range]::-ms-thumb {
            -webkit-appearance: none;
            border: none;
            height: 16px;
            width: 16px;
            border-radius: 50%;
            background: #555;
            margin-top: -5px;
            position: relative;
            z-index: 10000;
        }

        input[type=range]::-moz-range-thumb {
            -webkit-appearance: none;
            border: none;
            height: 16px;
            width: 16px;
            border-radius: 50%;
            background: #555;
            margin-top: -5px;
            position: relative;
            z-index: 10000;
        }

        input[type=range]:focus {
            outline: none;
        }

        .full-range,
        .incl-range {
            width: 100%;
            height: 5px;
            left: 0;
            top: 21px;
            position: absolute;
            background: #DDD;
        }

        .incl-range {
            background: #0081ff;
        }


        body{

            background-color: #eee;
        }


        .card{

            background-color: #fff;
            border:none;
            border-radius: 10px;
            width: 190px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);

        }

        .image-container{

            position: relative;
        }

        .thumbnail-image{
            border-radius: 10px !important;
        }


        .discount{

            background-color: red;
            padding-top: 1px;
            padding-bottom: 1px;
            padding-left: 4px;
            padding-right: 4px;
            font-size: 10px;
            border-radius: 6px;
            color: #fff;
        }

        .wishlist{

            height: 25px;
            width: 25px;
            background-color: #eee;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            box-shadow:  0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }

        .first{

            position: absolute;
            width: 100%;
            padding: 9px;
        }


        .dress-name{
            font-size: 13px;
            font-weight: bold;
            width: 75%;
        }


        .new-price{
            font-size: 13px;
            font-weight: bold;
            color: red;

        }
        .old-price{
            font-size: 8px;
            font-weight: bold;
            color: grey;
        }


        .btn{
            width: 14px;
            height: 14px;
            border-radius: 50%;
            padding: 3px;
        }

        .creme{
            background-color: #fff;
            border: 2px solid grey;


        }
        .creme:hover {
            border: 3px solid grey;
        }

        .creme:focus {
            background-color: grey;

        }


        .red{
            background-color: #fff;
            border: 2px solid red;

        }


        .red:hover {
            border: 3px solid red;
        }
        .red:focus {
            background-color: red;
        }



        .blue{
            background-color: #fff;
            border: 2px solid #40C4FF;
        }

        .blue:hover {
            border: 3px solid #40C4FF;
        }
        .blue:focus {
            background-color: #40C4FF;
        }
        .darkblue{
            background-color: #fff;
            border: 2px solid #01579B;
        }
        .darkblue:hover {
            border: 3px solid #01579B;
        }
        .darkblue:focus {
            background-color: #01579B;
        }
        .yellow{
            background-color: #fff;
            border: 2px solid #FFCA28;
        }
        .yellow:hover {
            border-radius: 3px solid #FFCA28;
        }
        .yellow:focus {
            background-color: #FFCA28;
        }


        .item-size{
            width: 15px;
            height: 15px;
            border-radius: 50%;
            background: #fff;
            border: 1px solid grey;
            color: grey;
            font-size: 10px;
            text-align: center;
            align-items: center;
            display: flex;
            justify-content: center;
        }


        .rating-star{
            font-size: 10px !important;
        }
        .rating-number{
            font-size: 10px;
            color: grey;

        }
        .buy{
            font-size: 12px;
            color: purple;
            font-weight: 500;
        }
    </style>

    <div class="row mr-5 ">

        <ul>
            @foreach($errors->all() as $error)
                <li class="alert alert-danger w-75 mr-auto ml-auto">{{$error}}</li>
            @endforeach
        </ul>
        @if(! empty($foods))

            @foreach($foods as $food)

                <div class="justify-content-between col-lg-3 col-md-4 col-sm-6 " >



                    <div class="card">

                        <div class="image-container" style="width: 190px;height: 180px">

                            <div class="first">

                                <div class="d-flex justify-content-between align-items-center mr-auto ml-auto">

                                    {{--                            <span class="discount">-25%</span>--}}
                                    <span class="wishlist bg-danger-gradient" style="transition: 0.5s" id="{{$food['id']}}" onclick="heart(this, this.className, this.id)" ><i class="fa fa-heart-o " id="heard"  ></i></span>


                                </div>
                            </div>


                            <img src="/upload/foods/{{json_decode($food['images'])[0]}}" class="img-fluid rounded thumbnail-image " style="width: 100%; max-height: 100%">

                        </div>

                        <a href="{{route('food.show', $food['id'])}}">
                            <div class="product-detail-container p-2 m-1">

                                <div class="d-flex justify-content-between align-items-center">

                                    <h5 class="dress-name">{{$food['name']}}</h5>

                                    <div class="d-flex flex-column mb-2">

                                        <span class="new-price" style="color: limegreen">{{number_format($food['price'])}}</span>
                                        <del style="color: gray"><small class="old-price text-right" style="color: red">{{str(rand(65, 100)). "000"}}</small></del>
                                    </div>

                                </div>


                                {{--                <div class="d-flex justify-content-between align-items-center pt-1">--}}

                                {{--                    <div class="color-select d-flex ">--}}

                                {{--                        <input type="button" name="grey" class="btn creme">--}}
                                {{--                        <input type="button" name="red" class="btn red ml-2">--}}
                                {{--                        <input type="button" name="blue" class="btn blue ml-2">--}}

                                {{--                    </div>--}}

                                {{--                    <div class="d-flex ">--}}

                                {{--                        <span class="item-size mr-2 btn" type="button">S</span>--}}
                                {{--                        <span class="item-size mr-2 btn" type="button">M</span>--}}
                                {{--                        <span class="item-size btn" type="button">L</span>--}}

                                {{--                    </div>--}}


                                {{--                </div>--}}


                                <div class="d-flex align-items-center pt-1">
                                    <form action="{{route("foods")}}" class="ml-auto" method="post">
                                        @csrf
                                        @method('put')
                                        <input type="hidden" name="id" value="{{$food['id']}}">
                                        <button class="btn btn-success h-50 w-100 rounded-bottom" type="submit">
                                            <small>افزودن به سبد خرید</small>
                                        </button>

                                    </form>
                                    <div class="mr-auto ">
                                        <i class="fa fa-star-o rating-star"></i>

                                        <span class="rating-number">{{str(rand(3, 4)) .".". str(rand(1, 5))}}</span>
                                    </div>
                                </div>



                            </div>
                        </a>

                    </div>





                    {{--        <div class="mt-3">--}}
                    {{--            <div class="card voutchers">--}}

                    {{--                <div class="voutcher-divider">--}}
                    {{--                        <p>{{$food->description}}</p>--}}
                    {{--                    <div class="voutcher-left text-center">--}}
                    {{--                        <span class="voutcher-name">Monday Happy</span>--}}
                    {{--                        <h5 class="voutcher-code">#MONHPY</h5>--}}

                    {{--                    </div>--}}
                    {{--                    <div class="voutcher-right text-center border-left">--}}
                    {{--                        <h5 class="discount-percent">20%</h5>--}}
                    {{--                        <span class="off">Off</span>--}}

                    {{--                    </div>--}}

                    {{--                </div>--}}

                    {{--            </div>--}}

                    {{--        </div>--}}






                </div>
            @endforeach
        @else
            <div class="justify-content-between col-12 " >
                <p class="text-bold text-center mt-5">
                    محصولی برای نمایش یافت نشد
                </p>

            </div>
        @endif

        {{--@component('component.menu')--}}
        {{--@slot('route',request()->route()->getName())--}}
        {{--    @endcomponent--}}
    </div>

@endsection

@section("script")
    <script>
        function heart(doc, cls, id) {
            if (cls === "wishlist"){
                doc.className = "wishlist bg-danger-gradient";
                $.ajax({
                    method: 'POST',
                    url: '/shop/favorite/' + id,
                    dataType: 'json',
                    data: {_token:`{{ csrf_token() }}`,value:id},
                    success: function (response) {
                        console.log(response);
                        $(".star-rating-prebuilt").attr("value", (response['wishlist']));
                    }
                });
            } else{
                doc.className = "wishlist";
                $.ajax({
                    method: 'POST',
                    url: '/shop/favorite/' + id + "/delete",
                    dataType: 'json',
                    data: {_token:`{{ csrf_token() }}`,value:id},
                    success: function (response) {
                        console.log(response);
                        $(".star-rating-prebuilt").attr("value", (response['wishlist']));
                    }
                });
            }

        }
    </script>
@endsection
