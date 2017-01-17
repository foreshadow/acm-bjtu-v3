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

use App\Article;
use App\Snippet;

Route::get('/', function () {
    return view('index')->with('articles', Article::where('public', '=', true)->get());
});

Auth::routes();

Route::get('dashboard', function () {
    return view('dashboard')->with('articles', Article::where('user_id', '=', Auth::id())->orderBy('created_at', 'desc')->get())
                            ->with('snippets', Snippet::where('user_id', '=', Auth::id())->orderBy('created_at', 'desc')->get());
});

Route::group(['prefix' => 'oj', 'namespace' => 'OJ'], function () {
    Route::resource('problem', 'ProblemController');
});

Route::resource('user', 'UserController');
Route::resource('article', 'ArticleController');
Route::resource('pastebin', 'PastebinController');
Route::resource('report', 'ReportController');