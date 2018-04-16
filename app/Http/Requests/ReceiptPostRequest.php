<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;


class ReceiptPostRequest extends FormRequest
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
            'project_id'    => 'required',
            'hijri_received'    => 'required',
            'date_received'    => 'required',
            'receiver_name' => 'required',
            'amount'        => 'required|numeric',
            'document_path' => 'file|mimes:pdf,jpg,bmp,png,jpeg'
        ];
    }
}
