<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductFormRequest extends FormRequest
{

    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'supplier' => 'required|max:255',
            'price' => 'required|max:12|regex:/^\d+(\.\d{1,2})?$/',
            'description' => '',
            'image' => 'nullable|image',
        ];
    }
}
