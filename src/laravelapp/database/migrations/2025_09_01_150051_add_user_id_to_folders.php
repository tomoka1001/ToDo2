<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdToFolders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    // user_idカラムを追加して外部キーを設定する処理
    public function up()
    {
        // foldersテーブルにuser_idカラムを追加
        Schema::table('folders', function (Blueprint $table) {
            // $table->データ型('カラム名')->カラム修飾子

            // 整数型　unsigned()は符号無し（正数）
            $table->integer('user_id')->unsigned();

            // 外部キーを設定する
            // foreign() どのカラムにキーを制約つけるのか（参照元）
            // references()->on() どのテーブルのどのカラムを参照するか（参照先）
            //folderを消したら関連するtaskも削除
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    // user_idカラムを削除する処理
    public function down()
    {
        Schema::table('folders', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
}
