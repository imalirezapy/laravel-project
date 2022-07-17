
@extends("layouts.master")
@section('style')
    <link href="/froala-editor/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
{{--    <link rel="stylesheet/less" type="text/css" href="styles.less" />--}}
{{--    <script src="https://cdn.jsdelivr.net/npm/less@4" ></script>--}}
    <link rel="stylesheet"  href="/scss/input.scss">
@endsection
<style>
    .form {
        /*font-size: 16px;*/
        margin-top: 5px;
        margin-bottom: 10px;
        width: 50%;
        position: relative;
        height: 100px;
        overflow: hidden;
    }
    .form input {
        font-weight: bold;
        width: 100%;
        height: 130%;
        color: #595f6e;
        padding-top: 20px;
        border: none;
        outline: none;
        background: none;
    }
    .form label {
        position: absolute;
        bottom: 0px;
        left: 0%;
        width: 100%;
        height: 100%;
        /*background: blue;*/
        pointer-events: none;
        border-bottom: 1px solid #858585;
    }
    .form label::after {
        content: '';
        position: absolute;
        left: 0px;
        bottom: -1px;
        height: 100%;
        width: 100%;
        border-bottom: 3px solid #5fa8d3;
        transform: translateX(-100%);
        transition:all 0.3s ease;
    }
    .content-name {
        position: absolute;
        bottom: 5px;
        right: 0px;
        transition: all 0.3s ease;

    }
    .form input:focus + .label-name .content-name,
    .form input:valid + .label-name .content-name {
        transform: translateY(-150%);
        font-size: 14px;
        color: #5fa8d3;

    }
    .form input:focus + .label-name::after,
    .form input:valid + .label-name::after
    {
        transform: translateX(0%);
    }
</style>
@section("title", "پروفایل")
@section("content")

    <form action="{{route('email.store')}}" method="post" class="form-group">
        @csrf

        <div class="form">

            <input type="text" name="subject" autocomplete="off" required>
            <label for="subject" class="label-name text-right">
                <span class="content-name " >موضوع</span>
            </label>
        </div>
        <div class="form" >

            <input type="text" name="title" autocomplete="off" required>
            <label for="subject" class="label-name text-right">
                <span class="content-name " >عنوان</span>
            </label>
        </div>

        <textarea class="form-control" id="froala-editor" style="max-height: 100vh" name="body" ></textarea>
        <button type="submit" class="btn btn-success w-50 form-control mt-3">
                ارسال
        </button>
    </form>

    @endsection
@section('script')
    <script type="text/javascript" src="/froala-editor/js/froala_editor.pkgd.min.js" ></script>

    <script>
        new FroalaEditor('textarea#froala-editor')
    </script>
@endsection
