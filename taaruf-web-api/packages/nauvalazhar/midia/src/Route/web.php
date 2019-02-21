<?php
Route::group(['prefix' => config('midia.prefix', 'midia'), 'middleware' => 'web'], function() {
	Route::get('open/{editor?}', 'Nauvalazhar\Midia\Controller\MidiaController@open')->name('midia.open');
	Route::get('get/{limit?}', 'Nauvalazhar\Midia\Controller\MidiaController@index')->name('midia.get');
	Route::delete('{file}/delete', 'Nauvalazhar\Midia\Controller\MidiaController@delete')->name('midia.delete');
	Route::put('{file}/rename', 'Nauvalazhar\Midia\Controller\MidiaController@rename')->name('midia.rename');
	Route::post('upload', 'Nauvalazhar\Midia\Controller\MidiaController@upload')->name('midia.upload');
});

Route::get(config('midia.directory_name', 'media') . '/{filename}', function ($filename) {
  $path = config('midia.directory') . '/' . $filename;
  if(!File::exists($path)) return abort(404);

  $file = File::get($path);
  $type = File::mimeType($path);

  // resize
  $width = request()->width;
  $height = request()->height;

  if($width || $height) {
    if(!$width) $width = $height;
    if(!$height) $height = $width;

    $image = Image::make($path);
    $image->fit($width, $height);
    return $image->response();
  }

  $response = Response::make($file, 200);
  $response->header("Content-Type", $type);

  return $response;
})->where('filename','(.*)');