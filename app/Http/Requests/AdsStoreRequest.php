<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class AdsStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|max:150',
            'description' => 'required|max:150',
            'advertiser' => 'required|numeric',
            'category' => 'required|numeric',
            'start_date' => 'required',
            'tags' => 'required',
        ];
    }

    public function failedValidation(Validator $validator)

    {
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'message'   => 'Validation errors',
                'data'      => $validator->errors()
            ])
        );
    }

    public function messages()
    {
        return [
            'title.required' => 'Title is required!',
            'description.required' => 'Description is required!',
            'advertiser.required' => 'Advertiser is required!',
            'category.required' => 'Category is required!',
            'tags.required' => 'Tags is required!',
            'start_date.required' => 'Start Date is required!',
        ];
    }
}
