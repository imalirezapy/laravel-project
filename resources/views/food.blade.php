@extends("layouts.master")
@section("title", "فروشگاه")
@section('style')
    <link rel="stylesheet" href="/js/star-rating.js/dist/star-rating.css">
    <link rel="stylesheet" href="/js/star-rating.js/demo/styles.min.css">
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.23.0/themes/prism.min.css" integrity="sha512-tN7Ec6zAFaVSG3TpNAKtk4DOHNpSwKHxxrsiw4GHKESGPs5njn/0sMCUMl2svV4wo4BK/rCP7juYz+zx+l6oeQ==" crossorigin="anonymous" />--}}
@php
$converter = new \App\Helpers\JalaliDate();

@endphp
@endsection

@section("content")
    <style>
        .badge{
            line-height: 7px;
        }
        body, .wrapper , .content-wrapper{
            background: white;
        }
        .line{
            /*content: "";*/
            height: 0.5px;
            /*width: 90%;*/
            background-color: #afaeae;
            display: block;
            margin-top: 10px;
        }
        @media (min-width: 1024px) {
            .kt-container {
                max-width: 1024px;
            }}
    </style>
    <style>

        .content-item {
            padding:30px 0;
            background-color:#FFFFFF;
        }

        .content-item.grey {
            background-color:#F0F0F0;
            padding:50px 0;
            height:100%;
        }

        .content-item h2 {
            font-weight:700;
            font-size:35px;
            line-height:45px;
            text-transform:uppercase;
            margin:20px 0;
        }

        .content-item h3 {
            font-weight:400;
            font-size:20px;
            color:#555555;
            margin:10px 0 15px;
            padding:0;
        }

        .content-headline {
            height:1px;
            text-align:center;
            margin:20px 0 70px;
        }

        .content-headline h2 {
            background-color:#FFFFFF;
            display:inline-block;
            margin:-20px auto 0;
            padding:0 20px;
        }

        .grey .content-headline h2 {
            background-color:#F0F0F0;
        }

        .content-headline h3 {
            font-size:14px;
            color:#AAAAAA;
            display:block;
        }


        #comments {
            box-shadow: 0 -1px 6px 1px rgba(0,0,0,0.1);
            background-color:#FFFFFF;
        }

        #comments form {
            margin-bottom:30px;
        }

        #comments .btn {
            margin-top:7px;
        }

        #comments form fieldset {
            clear:both;
        }

        #comments form textarea {
            height:100px;
        }

        #comments .media {
            border-top:1px dashed #DDDDDD;
            padding:20px 0;
            margin:0;
        }

        #comments .media > .pull-left {
            margin-right:20px;
        }

        #comments .media img {
            max-width:100px;
        }

        #comments .media h4 {
            margin:0 0 10px;
        }

        #comments .media h4 span {
            font-size:14px;
            float:right;
            color:#999999;
        }

        #comments .media p {
            margin-bottom:15px;
            text-align:justify;
        }

        #comments .media-detail {
            margin:0;
        }

        #comments .media-detail li {
            color:#AAAAAA;
            font-size:12px;
            padding-right: 10px;
            font-weight:600;
        }

        #comments .media-detail a:hover {
            text-decoration:underline;
        }

        #comments .media-detail li:last-child {
            padding-right:0;
        }

        #comments .media-detail li i {
            color:#666666;
            font-size:15px;
            margin-right:10px;
        }
    </style>
<div class="kt-container mr-auto ml-auto shadow-primary" style="background: #edf0f6;padding: 20px;border-radius: 20px 20px 0px 0px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19),inset 0 -7px 9px -7px rgba(0,0,0,0.4); ">

