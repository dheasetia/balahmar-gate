<?php

namespace App\Http\Requests;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Foundation\Http\FormRequest;

class ProposalUpdateRequest extends FormRequest
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
            'project_name'  => 'required|min:6',
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
