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

Route::group(['middleware' => 'localization', 'prefix' => Session::get('locale')], function () {
    $this->get('/trang-chu', 'HomeController@index')->name('home');
    Route::post('/lang', [
        'as' => 'switchLang',
        'uses' => 'LangController@postLang',
    ]);
    Route::get('/', function () { return view('sites.home'); });
	Route::get('/news', function()
	{
	   return View::make('sites.news');
	});
});
Auth::routes();

/*
 * --------------------------------------------------------------------------
 *                          ROUTE For ADMIN
 * --------------------------------------------------------------------------
 */
Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {
	Route::get('/', function () { return view('admin/dashboard'); });
	//news
	Route::resource('news','admin\NewsController');
	Route::patch('/news/{id}', 'admin\NewsController@update');
});


