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
use \App\Onesignal;
use Image;
use \App\ProfileData;

/**
 * Class SliderController
 * @package App\Http\Controllers\API
 */

class AppprofileAPIController extends AppBaseController
{

	public function update(Request $request){

		$data = $request->json()->all();

		if(isset($data['api_key'])){

			$user = Appusers::where('remember_token',$request->input('api_key'))->first();

			if($user != null){
				//update email and hp
				if($data['email'] != $user->email){
					Appusers::where('id',$user->id)->update(['email'=>$data['email']]);
				} 

				if($data['no_hp'] != $user->no_hp){
					Appusers::where('id',$user->id)->update(['email'=>$data['email']]);
				}


		    	if (strlen($data['profileData']['foto']) > 50 ){
				   	$png_url = time()."_".str_random(15).".png";
					$path = public_path().'/profile_pic/' . $png_url;
					Image::make(file_get_contents($data['profileData']['foto']))->save($path);
					$data['profileData']['foto'] = $png_url;
				}




				DB::table('profiles')
				->where('id_user',$user->id)
				->update($data['profileData']);

				DB::table('profiles_hidden_status')
				->where('id_user',$user->id)
				->update($data['hidden_status']);


				Appusers::where('id',$user->id)->update(['verified'=>'true']);					

				$appuser = DB::table('appusers')->where('id',$user->id)->first();

				$appuser->kriteria = DB::table('profiles')
				->select(
					'max_anak',
					'max_usia',
					'min_usia',
					'kriteria_afiliasi_keagamaan',
					'pendidikan_minimal',
					'kriteria_status',
					'minimum_penghasilan',
					'min_tinggi',
					'max_tinggi',
					'min_berat',
					'max_berat'
				)->where('id_user',$user->id)->first();

				$response = array(
				'success' => true,
				'message' => 'succesfly updated',
				'profile'=>$appuser	
				);

				return response($response);

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

