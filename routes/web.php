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
Route::prefix('admin')->group(function(){
	Route::get('/login', 'Backend\LoginController@showLoginForm')->name('admin.login');
	Route::post('/login', 'Backend\LoginController@login')->name('admin.login.submit');
	Route::get('/logout', 'Backend\LoginController@logout')->name('admin.logout');
	Route::get('/', 'Backend\AdminController@index')->name('admin.dashboard');

	Route::get('/theloainhac/danhsach', 'Backend\TypeController@index')->name('admin.style.listing');
	Route::get('/theloainhac/taomoi', 'Backend\TypeController@create')->name('admin.style.addnew');
	Route::post('/theloainhac/store', 'Backend\TypeController@store')->name('admin.style.store');
	Route::post('/theloainhac/deleteAjax', 'Backend\TypeController@deleteAjax')->name('admin.style.delAjax');
	Route::get('/theloainhac/edit/{type_id}', 'Backend\TypeController@edit')->name('admin.style.edit');
	Route::post('/theloainhac/update/{type_id}', 'Backend\TypeController@update')->name('admin.style.update');

	Route::get('/casi/danhsach', 'Backend\SingerController@index')->name('admin.singer.listing');
	Route::get('/casi/taomoi', 'Backend\SingerController@create')->name('admin.singer.addnew');
	Route::post('/casi/store', 'Backend\SingerController@store')->name('admin.singer.store');
	Route::post('/casi/deleteAjax', 'Backend\SingerController@deleteAjax')->name('admin.singer.delAjax');
	Route::get('/casi/edit/{singer_id}', 'Backend\SingerController@edit')->name('admin.singer.edit');
	Route::post('/casi/update/{singer_id}', 'Backend\SingerController@update')->name('admin.singer.update');

	//Route::resource('album', 'Backend\AlbumController');
	Route::get('/album/index', 'Backend\AlbumController@index')->name('admin.album.index');
	Route::get('/album/create', 'Backend\AlbumController@create')->name('admin.album.create');
	Route::post('/album/store', 'Backend\AlbumController@store')->name('admin.album.store');
	Route::post('/album/deleteAjax', 'Backend\AlbumController@deleteAjax')->name('admin.album.delAjax');
	Route::get('/album/edit/{album_id}', 'Backend\AlbumController@edit')->name('admin.album.edit');
	Route::post('/album/update/{album_id}', 'Backend\AlbumController@update')->name('admin.album.update');

	Route::get('/beat/danhsach', 'Backend\ProductController@index')->name('admin.product.listing');
	Route::get('/beat/taomoi', 'Backend\ProductController@create')->name('admin.product.create');
	Route::post('/beat/store', 'Backend\ProductController@store')->name('admin.product.store');
	Route::post('/beat/deleteAjax', 'Backend\ProductController@deleteAjax')->name('admin.product.delAjax');
	Route::get('/beat/edit/{pid}', 'Backend\ProductController@edit')->name('admin.product.edit');
	Route::post('/beat/update/{product_id}', 'Backend\ProductController@update')->name('admin.product.update');
	Route::get('/beat/getAlbum/{albums}', 'Backend\ProductController@getAlbum')->name('admin.product.getAlbum');
	Route::post('/beat/search', 'Backend\ProductController@search')->name('admin.product.search');

	Route::get('/page/danhsach', 'Backend\PageController@index')->name('admin.page.listing');
	Route::get('/page/taomoi', 'Backend\PageController@create')->name('admin.page.create');
	Route::post('/page/store', 'Backend\PageController@store')->name('admin.page.store');
	Route::post('/page/deleteAjax', 'Backend\PageController@deleteAjax')->name('admin.page.delAjax');
	Route::get('/page/edit/{pid}', 'Backend\PageController@edit')->name('admin.page.edit');
	Route::post('/page/update/{pid}', 'Backend\PageController@update')->name('admin.page.update');
	Route::get('/page/getAlbum/{albums}', 'Backend\PageController@getAlbum')->name('admin.page.getAlbum');
});

Route::get('/', 'FrontendController@index')->name('home');
//Route::get('/test', 'FrontendController@test')->name('test');
Route::get('/beats', 'FrontendController@listBeat')->name('beats');
Route::get('/karaokes', 'FrontendController@listKaraoke')->name('karaokes');
Route::get('/search/{keyword}', 'FrontendController@listSearch')->name('search');
Route::post('/searching', 'FrontendController@searching')->name('searching');
Route::post('/listsearch', 'FrontendController@getListSearch')->name('listsearch');

Route::get('cart', 'CartController@index')->name('cart');
Route::delete('emptyCart', 'CartController@emptyCart');
Route::post('addCart', 'CartController@storeAjax')->name('cart.add');
Route::post('removeCart', 'CartController@removeCart')->name('cart.remove');
Route::get('/lien-he', 'FrontendController@pageContact')->name('page.lienhe');
Route::get('/dat-bai', 'FrontendController@pageDatbai')->name('page.datbai');
Route::get('{slug}', 'ProductController@detail')->name('detail');


Route::get('/singer/{slug}', 'FrontendController@singerDetail')->name('singer.detail');
Route::get('/album/{slug}', 'FrontendController@albumDetail')->name('album.detail');
Route::get('/genre/{slug}', 'FrontendController@genreDetail')->name('genre.detail');
Route::get('/page/{slug}', 'FrontendController@pageDetail')->name('page.detail');
Route::get('/page/dat-bai', 'FrontendController@pageDetail')->name('page.detail.datbai');
Route::get('/pages/singers', 'FrontendController@singers')->name('singer.listing');
Route::get('/pages/albums', 'FrontendController@albums')->name('album.listing');
Route::get('/pages/genres', 'FrontendController@genres')->name('genre.listing');


Route::post('/store/lien-he', 'FrontendController@storeContact')->name('page.store.lienhe');
Route::post('/store/dat-bai', 'FrontendController@storeDatbai')->name('page.store.datbai');
Route::post('/store/subscribe', 'FrontendController@storeSubscribe')->name('page.store.subscribe');
Route::get('/page/nap-the', 'FrontendController@pageDetail')->name('page.detail.napthe');

Auth::routes();
Route::get('account', 'AccountController@myAccount')->name('user.profile');
Route::get('/account/logout', 'Auth\LoginController@userLogout')->name('user.logout');
Route::get('checkout', 'CheckoutController@checkout')->name('checkout');
