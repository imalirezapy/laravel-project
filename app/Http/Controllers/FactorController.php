<?php

namespace App\Http\Controllers;

use App\Mail\FactorMail;
use App\Models\Cart;
use App\Models\FactorDetails;
use App\Models\FactorProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FactorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $factor = $user->factors->last();
        $factor_profile = FactorProfile::create($factor->profile_details->toArray())->id;
//        $factor_profile = 1;
        $factor->update([
            "factor_profile_id"=>$factor_profile,
            "complete" => true,
        ]);
        $cart = \App\Models\Cart::where("user_id",auth()->user()->id);
//        dd($cart->get());
        foreach ($cart->get() as $food){
//            dd($food);

//            $count = $cart->where("food_id", $food->id)->first()->count;
            FactorDetails::create([
                "factor_id" => $factor->id,
                "food_id" => $food->food_id,
                "count" => $food->count
            ]);
        }

        Cart::where("user_id", $user->id)->delete();

        Mail::to("imalirezapy@gmail.com")->send(new FactorMail($factor));
        return redirect('/');

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
