<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class LoginRequest extends FormRequest
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
    public function rules(): array
    {
        $rules = [];
        $currentAction = $this->route()->getActionMethod();

        switch ($this->method()):
            case 'POST':
                switch ($currentAction) {
                    case 'Login_web':
                        $rules = [
                            'email' => 'required|email',
                            'password' => 'required',
                        ];
                        break;
                    case 'post_register_web':
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
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email chưa đúng định dạng',
            'email.unique' => 'Email đã tồn tại ',
            'password.required' => 'password không được để trống',
            'name.required' => 'Tên không được để trống'
        ];
    }
}
