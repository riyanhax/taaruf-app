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

/**
 * Class SliderController
 * @package App\Http\Controllers\API
 */

class AppproposalAPIController extends AppBaseController
{

	public function kirim(Request $request){

		$rules = array(
			'api_key'=>'required|max:100',
			'isi_proposal'=>'required',
			'id_penerima'=>'required|numeric'
		);

		$validator = Validator::make($request->all(), $rules);

		if($validator->passes()){

			$user = Appusers::where('remember_token',$request->input('api_key'))->first();

			if($user != null){

				$penerima = Appusers::where('id',$request->input('id_penerima'))->first();

				if($penerima != null){
          
					DB::table('proposal')->insert([
						'id_pengirim'=>$user->id,
						'id_penerima'=>$penerima->id,
						'isi_proposal'=>$request->input('isi_proposal'),
						'created_at'=> gmdate('Y-m-d H:i:s', time() + (60 * 60 * 7))
					]);

					if($penerima->device_id != null){

						$os = new Onesignal;
						$os->sendPushnotification($penerima->device_id, 'Alhamdulillah ada kiriman proposal baru untuk anda, yuk dilihat..');
					}

					$response = array(
						'message' => "proposal successfully sent",
						'success' => true
					);
					return response($response);

				}else{

					$response = array(
						'message' => "invalid reciever id",
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

		public function balas(Request $request){

		$rules = array(
			'api_key'=>'required|max:100',
			'balasan_penerima'=>'required',
			'respon'=>'required',
			'id_pengirim'=>'required|numeric',
			'proposal_id'=>'required|numeric'
		);

		$validator = Validator::make($request->all(), $rules);

		if($validator->passes()){

			$user = Appusers::where('remember_token',$request->input('api_key'))->first();

			if($user != null){

				$pengirim = Appusers::where('id',$request->input('id_pengirim'))->first();

				if($pengirim != null){
          
					DB::table('proposal')->where('id',$request->input('proposal_id'))->update([
						'balasan_penerima'=>$request->input('balasan_penerima'),
						'respon'=> $request->input('respon')
					]);

					if($pengirim->device_id != null){

						$os = new Onesignal;
						$os->sendPushnotification($pengirim->device_id,'Proposal yang telah anda kirimkan dibalas, yuk dilihat..');
					}

					$response = array(
						'message' => "balasan successfully sent",
						'success' => true
					);
					return response($response);

				}else{

					$response = array(
						'message' => "invalid reciever id",
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

	public function receivedlist(Request $request){

		$rules = array(
			'api_key'=>'required|max:100',
			'page'=>'required|numeric'
		);

		$validator = Validator::make($request->all(), $rules);

		if($validator->passes()){

			$user = Appusers::where('remember_token',$request->input('api_key'))->first();

			if($user != null){

				$page = $request->input('page');

				if($page < 1){
					$page = 1;
				}

          
				$data['list'] = DB::table('proposal')
				->select(DB::RAW("proposal.id as proposal_id,proposal.*,appusers.id,appusers.gender,bookmark_calon.id_user as bookmarked,
				CASE WHEN profiles_hidden_status.nama_asli = 0 THEN profiles.nama_asli END as nama_asli,
				CASE WHEN profiles_hidden_status.nama_jalan_ktp = 0 THEN profiles.nama_jalan_ktp END as nama_jalan_ktp,
				CASE WHEN profiles_hidden_status.ktp_rtrw = 0 THEN profiles.ktp_rtrw END as ktp_rtrw,
				CASE WHEN profiles_hidden_status.ktp_kelurahan = 0 THEN profiles.ktp_kelurahan END as ktp_kelurahan,
				CASE WHEN profiles_hidden_status.ktp_kecamatan = 0 THEN profiles.ktp_kecamatan END as ktp_kecamatan,
				CASE WHEN profiles_hidden_status.tinggal_nama_jalan = 0 THEN profiles.tinggal_nama_jalan END as tinggal_nama_jalan,
				CASE WHEN profiles_hidden_status.tinggal_rtrw = 0 THEN profiles.tinggal_rtrw END as tinggal_rtrw,
				CASE WHEN profiles_hidden_status.tinggal_kelurahan = 0 THEN profiles.tinggal_kelurahan END as tinggal_kelurahan,
				CASE WHEN profiles_hidden_status.tinggal_kecamatan = 0 THEN profiles.tinggal_kecamatan END as tinggal_kecamatan,
				CASE WHEN profiles_hidden_status.tinggal_kotakab = 0 THEN profiles.tinggal_kotakab END as tinggal_kotakab,
				CASE WHEN profiles_hidden_status.tinggal_provinsi = 0 THEN profiles.tinggal_provinsi END as tinggal_provinsi,
				CASE WHEN profiles_hidden_status.tinggal_kodepos = 0 THEN profiles.tinggal_kodepos END as tinggal_kodepos,
				profiles.nama_samaran,profiles.tanggal_lahir,profiles.tempat_lahir,profiles.status_pernikahan,profiles.ktp_kotakab,profiles.ktp_provinsi,profiles.ktp_kodepos,profiles.level_pendidikan_tertinggi,profiles.pend_sd,profiles.pend_smp,profiles.pend_slta,profiles.pend_diploma,profiles.pend_s1,profiles.pend_s2,profiles.pend_s3,profiles.pend_lain,profiles.pend_nonformal,profiles.nama_pekerjaan,profiles.tipe_pekerjaan,profiles.golongan_pekerjaan,profiles.penghasilan_pekerjaan,profiles.hobby,profiles.keahlian,profiles.tinggi_badan,profiles.berat_badan,profiles.warna_kulit,profiles.penilaian_wajah,profiles.riwayat_penyakit,profiles.tinggal_bersama,profiles.pekerjaan_ayah,profiles.pekerjaan_ibu,profiles.anak_ke,profiles.jumlah_saudara,profiles.jum_kakak,profiles.jum_adik,profiles.apakah_ikut_kajian_rutin,profiles.solat_5_waktu,profiles.membaca_alquran,profiles.sholat_sunnah,profiles.puasa_sunnah,profiles.afiliasi_keagamaan,profiles.max_anak,profiles.jumlah_anak,profiles.jum_kakak_laki,profiles.jum_kakak_perem,profiles.jum_adik_laki,profiles.jum_adik_perem,profiles.max_usia,profiles.min_usia,profiles.kriteria_afiliasi_keagamaan,profiles.pendidikan_minimal,profiles.kriteria_status,profiles.minimum_penghasilan,profiles.min_tinggi,profiles.max_tinggi,profiles.min_berat,profiles.max_berat"))
				->join('profiles','proposal.id_pengirim','profiles.id_user')
				->join('profiles_hidden_status','profiles_hidden_status.id_user','proposal.id_pengirim')
				->join('appusers','proposal.id_pengirim','=','appusers.id')
				->leftjoin('bookmark_calon','appusers.id','=',DB::raw('bookmark_calon.id_calon AND bookmark_calon.id_user = ' . $user->id))
				->where('proposal.id_penerima',$user->id)
				->skip(($page-1)*4)->limit(4)->orderBy('created_at','desc')->get()->toArray();


				$data['last_page'] = ceil(DB::table('proposal')->where('id_penerima',$user->id)->count()/3);

				$response = array(
					'data'=>$data,
					'message' => "data successfully loaded",
					'success' => true
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
	public function sentlist(Request $request){

		$rules = array(
			'api_key'=>'required|max:100',
			'page'=>'required|numeric'
		);

		$validator = Validator::make($request->all(), $rules);

		if($validator->passes()){

			$user = Appusers::where('remember_token',$request->input('api_key'))->first();

			if($user != null){

				$page = $request->input('page');

				if($page < 1){
					$page = 1;
				}

				$data['list'] = DB::table('proposal')
				->select(DB::RAW("proposal.id as proposal_id,proposal.*,appusers.id,appusers.gender,bookmark_calon.id_user as bookmarked,
				CASE WHEN profiles_hidden_status.nama_asli = 0 THEN profiles.nama_asli END as nama_asli,
				CASE WHEN profiles_hidden_status.nama_jalan_ktp = 0 THEN profiles.nama_jalan_ktp END as nama_jalan_ktp,
				CASE WHEN profiles_hidden_status.ktp_rtrw = 0 THEN profiles.ktp_rtrw END as ktp_rtrw,
				CASE WHEN profiles_hidden_status.ktp_kelurahan = 0 THEN profiles.ktp_kelurahan END as ktp_kelurahan,
				CASE WHEN profiles_hidden_status.ktp_kecamatan = 0 THEN profiles.ktp_kecamatan END as ktp_kecamatan,
				CASE WHEN profiles_hidden_status.tinggal_nama_jalan = 0 THEN profiles.tinggal_nama_jalan END as tinggal_nama_jalan,
				CASE WHEN profiles_hidden_status.tinggal_rtrw = 0 THEN profiles.tinggal_rtrw END as tinggal_rtrw,
				CASE WHEN profiles_hidden_status.tinggal_kelurahan = 0 THEN profiles.tinggal_kelurahan END as tinggal_kelurahan,
				CASE WHEN profiles_hidden_status.tinggal_kecamatan = 0 THEN profiles.tinggal_kecamatan END as tinggal_kecamatan,
				CASE WHEN profiles_hidden_status.tinggal_kotakab = 0 THEN profiles.tinggal_kotakab END as tinggal_kotakab,
				CASE WHEN profiles_hidden_status.tinggal_provinsi = 0 THEN profiles.tinggal_provinsi END as tinggal_provinsi,
				CASE WHEN profiles_hidden_status.tinggal_kodepos = 0 THEN profiles.tinggal_kodepos END as tinggal_kodepos,
				profiles.nama_samaran,profiles.tanggal_lahir,profiles.tempat_lahir,profiles.status_pernikahan,profiles.ktp_kotakab,profiles.ktp_provinsi,profiles.ktp_kodepos,profiles.level_pendidikan_tertinggi,profiles.pend_sd,profiles.pend_smp,profiles.pend_slta,profiles.pend_diploma,profiles.pend_s1,profiles.pend_s2,profiles.pend_s3,profiles.pend_lain,profiles.pend_nonformal,profiles.nama_pekerjaan,profiles.tipe_pekerjaan,profiles.golongan_pekerjaan,profiles.penghasilan_pekerjaan,profiles.hobby,profiles.keahlian,profiles.tinggi_badan,profiles.berat_badan,profiles.warna_kulit,profiles.penilaian_wajah,profiles.riwayat_penyakit,profiles.tinggal_bersama,profiles.pekerjaan_ayah,profiles.pekerjaan_ibu,profiles.anak_ke,profiles.jumlah_saudara,profiles.jum_kakak,profiles.jum_adik,profiles.apakah_ikut_kajian_rutin,profiles.solat_5_waktu,profiles.membaca_alquran,profiles.sholat_sunnah,profiles.puasa_sunnah,profiles.afiliasi_keagamaan,profiles.max_anak,profiles.jumlah_anak,profiles.jum_kakak_laki,profiles.jum_kakak_perem,profiles.jum_adik_laki,profiles.jum_adik_perem,profiles.max_usia,profiles.min_usia,profiles.kriteria_afiliasi_keagamaan,profiles.pendidikan_minimal,profiles.kriteria_status,profiles.minimum_penghasilan,profiles.min_tinggi,profiles.max_tinggi,profiles.min_berat,profiles.max_berat"))
				->join('profiles','proposal.id_penerima','profiles.id_user')
				->join('profiles_hidden_status','profiles_hidden_status.id_user','proposal.id_penerima')
				->join('appusers','proposal.id_penerima','=','appusers.id')
				->where('proposal.id_pengirim',$user->id)
				->leftjoin('bookmark_calon','appusers.id','=',DB::raw('bookmark_calon.id_calon AND bookmark_calon.id_user = '.$user->id))
				->skip(($page-1)*4)
				->limit(4)
				->orderBy('proposal.created_at','desc')
				->get()
				->toArray();

				
				$data['last_page'] = ceil(DB::table('proposal')->where('id_pengirim',$user->id)->count()/3);

				$response = array(
					'data'=>$data,
					'message' => "data successfully loaded",
					'success' => true
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

	public function read(Request $request){

		$rules = array(
			'api_key'=>'required|max:100',
			'proposal_id'=>'required|numeric'
		);

		$validator = Validator::make($request->all(), $rules);

		if($validator->passes()){

			$user = Appusers::where('remember_token',$request->input('api_key'))->first();

			if($user != null){

				$proposal =DB::table('proposal')->where('id',$request->input('proposal_id'))->first();

				if($proposal != null ){

					DB::table('proposal')->where('id',$proposal->id)->update([
						'readed'=>'yes'
					]);

					$response = array(
						'message' => "proposal updated",
						'success' => true
					);
					return response($response);

				}else{

					$response = array(
					'success' => false,
					'message' => 'invalid proposal id'
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

