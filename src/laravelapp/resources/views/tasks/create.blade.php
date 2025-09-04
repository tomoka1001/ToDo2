{{-- レイアウトファイルを使用することを宣言 
    resources/viewsからの相対パスでファイル名(.blade.phpは除く)を記述する--}}
@extends('layout')

@section('styles')
    <!-- デフォルトのスタイルシート -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- ブルーテーマの追加スタイルシート -->
    <link rel="stylesheet" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col col-md-offset-3 col-md-6">
                <nav class="panel panel-default">
                    <div class="panel-heading">タスクを追加する</div>
                    <div class="panel-body">
                        {{-- バリデーションエラー --}}
                        @if($errors->any())
                            <div class="alert alert-danger">
                                {{-- エラーがあればメッセージ表示 --}}
                                @foreach($errors->all() as $message)
                                    <p>{{ $message }}</p>
                                @endforeach
                            </div>
                        @endif
                        {{-- formのaction属性にはroute関数 タスクの登録にフォルダーのIDがいるからとばす--}}
                        <form action="{{ route('tasks.create', ['id' => $folder_id]) }}" method="POST">
                        {{-- methodがPOST、GETの時はCSRFがいる --}}
                        @csrf
                            <div class="form-group">
                                <label for="title">タイトル</label>
                                {{-- old関数値を保持する --}}
                                <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}" />
                            </div>
                            <div class="form-group">
                                <label for="due_date">期限</label>
                                <input type="text" class="form-control" name="due_date" id="due_date" value="{{ old('due_date') }}" />
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
<!-- flatpickrスクリプト -->
<script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>

<!-- 日本語化のための追加スクリプト -->
<script src="https://npmcdn.com/flatpickr/dist/l10n/ja.js"></script>

<script>
    // 第一引数にflatpickrで日付選択を行わせたい要素を指定、第二引数にオプション設定
    flatpickr(document.getElementById('due_date'), {
        // 日本語表記
        locale: 'ja',
        // 日付表記のフォーマット
        dateFormat: "Y/m/d",
        // 今日の日付より若い日付（過去）を入力できないように設定
        minDate: new Date()
    });
</script>
@endsection