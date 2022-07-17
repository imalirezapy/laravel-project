<?php

namespace App\Http\Controllers;

use App\Http\Requests\FoodRequest;
use App\Models\Cart;
use App\Models\Favorite;
use App\Models\Food;
use App\Models\Rate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;
use phpDocumentor\Reflection\Types\True_;
use function GuzzleHttp\Promise\all;

class ShopController extends Controller
{
    public function ShowProducts(Request $request)
    {
        $foods = new Food();
        $orderBy = "newest";
        $min = 1000;
        $max = 1000001;

        if ($request->isMethod('POST')){
            $request->validate([
                'orderBy' => [
                    'required',
                    Rule::in(['newest', 'name', 'expensive', 'inexpensive'])
                ],
                'rangeOne' => 'required',
                'rangeTwo' => "required"
            ]);

            $orderBy = $request->orderBy;
            if ($orderBy == 'newest') {
                $foods = Food::orderBy('id', 'desc');
            } elseif ($orderBy == 'name') {
                $foods = Food::orderBy('name');
            }elseif ($orderBy == 'expensive') {
                $foods = Food::orderBy('price', 'desc');
            }elseif ($orderBy == 'inexpensive') {
                $foods = Food::orderBy('price',);
            }
            $min = $request->rangeOne;
            $max = $request->rangeTwo;
            $foods = $foods->whereBetween('price', [$min, $max]);

        }

        return view("shop", [
            'foods' => $foods->get(),
            'orderBy' => $orderBy,
            'max' => $max,
            'min' => $min
        ]);
    }

    public function AddToCart(Request $request){
        $user_ip = $request->ip();
        $user_id = null;
        $food_id = (int)$request->id;
        $cart = new Cart();

        if (auth()->check()) {
            $user_id = auth()->user()->id;
            $cart = Cart::where("user_id", $user_id)->where("food_id", $request->id);
            $ids = Food::all()->pluck("id");

            $request->validate([
                'id' => [
                    "required",
                    Rule::in($ids, $food_id)
                ]
            ]);



        } else{
            $cart = Cart::where("user_ip", $user_ip)->where("food_id", $request->id);
        }

        if ($cart->first() == null){
            Cart::create([
                "user_id" => $user_id,
                "user_ip" => $user_ip,
                "food_id" => $food_id,
                "count" => 1,
            ]);
        } else{
            $cart->update([
                'user_id' => $user_id,
                'user_ip' => $user_ip,
                'food_id' => $food_id,
                'count' => $cart->first()->count+1
            ]);
        }





        return redirect()->back();

    }

    public function show(Food $food)
    {
        $is_rate = null;

        if (auth()->check() ){
            $rate = Rate::where("user_id", auth()->user()->id)->get();
            if(! empty($rate->toArray()) and ! is_null($rate = $rate->where('food_id', $food->id)->first())) {
                $is_rate = $rate->rate;
            }
        }
        return view("food", [
            'food' => $food,
            'rate' => $food->rating,
            'is_rate' => $is_rate,
        ]);
    }

    public function favorite(Food $food)
    {

        $data = [
            'user_id' => null,
            'user_ip' => $_SERVER['REMOTE_ADDR'],
            'food_id' => $food->id
        ];

        if (\auth()->check()) {
            $data['user_id'] = auth()->user()->id;
        }
        Favorite::create($data);
    }

    public function favorite_delete(Food $food)
    {
        if (\auth()->check()) {
            $favorite = Favorite::where('user_id', \auth()->user()->id);
        } else{
            $favorite = Favorite::where('user_ip', $_SERVER['REMOTE_ADDR']);
        }
        $favorite->where('food_id', $food->id)->first()->delete();
    }

    public function favorites()
    {
        if (\auth()->check()){
            $foods = User::find(\auth()->user()->id)->favorites()->get()->toArray();
        } else{
            $foods = Favorite::where("user_ip", $_SERVER['REMOTE_ADDR'])->get()->toArray();
            $foods = array_map(fn($i)=>\App\Models\Food::find($i['food_id']), $foods);
        }

        return view('favorites', [
            'foods' => $foods
        ]);
    }
}
