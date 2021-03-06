<?php

namespace App\Http\Requests\Quotes;

use Illuminate\Foundation\Http\FormRequest;

class SupplyRequest extends FormRequest
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
     * @return array
     */
    public function rules(){
        return [
            'fileQuotesProduct' => 'required|mimes:png,gif,jpeg,jpg,bmp',
        ];
    }

    /* public function messages(){
        return [
            'noteQuoteProduct.required' => 'El :attribute es obligatorio.',
        ];
    } */
    public function attributes()
    {
        return [
            'fileQuotesProduct' => 'archivo',
        ];
    }
}
