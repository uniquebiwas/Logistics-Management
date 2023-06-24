<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class CreditRequest extends FormRequest
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

            'title' => 'required',
            'description' => 'nullable',
            'dueDate' => 'nullable|date|after:today',
            'agentId' => 'required|exists:users,id',
            'creditAmount' => 'nullable',
            'type' => 'required|in:credit,advance'
        ];
    }

    public function messages()
    {
        return [
            'agentId.unique' => 'This agent already have an credit account.'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'title' => request()->title ?? 'credit given'
        ]);
    }
}
