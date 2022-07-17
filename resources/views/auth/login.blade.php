@extends('layouts.master')

@section("title", "ورود")
@section('bg-url', "bg-login.jpg")
@section('content')

    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center h-100">
                <div class="col-md-8 col-lg-7 col-xl-6">
                    <img src="/defaults/login.png"
                         class="img-fluid" alt="Phone image">
                </div>
                <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                    <form method="POST" action="{{ route('login')}}">
                    @csrf
                    <!-- Email input -->
                        <div class="form-outline mb-4 mt-2">
                            <label for="email" class="form-labe text-white">ایمیل</label>


                            <input id="email" type="email" class="form-control form-control-lg login-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" required>

                            @error('email')
                            <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

                        </div>
                        <div class="form-outline mb-4 mt-2">
                            <label for="password" class="form-labe text-white">رمز عبور</label>


                            <input id="password" type="password" class="form-control form-control-lg login-input @error('password') is-invalid @enderror" name="password"  autocomplete="new-password" required>

                            @error('password')
                            <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                            <script>
                                // const inputs = document.querySelectorAll('input');
                                //
                                // for (const input of inputs) {
                                //     // const validityState = input.validity;
                                //     input.setAttribute('required', '');
                                //     input.setCustomValidity('فیلد اجباری');

                                    // if (validityState.valueMissing) {
                                    //     input.setCustomValidity('You gotta fill this out, yo!')
                                    // } else {
                                    //     input.setCustomValidity('این فیلد را نمی توانید خالی رها کنید');
                                    // }
                                // }
                            </script>
                        </div>

                        <div class="d-flex  mb-1 ">

                            <label class="inline" style="cursor: pointer">
                                <label class="android-check">
                                    <input class="" type="checkbox" value="" id="form1Example3" {{ old('remember') ? 'checked' : '' }} />
                                    <span><i></i></span>
                                </label>
                                <em class="form-check-label text-white-50 pull-left mr-1 " > من را بخاطر بسپار</em>
                            </label>
                            @if (Route::has('password.request'))
                                <a class="mr-auto" href="{{ route('password.request') }}" >فراموشی رمز عبور؟</a>

                            @endif
                        </div>




                        <!-- Submit button -->
                        <!-- #ff1867 #6eff3e #1e9bff-->
                        <button type="submit" class="btn btn-lg btn-block mybutton mt-4" style="--clr:#ff00ff"> <span>ورود</span><i></i></button>


{{--                                                <div class="divider d-flex align-items-center my-4">--}}
{{--                                                    <p class="text-center fw-bold mx-3 mb-0 mr-auto text-muted">یا</p>--}}
{{--                                                    <hr>--}}
{{--                                                </div>--}}

                        <a class="btn btn-danger btn-lg btn-block mt-5"  href="{{route('google.auth')}}"
                           role="button">
                            ورود با اکانت گوگل
                            <i class="fa fa-google-plus me-2"></i>

                        </a>
{{--                                                <a class="btn btn-primary btn-lg btn-block" style="background-color: #55acee" href="#!"--}}
{{--                                                   role="button">--}}
{{--                                                    <i class="fab fa-twitter me-2"></i>Continue with Twitter</a>--}}

                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
<script>
    import Styling from "../../../public/plugins/chart.js/docs/axes/styling.html";
    import Swf_path from "../../../public/plugins/datatables/extensions/TableTools/examples/swf_path.html";
    export default {
        components: {Swf_path, Styling}
    }
</script>
