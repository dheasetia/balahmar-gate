<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Sentinel::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'  => 'required',
            'email' => 'required|email|unique:users,name,' . Sentinel::getUser()->id,
            'mobile'    => 'required|digits:10',
            'national_id'   => 'required|numeric',
            'password'  => 'confirmed'
        ];
    }
}
