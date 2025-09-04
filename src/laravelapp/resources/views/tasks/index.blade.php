@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col col-md-4">
                <nav class="panel panel-default">
                    <div class="panel-heading">フォルダ</div>
                    <div class="panel-body">
                        <a href="{{ route('folders.create') }}" class="btn btn-default btn-block">
                            フォルダを追加する
                        </a>
                    </div>
                    <div class="list-group">
                        {{-- テンプレートの中では@を付ける. コントローラーから渡されたデータ$foldersを参照している --}}
                        @foreach($folders as $folder)
                            {{-- route関数はURLを作成する。　tasks.indexはweb.phpで指定したname $folder->idはfoldersテーブルのIDカラム(数値)--}}
                            <a href="{{ route('tasks.index', ['id' => $folder->id]) }}" 
                                {{-- 選択したfolderのID($current_folder_id)が、$folder->idと一致したら背景色を変える　
                                        三項演算子　条件式 ? 真の式 : 偽の式--}}
                                class="list-group-item {{ $current_folder_id === $folder->id ? 'active' : '' }}">
                                {{-- foldersのtitleカラムを指してる --}}
                                {{ $folder->title }}
                            </a>
                        @endforeach
                    </div>
                </nav>
            </div>
            <div class="column col-md-8">
                <!-- ここにタスクが表示される -->
                <div class="panel panel-default">
                    <div class="panel-heading">タスク</div>
                    <div class="panel-body">
                        <div class="text-right">
                            {{-- tasks.createにとぶ current_folder_idはfolderのid--}}
                            <a href="{{ route('tasks.create', ['id' => $current_folder_id]) }}" class="btn btn-default btn-block">
                                タスクを追加する
                            </a>
                        </div>
                    </div>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>タイトル</th>
                                <th>状態</th>
                                <th>期限</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- tasksテーブルの値を取得し表示する --}}
                            @foreach($tasks as $task)
                                <tr>
                                    {{-- tasksテーブルのtitle(タイトル) --}}
                                    <td>{{ $task->title }}</td>
                                    <td>
                                        {{-- tasksテーブルのatatus(状態) --}}
                                        <span class="label {{ $task->status_class }}">{{ $task->status_label }}</span>
                                    </td>
                                    {{-- tasksテーブルのdue_date(期限) --}}
                                    <td>{{ $task->formatted_due_date }}</td>
                                    {{-- idはフォルダーのID、task_いどはタスクのID --}}
                                    <td><a href="{{ route('tasks.edit', ['id' => $task->folder_id, 'task_id' => $task->id]) }}">編集</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection