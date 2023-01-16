<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CompanyCreateOrUpdateRequest extends FormRequest
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
            'id' => 'nullable',
            'name' => 'required|max:100',
            'email' =>  ['nullable', 'email', 'max:255'],
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:min_width=100,min_height=100',
            'website' => 'nullable|max:255',
        ];

        return $rules;
    }

    public function attributes(): array
    {
        return [
            'name' => __('admin_company.name'),
            'email' => __('admin_company.email'),
            'logo' => __('admin_company.logo'),
            'website' => __('admin_company.website')
        ];
    }
}
