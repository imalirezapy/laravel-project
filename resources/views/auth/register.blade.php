@extends('layouts.master')

@section("title", "ثبت نام")
@section('bg-url', "bg-register.jpg")
@section('content')
    <section class="vh-100">
        <div class="container py-5 h-100 ">
            <div class="row d-flex align-items-center justify-content-center h-100">
                <div class="col-md-8 col-lg-7 col-xl-6">
                    <img src="/defaults/register.svg"
                         class="img-fluid" alt="Phone image">
                </div>
                <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                    <form method="POST" action="{{ route('register')}}">
                        @csrf
                        <!-- Email input -->
                        <div class="form-outline mb-4 mt-2">
                            <label for="name" class="form-labed">نام</label>


                                <input id="name" type="text" class="form-control form-control-lg login-input @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus >

                                @error('name')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                        </div>

                        <div class="form-outline mb-4 mt-2">
                            <label for="email" class="form-labe">ایمیل</label>


                                <input id="email" type="email" class="form-control form-control-lg login-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                        </div>
                        <div class="form-outline mb-4 mt-2">
                            <label for="password" class="form-labe">رمز عبور</label>


                                <input id="password" type="password" class="form-control form-control-lg login-input @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                        </div>

                        <div class="form-outline mb-4 mt-2">
                            <label for="password-confirm" class="form-labe">تایید رمز عبور</label>


                                <input id="password-confirm" type="password" class="form-control login-input" name="password_confirmation" required autocomplete="new-password">

                        </div>
                          <!--=================================== -->


                        <!-- Submit button -->

                            <!-- #ff1867 #6eff3e #1e9bff-->
                        <button type="submit" class="btn btn-lg btn-block mybutton" style="--clr:#1e9bff"> <span>ثبت نام</span><i></i></button>

{{--                        <div class="divider d-flex align-items-center my-4">--}}
{{--                            <p class="text-center fw-bold mx-3 mb-0 text-muted">OR</p>--}}
{{--                        </div>--}}

{{--                        <a class="btn btn-primary btn-lg btn-block" style="background-color: #3b5998" href="#!"--}}
{{--                           role="button">--}}
{{--                            <i class="fab fa-facebook-f me-2"></i>Continue with Facebook--}}
{{--                        </a>--}}
{{--                        <a class="btn btn-primary btn-lg btn-block" style="background-color: #55acee" href="#!"--}}
{{--                           role="button">--}}
{{--                            <i class="fab fa-twitter me-2"></i>Continue with Twitter</a>--}}

                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
