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
use App\CodeforcesStatus;
use App\InfoContest;

Route::get('/', function () {
    return view('index')->with('articles', Article::where('public', '=', true)->orderBy('updated_at', 'desc')->get());
});

Auth::routes();

Route::get('dashboard', function () {
    return view('dashboard')->with('articles', Article::where('user_id', '=', Auth::id())->orderBy('created_at', 'desc')->get())
                            ->with('snippets', Snippet::where('user_id', '=', Auth::id())->orderBy('created_at', 'desc')->get())
                            ->with('statuses', CodeforcesStatus::where('handle', '=', Auth::user()->handle)->get());
});

Route::group(['prefix' => 'oj', 'namespace' => 'OJ'], function () {
    Route::get('/', function () {
        return view('building');
    });
    Route::get('/submission', function () {
        return view('building');
    });
    Route::resource('problem', 'ProblemController');
});

Route::post('user/{id}/role', 'UserController@addRole');
Route::delete('user/{id}/role', 'UserController@deleteRole');

Route::resource('user', 'UserController');
Route::resource('article', 'ArticleController');
Route::resource('comment', 'CommentController');
Route::resource('blog', 'BlogController');
Route::resource('pastebin', 'PastebinController');
Route::resource('report', 'ReportController');
Route::get('contest', function () {
    return view('contest')->with('contests', InfoContest::filter());
});
Route::resource('onsite', 'OnsiteContestController');
Route::resource('onsite/{id}/register', 'OnlineContestRegistrantController');
Route::resource('problem', 'ProblemController');
Route::get('/print', function() {
    return view('print');
});

Route::get('/storage/*', function () {
    return 'hah';
});

Route::get('/storage/problem/{id}/{file}', function ($id, $file) {
    return view('raw')->with('content', file_get_contents(storage_path() . '/app/public/problem/' . $id . '/' . $file));
});
