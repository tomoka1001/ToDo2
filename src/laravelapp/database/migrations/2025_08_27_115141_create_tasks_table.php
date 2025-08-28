<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    // upメソッドにはマイグレート実行時に行うこと
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            // $table->データ型('カラム名')->カラム修飾子

            // 符号なしINTを使用した自動増分ID（主キー）
            $table->increments('id');
            // 整数型　カラム名folder_id　　unsigned()は符号無し（正数）
            $table->integer('folder_id')->unsigned();
            // 文字列型　カラム名title
            $table->string('title', 100);
            // 日付　カラム名due_date
            $table->date('due_date');
            // 整数型　カラム名status　default()はデフォルトを設定
            $table->integer('status')->default(1);
            // timestampsはcreated_at(作成日時),updated_at(編集日時)を意味する
            $table->timestamps();

            // 外部キーを設定する
            // foreign() どのカラムにキーを制約つけるのか（参照元）
            // references()->on() どのテーブルのどのカラムを参照するか（参照先）
            //folderを消したら関連するtaskも削除
            $table->foreign('folder_id')->references('id')->on('folders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    // downメソッドには処理を取り消すときに行うこと
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
