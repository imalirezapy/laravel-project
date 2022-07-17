<?php

namespace App\Http\Requests;

use App\Models\State;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileRequest extends FormRequest
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
    public function rules()

    {
        //        "user_id", "address", "post", "phone"

        return [
            "state" => [
//                Rule::in(State::all()->pluck("id")),
            ],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255',
                Rule::notIn(User::whereNot("id", auth()->user()->id)->get()->pluck("email")),
            ],
//            'password' => ['required', 'string', 'min:4', 'confirmed'],
        ];

    }
}
