<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\CouponDetails;
use App\Models\Factor;
use App\Models\Food;
use App\Models\Profile;
use App\Models\ProfileDetails;
use App\Models\State;
use App\Models\User;
use Dflydev\DotAccessData\Data;
use http\Exception\BadConversionException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use MongoDB\Driver\Session;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->check()) {
            $foods = User::find(auth()->user()->id)->foods;

            return view("cart", [
                'foods_cart' => $foods->isEmpty() ? [] : $foods
            ]);
        }

        $foods = Cart::where("user_ip", $_SERVER['REMOTE_ADDR'])->get()->toArray();
        $foods = array_map(fn($i) => Food::find($i['food_id']), $foods);

        return view("cart", [
            'foods_cart' => $foods,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        $cart->update([
           'count' => $request->value
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {

        $cart->delete();

        return response()->json(['status' => 100, 'msg' => "deleted"]);
    }

    public function coupon(Request $request)
    {
        $request->validate(["code" => "required"]);
        if (!auth()->check()) {
            return Redirect::back()->withErrors(['code' => "ابتدا وارد شوید"]);
        }

        $coupon = Coupon::all()->where("code", $request->code)->where("user_id", auth()->user()->id)->first();
        if (is_null($coupon)) {
            return Redirect::back()->withErrors(["code" => "کد نامعتبر است"]);
        }

        session(["coupon-percent" => [$coupon->percent, $coupon->code]]);
        return back();
    }


    public function delete_coupon(Request $request)
    {


        \session()->forget("coupon-percent");

//        dd(\session()->get("coupon-percent"));
        return back();

    }

    public function profile_details()
    {
        $user = User::find(auth()->user()->id);
        $details = $user->profile_details->first();
        $factor = Factor::where("user_id", $user->id);
        if (is_null($details)){
            $profile = $user->profile()->first();
            $details = ProfileDetails::create([
                'user_id' => $profile->user_id,
                'state_id' => $profile->state,
                'post' => $profile->post,
                'address' => $profile->address,
            ]);
        }
        if (is_null($factor->first()) or is_null($factor->where("profile_details_id", $details->id)->first()) or ! $factor->where("profile_details_id", $details->id)->first()->coplete ) {

            $cart = fn($food) => (int)Cart::where("user_id", auth()->user()->id)->where("food_id", $food["id"])->first()->count * $food['price'];
            $total = array_map($cart, $user->foods->toArray());
            $total = (int) array_sum($total);


            Factor::create(
                [
                    "user_id" => $user->id,
                    "profile_details_id" => $details->id,
                    "total" => $total,
                    "delivery" => "tipax",
                    "gateway" => "online",
                    "final_total" => $total,
                ]);
        }


        return view("profile-details", [
                "user" => $user,
                "foods" => $user->foods,
                "profile" => $user->profile,
                "profile_details" => $user->profile_details
            ]
        );
    }

    public function create_profile_details(Request $request)
    {
        $validate_data = $request->validate([
            "name" => "required",
            "email" => [
                "required",
                Rule::notIn(User::whereNot("id", auth()->user()->id)->get()->pluck("email")),
            ],
            "phone" => "required",
            "state" => [
                "required",
                Rule::in(State::all()->pluck("id")),
            ],
            "post" => "required",
            "address" => "required",
            "delivery" => [
                "required",
                Rule::in(['tipax', 'normal-delivery', 'special-delivery'])
            ]
        ]);

        $user = User::find(auth()->user()->id);
        if (is_null($user->profile_details->first()) ) {
            foreach (array_slice($user->profile->toArray(), 0, -2) as $key => $value) {
                if (is_null($value)) {
                    $user->profile->update([
                        $key => $request[$key],
                    ]);
                }

            }
        }
        $datas = [
            "user_id" => auth()->user()->id,
            "state_id" => $request->state,
            "post" => $request->post,
            "address" => $request->address,
            "delivery" => $request->delivery
        ];

        if (is_null($user->profile_details->where("post", $request->post)->first())) {
            ProfileDetails::create($datas);
        } else {
            $user->profile_details->first()->update($datas);
        }



        $fa = [
            "tipax" => "ارسال با تیپاکس",
            "special-delivery" => "ارسال با پست پیشتاز",
            "normal-delivery" => "ارسال عادی"
        ];
        $factor = Factor::where("user_id", $user->id)->where("profile_details_id", $user->profile_details->first()->id)->where("complete", 0)->first();
        $factor->update([
            "delivery" => $request->delivery,
            ]);

        return view("payment", [
            "details" => $datas,
            "count" => count($user->foods->toArray()),
            "total" => $factor->total,
            "delivery" => $fa[$request->delivery],
            "foods" => $user->foods,
            "factor" => $factor,
        ]);
    }

    public function payment(Request $request)
    {

        $gateway = "online";
        $user = User::find(auth()->user()->id);
        $details = $user->profile_details->first();
        $factor = Factor::where("user_id", $user->id)->where("profile_details_id", $details->id)->where('complete', 0)->first();

        $fa = [
            "tipax" => "ارسال با تیپاکس",
            "special-delivery" => "ارسال با پست پیشتاز",
            "normal-delivery" => "ارسال عادی"
        ];



        if ($request->isMethod("POST")) {
            if ($gateway == "credit-card"){
                return Redirect::route("/");
            }
            return view("gateway", ["price"=>$factor->final_total, "gateway"=>$factor->gateway]);
        }
        return view("payment", [
            "factor" => $factor,
            "details" => $details,
            "count" => count($user->foods->toArray()),
            "delivery" => $fa[$details->delivery],
            'gateway' => $gateway
        ]);

    }

    public function coupon_use(Request $request)
    {

        $user = User::find(auth()->user()->id);
        $details = $user->profile_details->first();
        $factor = Factor::where("user_id", $user->id)->where("profile_details_id", $details->id)->where('complete', 0)->first();

        $cart = fn($food) => (int)Cart::where("user_id", auth()->user()->id)->where("food_id", $food["id"])->first()->count * $food['price'];
        $total = array_map($cart, $user->foods->toArray());

        $request->validate(["code" => "required"]);
        $gateway = $request->gateway;
        $coupon = $user->coupons->where("code", $request->code)->first();
        $coupon_details = count($user->coupon_details->where('code', $request->code));

        if (is_null($coupon) or $coupon_details >= $coupon->count) {
            return Redirect::route('coupon.index')->withErrors(["code" => "کد نامعتبر است"]);
        }


        CouponDetails::create([
            "user_id" => auth()->user()->id,
            "code" => $request->code
        ]);


        $code = $request->code;
        $percent=$coupon->percent;
//            ['profile_details_id', 'total', 'delivery', 'foods', 'coupon_id', 'gateway', 'complete']
        $total = ((int) array_sum($total)+15000) * ((100 - $percent) / 100);

        $factor->update([
            "profile_details_id" => $details->id,
            'coupon_id' => $coupon->id,
            "gateway" => $gateway,
            "final_total" => $total
            ]);

        return Redirect::route("coupon.index");
    }
}
