<?php

namespace App\Http\Requests\Employees;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
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
            'fname' => 'required',
            'lname' => 'required',
            'birth_date' => 'required',
            'birth_place' => 'required',
            'civil_status_id' => 'required',
            'gender' => 'required',
            'per_address' => 'required',
            'phone_num' => 'required|regex:/^[0-9]*$/|min:10|max:10',
            'email' => 'required|unique:employee_personal_details,email,' . $this->id,
            'employee_id' => 'required|unique:employee_employment_details,employee_id,' . $this->id . ',employee_personal_detail_id',
            'role_type' => 'required',
            'employment_status_id' => 'required',
            'job_code' => 'required',
            'date_join' => 'required',
            'date_appoint' => 'required',
            'work_shift' => 'required',
            'item_num' => 'required',
        ];
    }
}
