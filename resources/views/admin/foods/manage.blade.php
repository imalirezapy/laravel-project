@extends("layouts.master")

@section("title", "مدیریت محصولات")
@section("content")
    <script>
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
    </script>
    <div class="row">

        <div class="col-md-12">
            <div class="card">

                <div class="card-body">
                    <div class="row justify-content-end mb-3">
                        <div class="col-md-2">
                            <a class="btn btn-success" href="{{route("foods.create")}}">ایجاد محصول جدید</a>
                        </div>
                    </div>
                    <form action="{{route("foods.index")}}" method="get">
                        <div class="row mb-3">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>نام محصول</label>
                                    <input class="form-group" type="text" name="food-name" value="<?= isset($_GET['food-name'])? $_GET['food-name']: ''?>">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>حداقل قیمت</label>
                                    <input class="form-group" type="number" name="min-price" value="<?= isset($_GET['min-price'])? $_GET['min-price']: ''?>">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>حداکثر قیمت</label>
                                    <input class="form-group" type="number" name="max-price" value="<?= isset($_GET['max-price'])? $_GET['max-price']: ''?>">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>توضیحات</label>
                                    <input class="form-group" type="text" name="description" value="<?= isset($_GET['description'])? $_GET['description']: ''?>">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group mt-4">
                                    <button type="submit" class="btn btn-info">سرچ</button>
                                </div>

                            </div>
                            <div class="col-md-2">
                                <div class="form-group mt-4">
                                    <a href="#" type="submit" class="btn btn-danger">حذف فیلتر ها</a>
                                </div>

                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">نام</th>
                                <th scope="col">قیمت</th>
                                <th scope="col">توضیحات</th>
                                <th scope="col">آپشن</th>
                            </tr>
                            </thead>
                            <tbody>

                        @if(!empty($foods))
                            @php($i = 0)
                            @foreach($foods as $food)
                                @php($i++)
                            <tr>
                                <th scope="row">{{$i}}</th>
                                <td>{{$food['name']}}</td>
                                <td>{{number_format($food['price'])}}</td>
                                <td>{{ substr($food['description'], 0, 80) }}</td>
                                <td>
                                    <div>

                                        <a href="{{route("foods.edit", $food->id)}}" class="btn btn-success text-white btn-sm" type="submit"><i class="fa fa-pencil"></i> </a>

                                        <form class="form-check-inline" action="{{route("foods.destroy", $food->id)}}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger text-white btn-sm" type="submit"><i class="fa fa-trash"></i> </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @else

                            <tr class="text-center">
                                <th colspan="5" class="">غذایی برای نمایش پیدا نشد</th>

                            </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
