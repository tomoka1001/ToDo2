<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFoldersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::createテーブルを作成するメソッド　'folders'テーブル名　function (Blueprint $table)コールバック関数　カラム名をインデックスとして扱う連想配列$tableが作成しているイメージ？
        Schema::create('folders', function (Blueprint $table) {
            // $table->データ型('カラム名')->カラム修飾子
            // 主キーのデフォルトが、increments()からbigIncrements()になった
            
            // 符号なしINTを使用した自動増分ID（主キー）
            $table->increments('id');
            // string型(文字列型)
            $table->string('title', 20);
            // timestampsはcreated_at(作成日時),updated_at(編集日時)を意味する
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('folders');
    }
}
