<?php

namespace App\Http\Controllers;

use App\Folder;
use Illuminate\Http\Request;
use App\Http\Requests\CreateFolder;
use Illuminate\Support\Facades\Auth;

class FolderController extends Controller
{
    // フォルダー作成画面
    public function showCreateForm()
    {
        return view('folders/create');
    }

    // 引数にインポートしたCreateFolderクラスを受け入れる. CreateFolderクラスのインスタンス$requestに値を入れて引数として情報を渡す
    public function create(CreateFolder $request)
    {
        // フォルダモデル(設計)のインスタンス(物)を作成
        $folder = new Folder();

        // タイトルに入力値を代入する
        $folder->title = $request->title;

        // ユーザーに紐づけて保存
        Auth::user()->folders()->save($folder);

        // インスタンスの状態をデータベースに書き込む
        $folder->save();

        // web.phpで決めたnameを指定
        return redirect()->route('tasks.index', [
            'id' => $folder->id,
        ]);
    }
}