<div class="row justify-content-between" >
    <div class="col-6">
        <h3>
            {{$food->name}}
        </h3>
        <p class="text-black-50 mt-51 w-75" >
            {{$food->description}}
        </p>
        <div class="col-12 mt-5">
            <div class="d-flex">

                <span class="text-black-50 col-lg-8 col-md-8 col-sm-8 col-6">
                    قیمت

                </span>
                <span  class="col-2 pull-left" style="font-size: 20px">
                {{$converter->english_to_persian(number_format($food->price))}}
                </span>


            </div>

            <div class="line col-10" ></div>
            <div class="d-flex mt-3">
                <span class="text-black-50 col-lg-8 col-md-8 col-sm-8 col-6">
                    امتیاز

                </span>
                <span class="col-3 pull-right mr-3" id="rate">

                    {{is_null($rate)?" ثبت نشده":$rate}}
                </span>
            </div>
            <div class="line col-10" ></div>

        </div>
            <div class="col-10 mt-5" >

                @if(auth()->check())
            @if(is_null($is_rate))
            <label for="glsr-ltr" style="pointer-events: none;">امتیاز</label>

            <div class="form-field" id="gl-star-rating--stars">

                    <span class="gl-star-rating">
                        <select id="" class="star-rating-prebuilt" >
                            <option value="">Select a rating</option>
                            <option value="5" id="5" >عالی</option>
                            <option value="4" id="4">خوب</option>
                            <option value="3" id="3">متوسط</option>
                            <option value="2" id="2">بد</option>
                            <option value="1" id="1">خیلی بد</option>
                        </select>
                        <span class="gl-star-rating--stars">
                            <span data-value="2" class=""><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="gl-emote" style="pointer-events: none;"><circle class="gl-emote-bg" fill="#FFA98D" cx="12" cy="12" r="10"></circle><path fill="#393939" d="M12 14.6c1.48 0 2.9.38 4.15 1.1a.8.8 0 01-.79 1.39 6.76 6.76 0 00-6.72 0 .8.8 0 11-.8-1.4A8.36 8.36 0 0112 14.6zm4.6-6.25a1.62 1.62 0 01.58 1.51 1.6 1.6 0 11-2.92-1.13c.2-.04.25-.05.45-.08.21-.04.76-.11 1.12-.18.37-.07.46-.08.77-.12zm-9.2 0c.31.04.4.05.77.12.36.07.9.14 1.12.18.2.03.24.04.45.08a1.6 1.6 0 11-2.34-.38z"></path></svg></span>
                            <span data-value="4" class=""><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="gl-emote" style="pointer-events: none;"><circle class="gl-emote-bg" fill="#FFC385" cx="12" cy="12" r="10"></circle><path fill="#393939" d="M12 14.8c1.48 0 3.08.28 3.97.75a.8.8 0 11-.74 1.41A8.28 8.28 0 0012 16.4a9.7 9.7 0 00-3.33.61.8.8 0 11-.54-1.5c1.35-.48 2.56-.71 3.87-.71zM15.7 8c.25.31.28.34.51.64.24.3.25.3.43.52.18.23.27.33.56.7A1.6 1.6 0 1115.7 8zM8.32 8a1.6 1.6 0 011.21 2.73 1.6 1.6 0 01-2.7-.87c.28-.37.37-.47.55-.7.18-.22.2-.23.43-.52.23-.3.26-.33.51-.64z"></path></svg></span>
                            <span data-value="6" class=""><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="gl-emote" style="pointer-events: none;"><circle class="gl-emote-bg" fill="#FFD885" cx="12" cy="12" r="10"></circle><path fill="#393939" d="M15.33 15.2a.8.8 0 01.7.66.85.85 0 01-.68.94h-6.2c-.24 0-.67-.26-.76-.7-.1-.38.17-.81.6-.9zm.35-7.2a1.6 1.6 0 011.5 1.86A1.6 1.6 0 1115.68 8zM8.32 8a1.6 1.6 0 011.21 2.73A1.6 1.6 0 118.33 8z"></path></svg></span>
                            <span data-value="8" class=""><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="gl-emote" style="pointer-events: none;"><circle class="gl-emote-bg" fill="#FFD885" cx="12" cy="12" r="10"></circle><path fill="#393939" d="M15.45 15.06a.8.8 0 11.8 1.38 8.36 8.36 0 01-8.5 0 .8.8 0 11.8-1.38 6.76 6.76 0 006.9 0zM15.68 8a1.6 1.6 0 011.5 1.86A1.6 1.6 0 1115.68 8zM8.32 8a1.6 1.6 0 011.21 2.73A1.6 1.6 0 118.33 8z"></path></svg></span>
                            <span data-value="10" class=""><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="gl-emote" style="pointer-events: none;"><circle class="gl-emote-bg" fill="#FFD885" cx="12" cy="12" r="10"></circle><path fill="#393939" d="M16.8 14.4c.32 0 .59.2.72.45.12.25.11.56-.08.82a6.78 6.78 0 01-10.88 0 .78.78 0 01-.05-.87c.14-.23.37-.4.7-.4zM15.67 8a1.6 1.6 0 011.5 1.86A1.6 1.6 0 1115.68 8zM8.32 8a1.6 1.6 0 011.21 2.73A1.6 1.6 0 118.33 8z"></path></svg></span>
                        </span>
                    </span>
            </div>
            @else
            <label for="glsr-ltr" style="pointer-events: none;">امتیاز</label>

                <div class="form-field" id="gl-star-rating--stars">

                    <span class="gl-star-rating">
                        <select id="" class="star-rating-prebuilt" disabled>
                            <option value="">Select a rating</option>
                            <option value="5" id="5" {{$is_rate==5?"selected":""}}>عالی</option>
                            <option value="4" id="4" {{$is_rate==4?"selected":""}}>خوب</option>
                            <option value="3" id="3" {{$is_rate==3?"selected":""}}>متوسط</option>
                            <option value="2" id="2" {{$is_rate==2?"selected":""}}>بد</option>
                            <option value="1" id="1" {{$is_rate==1?"selected":""}}>خیلی بد</option>
                        </select>
                        <span class="gl-star-rating--stars">
                            <span data-value="2" class="{{$is_rate==2?"gl-active gl-selected":''}}"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="gl-emote" style="pointer-events: none;"><circle class="gl-emote-bg" fill="#FFA98D" cx="12" cy="12" r="10"></circle><path fill="#393939" d="M12 14.6c1.48 0 2.9.38 4.15 1.1a.8.8 0 01-.79 1.39 6.76 6.76 0 00-6.72 0 .8.8 0 11-.8-1.4A8.36 8.36 0 0112 14.6zm4.6-6.25a1.62 1.62 0 01.58 1.51 1.6 1.6 0 11-2.92-1.13c.2-.04.25-.05.45-.08.21-.04.76-.11 1.12-.18.37-.07.46-.08.77-.12zm-9.2 0c.31.04.4.05.77.12.36.07.9.14 1.12.18.2.03.24.04.45.08a1.6 1.6 0 11-2.34-.38z"></path></svg></span>
                            <span data-value="4" class="{{$is_rate==4?"gl-active gl-selected":''}}"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="gl-emote" style="pointer-events: none;"><circle class="gl-emote-bg" fill="#FFC385" cx="12" cy="12" r="10"></circle><path fill="#393939" d="M12 14.8c1.48 0 3.08.28 3.97.75a.8.8 0 11-.74 1.41A8.28 8.28 0 0012 16.4a9.7 9.7 0 00-3.33.61.8.8 0 11-.54-1.5c1.35-.48 2.56-.71 3.87-.71zM15.7 8c.25.31.28.34.51.64.24.3.25.3.43.52.18.23.27.33.56.7A1.6 1.6 0 1115.7 8zM8.32 8a1.6 1.6 0 011.21 2.73 1.6 1.6 0 01-2.7-.87c.28-.37.37-.47.55-.7.18-.22.2-.23.43-.52.23-.3.26-.33.51-.64z"></path></svg></span>
                            <span data-value="6" class="{{$is_rate==6?"gl-active gl-selected":''}}"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="gl-emote" style="pointer-events: none;"><circle class="gl-emote-bg" fill="#FFD885" cx="12" cy="12" r="10"></circle><path fill="#393939" d="M15.33 15.2a.8.8 0 01.7.66.85.85 0 01-.68.94h-6.2c-.24 0-.67-.26-.76-.7-.1-.38.17-.81.6-.9zm.35-7.2a1.6 1.6 0 011.5 1.86A1.6 1.6 0 1115.68 8zM8.32 8a1.6 1.6 0 011.21 2.73A1.6 1.6 0 118.33 8z"></path></svg></span>
                            <span data-value="8" class="{{$is_rate==8?"gl-active gl-selected":''}}"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="gl-emote" style="pointer-events: none;"><circle class="gl-emote-bg" fill="#FFD885" cx="12" cy="12" r="10"></circle><path fill="#393939" d="M15.45 15.06a.8.8 0 11.8 1.38 8.36 8.36 0 01-8.5 0 .8.8 0 11.8-1.38 6.76 6.76 0 006.9 0zM15.68 8a1.6 1.6 0 011.5 1.86A1.6 1.6 0 1115.68 8zM8.32 8a1.6 1.6 0 011.21 2.73A1.6 1.6 0 118.33 8z"></path></svg></span>
                            <span data-value="10" class="{{$is_rate==10?"gl-active gl-selected":''}}"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="gl-emote" style="pointer-events: none;"><circle class="gl-emote-bg" fill="#FFD885" cx="12" cy="12" r="10"></circle><path fill="#393939" d="M16.8 14.4c.32 0 .59.2.72.45.12.25.11.56-.08.82a6.78 6.78 0 01-10.88 0 .78.78 0 01-.05-.87c.14-.23.37-.4.7-.4zM15.67 8a1.6 1.6 0 011.5 1.86A1.6 1.6 0 1115.68 8zM8.32 8a1.6 1.6 0 011.21 2.73A1.6 1.6 0 118.33 8z"></path></svg></span>
                        </span>
                    </span>
                </div>

        @endif
                @endif

        </div>

    </div>
    <div class="col-5 row justify-content-center " >
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="height: 50vh;background: #252525;border-radius: 20px;overflow: hidden">
            <ol class="carousel-indicators">
                @php
                    $i = 0;
                @endphp
                @foreach($images = json_decode($food->images) as $image)
                    <li data-target="#carouselExampleIndicators" data-slide-to="{{$i}}" class="active"></li>
                    @php
                        $i++
                    @endphp
                @endforeach

            </ol>
            <div class="carousel-inner">
                @foreach($images = json_decode($food->images) as $image)

                <div class="carousel-item {{$images[0] == $image?"active":""}}" style="margin-top: auto; height: 50vh;width: 100%;">
                    <img class="d-block w-100 " src="/upload/foods/{{$image}}" style="width: 100%;overflow: hidden;border-radius: 20px">
                </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

    </div>
