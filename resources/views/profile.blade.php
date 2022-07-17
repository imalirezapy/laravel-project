@extends("layouts.master")
@section("title", "پروفایل")
@section("content")

<div class="container">
    @error('require')
    <ul>
        <li class="bg-danger">
            <span>
                $message
            </span>
        </li>
    </ul>
    @enderror
    <div class=" rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <img class="rounded-circle mt-5" width="150px" src="/defaults/profile.png">
                <span class="font-weight-bold">{{$user['name']}}</span>
                <span class="text-black-50">{{$user['email']}}</span>
            </div>
        </div>
        <div class="col-md-5 border-right  mt-3">
            <div class="mr-3" >

                <a  data-toggle="collapse" href="#collapse" role="button" aria-expanded="false" aria-controls="collapseExample" class="fa fa-cog">
                    <label  style="font-family: 'Dubai Medium'">
                        تنظیمات
                    </label>
                </a>

                <div class="row collapse" id="collapse">
                <div class=" pull-right">
                    <label class="inline" style="cursor: pointer">
                        <span class="form-check-label  mr-1 " >اعلان های عمومی</span>
                        <label class="android-check pull-right">
                            <input class="" type="checkbox" value="notification" id="notification" {{$notification?'checked':''}}/>
                            <span><i></i></span>
                        </label>
                    </label>
                    <label class="inline" style="cursor: pointer">
                        <span class="form-check-label mr-1 " >اعلان کد تخفیف ها</span>
                        <label class="android-check pull-right">
                            <input class="" type="checkbox" value="coupon_notification" id="coupon_notification" {{$coupon_notification?'checked':''}}/>
                            <span><i></i></span>
                        </label>
                    </label>
                </div>
            </div>
            </div>
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">ویرایش اطلاعات</h4>
                </div>

                <form action="{{route("profile.update", $user['id'])}}" method="post">
                    @csrf
                    @method("put")
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label class="labels">نام</label><input type="text" class="form-control"  value="{{$user['name']}}" name="name">
                            @error("name")
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="labels">ایمیل</label><input type="text" class="form-control" value="{{$user['email']}}" name="email">
                            @error("email")
                            <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label class="labels">شماره موبایل</label><input type="text" class="form-control" placeholder="0900000000" value="{{$user['phone']}}" name="phone">
                            @error("phone")
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label class="labels">استان</label>
                            <select class="js-example-theme-single w-100 form-control" name="state" >
                                <option value="" >
                                    انتخاب استان
                                </option>
                                @foreach(\App\Models\State::orderBy("id", "desc")->get() as $state)
                                    <option value="{{$state->id}}">
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
                            <label class="labels">کدپستی</label><input type="text" class="form-control" placeholder="" value="{{$user['post']}}" name="post">
                            @error("post")
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label class="labels">ادرس</label><textarea type="text" class="form-control" placeholder="" value="{{$user['address']}}" name="address"></textarea>
                            @error("address")
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
    {{--                    <div class="col-md-12"><label class="labels">Area</label><input type="text" class="form-control" placeholder="enter address line 2" value=""></div>--}}
    {{--                    <div class="col-md-12"><label class="labels">Email ID</label><input type="text" class="form-control" placeholder="enter email id" value=""></div>--}}
    {{--                    <div class="col-md-12"><label class="labels">Education</label><input type="text" class="form-control" placeholder="education" value=""></div>--}}
                    </div>
    {{--                <div class="row mt-3">--}}
    {{--                    <div class="col-md-6"><label class="labels">Country</label><input type="text" class="form-control" placeholder="country" value=""></div>--}}
    {{--                    <div class="col-md-6"><label class="labels">State/Region</label><input type="text" class="form-control" value="" placeholder="state"></div>--}}
    {{--                </div>--}}
                    <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit">ذخیره</button></div>
                </form>
            </div>
        </div>
{{--        <div class="col-md-4">--}}
{{--            <div class="p-3 py-5">--}}
{{--                <div class="d-flex justify-content-between align-items-center experience"><span>Edit Experience</span><span class="border px-3 p-1 add-experience"><i class="fa fa-plus"></i>&nbsp;Experience</span></div><br>--}}
{{--                <div class="col-md-12"><label class="labels">Experience in Designing</label><input type="text" class="form-control" placeholder="experience" value=""></div> <br>--}}
{{--                <div class="col-md-12"><label class="labels">Additional Details</label><input type="text" class="form-control" placeholder="additional details" value=""></div>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
</div>
</div>
@endsection
@section('script')

    <script>
        function apply(checked, route) {


            $.ajax({
                method: 'POST',
                url: '/profile/'+route+'/'+`{{auth()->user()->id}}`,
                dataType: 'json',
                data: {_token: `{{ csrf_token() }}`, _method:`put`, value: checked},
                success: function (response) {
                    console.log(response);
                    // input.attr("checked", (response['checked']));
                },
                // complete: function () {
                //     sleep(1000).then(() => {
                //         var single_price_obj = document.getElementById('price' + id);
                //         var number1 = parseInt(input.value) * parseInt(price);
                //         single_price_obj.innerHTML = new Intl.NumberFormat('ja-JP', {maximumSignificantDigits: 3}).format(number1);
                //         var single_count = document.getElementById('single-count'+id);
                //         single_count.innerHTML = input.value;
                //         $('#count' + id).show();
                //         $('#load' + id).hide();
                //     }
                //     );
                //
                // }
            });
        }
        const notification = document.getElementById('notification')

        notification.addEventListener('change', (event) => {
            if (event.currentTarget.checked) {
                apply(1, 'notification')
            } else {
                apply(0, 'notification')
            }
        });
        const coupon_notification = document.getElementById('coupon_notification')

        coupon_notification.addEventListener('change', (event) => {
            if (event.currentTarget.checked) {
                apply(1, 'coupon_notification')

            } else {
                apply(0, 'coupon_notification')

            }
        });
        {{--$(document).ready(function (){--}}
        {{--    $("#notification").on("ick",function () {--}}


        {{--        var value = $(this).find("span[class='gl-active gl-selected']").data('value');--}}
        {{--        // document.getElementById("gl-star-rating--stars").innerHTML =  value + ' از 5';--}}
        {{--        $("#glsr-prebuilt").attr("disabled", true);--}}
        {{--        $("#" + value).attr("selected", true);--}}
        {{--        // document.getElementById('glsr-prebuilt').setAttribute('disabled', true);--}}
        {{--        $.ajax({--}}
        {{--            method: 'POST',--}}
        {{--            url: `{{route("rate", $food->id)}}`,--}}
        {{--            dataType: 'json',--}}
        {{--            data: {_token:`{{ csrf_token() }}`,value:value/2},--}}
        {{--            success: function (response) {--}}
        {{--                $(".star-rating-prebuilt").attr("value", (response['rating']));--}}
        {{--                // document.getElementById(value*2).className = "gl-active gl-selected";--}}
        {{--                document.getElementById('rate').innerHTML = response.rate;--}}
        {{--                location.reload();--}}

        {{--                // document.getElementById(value).className = "gl-active gl-selected";--}}
        {{--                // alert(value*2);--}}
        {{--            }--}}
        {{--        });--}}


        {{--    })--}}
        {{--})--}}
    </script>
<script>
    $(".js-example-theme-single").select2({
        theme: "classic"
    });
    import Options from "../../public/plugins/chart.js/docs/general/options.html";
    export default {
        components: {Options}
    }
</script>
@endsection
