<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class ProjectUpdateRequest extends FormRequest
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
            'name'  => 'required|min:6',
            'description'   => 'required|min:6',
            'responsible_person'    => 'required|min:6',
            'mobile'        => 'required|numeric|digits:10',
            'email'         => 'required|email',
            'kind_id'       => 'required|numeric',
            'city_id'       => 'required|numeric',
            'execution_date'    => 'required'
        ];
    }
}
