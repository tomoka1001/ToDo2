<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::HTTPメソッド('URL', ’コントローラー＠メソッド')->name('ルート名');
// get　ページ表示
// poat　データ保存
// put または　patch　データ更新
// delete　データ削除

Route::group(['middleware' => 'auth'], function() {
    // トップページ
    Route::get('/', 'HomeController@index')->name('home');

    // フォルダ作成画面表示
    Route::get('/folders/create', 'FolderController@showCreateForm')->name('folders.create');
    // フォルダ保存
    Route::post('/folders/create', 'FolderController@create');

    Route::group(['middleware' => 'can:view,folder'], function() {
        // getメソッドで/folders/{id}/tasksにリクエストがきたらTaskControllerコントローラーのindexメソッドを呼びだす
        // フォルダ、タスク一覧表示画面
        Route::get('/folders/{folder}/tasks', 'TaskController@index')->name('tasks.index');

        // タスク作成画面表示
        Route::get('/folders/{folder}/tasks/create', 'TaskController@showCreateForm')->name('tasks.create');
        // タスク保存
        Route::post('/folders/{folder}/tasks/create', 'TaskController@create');

        // タスク編集
        Route::get('/folders/{folder}/tasks/{task}/edit', 'TaskController@showEditForm')->name('tasks.edit');
        // タスク編集保存
        Route::post('/folders/{folder}/tasks/{task}/edit', 'TaskController@edit');
    });
});

// 会員登録・ログイン・ログアウト・パスワード再設定の各機能で必要なルーティング設定をすべて定義している
Auth::routes();
