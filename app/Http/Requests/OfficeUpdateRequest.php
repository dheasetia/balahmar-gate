<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class OfficeUpdateRequest extends FormRequest
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
            'name'          => 'required|min:6|unique:offices,name,' . request('office_id'),
            'advisor_id'    => 'required|numeric',
            'manager_name'  => 'required|min:6',
            'license_no'    => 'required|numeric',
            'license_date'  => 'required',
            'bank_id'       => 'required|numeric',
            'iban'          => 'required|unique:offices,iban,' . request('office_id'),
            'representative'    => 'required|min:6',
            'role'          => 'required',
            'mobile'        => 'required:digits:10|unique:offices,mobile,' . request('office_id'),
            'phone'         => 'required|numeric',
            'email'         => 'required|email|unique:offices,email,' . request('office_id'),
            'area_id'       => 'required|numeric',
            'city_id'       => 'required|numeric',
            'zip_code'      => 'required|numeric',
            'logo'          => 'max:2000|mimes:jpeg,jpg,bmp,png',
            'license_file'  => 'max:2000|mimes:pdf',
            'bank_file'     => 'max:2000|mimes:pdf'
        ];
    }
}
