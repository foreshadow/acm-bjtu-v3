<?php
use App\Article;

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
    return view('index')->with('articles', App\Article::all());
});

Auth::routes();

Route::get('dashboard', function () {
    return view('dashboard')->with('articles', App\Article::where('user_id', '=', \Auth::id())->orderBy('created_at', 'desc')->get())
                            ->with('snippets', App\Snippet::where('user_id', '=', \Auth::id())->orderBy('created_at', 'desc')->get());
});

Route::group(['prefix' => 'oj', 'namespace' => 'OJ'], function () {
    Route::resource('problem', 'ProblemController');
});

Route::resource('user', 'UserController');
Route::resource('article', 'ArticleController');
Route::resource('pastebin', 'PastebinController');
Route::resource('report', 'ReportController');
