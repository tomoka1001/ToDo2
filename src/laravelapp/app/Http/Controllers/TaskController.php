<?php

namespace App\Http\Controllers;

use App\Folder;
use App\Task;
use Illuminate\Http\Request;
use App\Http\Requests\CreateTask;
use App\Http\Requests\EditTask;

class TaskController extends Controller
{
    // タスク、フォルダ一覧表示画面
    // コントローラーメソッドの引数としてidを受け取る。　引数名はルーティングで定義した波括弧内の値と同じじゃないとダメ
    public function index(int $id)
    {
        // Folderモデル　allクラスメソッドですべてのfoldersデータをデータベースから取得
        $folders = Folder::all();

        // 選ばれたフォルダを取得
        // Folderモデル　findメソッドでプライマリキーのカラムを条件として一行分のデータを取得
        $current_folder = Folder::find($id);

        // 選ばれたフォルダに紐づくタスクを取得する hasmanyで結びつけてるからtasks()
        $tasks = $current_folder->tasks()->get();

        // view 関数(第一引数がテンプレートファイル名,第二引数がテンプレートに渡すデータ)　キーがテンプレート側で参照する際の変数名になる
        // tasks/indexに$folders,$current_folder,$tasksを渡す
        return view('tasks/index', [
            'folders' => $folders,
            'current_folder_id' => $current_folder->$id,
            'tasks' => $tasks,
        ]);
    }

    // タスク作成画面
    // /folders/{id}/tasks/createを作るのにフォルダのIDが必要、コントローラーメソッドの引数で受け取ってview関数でテンプレートに渡してい
    public function showCreateForm(int $id)
    {
        return view('tasks/create', [
            'folder_id' => $id
        ]);
    }

    // 登録処理
    // フォルダーのID,バリデーション
    public function create(int $id, CreateTask $request)
    {
        // 保存したいタスクの大元のフォルダーのID
        $current_folder = Folder::find($id);

        // Taskモデル(設計)のインスタンス(物)を作成
        $task = new Task();

        // タイトルに入力値を代入する
        $task->title = $request->title;
        // 期限に入力値を代入する
        $task->due_date = $request->due_date;

        // $taskをデータベースに書き込む
        $current_folder->tasks()->save($task);

        // tasks.indexぺージを表示するのにフォルダーIDがいるからreturnで返す
        return redirect()->route('tasks.index', [
            'id' => $current_folder->id,
        ]);
    }

    // タスク編集画面
    // $idはフォルダーのID、$task_idはタスクのID
    public function showEditForm(int $id, int $task_id)
    {
        // 選択したタスクを取得
        $task = Task::find($task_id);       

        return view('tasks/edit', [
            'task' => $task,
        ]);
    }

    // $idはフォルダーのID,$task_idはタスクのID,EditTask $requestバリデーション
    public function edit(int $id, int $task_id, EditTask $request)
    {
        // 1
        // 選択したタスクの情報を取得
        $task = Task::find($task_id);

        // 2
        // バリデーションをして保存する
        $task->title = $request->title;
        $task->status = $request->status;
        $task->due_date = $request->due_date;
        $task->save();

        // 3
        
        return redirect()->route('tasks.index', [
            'id' => $task->folder_id,
        ]);
    }
}
