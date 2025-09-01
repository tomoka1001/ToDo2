<?php

namespace App\Http\Requests;

use App\Task;
use Illuminate\Validation\Rule;

// EditTaskクラスはCreateTaskクラスを継承。 タスクの作成と編集では状態欄の有無が異なるだけでタイトルと期限日は同一なので重複を避けるために継承を用いる
class EditTask extends CreateTask
{
    // バリデーション
    public function rules()
    {
        // 継承元(CreateTaskクラス)のrulesを実行
        $rule = parent::rules();

        // Ruleクラスのinを実行。
        $status_rule = Rule::in(array_keys(Task::STATUS));

        // 親クラスCreateTaskのrulesメソッドの結果と合体したルールリストを返す
        return $rule + [
            'status' => 'required|' . $status_rule,
        ];
    }

    // エラー表示
    public function attributes()
    {
        // 継承元(CreateTaskクラス)のattributesを実行
        $attributes = parent::attributes();

        // 親クラスCreateTaskのattributesメソッドの結果と合体したattributesリストを返す
        return $attributes + [
            'status' => '状態',
        ];
    }

    // エラーメッセージ
    public function messages()
    {
        // 継承元(CreateTaskクラス)のmessagesを実行
        $messages = parent::messages();

        // array_map( コールバック関数名 , $配列1 [, $配列2, $… ] )
        $status_labels = array_map(function($item) {
            return $item['label'];
        }, Task::STATUS);

        // implode関数で句読点でくっつけて文字列を作成する
        $status_labels = implode('、', $status_labels);

        // status.in ルールのメッセージを作成
        return $messages + [
            'status.in' => ':attribute には ' . $status_labels. ' のいずれかを指定してください。',
        ];
    }
}