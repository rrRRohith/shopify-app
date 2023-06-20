<?php

use Illuminate\Support\Facades\Route;
use App\Models\Page;
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
Route::group(['middleware' => ['auth']], function () {
	Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home');

    Route::resource('/shops', 'App\Http\Controllers\ShopController');
    Route::get('/shops/{shop}/delete', 'App\Http\Controllers\ShopController@destroy')->name('shops.delete');
    Route::get('/shops/{shop}/login', 'App\Http\Controllers\ShopController@login')->name('shops.login');

    Route::resource('/pages', 'App\Http\Controllers\PageController')->middleware('shop');
    Route::get('/page/{page}/delete', 'App\Http\Controllers\PageController@destroy')->name('pages.delete')->middleware('shop');
    Route::post('/page/{page}/save', 'App\Http\Controllers\PageController@save')->name('pages.save')->middleware('shop');

    Route::post('/page/{page}/image', 'App\Http\Controllers\PageController@image')->name('pages.image')->middleware('shop');

    Route::get('/page/{page}/duplicate', 'App\Http\Controllers\PageController@duplicate')->name('pages.duplicate')->middleware('shop');
    Route::post('/page/{page}/duplicate', 'App\Http\Controllers\PageController@saveDuplicate')->name('pages.duplicate.save')->middleware('shop');
});

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
]);
Route::get('/logout', function () {
    \Auth::logout();
    \Session::flush();
	return redirect('/');
})->name('logout');