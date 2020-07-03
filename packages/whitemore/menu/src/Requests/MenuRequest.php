<?php

namespace Whitemore\Menu\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MenuRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'hidden' => 'integer',
            'hide_children' => 'integer',
            'slug' => 'nullable|string|unique:menu,slug',
        ];

        $rules['parent_id'] = [
            'nullable',
            'integer',
            function ($attribute, $value, $fail) {
                $id = $this->get('id');
                if ($value === $id) {
                    $fail($attribute . ' не должен быть родителем самого себя.');
                }
            },
        ];

        if ($this->isMethod('PUT')) {
            $menu = $this->route()->parameter('menu');
            $rules['slug'] = [
                'nullable',
                'string',
                Rule::unique('menu', 'slug')->ignore($menu),
            ];
        }

        return $rules;
    }
}