</div>

</div>
    <section class="kt-container mr-auto ml-auto content-item row" style="border-radius: 0px 0px 20px 20px; ;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19),inset 0 7px 9px -7px rgba(0,0,0,0.4);background: #fcfcfd" id="comments">
            <div class="col-2">نظر دهید:</div>
            <div class="col-8  ml-auto row " >
                        <div class="comment-box text-center">
                            <form action="{{route("comment.create", $food->id)}}" id="algin-form" class="text-right row" method="post">
                                @csrf
                                <div class="form-group col-6">
                                    <label for="name">نام</label>
                                    <input type="text" name="name" id="fullname" class="form-control">
                                </div>
                                <div class="form-group col-6">
                                    <label for="email">ایمیل</label>
                                    <input type="text" name="email" id="email" class="form-control">
                                </div>
                                <div class="form-group col-12" >
                                    <label for="message">دیدگاه</label>
                                    <textarea name="msg" id=""msg cols="30" rows="5" class="form-control" style="background-color: #f6f6f6;"></textarea>
                                </div>


                                <div class="form-group col-12">
                                    <button type="submit" id="post" class="btn btn-default w-25">ارسال</button>
                                </div>
                            </form>
                        </div>
            </div >
        @if($food->comments->count() != 0)

        <div class="col-12 ">
                    <h3>{{$food->comments->count()}} نظر </h3>


                        @foreach($food->comments as $comment)
                        <div class="media col-10">
                            <a class="pull-left" href="#"></a>
                            <div class="media-body">
                                <h4 class="media-heading">{{$comment->user()->first()->name}}</h4>
                                <p>{{$comment->comment}}</p>
                                <ul class="list-unstyled list-inline media-detail pull-left">
                                    <li>{{$converter->gregorian_to_jalali($converter->normal_format(explode(' ', $comment->created_at)[0]))}}<i class="fa fa-calendar"></i></li>
                                    <li class="pull-left" onclick="like(this, `{{$comment->id}}`)"><span>{{$comment->likes}}</span><i class="fa fa-thumbs-up {{(auth()->check() and in_array(auth()->id(),$comment->likes()->get()->pluck('user_id')->toArray()))?'text-success':''}}" ></i></li>

                                </ul>
                                <ul class="list-unstyled list-inline media-detail pull-right d-flex">
                                    @if(auth()->check() and auth()->user()->isAdmin)
                                    <li class=""><a >پاسخ</a>
                                    </li>
                                    <li>
                                        <form id="delete" action="{{route("comment.destroy", [$food->id, $comment->id])}}" method="post" style="display: none">
                                            @csrf
                                            @method('delete')
                                        </form>

                                        <button type="submit" form="delete" class="btn text-danger pull-left mr-5"  style="margin-top: -8px;border: none;background:none;" >
                                        حذف
                                        </button>
                                    </li>



                                    @endif
                                </ul>
                            </div>
                        </div>
                        @endforeach

                </div>
        @else

            <div class="col-12 text-bold" style="text-align: center">
                <div class="w-75 border-top mr-auto ml-auto mb-3">

                </div>
                اولین نفری باشید که نظر میدهید
            </div>
        @endif

    </section>


