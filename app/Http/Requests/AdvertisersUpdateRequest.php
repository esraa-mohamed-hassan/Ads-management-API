<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class AdvertisersUpdateRequest extends FormRequest
{ /**
    * Get the validation rules that apply to the request.
    *
    * @return array<string, mixed>
    */
   public function rules()
   {

       return [
           'name' => 'required|max:150',
           'email' => 'required|email|unique:advertisers,id'
       ];
   }

   public function failedValidation(Validator $validator)

   {
       throw new HttpResponseException(response()->json([
           'success'   => 'false',
           'message'   => 'Validation errors',
           'data'      => $validator->errors()
       ]));
   }

   public function messages()
   {
       return [
           'name.required' => 'Name is required!',
           'email.required' => 'Email is required!',
       ];
   }
}
