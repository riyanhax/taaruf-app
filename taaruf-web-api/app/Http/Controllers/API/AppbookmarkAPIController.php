<?php

namespace App\Http\Controllers\API;

use App\Appusers;
use App\Slider;
use App\Banner;
use App\Blog;
use App\Page;
use \App\Clickatell;
use App\Repositories\SliderRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use DB;

/**
 * Class SliderController
 * @package App\Http\Controllers\API
 */

class AppbookmarkAPIController extends AppBaseController
{
	public function add(Request $request){

		$rules = array(
			'api_key'=>'required|max:100',
			'id_blog'=>'required|numeric'
		);

		$validator = Validator::make($request->all(), $rules);

		if($validator->passes()){

			$user = Appusers::where('remember_token',$request->input('api_key'))->first();

			if($user != null){

				$blog = Blog::where('id',$request->input('id_blog'))->first();

				if($blog != null){
          
					DB::table('bookmark_blog')->insert([
						'id_user'=>$user->id,
						'id_blog'=>$blog->id,
						'created_at'=> gmdate('Y-m-d H:i:s', time() + (60 * 60 * 7))
					]);

					$response = array(
						'message' => "blog bookmark added succesfully",
						'success' => true
					);
					return response($response);

				}else{

					$response = array(
						'message' => "invalid bookmark id",
						'success' => false
					);
					return response($response);
				}
				

			}else{

				$response = array(
				'success' => false,
				'message' => 'invalid api key'
				);

				return response($response);
			}


		}else{

			$response = array(
				'success' => false,
				'message' => 'invalid api key'
			);

			return response($response);
		}

	
	}

	public function delete(Request $request){

		$rules = array(
			'api_key'=>'required|max:100',
			'id_blog'=>'required|numeric'
		);

		$validator = Validator::make($request->all(), $rules);

		if($validator->passes()){

			$user = Appusers::where('remember_token',$request->input('api_key'))->first();

			if($user != null){

				$blog = Blog::where('id',$request->input('id_blog'))->first();

				if($blog != null){

					DB::table('bookmark_blog')->where('id_user','=',$user->id)->where('id_blog','=',$blog->id)->delete();

					$response = array(
						'message' => "blog bookmark deleted succesfully",
						'success' => true
					);
					return response($response);

				}else{

					$response = array(
						'message' => "invalid bookmark id",
						'success' => false
					);
					return response($response);
				}
				

			}else{

				$response = array(
				'success' => false,
				'message' => 'invalid api key'
				);

				return response($response);
			}


		}else{

			$response = array(
				'success' => false,
				'message' => 'invalid api key'
			);

			return response($response);
		}
	}



	public function addCalon(Request $request){

		$rules = array(
			'api_key'=>'required|max:100',
			'id_calon'=>'required|numeric'
		);

		$validator = Validator::make($request->all(), $rules);

		if($validator->passes()){

			$user = Appusers::where('remember_token',$request->input('api_key'))->first();

			if($user != null){

				$calon = Appusers::where('id',$request->input('id_calon'))->first();

				if($calon != null){
          
					DB::table('bookmark_calon')->insert([
						'id_user'=>$user->id,
						'id_calon'=>$calon->id,
						'created_at'=> gmdate('Y-m-d H:i:s', time() + (60 * 60 * 7))
					]);

					$response = array(
						'message' => "calon bookmark added succesfully",
						'success' => true
					);
					return response($response);

				}else{

					$response = array(
						'message' => "invalid bookmark id",
						'success' => false
					);
					return response($response);
				}
				

			}else{

				$response = array(
				'success' => false,
				'message' => 'invalid api key'
				);

				return response($response);
			}


		}else{

			$response = array(
				'success' => false,
				'message' => 'invalid api key'
			);

			return response($response);
		}

	}

	public function removeCalon(Request $request){

		$rules = array(
			'api_key'=>'required|max:100',
			'id_calon'=>'required|numeric'
		);

		$validator = Validator::make($request->all(), $rules);

		if($validator->passes()){

			$user = Appusers::where('remember_token',$request->input('api_key'))->first();

			if($user != null){

				$calon = Appusers::where('id',$request->input('id_calon'))->first();

				if($calon != null){

					DB::table('bookmark_calon')->where('id_user','=',$user->id)->where('id_calon','=',$calon->id)->delete();

					$response = array(
						'message' => "blog bookmark deleted succesfully",
						'success' => true
					);
					return response($response);

				}else{

					$response = array(
						'message' => "invalid bookmark id",
						'success' => false
					);
					return response($response);
				}
				

			}else{

				$response = array(
				'success' => false,
				'message' => 'invalid api key'
				);

				return response($response);
			}


		}else{

			$response = array(
				'success' => false,
				'message' => 'invalid api key'
			);

			return response($response);
		}

	}
}

