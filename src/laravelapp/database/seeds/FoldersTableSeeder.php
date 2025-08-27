<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FoldersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    // run メソッドの中にデータを挿入するコードを記述する
    public function run()
    {
        // プライベート、仕事、旅行という三つのフォルダを作る
        $titles = ['プライベート', '仕事', '旅行'];

        foreach ($titles as $title) {
            // foldersテーブルに上で定義した$titlesをforeachで１つずつ取り出してinsertする
            DB::table('folders')->insert([
                'title' => $title,
                // Carbon::now(),は現在の日時を取得
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
