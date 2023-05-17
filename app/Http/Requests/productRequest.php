<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class productRequest extends FormRequest
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
        $rules = [];
        $currentAction = $this->route()->getActionMethod();

        switch ($this->method()):
            case 'POST':
                switch ($currentAction) {
                    case 'store':
                        $rules = [
                            'name' => 'required|string|min:3|max:900',
                            'price' => 'required|numeric|min:0',
                            'sale' => 'required|numeric',
                            'status' => 'required',
                            'color' => 'required',
                            'msize' => 'required',
                            'misize' => 'required',
                            'file_image' => 'required',
                            'file_image.*' => 'required|mimes:jpg,jpeg,png,pdf|max:2048',
                            'brandID' => 'required',
                            'content' => 'required',
                            'desc' => 'required'
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


    public function messages()
    {
        return [
            'name.required' => 'nhập tên sản phẩm',
            'name.string' => 'Không phải loại chuỗi',
            'name.min' => 'Tên quá ngắn',
            'name.max' => 'Tên quá dài',

            'price.required' => 'Nhập giá sản phẩm',
            'price.numeric' => 'Không phải loại số',
            'price.min' => 'giá trị quá nhỏ',

            'sale.numeric' => 'Không phải loại số',
            
            'status.required' => 'chọn trạng thái sản phẩm',
            'color.required' => 'Không để trống màu sắc',

            'msize.required' => 'Nhập kích sở lớn nhất',
            'misize.required' => 'nhập kích cở nhỏ nhất',

            'file_image.required' => 'Chọn ảnh cho sản phẩm',
            'file_image.*.mimes' => 'File không phải định dạng ảnh',

            'brandID.required' => 'Chọn trạng thái sản phẩm',
            'content.required' => 'Viết nội dung sản phẩm',
            'desc.required' => 'Viết mô tả sản phẩm
            '

        ];
    }
}
