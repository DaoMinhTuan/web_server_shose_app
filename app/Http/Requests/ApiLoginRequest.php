<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;


class ApiLoginRequest extends FormRequest
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

    protected function failedValidation(Validator $validator)
    {
        $err = $validator->errors();
        foreach ($err as  $key => $value) {
             $value;
        }

        $json = [
            'result' => false,
            'message' => $err,
        ];
        $response = response( $json );
        throw new ValidationException($validator, $response);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required',
        ];
    }

    public function messages() : array
    {
        return [
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email chưa đúng định dạng',
            'password.required' => 'password không được để trống',
        ];
    }
}
