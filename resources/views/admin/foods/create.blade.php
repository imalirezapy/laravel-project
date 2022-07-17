@extends("layouts.master")
@section("script")
 <link rel="stylesheet" href="/dist/cropper.css">

@endsection
@section('title', "بارگذاری غذا")
@section("content")


{{--    <script>--}}
{{--        function readURL(input) {--}}
{{--            if (input.files && input.files[0]) {--}}
{{--                var reader = new FileReader();--}}

{{--                reader.onload = function (e) {--}}
{{--                    $('#blah')--}}
{{--                        .attr('src', e.target.result)--}}
{{--                        .width(450)--}}
{{--                        .height(300);--}}
{{--                };--}}
{{--                <?php $_SESSION['image-uploaded'] = true?>--}}
{{--                reader.readAsDataURL(input.files[0]);--}}
{{--            }--}}
{{--        }--}}
{{--    </script>--}}

    <style>
        .upload-image{
            color: #0a53be;
        }
        .upload-image:hover{
            color: #00e3ff;
        }

        .divholder {
            border: none;
            font-size: 20px;
            color: gray;
            font-family: "Dubai Medium";
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            margin: auto;
        }
    </style>
{{--    <section class="py-5">--}}
{{--        <ul>--}}
{{--            @foreach($errors->all() as $error)--}}
{{--                <li class="alert alert-danger w-75 mr-auto ml-auto">{{$error}}</li>--}}
{{--            @endforeach--}}
{{--        </ul>--}}
{{--        <div class="container px-4 px-lg-5 mt-5">--}}
{{--            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">--}}

{{--                <div class="col mb-5">--}}

{{--                    <div class="card h-100">--}}
{{--                        <form action="{{route("foods.index")}}" class="form-group" id="upload-form" enctype="multipart/form-data" method="post">--}}
{{--                           @csrf--}}
{{--                            <!-- Product image-->--}}

{{--                            <!--                                <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />-->--}}

{{--                            <!-- Product details-->--}}
{{--                            <div class="card-body p-4">--}}
{{--                                <div class="text-center">--}}

{{--                                    <label class="upload-image">--}}
{{--                                        <h1 class="fw-border" style="font-size: 60px"> <span class="fa fa-file-image-o"></span></h1>--}}
{{--                                        <h4><span >بارگذاری عکس</span></h4>--}}
{{--                                            <input type="file"  class="custom-file-input" name="image" onchange="readURL(this);" >--}}
{{--                                        <img id="blah" src="#" alt="" />--}}

{{--                                    </label>--}}
{{--                                <!-- /image input -->--}}

{{--                                    <!-- number input-->--}}
{{--                                    <div style="width: 90%" >--}}
{{--                                        <label >--}}
{{--                                            <input class="form-control" type="text" placeholder="نام" id="numberExample" class="form-control" name="name">--}}
{{--                                        </label>--}}
{{--                                    </div>--}}
{{--                                    <!-- Material input -->--}}
{{--                                    <div style="width: 90%">--}}
{{--                                        <label >--}}
{{--                                            <input class="form-control" type="number" placeholder="قیمت" id="numberExample" class="form-control" name="price">--}}
{{--                                        </label>--}}
{{--                                    </div>--}}
{{--                                    <div style="width: 90%">--}}
{{--                                        <label>--}}
{{--                                            <textarea  class="form-control" name="description" placeholder="توضیحات" form="upload-form" style="width: 120%; height: 100px"></textarea>--}}
{{--                                        </label>--}}
{{--                                    </div>--}}

{{--                                    <!-- /number input-->--}}

{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <!-- Product actions-->--}}
{{--                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent" style="padding: 0rem !important;">--}}

{{--                                <div class="text-center"><button class="btn btn-outline-dark mt-auto" type="submit">بارگذاری محصول</button></div>--}}

{{--                                <!--                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="login.php">Add to cart</a></div>-->--}}
{{--                            </div>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}


{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
    <div class="row">
        <div class="col-xl-9 col-lg-10 col-md-12 col-sm-12 mx-auto">
            <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
                <div class="row">
                    <div class="col-12">
                        <h2 class="tm-block-title d-inline-block">ایجاد محصول</h2>
                    </div>
                </div>
                <form action="{{route("foods.store")}}" class="form-group row tm-edit-product-row" id="upload-form" enctype="multipart/form-data" method="post">
                    @csrf


                <div class="col-xl-6 col-lg-6 col-md-12">

                        <div class="form-group mb-3">
                            <label for="name">نام محصول
                            </label>
                            <input id="name" name="name" type="text" class="form-control validate @error('name') is-invalid @enderror" form="upload-form">
                            @error('name')
                            <span class="text-danger">
                                {{$message}}
                            </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="description">توضیحات</label>
                            <textarea class="form-control validate @error('description') is-invalid @enderror" rows="3" form="upload-form" name="description"></textarea>
                            @error('description')
                            <span class="text-danger">
                                {{$message}}
                            </span>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="price">قیمت
                                </label>
                                <input  id="price" name="price" type="text" form="upload-form" class="form-control validate hasDatepicker @error('price') is-invalid @enderror" data-large-mode="true">
                                @error('price')
                                <span class="text-danger">
                                {{$message}}
                            </span>
                                @enderror
                            </div>
                        </div>


                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 mx-auto mb-4">
                    <div class="tm-product-img-dummy mx-auto">
                        <i class="fas fa-cloud-upload-alt tm-upload-icon" onclick="document.getElementById('gallery-photo-add').click();"></i>
                    </div>

{{--                    <input type="file" name="image[]" multiple id="gallery-photo-add" form="upload-form">--}}
                    <div class="@error('images') is-invalid @enderror">
                        <label for="gallery-photo-add" class="form-label">بارگذاری عکس</label>
                        <input  name="images[]" form="upload-form" multiple id="gallery-photo-add" type="file" hidden>
                        <div class="card " style="min-height: 100px" onclick="document.getElementById('gallery-photo-add').click();">
{{--                            <div class="divholder" id="divholder">بارگذاری عکس</div>--}}
                            <div class="gallery img-fluid d-flex" id="gallery"></div>
                        </div>
                        @error('images')
                        <span class="text-danger">
                                {{$message}}
                            </span>
                        @enderror
                    </div>

                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block text-uppercase" form="upload-form">ایجاد محصول</button>
                </div>
                </form>

            </div>

        </div>

    </div>
<style type="text/css">
    img {
        display: block;
        max-width: 100%;
    }
    .preview {
        overflow: hidden;
        width: 160px;
        height: 160px;
        margin: 10px;
        border: 1px solid red;
    }

</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <script>
        console.log('asdaadsa');
            var imagesPreview = function(input, placeToInsertImagePreview) {
                if (input.files) {
                    var filesAmount = input.files.length;
                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();
                        reader.onload = function(event) {
                            $($.parseHTML('<img class="img-size-64 m-3">')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                        }
                        reader.readAsDataURL(input.files[i]);
                    }
                }

            };

            $('#gallery-photo-add').on('change', function () {
                document.getElementById("gallery").innerHTML = "";
                // alert($("gallery").innerHTML);
                // if (! $('#img-size-64').length) {
                    // alert('exists')
                //     $(".divholder").hide();
                // } else {
                //     alert('not exists')
                //     $(".divholder").show();

                    // document.getElementById("divholder").innerHTML = "بارگذاری عکس";
                // }

                imagesPreview(this, 'div.gallery');


            });
    </script>

<script>
    import ClassName
        from "../../../../public/plugins/datatables/extensions/Responsive/examples/initialisation/className.html";
    export default {
        components: {ClassName}
    }
</script>
<script>
    import Line from "../../../../public/plugins/chart.js/docs/charts/line.html";
    export default {
        components: {Line}
    }
</script>
@endsection

