<?php

namespace App\Http\Controllers;

use App\Folder;
use App\Task;
use Illuminate\Http\Request;
use App\Http\Requests\CreateTask;
use App\Http\Requests\EditTask;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    // タスク、フォルダ一覧表示画面
    // コントローラーメソッドの引数としてidを受け取る。　引数名はルーティングで定義した波括弧内の値と同じじゃないとダメ
    public function index(Folder $folder)
    {
        // ユーザーのフォルダを取得する
        $folders = Auth::user()->folders()->get();

        // 選ばれたフォルダに紐づくタスクを取得する hasmanyで結びつけてるからtasks()
        // $tasks  Tasks::where('folder_id', '=', $current_folder->id)->get(); getメソッドがないと値を取得できない
        $tasks = $folder->tasks()->get();

        // view 関数(第一引数がテンプレートファイル名,第二引数がテンプレートに渡すデータ)　キーがテンプレート側で参照する際の変数名になる
        // tasks/index(タスク、フォルダ一覧)に$folders,$current_folder,$tasksを渡す
        return view('tasks/index', [
            'folders' => $folders,
            // current　現在
            'current_folder_id' => $folder->id,
            'tasks' => $tasks,
        ]);
    }

    // タスク作成画面
    // /folders/{id}/tasks/createを作るのにフォルダのIDが必要、コントローラーメソッドの引数で受け取ってview関数でテンプレートに渡してい
    public function showCreateForm(Folder $folder)
    {
        return view('tasks/create', [
            'folder_id' => $folder->id
        ]);
    }

    // 登録処理
    // フォルダーのID,バリデーション
    public function create(Folder $folder, CreateTask $request)
    {
        // Taskモデル(設計)のインスタンス(物)を作成
        $task = new Task();

        // タイトルに入力値を代入する
        $task->title = $request->title;
        // 期限に入力値を代入する
        $task->due_date = $request->due_date;

        // $taskをデータベースに書き込む
        $folder->tasks()->save($task);

        // tasks.indexぺージを表示するのにフォルダーIDがいるからreturnで返す
        return redirect()->route('tasks.index', [
            'id' => $folder->id,
        ]);
    }

    // タスク編集画面
    // $idはフォルダーのID、$task_idはタスクのID
    public function showEditForm(Folder $folder, Task $task)
    {
        // 選択したタスクの情報を渡す
        return view('tasks/edit', [
            'task' => $task,
        ]);
    }

    // $idはフォルダーのID,$task_idはタスクのID,EditTask $requestはバリデーション
    public function edit(Folder $folder, Task $task, EditTask $request)
    {
        // 1
        // 選択したタスクの情報を取得
        $this->checkRelation($folder, $task);

        // 2
        // バリデーションをして保存する
        $task->title = $request->title;
        $task->status = $request->status;
        $task->due_date = $request->due_date;
        $task->save();

        // 3
        // フォルダIDを持ってタスク一覧画面へリダイレクト
        return redirect()->route('tasks.index', [
            'id' => $task->folder_id,
        ]);
    }

    private function checkRelation(Folder $folder, Task $task)
    {
        if ($folder->id !== $task->folder_id) {
            abort(404);
        }
    }
}
