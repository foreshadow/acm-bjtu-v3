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

Route::get('/', function () {
    return App::make('App\Http\Controllers\RootController')->getIndex();
});

Auth::routes();

Route::group(['prefix' => 'oj', 'namespace' => 'OJ'], function () {
    Route::get('/', function () {
        return view('building');
    });
    Route::get('/submission', function () {
        return view('building');
    });
    Route::resource('problem', 'ProblemController');
});

Route::resource('user', 'UserController');
Route::post('user/{id}/role', 'UserController@addRole');
Route::delete('user/{id}/role', 'UserController@deleteRole');

Route::resource('article', 'ArticleController');
Route::resource('comment', 'CommentController');
Route::resource('blog', 'BlogController');
Route::resource('pastebin', 'PastebinController');
Route::resource('report', 'ReportController');
Route::resource('onsite', 'OnsiteContestController');
Route::resource('onsite/{id}/register', 'OnlineContestRegistrantController');
Route::resource('problem', 'ProblemController');

Route::get('/storage/{path}', function ($path) {
    return response()->file(storage_path() . '/app/public/' . $path);

})->where('path', '.+');

Route::get('/code/{path}', function ($path) {
    return view('raw')->with('content', file_get_contents(storage_path() . '/app/public/' . $path));
})->where('path', '.+');

/*
 * Automatic route, Route::controller is deprecated in laravel 5.3
 */
Route::get('/{action}', function ($action) {
    return response(App::make('App\Http\Controllers\RootController')->{'get' . $action}());
});
