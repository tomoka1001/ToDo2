<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// Taskモデルファイルがある場所
use App\Task;

//  foldersテーブルに対応 継承元Modelクラス
class Folder extends Model
{
    public function tasks()
    {
        // hasManyメソッドは引数を省略して書ける
        // foldersテーブルとtasksテーブルの一対多の関連性
        return $this->hasMany('App\Task');

        // 省略しないと$this->hasMany('App\Task', 'folder_id', 'id');
        // 第一引数が関連するモデル名(名前空間も含む)
        // 第二引数が関連するテーブルが持つ外部キーカラム名
        // 第三引数はモデルにhasManyが定義されている側のテーブルが持つ、外部キーに紐づけられたカラムの名前。第二引数がテーブル名単数形_idで第三引数が idであれば省略できる。
    }
}
