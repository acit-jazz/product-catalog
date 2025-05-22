<?php

namespace AcitJazz\ProductCatalog\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255'],
            'qty' => ['required'],
            'price' => ['required'],
            'categories' => ['required'],
            'published_at' => ['required'],
        ];
    }
}
