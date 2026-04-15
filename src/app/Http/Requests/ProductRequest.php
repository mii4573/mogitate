<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        $isUpdate = $this->isMethod('PATCH') || $this->isMethod('PUT');

        return [
            'name'=>'required|string',
            'price'=>'required|integer|min:0|max:10000',
            'description'=>'required|string|max:120',
            'image'=>($isUpdate ? 'nullable' : 'required') . '|image|mimes:png,jpeg,jpg',
            'seasons'=>'required|array',
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'商品名を入力してください',
            'price.required'=>'値段を入力してください',
            'price.integer'=>'数値で入力してください',
            'price.max'=>'0～10,000円以内で入力してください',
            'description.required'=>'商品説明を入力してください',
            'description.max'=>'120文字以内で入力してください',
            'image.required'=>'商品画像を登録してください',
            'image.mimes'=>'「.png」または「.jpeg」形式でアップロードしてください',
            'seasons.required'=>'季節を選択してください',

        ];
    }
}
