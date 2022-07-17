@extends("layouts.master")
@section("title", "سبد خرید")
@section("content")

<div class="wrapper">

{{--    <div class="discount-box index content-wrapper pull-right" >--}}
{{--        <h4 class="form-group classic-title mt-0">ساخت کد تخفیف</h4>--}}


        <!-- Main content -->
        <section class=" discount-box index mr-auto ml-auto " style="width: 80%;min-height: 85vh">
            <ul >
{{--                @php--}}
{{--                var_dump(session()->all())--}}
{{--                @endphp--}}
                @if(session()->exists("coupon-messages"))
                    @foreach(session()->get("coupon-messages") as $key=>$message)
                        @if($key == "create")
                            @foreach($message as $i)
                                <li class="text-success w-75 mr-auto ml-auto">{{$i}}</li>
                            @endforeach
                        @else
                            @foreach($message as $i)
                                <li class="text-primary  w-75 mr-auto ml-auto">{{$i}}</li>
                            @endforeach
                        @endif

                    @endforeach
                    @php
                        session()->forget('coupon-messages')
                    @endphp
                @endif
            </ul>
            <h4 class="form-group classic-title mt-0">ایجاد کد تخفیف</h4>

            <div class="container-fluid ">




                <div class="container">
                    <form action="{{route("coupons.store")}}" method="post">
                        @csrf
                        <div class="row">

                            <div class="form-group col-md-6 inputBox">

                                <label class="classic-icon" style="width: 100px; border-radius: 10px">دسترسی
                                </label>


                                <select name="access" class="form-control"  id="accessSelectBox" onchange="yesnoCheck(this);">
                                    <option value="public">عمومی</option>
                                    <option value="private" {{key_exists("user_ids", $errors->toArray())?"selected":""}}>شخصی</option>
                                </select>

                                @error('access')
                                <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="form-group col-md-6 inputBox" style="display: {{key_exists("user_ids", $errors->toArray())?"block":"none"}}" id="user_id">
                                <div class="row">
                                    <label class="classic-icon" style="width: 100px; border-radius: 10px">کاربران</label>
                                    <span class="text-danger mr-1">*</span>
                                </div>
                                <select name="user_ids[]" class="form-control" id="accessSelectBox" multiple>
                                    @php
                                      $i = 0
                                    @endphp

                                    @foreach($users as $user)
                                        @php
                                            $i++
                                        @endphp
                                        <option value="{{$user->id}}">
                                            {{$user->name}},{{$user->email}}
                                        </option>
                                    @endforeach


                                </select>

                                @error('user_ids')

                                <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>

                        <div class="row">
                            <div class="form-group col-md-6 inputBox">
                            <div class="row">
                                <label class="classic-icon" style="width: 100px; border-radius: 10px;font-size:15px">درصد تخفیف</label>
                                <span class="text-danger mr-1">*</span>
                            </div>
                                <div class="classic-box">

                                <input class="form-control" type="number" min="1" step="0.1" name="percent" placeholder="%">
                                </div>
                                @error('percent')
                                <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 inputBox" >
                            <div class="row">
                                <label class="classic-icon" style="width: 100px; border-radius: 10px;font-size:12px">تعداد مجاز استفاده</label>
                                <span class="text-danger mr-1">*</span>
                            </div>
                                <div class="classic-box">

                                <input class="form-control" type="number" min="1"  name="count">
                                </div>
                                @error('count')
                                <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6 inputBox">
                            <div class="row">
                                <label class="classic-icon" style="width: 100px; border-radius: 10px">تاریخ شروع</label>
                                <span class="text-danger mr-1">*</span>
                            </div>
                                <div class="classic-box">
                                    @php
                                        $date = \Morilog\Jalali\Jalalian::now();
                                        $date = explode(" ",str_replace("-", "/", $date))[0];
                                    @endphp
                                <input type="text" class="jalaliDatePicker form-control" placeholder="تاریخ شروع"
                                       title="تاریخ شروع" name="start_at"
                                       value="{{(new \App\Helpers\JalaliDate)->english_to_persian($date)}}"
                                >
                                    @error('start_at')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="form-group col-md-6 inputBox">
                            <div class="row">
                                <label class="classic-icon" style="width: 100px; border-radius: 10px">تاریخ انقضا</label>
                                <small class="text-white-50 mt-auto mb-auto">(اختیاری)</small>
                            </div>
                                <div class="classic-box">


                                <input type="text" class="jalaliDatePicker form-control" placeholder="تاریخ انقضا"
                                       title="تاریخ انقضا" name="expire_at"
                                >
                                </div>
                                @error('expire_at')
                                <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 inputBox">
                                <label class="classic-icon" style="width: 100px; border-radius: 10px" >کد</label>
                                <div class="classic-box">
                                    @php
                                        $chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                                        $res = "";
                                        $res2 = "";
                                        for ($i = 0; $i < 4; $i++) {
                                            $res .= $chars[mt_rand(0, strlen($chars)-1)];
                                            $res2 .= $chars[mt_rand(0, strlen($chars)-1)];
                                        }
                                        $code = $res."-".$res2;
                                    @endphp
                                    <input class="form-control" type="text" name="code" value="{{$code}}">
                                    @error('code')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                        </div>


                        <hr class="my-3">
                        <div class="row">
                            <div class="col-md-12">
                            <button class="btn btn-primary btn-apply btn-classic  pull-left" style="width: 80%" type="submit">ایجاد شد</button>
                            </div>
                        </div>

                    </form>
                </div>



            </div>
        </section>
        <!-- /.content -->
{{--    </div>--}}
</div>

    <!-- ./wrapper -->

    <!-- jQuery -->
