<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'              => 'required',
            'email'             => 'required|email',
            'date_of_birth'     => 'date_format:Y-m-d',
            'image'             => 'mimes:jpeg,jpg,png,gif|max:10000',
            't_class_id'        => 'required',
            'reg_no'            => 'required|integer',
            'roll_no'           => 'required|integer',
            'result'            => 'required',
        ];
    }
}
