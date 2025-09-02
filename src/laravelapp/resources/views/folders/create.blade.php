{{-- レイアウトファイルを使用することを宣言  --}}
@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col col-md-offset-3 col-md-6">
                <nav class="panel panel-default">
                    <div class="panel-heading">フォルダを追加する</div>
                    <div class="panel-body">
                        {{-- バリデーションエラーがあれば --}}
                        @if($errors->any())
                            <div class="alert alert-danger">
                            <ul>
                                {{-- エラーメッセージ表示 --}}
                                @foreach($errors->all() as $message)
                                <li>{{ $message }}</li>
                                @endforeach
                            </ul>
                            </div>
                        @endif
                        {{-- フォルデー作成(保存)処理に行く --}}
                        <form action="{{ route('folders.create') }}" method="post">
                            {{-- method=post,getの場合csrfいる --}}
                            @csrf
                            <div class="form-group">
                                <label for="title">フォルダ名</label>
                                <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}"/>
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