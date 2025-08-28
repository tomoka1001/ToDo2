<?php

namespace App\Http\Controllers;

use App\Folder;
use Illuminate\Http\Request;
use App\Http\Requests\CreateFolder;

class FolderController extends Controller
{
    public function showCreateForm()
    {
        return view('folders/create');
    }

    // 引数にインポートしたCreateFolderクラスを受け入れる. CreateFolderクラスのインスタンス$requestに値を入れて引数として情報を渡す
    public function create(CreateFolder $request)
    {
        // フォルダモデルのインスタンスを作成
        $folder = new Folder();

        // タイトルに入力値を代入する
        $folder->title = $request->title;

        // インスタンスの状態をデータベースに書き込む
        $folder->save();

        // web.phpで決めたnameを指定
        return redirect()->route('folders/create', [
            'id' => $folder->id,
        ]);
    }
}
