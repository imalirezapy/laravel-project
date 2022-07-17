<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\JalaliDate;
use App\Http\Controllers\Controller;
use App\Http\Requests\CouponRequest;
use App\Models\Coupon;
use App\Models\User;
use Couchbase\PathNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Morilog\Jalali\Jalalian;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.coupons.create", [
            "users"=>User::orderBy("id", "desc")->get()
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CouponRequest $request)
    {
        $validate_data = $request->validated();

        $converter = new JalaliDate();

        $start_at = $converter->sql_format($converter->jalali_to_gregorian($request->start_at));
        $expire_at = $converter->sql_format($converter->jalali_to_gregorian($request->expire_at));
        $access = $validate_data['access'];
        $count = (int) $validate_data['count'];
        $percent = (int) $validate_data['percent'];
        $code = $validate_data['code'];
        $user_id = null;
        if ($request->access == "private") {
            $user_ids = $request->validate([
                "user_ids" => "required|exists:users,id",
            ])['user_ids'];

            $messages = [];
            foreach ($user_ids as $user_id) {
                $user_exists = Coupon::where("user_id", $user_id)->where("code", $code)->first();
                $datas = [
                    "access" => $access,
                    "user_id" => $user_id,
                    "code" => $code,
                    "percent" => $percent,
                    "count" => $count,
                    "start_at" => $start_at,
                    "expire_at" => $expire_at,
                ];
                if (is_null($user_exists)){
                    Coupon::create($datas);
                    $messages["create"][] = " کد تخفیف ". $code. " برای کاربری با ایمیل "." <". User::where("id", $user_id)->first()->email.">". " ایجاد شد";
                    continue;
                }

                $user_exists->update($datas);
                $messages["update"][] = " کد تخفیف ". $code." برای کاربری با ایمیل "." <".User::where("id", $user_id)->first()->email.">"." به روزرسانی شد";

            }

        } elseif ($request->access == "public"){
            $datas = [
                "access" => $access,
                "code" => $code,
                "percent" => $percent,
                "count" => $count,
                "start_at" => $start_at,
                "expire_at" => $expire_at,
            ];
            Coupon::create($datas);
            $messages["create"][] = " کد تخفیف ". $code. " برای همه کاربران ایجاد شد";


        }
        session(['coupon-messages'=>$messages]);
        return back();
//        return back()->with('messages',$messages);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
