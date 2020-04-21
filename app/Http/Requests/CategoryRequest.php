<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
    public function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'menu_name' => 'nullable|string|max:255',
            'text' => 'nullable|string',
            'image' => 'nullable|image',
            'parent' => 'nullable|integer|exists:page_categories,id',
            'hidden' => 'integer',
            'slug' => 'nullable|string|unique:page_categories,slug',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
        ];

        if ($this->isMethod('PUT')) {
            $category = $this->route()->parameter('category');;
            $rules['slug'] = [
                'nullable',
                'string',
                Rule::unique('page_categories', 'slug')->ignore($category),
            ];
        }

        return $rules;
    }
}
