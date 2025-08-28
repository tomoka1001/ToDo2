<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateFolder extends FormRequest
{
    // 日本語に変換
    public function attributes()
    {
        return [
            'title' => 'フォルダ名',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    //  メソッドはリクエストの内容に基づいた権限チェックのために使う
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    // ruleメソッドで、入力欄ごとにチェックするルールを定義する。
    public function rules()
    {
        return [
            'title' => 'required|max:20',
        ];
    }
}
