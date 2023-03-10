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
        $rules = [];
        $currentAction = $this->route()->getActionMethod();

        switch ($this->method()):
            case 'POST':
                switch ($currentAction) {
                    case 'Login':
                        $rules = [
                            'email' => 'required|email',
                            'password' => 'required',
                        ];
                        break;
                    case 'api_register':
                        $rules = [
                            'name' => 'required', 
                            'phoneNumber' => 'required|unique:users,phoneNumber', 
                            'email' => 'required|email|unique:users,email',
                            'password' => 'required', 
                        ];
                        break;
                    default:
                        break;
                }
                break;
            default:
                break;
        endswitch;
        return $rules;
    }

    public function messages() : array
    {
        return [
            'email.required' => 'Email kh??ng ???????c ????? tr???ng',
            'email.email' => 'Email ch??a ????ng ?????nh d???ng',
            'email.unique' => 'Email ???? t???n t???i ',
            'password.required' => 'password kh??ng ???????c ????? tr???ng',
            'name.required' => 'T??n kh??ng ???????c ????? tr???ng'
        ];
    }
}
