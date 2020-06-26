<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PageRequest extends FormRequest
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
            'category_id' => 'integer|not_in:0',
            'hidden' => 'integer',
            'slug' => 'nullable|string|unique:pages,slug',
            'image' => 'nullable|image',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
        ];

        if ($this->isMethod('PUT')) {
            $page = $this->route()->parameter('page');;
            $rules['slug'] = [
                'nullable',
                'string',
                Rule::unique('pages', 'slug')->ignore($page),
            ];
        }

        return $rules;
    }
}
