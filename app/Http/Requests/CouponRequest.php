<?php

namespace App\Http\Requests;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CouponRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(Request $request)
    {
        return [
            "access" => [
                "required",
                Rule::in(["public", "private"]),
            ],
            "count" => "required",
            "percent" => "required",
            "code" => [
                "required",
//                Rule::notIn(Coupon::all()->pluck("code"))
            ],
            "start_at" => ["required"],
        ];
    }
}
