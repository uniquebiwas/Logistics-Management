<?php

namespace App\Http\Requests;

use App\Models\Partner;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class PartnerRequest extends FormRequest
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
            'image' => 'required|url',
            'url' => 'nullable|active_url',
            'publishStatus' => 'required|in:0,1',
            'slug' => 'required',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'slug' => $this->getSlug(request()->title),
        ]);
    }


    protected function getSlug($title, $recursion = 0)
    {
        if ($recursion > 0) {
            $slugTitle = str_slug($title) . '-' . Str::random($recursion);
        } else {
            $slugTitle = str_slug($title);
        }

        $slug = Partner::where('slug', $slugTitle)->first();
        if ($slug) {
            return $this->getSlug($slugTitle, $recursion + 1);
        }

        return $slugTitle;
    }
}
