<?php

namespace App\Http\Requests;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Foundation\Http\FormRequest;

class ReportPostRequest extends FormRequest
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
            'hijri_created' => 'required',
            'project_id'    => 'required',
            'nth'           => 'required',
            'hijri_report_from' => 'required',
            'report_from'   => 'required',
            'hijri_report_to'   => 'required',
            'report_to'     => 'required',
            'document_path' => 'file|mimes:pdf,jpeg,png,jpg'
        ];
    }
}