@endsection
@section('script')
    @auth()
    <script>
        function apply(id) {
            $.ajax({
                method: 'POST',
                url: '/shop/like/'+id,
                dataType: 'json',
                data: {_token: `{{ csrf_token() }}`},
                success: function (response) {
                    // input.attr("count", (response['count']))
                },
                // complete: function () {
                //     sleep(1000).then(() => {
                //
                //     });
                //
                // }
            });
        }
    </script>
<script>
    function like(element, id) {
        var span = element.firstChild;
        var i = element.lastChild;
        if (! i.className.includes("text-success")) {
            i.className = "fa fa-thumbs-up text-success" ;
            span.innerHTML = parseInt(span.innerHTML) + 1;
        } else {
            i.className = "fa fa-thumbs-up";
            span.innerHTML = parseInt(span.innerHTML) - 1;

        }
        apply(id)
    }
</script>
    @endauth
<script>
    import ClassName
        from "../../public/plugins/datatables/extensions/Responsive/examples/initialisation/className.html";
    export default {
        components: {ClassName}
    }
</script>

    <script src="/js/star-rating.js/dist/star-rating.js?ver=4.2.3"></script>
    <script src="/js/star-rating.js/js/star-rating.js"></script>
    @if(is_null($is_rate))
        <script>
            $(document).ready(function (){
                $(".gl-star-rating--stars").one("click",function () {
                    var value = $(this).find("span[class='gl-active gl-selected']").data('value');
                    // document.getElementById("gl-star-rating--stars").innerHTML =  value + ' از 5';
                    $("#glsr-prebuilt").attr("disabled", true);
                    $("#" + value).attr("selected", true);
                    // document.getElementById('glsr-prebuilt').setAttribute('disabled', true);
                    $.ajax({
                        method: 'POST',
                        url: `{{route("rate", $food->id)}}`,
                        dataType: 'json',
                        data: {_token:`{{ csrf_token() }}`,value:value/2},
                        success: function (response) {
                            $(".star-rating-prebuilt").attr("value", (response['rating']));
                            // document.getElementById(value*2).className = "gl-active gl-selected";
                            document.getElementById('rate').innerHTML = response.rate;
                            location.reload();
                            // document.getElementById(value).className = "gl-active gl-selected";
                            // alert(value*2);
                        }
                    });


                })
            })
        </script>
    @endif
    <script>
        var stars = new StarRating('.star-rating');
    </script>
    <script>
        var destroyed = false;
        var starratingPrebuilt = new StarRating('.star-rating-prebuilt', {
            prebuilt: true,
            maxStars: 5,
        });
        var starrating = new StarRating('.star-rating', {
            stars: function (el, item, index) {
                el.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><rect class="gl-star-full" width="19" height="19" x="2.5" y="2.5"/><polygon fill="#FFF" points="12 5.375 13.646 10.417 19 10.417 14.665 13.556 16.313 18.625 11.995 15.476 7.688 18.583 9.333 13.542 5 10.417 10.354 10.417"/></svg>';
            },
        });
        var starratingOld = new StarRating('.star-rating-old');
        document.querySelector('.toggle-star-rating').addEventListener('click', function () {
            if (!destroyed) {
                starrating.destroy();
                starratingOld.destroy();
                starratingPrebuilt.destroy()
                destroyed = true;
            } else {
                starrating.rebuild();
                starratingOld.rebuild();
                starratingPrebuilt.rebuild()
                destroyed = false;
            }
        });
    </script>

@endsection
