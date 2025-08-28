<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    // public function getGenderTextAttribute() {
    //     // $this->attributes['gender']でgender カラムの値を取得
    //     // getAttributeは属性の値を取得するためのメソッド
    //     // 各カラムの値は$attributesという一つのプロパティで配列として管理
    //     switch($this->attributes['gender']) {
    //         case 1:
    //             return 'male';
    //         case 2:
    //             return 'female';
    //         default:
    //             return '??';
    //     }
    // }

    // 状態定義
    const STATUS = [
        1 => [ 'label' => '未着手', 'class' => 'label-danger' ],
        2 => [ 'label' => '着手中', 'class' => 'label-info' ],
        3 => [ 'label' => '完了', 'class' => '' ],
    ];

    // 状態のラベル
    // @return string
    public function getStatusLabelAttribute()
    {
        // 状態値 statusカラムの値を習得
        $status = $this->attributes['status'];

        // 定義されていなければ空文字を返す
        if (!isset(self::STATUS[$status])) {
            return '';
        }
        // 定義されていれば[$status]['class']を返す
        return self::STATUS[$status]['class'];
    }

    // 成形した期限日
    // @return string

    public function getFormattedDueDateAttribute()
    {
        return Carbon::createFromFormat('Y-m-d', $this->attributes['due_date'])->format('Y/m/d');
    }

    // タスクを所有するフォルダーを取得
    // public function folders()
    // {
    //     return $this->belongsTo('App\Post');
    // }
}