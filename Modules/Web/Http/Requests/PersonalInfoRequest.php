<?php

namespace Modules\Web\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonalInfoRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            "address"                   =>   "required | max:255",
            "district"                  =>   "required | max:255",
            "pin"                       =>   "required | numeric",
            "gender"                    =>   "required | max:255",
            'date_of_birth'             =>   "required | date_format:d/m/Y",
            'caste_category'            =>   "required | max:255",
            'caste_category_other'      =>   "max:255 | required_if:caste_category,Other", 
            'mobile'                    =>   "required | numeric",
            'whatsapp'                  =>   "required | numeric",
            'parent_name'               =>   'required|max:225',
            'parent_contact'            =>   'required | numeric',
//            'class_completed'           =>   "required | max:255",
//            'board'                     =>   "required | max:255",
//            'board_other'               =>   "required_if:board,Other | max:255",
//            'last_studied'              =>   "required | max:255",
//            'annual_income'             =>   "required | max:255",

        ];
    }


    public function messages()
{
    return [
        'date_of_birth.date_format' => 'The date of birth does not match the format.',
    ];
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
}
