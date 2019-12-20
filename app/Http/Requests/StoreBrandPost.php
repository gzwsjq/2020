<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBrandPost extends FormRequest
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
            'bname' => 'required|unique:brand|max:20|min:2',
            'burl' => 'required',
        ];
    }

    /**
     * 获取被定义验证规则的错误消息
     *
     * @return array
     * @translator laravelacademy.org
     */
    public function messages(){
        return [
            'bname.required'=>'品牌名称必填',
            'bname.unique'=>'品牌名称已存在',
            'bname.max'=>'品牌名称最大长度为20位',
            'bname.min'=>'品牌名称最小的长度2位',
            'burl.required'=>'品牌网址必填',
        ];
    }
}
