<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\Profile;
use App\Models\Setting;
use App\Models\User;
use Hamcrest\Core\Set;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $user = User::find(auth()->user()->id)->toArray();

        $profile = Profile::where("user_id", auth()->user()->id)->first()->toArray();
//        dd($user, auth()->user()->id);
        $user = array_merge($profile, $user);

        $setting = Setting::find(auth()->id());

        return view("profile", [
            "user" => $user,
            "notification" => $setting->notification,
            "coupon_notification" => $setting->coupon_notification
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function update(ProfileRequest $request, Profile $profile)
    {
        $user = $profile->user;

        $user->update([
            "name" => $request->name,
            "email" => $request->email
        ]);

        $profile->update([
                "state" => $request->state,
                "address" => $request->address,
                "post" => $request->post,
                "phone" => $request->phone
        ]);
        return back();

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

    public function notification(Setting $setting, Request $request)
    {
        if (is_bool((bool) $request)) {
            $setting->update([
                'notification' => (bool) $request->value,

            ]);
        }

    }
    public function coupon_notification(Setting $setting, Request $request)
    {
        if (is_bool((bool) $request)) {
            $setting->update([
                'coupon_notification' => (bool) $request->value,

            ]);
        }

    }
}
