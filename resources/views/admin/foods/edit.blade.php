@extends("layouts.master")

@section("title", "ویرایش")

@section("content")
    <section class="py-5">
    <ul>
        @foreach($errors->all() as $error)
            <li class="alert alert-danger w-75 mr-auto ml-auto">{{$error}}</li>
        @endforeach
    </ul>

        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
<!--                --><?php //if ($important->isAdmin()){ ?>

                <div class="col mb-5">

                    <div class="card h-100">
                        <form action="/admin/foods/{{$food->id}}" class="form-group" id="upload-form" enctype="multipart/form-data" method="post">
                        @csrf
                        @method("put")

                            <!-- Product image-->

                            <!--                                <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />-->

                            <!-- Product details-->
<
                            <input type="hidden" name="id" value="id">
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- image input -->

                                    <label class="upload-image">
                                        <h1 class="fw-border" style="font-size: 60px"> <span class="fa fa-file-image-o"></span></h1>
                                        <h4><span >بارگذاری عکس</span></h4>
                                        <input type="file"  class="custom-file-input" name="image[{{$food->image}}]" onchange="readURL(this);" value="{{$food->image}}">



                                    </label>
                                    <!-- /image input -->
                                    <!-- number input-->
                                    <div style="width: 90%">
                                        <label >
                                            <input type="text" placeholder="نام" id="numberExample" class="form-control" name="name" value="{{$food->name}}">
                                        </label>
                                    </div>
                                    <!-- Material input -->
                                    <div style="width: 90%">
                                        <label >
                                            <input type="number" placeholder="قیمت" id="numberExample" class="form-control" name="price" value="{{$food->price}}">
                                        </label>
                                    </div>
                                    <div style="width: 90%">
                                        <label>
                                            <textarea name="description" placeholder="توضیحات" form="upload-form" style="width: 120%; height: 100px" >{{$food->description}}</textarea>
                                        </label>
                                    </div>

                                    <!-- /number input-->

                                </div>
                            </div>


                        <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent" style="padding: 0rem !important;">

                                <div class="text-center"><button class="btn btn-outline-dark mt-auto" type="submit">بارگذاری محصول</button></div>

                                <!--                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="login.php">Add to cart</a></div>-->
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
