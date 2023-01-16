<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class EmployeCreateOrUpdateRequest extends FormRequest
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
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' =>  'nullable|email|max:255',
            'phone' => 'nullable|max:20',
            'company_id' => 'integer|nullable'
        ];

        return $rules;
    }

    public function attributes(): array
    {
        return [
            'first_name' => __('admin_employe.first_name'),
            'last_name' => __('admin_employe.last_name'),
            'email' => __('admin_employe.email'),
            'phone' => __('admin_employe.phone'),
            'company_id' => __('admin_employe.company')
        ];
    }
}
