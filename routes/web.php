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

//Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => 'locale'], function () {
	Route::get('change-language/{language}', 'HomeController@changeLanguage')
		->name('user.change-language');
	Route::get('/', function () {
		return view('sites.home');
	});
	Route::get('/news', function () {
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
	Route::get('/', function () {
		return view('admin/dashboard');
	});
	//news
	Route::resource('news', 'admin\NewsController');
	Route::patch('/news/{id}', 'admin\NewsController@update');
	//support
	Route::resource('support', 'admin\SupportController');
	Route::patch('/support/{id}', 'admin\SupportController@update');
	//store address
	Route::resource('storeAddress', 'admin\StoreAddressController');
	Route::patch('/storeAddress/{id}', 'admin\StoreAddressController@update');
	//connector nhà môi giới
	Route::resource('connector', 'admin\ConnectorController');
	Route::patch('/connector/{id}', 'admin\ConnectorController@update');
});
