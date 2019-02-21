<?php

namespace App\Http\Controllers\API;

use App\Appusers;
use \App\Clickatell;
use App\Repositories\SliderRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Support\Facades\Validator;
use DB;
use \App\ProfileData;

/**
 * Class SliderController
 * @package App\Http\Controllers\API
 */

class AppauthAPIController extends AppBaseController
{

	public function login(Request $request){

		if($request->input('mobile') != null ){
			$user = Appusers::where('no_hp',$request->input('mobile'))->first();
		}else if($request->input('email') != null) {
			$user = Appusers::where('email',$request->input('email'))->first();
		}


		if($user !== null){

			$code = mt_rand(1000, 9999);
			Appusers::find($user->id)->update(['otp_code'=>$code]);

			$otp = new Clickatell();
			//echo $user->no_hp;
			$result = $otp->sendSMS($user->no_hp, $code);

			$response = array(
				'message'=>'otp sent',
				'success'=>true,
				'data'=> array('email'=>$user->email,'no_hp'=>$user->no_hp),
				'code'=>$code,
				'sms' => $result
			);

			return response($response);

		}else{

			return response(array('success'=>false,'message'=>'Parameters failed'));	

		}

	}


	public function otpVerify(Request $request){
		
		$rules = array(
			'email'=>'email',
		);

		$validator = Validator::make($request->all(), $rules);

		if($validator->passes()){

			$user = Appusers::where('email',$request->input('email'))->first();
	
			if($user != null){
				if($user->otp_code == $request->input('code')){
						

					do {
		                $api_key = str_random(100);
	            	}while(Appusers::where("remember_token", "=", $api_key)->first() instanceof Appusers);


					Appusers::where('email',$request->input('email'))->update([
						'remember_token'=>$api_key,
						'otp_code' => null
					]);

					$user = Appusers::where('email',$request->input('email'))->first();

					$user->kriteria = DB::table('profiles')->select('min_usia','max_usia','kriteria_afiliasi_keagamaan','pendidikan_minimal','kriteria_status','minimum_penghasilan','min_tinggi','max_tinggi','min_berat','max_berat')->where('id_user',$user->id)->first();

					$response = array (
						'success'=>true,
						'data'=>$user->toArray(),
						'message'=>'otp code valid'
					);
					return response($response);
				}else{
					$response = array (
						'success'=>false,
						'message'=>'code yang anda masukan salah'
					);
					return response($response);
				}
			}

		}else{
			$response = array (
							'success'=>false,
							'message'=>'invalid parameters'
						);

			return response($response);
		}

	}

	public function register(Request $request){

		$rules = array(
			'email'=>'required|email',
			'gender'=>'required|max:1',
			'no_hp'=>'required|numeric'
		);

		$validator = Validator::make($request->all(), $rules);

		if($validator->passes()){

			$checkEmail = Appusers::where('email',$request->input('email'))->first();
			$checkNumber = Appusers::where('no_hp',$request->input('no_hp'))->first();
			$error = array();

			if($checkEmail != null){
				array_push($error, "Email telah terdaftar");
			}
			if($checkNumber != null){
				array_push($error, "Nomor Handphone telah terdaftar");
			}

			if(count($error) < 1){

				$code = mt_rand(1000, 9999);

				$reg = new Appusers;
				$reg->email = $request->input('email');
				$reg->gender = $request->input('gender');
				$reg->no_hp = $request->input('no_hp');
				$reg->otp_code = $code;
				$reg->save();


				DB::table('profiles')->insert([
					'id_user'=>$reg->id
				]);

				DB::table('profiles_hidden_status')->insert([
					'id_user'=>$reg->id,
					'nama_asli'=> 1,	
					'nama_jalan_ktp'	=> 1,
					'ktp_rtrw'	=> 1,
					'ktp_kelurahan'	=> 1,
					'ktp_kecamatan'	=> 1,
					'tinggal_nama_jalan'	=> 1,
					'tinggal_rtrw'	=> 1,
					'tinggal_kelurahan'	=> 1,
					'tinggal_kecamatan'	=> 1,
					'tinggal_kotakab'	=> 1,
					'tinggal_provinsi'	=> 1,
					'tinggal_kodepos'=> 1
				]);

				/*$fields = DB::table('field_profile')->get();
				foreach ($fields as $key => $field) {
					DB::table('profile_data')->insert([
						'id_field_profile'=> $field->id,
						'id_user'=>$reg->id
					]);

					if($field->can_hidden == 'true'){
						DB::table('profile_data_hidden_status')->insert([
							'id_user'=>$reg->id,
							'id_field_profile'=>$field->id
						]);
					}
				} */
				$otp = new Clickatell();
				$otp->sendSMS($reg->no_hp, $code);

				$response = array(
					'success'=> true,
					'data'=> array('email'=>$reg->email, 'no_hp'=>$reg->no_hp),
					'message'=> 'register success',
					'code'=>$code
				);

				return response($response);

			}else{
				$response = array (
							'success'=>false,
							'error'=>$error,
							'message'=>'some used'
						);
				return response($response);
			}

		}else{

			$response = array (
							'success'=>false,
							'message'=>'invalid parameters'
						);
			return response($response);

		}

	}

	public function logout(Request $request){
		$rules = array(
			'api_key'=>'required|max:100'
		);

		$validator = Validator::make($request->all(), $rules);

		if($validator->passes()){

			$user = Appusers::where('remember_token',$request->input('api_key'))->first();

			if($user != null){

				Appusers::where('id', $user->id)->update([
					'remember_token' => null,
					'device_id' => null
				]);
				
				$response = array(
					'success' => true,
					'message' => 'token removed, logout done',
					'logout' => true
				);

				return response($response);	

			}else{

				$response = array(
				'success' => false,
				'message' => 'api_key not found',
				'logout' => true
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

	public function savedeviceid(Request $request){
		$rules = array(
			'api_key'=>'required|max:100',
			'device_id'=>'required'
		);

		$validator = Validator::make($request->all(), $rules);

		if($validator->passes()){

			$user = Appusers::where('remember_token',$request->input('api_key'))->first();

			if($user != null){

				Appusers::where('id', $user->id)->update([
					'device_id' => $request->input('device_id')
				]);
				
				$response = array(
					'success' => true,
					'message' => 'device id saved',
				);

				return response($response);	

			}else{

				$response = array(
				'success' => false,
				'message' => 'api_key not found',
				'logout' => true
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





	/*
    public function makeotp(Request $request){
    	$response = array();
	    
	    $userId = Auth::user()->id;

	    $users = User::where('id', $userId)->first();

	    if ( isset($users['mobile']) && $users['mobile'] =="" ) {
	        $response['error'] = 1; 
	        $response['message'] = 'Invalid mobile number';
	        $response['loggedIn'] = 1;
	    } else {

	        $otp = rand(1000, 9999);
	        $MSG91 = new MSG91();

	        $msg91Response = $MSG91->sendSMS($otp,$users['mobile']);

	        if($msg91Response['error']){
	            $response['error'] = 1;
	            $response['message'] = $msg91Response['message'];
	            $response['loggedIn'] = 1;
	        }else{

	            Session::put('OTP', $otp);

	            $response['error'] = 0;
	            $response['message'] = 'Your OTP is created.';
	            $response['OTP'] = $otp;
	            $response['loggedIn'] = 1; 
	        }
	    }
	    echo json_encode($response);
	}

	*/
}



