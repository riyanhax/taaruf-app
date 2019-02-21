<?php
function title($title) {
	if(!isset($title) || $title == false) {
		$title = ucwords(str_replace([config('app.backend'), '/'], '', request()->path()));
	}

	$title .= ' &mdash; ' . config('app.name');

	return $title;
}

function modules($path="/") {
	return url("modules/" . $path);
}

function img($path='/') {
	return url('img/' . $path);
}

function user() {
	return Auth::user();
}

if( !function_exists('response_json') ) {
	/**
	 * Return preformated JSON response.
	 *
	 * @return string.
	 */

	 function response_json($data = [], $code = 200, $options = JSON_PRETTY_PRINT) {
		 	$data['error'] = ($code != 200) ? true : false;
			$data['status'] = [
					'status_code' => $code,
					'status_message' => http_status_code($code)
			];
			$data['trace_id'] = str_random(15);
			return response()->json($data, $code, [], $options);
	 }
}

if( !function_exists('http_status_code') ) {
		/**
		 * Return the HTTP Status Code message.
		 *
		 * @param int $code.
		 * @return string.
		 */

		 function http_status_code($code) {
			 		switch ($code) {
              case 100: $text = 'Continue'; break;
              case 101: $text = 'Switching Protocols'; break;
              case 200: $text = 'OK'; break;
              case 201: $text = 'Created'; break;
              case 202: $text = 'Accepted'; break;
              case 203: $text = 'Non-Authoritative Information'; break;
              case 204: $text = 'No Content'; break;
              case 205: $text = 'Reset Content'; break;
              case 206: $text = 'Partial Content'; break;
              case 300: $text = 'Multiple Choices'; break;
              case 301: $text = 'Moved Permanently'; break;
              case 302: $text = 'Moved Temporarily'; break;
              case 303: $text = 'See Other'; break;
              case 304: $text = 'Not Modified'; break;
              case 305: $text = 'Use Proxy'; break;
              case 400: $text = 'Bad Request'; break;
              case 401: $text = 'Unauthorized'; break;
              case 402: $text = 'Payment Required'; break;
              case 403: $text = 'Forbidden'; break;
              case 404: $text = 'Not Found'; break;
              case 405: $text = 'Method Not Allowed'; break;
              case 406: $text = 'Not Acceptable'; break;
              case 407: $text = 'Proxy Authentication Required'; break;
              case 408: $text = 'Request Time-out'; break;
              case 409: $text = 'Conflict'; break;
              case 410: $text = 'Gone'; break;
              case 411: $text = 'Length Required'; break;
              case 412: $text = 'Precondition Failed'; break;
              case 413: $text = 'Request Entity Too Large'; break;
              case 414: $text = 'Request-URI Too Large'; break;
              case 415: $text = 'Unsupported Media Type'; break;
              case 500: $text = 'Internal Server Error'; break;
              case 501: $text = 'Not Implemented'; break;
              case 502: $text = 'Bad Gateway'; break;
              case 503: $text = 'Service Unavailable'; break;
              case 504: $text = 'Gateway Time-out'; break;
              case 505: $text = 'HTTP Version not supported'; break;
              default:
                  $text = 'Unknown http status code ';
              break;
          }

					return $text;
		 }
}

function slugify($text) {
	// replace non letter or digits by -
	$text = preg_replace('~[^\pL\d]+~u', '-', $text);

	// transliterate
	$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

	// remove unwanted characters
	$text = preg_replace('~[^-\w]+~', '', $text);

	// trim
	$text = trim($text, '-');

	// remove duplicate -
	$text = preg_replace('~-+~', '-', $text);

	// lowercase
	$text = strtolower($text);

	if (empty($text)) {
	return 'n-a';
	}

	return $text;
}


function myjson_decode($json) {
	$json = preg_replace(['/\\\+/', '/""+/'], [''], $json);
	$json = ltrim($json, '"');
	$json = rtrim($json, '"');
	$json = json_decode($json);
	return $json;
}
