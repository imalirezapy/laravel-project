@extends("layouts.master")
@section("title", "کاربران")


@section("content")
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h3 class="text-white text-capitalize ps-3 mr-2">کاربرها</h3>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-2xl font-weight-bolder opacity-7">کاربر</th>
                                    <th class="text-right text-uppercase text-secondary text-2xl font-weight-bolder opacity-7 ps-2">سطح</th>
                                    <th class="text-center text-uppercase text-secondary text-2xl font-weight-bolder opacity-7">وضعیت</th>
                                    <th class="text-center text-uppercase text-secondary text-2xl font-weight-bolder opacity-7">عضویت</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="/defaults/profile.png" class="avatar avatar-sm me-3 border-radius-lg " alt="user1">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center mr-3">
                                                    <h6 class="mb-0 text-sm">{{$user->name}}</h6>
                                                    <p class="text-xs text-secondary mb-0">{{$user->email}}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-md-center font-weight-bold mb-0">{{$user->isAdmin?"ادمین":"کاربر"}}</p>
{{--                                            <p class="text-xs text-secondary mb-0">Organization</p>--}}
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            @php($i = $user->isAdmin?0:random_int(0, 1))
                                            <span class="badge badge-sm {{["bg-gradient-success", "bg-gradient-secondary"][$i]}}">{{["Online", "Offline"][$i]}}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <?php
                                                $converter  = new \App\Helpers\JalaliDate();
                                                $date = str_replace("-", "/", explode(" ", $user->created_at)[0]);
                                                $date = $converter->english_to_persian($converter->gregorian_to_jalali($date));
                                            ?>
                                            <span class="text-secondary font-size-4 font-weight-bold "><?=$date?></span>
                                        </td>
                                        <td class="align-middle">
{{--                                            <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">--}}
{{--                                                Edit--}}
{{--                                            </a>--}}
                                            <a href="" class="btn btn-success text-white" style="margin-top:12px" type="submit"><i class="fa fa-pencil"></i> </a>

                                            <form class="form-check-inline" action="{{route("users.destroy", $user->id)}}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-danger text-white" type="submit"><i class="fa fa-trash"></i> </button>
                                            </form>
                                        </td>
                                    </tr>


                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<link id="pagestyle" href="/css/material-dashboard.css?v=3.0.2" rel="stylesheet" />

@section("script")
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/material-dashboard.min.js?v=3.0.2"></script>
@endsection
