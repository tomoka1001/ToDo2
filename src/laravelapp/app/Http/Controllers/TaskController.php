<?php

namespace App\Http\Controllers;

use App\Folder;
use App\Task;
use Illuminate\Http\Request;
use App\Http\Requests\CreateTask;

class TaskController extends Controller
{
    // indexメソッドできたら
    // コントローラーメソッドの引数としてidを受け取る。　引数名はルーティングで定義した波括弧内の値と同じじゃないとダメ
    public function index(int $id)
    {
        // Folderモデル　allクラスメソッドですべてのfoldersデータをデータベースから取得
        $folders = Folder::all();

        // 選ばれたフォルダを取得
        // Folderモデル　findメソッドでプライマリキーのカラムを条件として一行分のデータを取得
        $current_folder = Folder::find($id);

        // 選ばれたフォルダに紐づくタスクを取得する
        // whereメソッドはSQL の WHERE 句に当たる　where(第一引数がカラム名,第二引数が比較する値)
        // get()メソッドがあることによって構築された SQL をデータベースに発行して結果を取得している。
        // $tasks = Task::where('folder_id', $current_folder->id)->get();
        $tasks = $current_folder->tasks()->get();

        // view 関数(第一引数がテンプレートファイル名,第二引数がテンプレートに渡すデータ)
        // tasks/indexに$folders,$current_folder,$tasksを渡す
        return view('tasks/index', [
            'folders' => $folders,
            'current_folder_id' => $current_folder->$id,
            'tasks' => $tasks,
        ]);
    }

    public function showCreateForm(int $id)
    {
        return view('tasks/create', [
            'folder_id' => $id
        ]);
    }

    public function create(int $id, CreateTask $request)
    {
        $current_folder = Folder::find($id);

        $task = new Task();
        $task->title = $request->title;
        $task->due_date = $request->due_date;

        $current_folder->tasks()->save($task);

        return redirect()->route('tasks.index', [
            'id' => $current_folder->id,
        ]);
    }
}
