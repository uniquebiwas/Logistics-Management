<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;


class AgentServiceRequest extends FormRequest
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
        return  [
            'title' => 'required',
            'description' => 'required',
            'categoryId' => 'required|numeric|exists:service_categories,id',
            'image' => 'nullable|image',
            'noOfWorker' => 'required|numeric',
            'publishStatus' => 'required|boolean',
            'deadline' => 'required|date',
            'workingHour' => 'required',
            'startDate' => 'required|date',
            'endDate' => 'required|date|after:startDate',
            'location' => 'required',
            'workerGradesId' => 'required|exists:worker_grades,id',
            'parentId' => 'nullable|numeric|exists:agent_services,id',
        ];
    }

    protected function prepareForValidation()
    {
        $loginId =  auth()->user()->id;
        $this->merge([
            'adminId' => $loginId,
            'addedBy' => $loginId,
            'agentId' => $loginId,
        ]);
    }
}
