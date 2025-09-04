{{-- レイアウトファイルを使用することを宣言  --}}
@extends('layout')

@section('styles')
    @include('share.flatpickr.styles')
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col col-md-offset-3 col-md-6">
                <nav class="panel panel-default">
                    <div class="panel-heading">タスクを編集する</div>
                    <div class="panel-body">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $message)
                                    <p>{{ $message }}</p>
                                @endforeach
                            </div>
                        @endif
                        <form
                            action="{{ route('tasks.edit', ['id' => $task->folder_id, 'task_id' => $task->id]) }}"
                            method="POST"
                        >
                        @csrf
                            <div class="form-group">
                                <label for="title">タイトル</label>
                                {{-- valueでタスクの情報を受け取る。
                                    old関数の第二引数を指定するとそれがデフォルト値になる --}}
                                <input type="text" class="form-control" name="title" id="title"  value="{{ old('title', $task->title) }}" />
                            </div>
                            <div class="form-group">
                                <label for="status">状態</label>
                                <select name="status" id="status" class="form-control">
                                    {{-- Taskモデルで定義した配列定数STATUSを@foreachでループ 
                                            option要素のvalueに配列のキー1, 2, 3の値を入れている--}}
                                    {{-- Taskモデルで定義した配列STATUS as $キー => 値
                                        ダブルアロー演算子は連想配列を取り扱うとき、アローを実装するときに使う
                                        アロー演算子はプロパティやメソッドにアクセスするときに使う--}}
                                @foreach(\App\Task::STATUS as $key => $val)
                                    <option
                                        {{-- 1,2,3が入る --}}
                                        value="{{ $key }}"
                                        {{-- セレクトボックスはselected属性の置かれたoption要素が初期表示で選択状態となります。 --}}
                                        {{ $key == old('status', $task->status) ? 'selected' : '' }}
                                    >
                                    {{-- labelの値の未着手、着手中、完了のどれかが入る --}}
                                    {{ $val['label'] }}
                                    </option>
                                @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="due_date">期限</label>
                                <input type="text" class="form-control" name="due_date" id="due_date"
                                    value="{{ old('due_date', $task->formatted_due_date) }}" />
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">送信</button>
                            </div>
                        </form>
                    </div>
                </nav>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @include('share.flatpickr.scripts')
@endsection