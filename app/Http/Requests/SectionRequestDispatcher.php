<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SectionRequestDispatcher extends FormRequest
{
    private $section;

    public function setSection($section)
    {
        $this->section = $section;

        return $this;
    }

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
        $section = request()->getSection();

        $section->setFields();

        return $section->getValidationRules();
    }

    public function messages()
    {
        $section = request()->getSection();

        $section->setFields();

        return $section->getValidationMessages();
    }
}
