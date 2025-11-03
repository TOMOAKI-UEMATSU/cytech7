<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize()
    {
        return true; // 誰でもOK、権限チェックはコントローラで行う
    }

    public function rules()
    {
        return [
            'name' => 'required|max:255',                 // 商品名必須
            'price' => 'required|numeric|min:0',         // 価格必須・数字・0以上
            'description' => 'nullable|max:1000',        // 説明は任意
            'image' => 'nullable|image|max:2048',        // 画像は任意・2MB以内
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '商品名は必須です。',
            'name.max' => '商品名は255文字以内で入力してください。',
            'price.required' => '価格は必須です。',
            'price.numeric' => '価格は数字で入力してください。',
            'price.min' => '価格は0以上で入力してください。',
            'description.max' => '説明は1000文字以内で入力してください。',
            'image.image' => '画像ファイルを選択してください。',
            'image.max' => '画像サイズは2MB以内でアップロードしてください。',
        ];
    }
}
