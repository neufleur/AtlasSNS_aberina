<?php

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
// Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();
//getはログインページを表示するだけの処理　
//postは実際にmailやpasswordを入力してログインする処理

//ログアウト中のページ

Route::get('/login', 'Auth\LoginController@login');
Route::post('/login', 'Auth\LoginController@login');

Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added');
Route::post('/added', 'Auth\RegisterController@added');

Route::group(['middleware' => 'auth'], function() {
//アクセス制限をかけるmiddleware

Route::get('/top','PostsController@index'); //投稿を表示
Route::post('/posts','PostsController@create'); //投稿内容を入力　送る

Route::get('/post/{id}/update-Form','PostsController@updateForm'); // 編集ページ表示
Route::post('/post/{id}/update-Form','PostsController@updateForm'); //

Route::get('/post/update','PostsController@update'); // 反映させる

Route::get('/post/{id}/delete','PostsController@delete'); //削除

Route::get('/profile','UsersController@profile');
Route::post('/profile','UsersController@profile');
Route::post('/profile/update','UsersController@updateProfile');

Route::get('/search','UsersController@search');
Route::post('/search','UsersController@search');
//検索用のRoute作る

//フォロー解除
Route::post('/users/{user}/unFollow','FollowsController@unFollow')->name('unFollow');
//フォロー
Route::post('/users/{user}/Follow','FollowsController@Follow')->name('Follow');

//フォローリスト
Route::get('/follow-list','FollowsController@followList');
Route::post('/follow-list','FollowsController@followList');

Route::get('/follower-list','PostsController@index');

});

//authというミドルウェアは、ユーザがログインしているかどうかを確認できるミドルウェアです。
//送られてきたデータが、指定された条件を満たしているかをチェックしてルーティングを制限するものです。