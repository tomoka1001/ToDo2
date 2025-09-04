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
    // アクセサ　get⚪︎⚪︎⚪︎Attribute
    public function getStatusLabelAttribute()
    {
        // 状態値 statusカラムの値を習得　attributes属性
        // $thisはインスタンスメソッド内でのみ利用できる特別なメソッドで、現在のインスタンスを指します。
        // $thisインスタンス化されているメソッドやプロパティを呼び出す時に使用する
        $status = $this->attributes['status'];

        // 定義されていなければ空文字を返す
        // self::は、自クラスを示す。
        // static変数はインスタンス化せずに使用します。この場合$thisは使用できません。 self::静的メソッドや静的プロパティを呼び出す時に使用する
        // Taskモデルクラスで定義されている変数STATUSをself::を使って呼び出している
        // 定義されていれば[$status]['label']を返す
        if (!isset(self::STATUS[$status])) {
            return '';
        }
        return self::STATUS[$status]['label'];
    }

    /**
     * 状態を表すHTMLクラス
     * @return string
     */
    // 色分け
    public function getStatusClassAttribute()
    {
        // 状態値
        $status = $this->attributes['status'];

        // 定義されていなければ空文字を返す
        if (!isset(self::STATUS[$status])) {
            return '';
        }
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