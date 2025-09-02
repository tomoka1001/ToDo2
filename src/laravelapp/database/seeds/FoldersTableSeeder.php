<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

// FoldersTableSeederクラス　Seeder継承
class FoldersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    // runメソッドの中にデータを挿入するコードを記述する
    public function run()
    {
        // firstメソッドでユーザーを一行だけ取得してそのIDをuser_idの値に指定
        // firstメソッドは配列の要素を取り出すときにその配列の中の最初の要素を取得するメソッド。
        $user = DB::table('users')->first(); // ★

        // プライベート、仕事、旅行という三つのフォルダを作る
        $titles = ['プライベート', '仕事', '旅行'];

        foreach ($titles as $title) {
            // foldersテーブルに１つずつ取り出してinsertする
            DB::table('folders')->insert([
                'title' => $title,
                'user_id' => $user->id,
                // Carbon::now(),は現在の日時を取得
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
