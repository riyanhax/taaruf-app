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
	if(Auth::guest()){
		return redirect()->route('login');
	}else{
		return redirect()->route('home');
	}
});

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
	Route::get('/home', 'HomeController@index')->name('home');

	Route::group(['prefix' => 'backend', 'middleware' => ['auth', 'web']], function() {
		Route::get('backend/users', ['as'=> 'backend.users.index', 'uses' => 'UserController@index']);
		Route::get('/', ['as' => 'backend', 'uses' => 'HomeController@index']);
		Route::post('backend/users', ['as'=> 'backend.users.store', 'uses' => 'UserController@store']);
		Route::get('backend/users/create', ['as'=> 'backend.users.create', 'uses' => 'UserController@create']);
		Route::put('backend/users/{users}', ['as'=> 'backend.users.update', 'uses' => 'UserController@update']);
		Route::patch('backend/users/{users}', ['as'=> 'backend.users.update', 'uses' => 'UserController@update']);
		Route::delete('backend/users/{users}', ['as'=> 'backend.users.destroy', 'uses' => 'UserController@destroy']);
		Route::get('backend/users/{users}', ['as'=> 'backend.users.show', 'uses' => 'UserController@show']);
		Route::get('backend/users/{users}/edit', ['as'=> 'backend.users.edit', 'uses' => 'UserController@edit']);
	});


	Route::get('backend/kotaTaarufs', ['as'=> 'backend.kotaTaarufs.index', 'uses' => 'KotaTaarufController@index']);
	Route::post('backend/kotaTaarufs', ['as'=> 'backend.kotaTaarufs.store', 'uses' => 'KotaTaarufController@store']);
	Route::get('backend/kotaTaarufs/create', ['as'=> 'backend.kotaTaarufs.create', 'uses' => 'KotaTaarufController@create']);
	Route::put('backend/kotaTaarufs/{kotaTaarufs}', ['as'=> 'backend.kotaTaarufs.update', 'uses' => 'KotaTaarufController@update']);
	Route::patch('backend/kotaTaarufs/{kotaTaarufs}', ['as'=> 'backend.kotaTaarufs.update', 'uses' => 'KotaTaarufController@update']);
	Route::delete('backend/kotaTaarufs/{kotaTaarufs}', ['as'=> 'backend.kotaTaarufs.destroy', 'uses' => 'KotaTaarufController@destroy']);
	Route::get('backend/kotaTaarufs/{kotaTaarufs}', ['as'=> 'backend.kotaTaarufs.show', 'uses' => 'KotaTaarufController@show']);
	Route::get('backend/kotaTaarufs/{kotaTaarufs}/edit', ['as'=> 'backend.kotaTaarufs.edit', 'uses' => 'KotaTaarufController@edit']);


	Route::get('backend/kotaTaarufs', ['as'=> 'backend.kotaTaarufs.index', 'uses' => 'KotaTaarufController@index']);
	Route::post('backend/kotaTaarufs', ['as'=> 'backend.kotaTaarufs.store', 'uses' => 'KotaTaarufController@store']);
	Route::get('backend/kotaTaarufs/create', ['as'=> 'backend.kotaTaarufs.create', 'uses' => 'KotaTaarufController@create']);
	Route::put('backend/kotaTaarufs/{kotaTaarufs}', ['as'=> 'backend.kotaTaarufs.update', 'uses' => 'KotaTaarufController@update']);
	Route::patch('backend/kotaTaarufs/{kotaTaarufs}', ['as'=> 'backend.kotaTaarufs.update', 'uses' => 'KotaTaarufController@update']);
	Route::delete('backend/kotaTaarufs/{kotaTaarufs}', ['as'=> 'backend.kotaTaarufs.destroy', 'uses' => 'KotaTaarufController@destroy']);
	Route::get('backend/kotaTaarufs/{kotaTaarufs}', ['as'=> 'backend.kotaTaarufs.show', 'uses' => 'KotaTaarufController@show']);
	Route::get('backend/kotaTaarufs/{kotaTaarufs}/edit', ['as'=> 'backend.kotaTaarufs.edit', 'uses' => 'KotaTaarufController@edit']);


	Route::get('backend/blogs', ['as'=> 'backend.blogs.index', 'uses' => 'BlogController@index']);
	Route::post('backend/blogs', ['as'=> 'backend.blogs.store', 'uses' => 'BlogController@store']);
	Route::get('backend/blogs/create', ['as'=> 'backend.blogs.create', 'uses' => 'BlogController@create']);
	Route::put('backend/blogs/{blogs}', ['as'=> 'backend.blogs.update', 'uses' => 'BlogController@update']);
	Route::patch('backend/blogs/{blogs}', ['as'=> 'backend.blogs.update', 'uses' => 'BlogController@update']);
	Route::delete('backend/blogs/{blogs}', ['as'=> 'backend.blogs.destroy', 'uses' => 'BlogController@destroy']);
	Route::get('backend/blogs/{blogs}', ['as'=> 'backend.blogs.show', 'uses' => 'BlogController@show']);
	Route::get('backend/blogs/{blogs}/edit', ['as'=> 'backend.blogs.edit', 'uses' => 'BlogController@edit']);


	Route::get('backend/banners', ['as'=> 'backend.banners.index', 'uses' => 'BannerController@index']);
	Route::post('backend/banners', ['as'=> 'backend.banners.store', 'uses' => 'BannerController@store']);
	Route::get('backend/banners/create', ['as'=> 'backend.banners.create', 'uses' => 'BannerController@create']);
	Route::put('backend/banners/{banners}', ['as'=> 'backend.banners.update', 'uses' => 'BannerController@update']);
	Route::patch('backend/banners/{banners}', ['as'=> 'backend.banners.update', 'uses' => 'BannerController@update']);
	Route::delete('backend/banners/{banners}', ['as'=> 'backend.banners.destroy', 'uses' => 'BannerController@destroy']);
	Route::get('backend/banners/{banners}', ['as'=> 'backend.banners.show', 'uses' => 'BannerController@show']);
	Route::get('backend/banners/{banners}/edit', ['as'=> 'backend.banners.edit', 'uses' => 'BannerController@edit']);


	Route::get('backend/sliders', ['as'=> 'backend.sliders.index', 'uses' => 'SliderController@index']);
	Route::post('backend/sliders', ['as'=> 'backend.sliders.store', 'uses' => 'SliderController@store']);
	Route::get('backend/sliders/create', ['as'=> 'backend.sliders.create', 'uses' => 'SliderController@create']);
	Route::put('backend/sliders/{sliders}', ['as'=> 'backend.sliders.update', 'uses' => 'SliderController@update']);
	Route::patch('backend/sliders/{sliders}', ['as'=> 'backend.sliders.update', 'uses' => 'SliderController@update']);
	Route::delete('backend/sliders/{sliders}', ['as'=> 'backend.sliders.destroy', 'uses' => 'SliderController@destroy']);
	Route::get('backend/sliders/{sliders}', ['as'=> 'backend.sliders.show', 'uses' => 'SliderController@show']);
	Route::get('backend/sliders/{sliders}/edit', ['as'=> 'backend.sliders.edit', 'uses' => 'SliderController@edit']);

	Route::get('backend/mediaManager', 'MediaManagerController@index')->name('backend.mediaManager.index');

	Route::get('backend/pages', ['as'=> 'backend.pages.index', 'uses' => 'PageController@index']);
	Route::post('backend/pages', ['as'=> 'backend.pages.store', 'uses' => 'PageController@store']);
	Route::get('backend/pages/create', ['as'=> 'backend.pages.create', 'uses' => 'PageController@create']);
	Route::put('backend/pages/{pages}', ['as'=> 'backend.pages.update', 'uses' => 'PageController@update']);
	Route::patch('backend/pages/{pages}', ['as'=> 'backend.pages.update', 'uses' => 'PageController@update']);
	Route::delete('backend/pages/{pages}', ['as'=> 'backend.pages.destroy', 'uses' => 'PageController@destroy']);
	Route::get('backend/pages/{pages}', ['as'=> 'backend.pages.show', 'uses' => 'PageController@show']);
	Route::get('backend/pages/{pages}/edit', ['as'=> 'backend.pages.edit', 'uses' => 'PageController@edit']);

	// Administrative
	Route::get('backend/administrative/city/{province_id}', function($province_id) {
		return response(Administrative::city($province_id));
	})->name('get.city');

	Route::get('backend/administrative/subdistrict/{city_id}', function($city_id) {
		return response(Administrative::subdistrict($city_id));
	})->name('get.subdistrict');

	Route::get('backend/proposals', ['as'=> 'backend.proposals.index', 'uses' => 'ProposalController@index']);
	Route::post('backend/proposals', ['as'=> 'backend.proposals.store', 'uses' => 'ProposalController@store']);
	Route::get('backend/proposals/create', ['as'=> 'backend.proposals.create', 'uses' => 'ProposalController@create']);
	Route::put('backend/proposals/{proposals}', ['as'=> 'backend.proposals.update', 'uses' => 'ProposalController@update']);
	Route::patch('backend/proposals/{proposals}', ['as'=> 'backend.proposals.update', 'uses' => 'ProposalController@update']);
	Route::delete('backend/proposals/{proposals}', ['as'=> 'backend.proposals.destroy', 'uses' => 'ProposalController@destroy']);
	Route::get('backend/proposals/{proposals}', ['as'=> 'backend.proposals.show', 'uses' => 'ProposalController@show']);
	Route::get('backend/proposals/{proposals}/edit', ['as'=> 'backend.proposals.edit', 'uses' => 'ProposalController@edit']);


	Route::get('backend/appusers', ['as'=> 'backend.appusers.index', 'uses' => 'AppusersController@index']);
	Route::post('backend/appusers', ['as'=> 'backend.appusers.store', 'uses' => 'AppusersController@store']);
	Route::get('backend/appusers/create', ['as'=> 'backend.appusers.create', 'uses' => 'AppusersController@create']);
	Route::put('backend/appusers/{appusers}', ['as'=> 'backend.appusers.update', 'uses' => 'AppusersController@update']);
	Route::patch('backend/appusers/{appusers}', ['as'=> 'backend.appusers.update', 'uses' => 'AppusersController@update']);
	Route::delete('backend/appusers/{appusers}', ['as'=> 'backend.appusers.destroy', 'uses' => 'AppusersController@destroy']);
	Route::get('backend/appusers/{appusers}', ['as'=> 'backend.appusers.show', 'uses' => 'AppusersController@show']);
	Route::get('backend/appusers/{appusers}/edit', ['as'=> 'backend.appusers.edit', 'uses' => 'AppusersController@edit']);

});







