<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => config('app.api_version', 'v1'), 'middleware' => ['api']], function(){
	// administrative
	Route::get('administrative/search', function() {
		$q = request()->query()['query'];
		$subdistrict = App\Subdistrict::where(function($query) use($q) {
			$query = $query->orWhere('subdistrict_name', 'like', '%' . $q . '%');
		});

		$subdistrict = $subdistrict->take(10)->get();

		$data = $subdistrict;

		$output = [];
		foreach($data as $s) {
			$output[] = [
				'id' => $s->id,
				'name' => $s->city->province->province . ' > ' . $s->city->city_name . ' > ' . $s->subdistrict_name,
				'subdistrict' => $s,
				'city' => $s->city,
				'province' => $s->city->province
			];
		}

		return response($output);
	});
});

Route::get('backend/sliders', 'SliderAPIController@index');
Route::post('backend/sliders', 'SliderAPIController@store');
Route::get('backend/sliders/{sliders}', 'SliderAPIController@show');
Route::put('backend/sliders/{sliders}', 'SliderAPIController@update');
Route::patch('backend/sliders/{sliders}', 'SliderAPIController@update');
Route::delete('backend/sliders{sliders}', 'SliderAPIController@destroy');

Route::get('backend/pages', 'PageAPIController@index');
Route::post('backend/pages', 'PageAPIController@store');
Route::get('backend/pages/{pages}', 'PageAPIController@show');
Route::put('backend/pages/{pages}', 'PageAPIController@update');
Route::patch('backend/pages/{pages}', 'PageAPIController@update');
Route::delete('backend/pages{pages}', 'PageAPIController@destroy');


//Android APP Authentication API
Route::get('appauth/login','AppauthAPIController@login');
Route::get('appauth/register','AppauthAPIController@register');
Route::get('appauth/otpVerify','AppauthAPIController@otpVerify');
Route::get('appauth/logout','AppauthAPIController@logout');
Route::get('appauth/savedeviceid','AppauthAPIController@savedeviceid');




//app content
Route::get('appcontent/homepage','AppcontentAPIController@homepage');
Route::get('appcontent/aboutpage','AppcontentAPIController@aboutpage');
Route::get('appcontent/blogpage','AppcontentAPIController@blogpage');
Route::get('appcontent/bookmarkpage','AppcontentAPIController@bookmarkpage');
Route::get('appcontent/listpage','AppcontentAPIController@listpage');
Route::get('appcontent/profilepage','AppcontentAPIController@profilepage');
Route::get('appcontent/calonpage','AppcontentAPIController@calonpage');
Route::get('appcontent/citypage','AppcontentAPIController@citypage');
Route::post('search','AppcontentAPIController@searchpage');

//blog bookmark action
Route::get('appbookmark/add','AppbookmarkAPIController@add');
Route::get('appbookmark/delete','AppbookmarkAPIController@delete');
Route::get('appbookmark/addCalon','AppbookmarkAPIController@addCalon');
Route::get('appbookmark/removeCalon','AppbookmarkAPIController@removeCalon');

Route::get('appproposal/kirim','AppproposalAPIController@kirim');
Route::get('appproposal/sentlist','AppproposalAPIController@sentlist');
Route::get('appproposal/receivedlist','AppproposalAPIController@receivedlist');
Route::get('appproposal/read','AppproposalAPIController@read');
Route::get('appproposal/balas','AppproposalAPIController@balas');

Route::post('appprofile/update','AppprofileAPIController@update');

//Route::get('test','AppcontentAPIController@testquery');












