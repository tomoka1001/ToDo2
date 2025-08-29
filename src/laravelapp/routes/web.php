<?php
use Illuminate\Support\Facades\Route;
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

Route::get('/', function () {
    return view('welcome');
});

// Route::HTTPメソッド('URL', ’コントローラー＠メソッド')->name('ルート名');
// get　ページ表示
// poat　データ保存
// put または　patch　データ更新
// delete　データ削除

// getメソッドで/folders/{id}/tasksにリクエストがきたらTaskControllerコントローラーのindexメソッドを呼びだす
// フォルダ、タスク一覧表示画面
Route::get('/folders/{id}/tasks', 'TaskController@index')->name('tasks.index');

// フォルダ作成画面表示
Route::get('/folders/create', 'FolderController@showCreateForm')->name('folders.create');
// フォルダ保存
Route::post('/folders/create', 'FolderController@create');

// タスク作成画面表示
Route::get('/folders/{id}/tasks/create', 'TaskController@showCreateForm')->name('tasks.create');
// タスク保存
Route::post('/folders/{id}/tasks/create', 'TaskController@create');

// タスク編集
Route::get('/folders/{id}/tasks/{task_id}/edit', 'TaskController@showEditForm')->name('tasks.edit');
// タスク編集保存
Route::post('/folders/{id}/tasks/{task_id}/edit', 'TaskController@edit');