<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {

        $rule = 'required';
        $val = 'required|unique:teachers,email';
        if($this->method() == 'PUT') {
            $rule = 'nullable';
            $val = 'required|unique:teachers,email,'.$this->teacher_id;
        }
        return [
            'name' => 'required',
            'email' => $val,
            'password' => $rule,
            'phone' => 'required',
            'image' => $rule,
            'ex_years' => 'required',
            'bio' => 'required'
        ];
    }
}
