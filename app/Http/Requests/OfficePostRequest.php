<?php

namespace App\Http\Requests;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Foundation\Http\FormRequest;

class OfficePostRequest extends FormRequest
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
            'name'              => 'required|min:6|unique:offices',
            'advisor_id'        => 'required|numeric',
            'manager_name'      => 'required|min:6',
            'license_no'        => 'required|numeric',
            'license_date'      => 'required',
            'bank_id'           => 'required|numeric',
            'iban'              => 'required|unique:offices',
            'representative'    => 'required|min:6',
            'role'              => 'required',
            'mobile'            => 'required:digits:10|unique:offices',
            'phone'             => 'required|numeric',
            'fax'               => 'numeric',
            'email'             => 'required|email|unique:offices',
            'area_id'           => 'required|numeric',
            'city_id'           => 'required|numeric',
            'zip_code'          => 'required|numeric',
            'logo'              => 'max:2000|mimes:jpeg,jpg,bmp,png',
            'license_file'      => 'required|max:2000|mimes:pdf',
            'bank_file'         => 'required|max:2000|mimes:pdf'
        ];
    }
}