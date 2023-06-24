<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MembershipTypeRequest extends FormRequest
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
        return [
            'np_title' => 'required_if:en_title,null',
            'en_title' => 'required_if:np_title,null',
            'image' => 'nullable|url',
            'weeklyMembership' => 'numeric|min:0',
            'monthlyMembership' => 'numeric|min:0',
            'yearlyMembership' => 'numeric|min:0',
            'weeklyRenewal' => 'numeric|min:0',
            'monthlyRenewal' => 'numeric|min:0',
            'yearlyRenewal' => 'numeric|min:0',
            'year' => 'numeric|min:0',
            'publish_status' => 'required',
            'applicableYear' => 'nullable|digits_between:2000,2100'

        ];
    }

    public function messages()
    {
        return [
            'required_if' => ':attribute is required if :other is not provided',
            'integer' => ':attribute must be in number',
            'min' => ':attribute must be provided with appropriate value'
        ];
    }
}
