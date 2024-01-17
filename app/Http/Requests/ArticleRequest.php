<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'product_name' => 'required|max:20',
            'price' => 'required|numeric',
            'company_id' => 'required|exists:companies,id', 
            'comment' => 'required|max:140',
            'stock' => 'nullable|integer|min:0',
           'img_path' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
    public function attributes()
    {
        return[
        'product_name' => '商品名',
        'price' => '価格',
        'company_id' => 'メーカー名', 
        'comment' => '詳細',
        'stock' => '在庫数',
        'img_path' => '商品画像',
        ];
    }
    public function messages() 
    {

        return[
            'product_name.required' => '商品名は必須項目です。',
            'product_name.max' => '商品名は20文字以内で入力してください。',
            'price.required' => '価格は必須項目です',
            'price.numeric' => '価格の入力エラーです',
            'company_id.required' =>  'メーカー名は必須項目です',
            'company_id.exists' => 'メーカー名の入力エラーです',
            'comment.required' =>  '詳細は必須項目です',
            'comment.max' =>  '詳細は140文字以内で入力してください。',
            'stock.nullable' => '在庫数の入力エラーです',
            'stock.integer' => '在庫数の入力エラーです',
            'stock.min' =>'在庫数は１文字以上で入力してください。',
            'img_path.image' => '画像を添付してください',
            'img_path.mimes' => '画像を添付してください',
            'img_path.max' => '別の画像を添付してください',
            ];
}

}