@section("script")
    <script src="/js/persian-date.min.js"></script>
    <script src="/js/persian-datepicker.min.js"></script>


    <script src="/js/jquery.number.min.js"></script>

    <script type="text/javascript">

        $("#accessSelectBox").on('change',function () {
            if($(this).val()=='public'){
                $("#userIdInput").prop('disabled',true);
            }
            else {
                $("#userIdInput").prop('disabled',false);
            }
        });


        $("#confirmDetailsForm .increaseButton").click(function () {
            var val = parseInt(fixNumbers($(this).siblings("span").text()));
            $(this).siblings("span").text(val+1);
            $(this).siblings(".productCount").val(val+1);
        });

        $("#confirmDetailsForm .decreaseButton").click(function () {
            var val = parseInt(fixNumbers($(this).siblings("span").text()));
            if (val > 1){
                $(this).siblings("span").text(val-1);
                $(this).siblings(".productCount").val(val-1);

            }else if(val <= 1){
                $(this).closest("tr").remove();
            }
        });

        $(".submitbtn").click(function (){
            this.disabled=true;
            this.innerHTML='<small>...</small>';
            this.form.submit();
        });



        $(document).ready(function () {

            $(".jalaliDatePicker").pDatepicker({
                initialValue: false,
                autoClose: true,

                format: 'YYYY/MM/DD',
            });

            $(".numberInput").keyup(function () {
                var number = $(this).val();
                $(this).val($.number(number));
            });

            $(".numberInput").keydown(function (evt) {
                // var charCode = (e.which) ? e.which : event.keyCode;
                // if (String.fromCharCode(charCode).match(/[^0-9]/g))
                //     return false;
                var charCode = (evt.which) ? evt.which : event.keyCode
                if (charCode > 31 && (charCode < 48 || charCode > 57))
                    return false;
                return true;
            });

        });

        var
            persianNumbers = [/۰/g, /۱/g, /۲/g, /۳/g, /۴/g, /۵/g, /۶/g, /۷/g, /۸/g, /۹/g],

        fixNumbers = function (str)
        {
            if(typeof str === 'string')
            {
                for(var i=0; i<10; i++)
                {
                    str = str.replace(persianNumbers[i], i);
                }
            }
            return str;
        };
        function yesnoCheck(that) {
            if (that.value == "private") {
            document.getElementById("user_id").style.display = "block";
        } else {
            document.getElementById("user_id").style.display = "none";
        }
        }


    </script>

@endsection
@endsection
