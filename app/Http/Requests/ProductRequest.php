<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{

    public function rules(){
		$rules = [ 
			'per_page' => ['nullable'],
			'name' => ['required', 'string'],
			'price' => 'required|regex:/^(\d+)\.?(\d{0,2})?$/i|numeric',
			'description' => ['string']
		];

		return $rules;
	}

	public function messages(){
		return [


			'required'	=> "Field is required.",
			'integer' => "Invalid data.",
			'alpha_spaces' => "Special characters and number are not allowed.",
            'regex'=> "Validation Input is Invalid"

		];
	}
}
