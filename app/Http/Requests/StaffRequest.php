<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StaffRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email:rfc,dns|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'publish_status' => 'required|in:1,0',
            'accountNumber' => 'nullable',
        ];
    }
    protected function prepareForValidation(): void
    {
        $this->merge([
            'name' => ['en' => request()->en_name, 'np' => request()->np_name],
        ]);
    }
}
