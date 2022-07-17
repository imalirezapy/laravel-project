@php
    use Illuminate\Support\Str;
@endphp
@extends("layouts.master")
@section("title", "خانه")
@section("content")
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fa fa-gear"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">ترافیک Cpu</span>
                    <span class="info-box-number">
                  10
                  <small>%</small>
                </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-google-plus"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">لایک‌ها</span>
                    <span class="info-box-number">41,410</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix hidden-md-up"></div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fa fa-shopping-cart"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">فروش</span>
                    <span class="info-box-number">760</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-users"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">اعضای جدید</span>
                    <span class="info-box-number">2,000</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>

    <div class="row">
        <div class="col-md-6">

            <!-- PRODUCT LIST -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">محصولات تازه اضافه شده</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-widget="remove">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <ul class="products-list product-list-in-card pl-2 pr-2">

                        @foreach($foods as $food)

                            <li class="item">
                                <a href="{{route('food.show', $food['id'])}}">

                                <div class="product-img">
                                    <img src="/upload/foods/{{json_decode($food['images'])[0]}}" alt="Product Image" class="img-size-50">
                                </div>
                                <div class="product-info">
                                    <div  class="product-title">{{$food['name']}}
                                        <span class="badge badge-info float-left">{{number_format($food['price'])}}</span>
                                    </div>
                                    <span class="product-description">
{{--                                        {{Str::random(6)}}--}}
                                         {{Str::words($food['description'],5)}}
                                    </span>
                                </div>
                                </a>
                            </li>


                        @endforeach

                    </ul>
                </div>

                <div class="card-footer text-center">
                    <a href="{{auth()->check() && auth()->user()->isAdmin?route("foods.index"):route("shop")}}" class="uppercase">نمایش همه محصولات</a>
                </div>

            </div>

        </div>

    </div>

@endsection
