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
use App\KotaTaaruf;
use App\ProfileData;
use App\FieldProfile;
use Carbon\Carbon;

/**
 * Class SliderController
 * @package App\Http\Controllers\API
 */

class AppcontentAPIController extends AppBaseController
{

	public function homepage(Request $request){
		$rules = array(
			'api_key'=>'required|max:100'
		);

		$validator = Validator::make($request->all(), $rules);

		if($validator->passes()){

			$user = Appusers::where('remember_token',$request->input('api_key'))->first();

			if($user != null){

				if($user->gender == "L"){
					$opposite = "P";
				}else if($user->gender == "P"){
					$opposite = "L";
				}

				/*$data['profile'] = 
				Appusers::select(DB::RAW("appusers.id,appusers.gender,bookmark_calon.id_user as bookmarked,	
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
				->leftjoin('bookmark_calon','appusers.id','=',DB::raw('bookmark_calon.id_calon AND bookmark_calon.id_user = ' . $user->id))
				->join('profiles','profiles.id_user','appusers.id')
				->join('profiles_hidden_status','profiles_hidden_status.id_user','appusers.id')
				->where('appusers.gender','=',$opposite)
				->where('appusers.verified','=','true')
				->orderBy('appusers.created_at','desc')
				->limit(4)->get()->toArray(); 	
				*/
				$data['slider'] = Slider::all()->toArray();
				$data['banner'] = Banner::where('status','active')->limit(1)->get()->toArray();
				
				$data['blogs'] = DB::table('blogs')
				->select('blogs.*','bookmark_blog.id_user as bookmarked')
				->leftjoin('bookmark_blog','blogs.id','=',DB::raw('bookmark_blog.id_blog AND bookmark_blog.id_user = ' . $user->id))
				->orderBy('blogs.created_at','desc')
				->limit(3)
				->get();
				$data['blogs'] = $data['blogs']->toArray();


				foreach ($data['blogs'] as $key => $blog) {
					$data['blogs'][$key]->preview = substr(strip_tags($blog->content),0,25)."...";
				}

				$response = array(
					'message' => "content retrieved succesfully",
					'data'=> $data,
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

	public function aboutpage(Request $request) {

		$rules = array(
			'api_key'=>'required|max:100'
		);

		$validator = Validator::make($request->all(), $rules);

		if($validator->passes()){

			$user = Appusers::where('remember_token',$request->input('api_key'))->first();

			if($user != null){

				//get tentang-kami
				$data['aboutus'] = Page::where('slug','tentang-kami')->first();

				$response = array(
					'message' => "content retrieved succesfully",
					'data'=> $data,
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

	

	public function bookmarkPage(Request $request){
		
		$rules = array(
			'api_key'=>'required|max:100',
			'page'=>'required|numeric'
		);

		$validator = Validator::make($request->all(), $rules);

		if($validator->passes()){

			$user = Appusers::where('remember_token',$request->input('api_key'))->first();

			if($user != null){

				//get profil calon bookmark

				if($user->gender == "L"){
					$opposite = "P";
				}else if($user->gender == "P"){
					$opposite = "L";
				}

				$data['profile'] = DB::table('bookmark_calon')->select(DB::RAW("appusers.id,appusers.gender,bookmark_calon.id_user as bookmarked,	
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
				->join('profiles','bookmark_calon.id_calon','profiles.id_user')
				->join('profiles_hidden_status','profiles_hidden_status.id_user','bookmark_calon.id_calon')
				->join('appusers','bookmark_calon.id_calon','appusers.id')
				->where('bookmark_calon.id_user',$user->id)
				->orderBy('bookmark_calon.created_at','desc')->get()->toArray();

				//get blogs bookmark

				$page = $request->input('page');
				
				if($page < 1 ){
					$page = 1;
				}

				$data['blogs'] = DB::table('blogs')
					->select('blogs.*','bookmark_blog.id_user as bookmarked')
					->join('bookmark_blog','blogs.id','=', DB::raw('bookmark_blog.id_blog AND bookmark_blog.id_user = '.$user->id))
					->orderBy('bookmark_blog.created_at','desc')
					->skip(($page-1)*6)
					->limit(6)
					->get();

				//make previews (first 25 char of article)
				foreach ($data['blogs'] as $key => $blog) {
					$data['blogs'][$key]->preview = substr(strip_tags($blog->content),0,25)."...";
				}

				//calculating the last page of pagination

				$data['last_page'] = ceil(DB::table('blogs')->select('blogs.*','bookmark_blog.id_user as bookmarked')
					->join('bookmark_blog','blogs.id','=', DB::raw('bookmark_blog.id_blog AND bookmark_blog.id_user = '.$user->id))
					->orderBy('blogs.created_at','desc')->count()/6);

				$response = array(
					'message' => "content retrieved succesfully",
					'data'=> $data,
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

	


	public function blogpage(Request $request){

		$rules = array(
			'api_key'=>'required|max:100',
			'page'=>'required|numeric'
		);

		$validator = Validator::make($request->all(), $rules);

		if($validator->passes()){

			$user = Appusers::where('remember_token',$request->input('api_key'))->first();

			if($user != null){

				$page = $request->input('page');
				
				if($page < 1 ){
					$page = 1;
				}

				//get blogs
				$data['blogs'] = DB::table('blogs')
					->select('blogs.*','bookmark_blog.id_user as bookmarked')
					->leftjoin('bookmark_blog','blogs.id','=', DB::raw('bookmark_blog.id_blog AND bookmark_blog.id_user = '.$user->id))
					->orderBy('blogs.created_at','desc')
					->skip(($page-1)*6)
					->limit(6)
					->get();

				foreach ($data['blogs'] as $key => $blog) {
					$data['blogs'][$key]->preview = substr(strip_tags($blog->content),0,25)."...";
				}

				$data['last_page'] = ceil(DB::table('blogs')->count()/6);

				$response = array(
					'message' => "content retrieved succesfully",
					'data'=> $data,	
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

	public function listpage(Request $request){
		/*

		$rules = array(
			'api_key'=>'required|max:100',
			'page'=>'required|max:1'
		);

		$validator = Validator::make($request->all(), $rules);

		if($validator->passes()){

			$user = Appusers::where('remember_token',$request->input('api_key'))->first();

			if($user != null){

				if($user->gender == "L"){
					$opposite = "P";
				}else if($user->gender == "P"){
					$opposite = "L";
				}

				$page = $request->input('page');

				if($page < 1){
					$page = 1;
				}


				$data['profile'] = Appusers::select('appusers.id','appusers.gender','bookmark_calon.id_user as bookmarked')
				->leftjoin('bookmark_calon','appusers.id','=',DB::raw('bookmark_calon.id_calon AND bookmark_calon.id_user = ' . $user->id))
				->where('gender','=',$opposite)
				->where('appusers.verified','=','true')
				->orderBy('appusers.created_at','desc')
				->skip(($page-1)*12)
				->limit(12)->get()->toArray();

				foreach ($data['profile'] as $key => $profile) {


					$profiledata = DB::table('profile_data')
					->select('profile_data.data_varchar','profile_data.data_date','field_profile.field_name','profile_data_hidden_status.status_hidden')
					->join('field_profile','profile_data.id_field_profile','=','field_profile.id')
					->leftjoin('profile_data_hidden_status','field_profile.id','=',DB::raw('profile_data_hidden_status.id_field_profile AND profile_data_hidden_status.id_user = '.$profile['id']))
					->where('profile_data.id_user',$profile['id'])->get();

					$temp=array();
					foreach ($profiledata as $i => $p) {
						
						$temp[$p->field_name] = $profiledata[$i];

					}
					

					$data['profile'][$key]['data'] = $temp;

				}



				$data['last_page'] = ceil(Appusers::select('appusers.id','appusers.name','appusers.gender','bookmark_calon.id_user as bookmarked')
				->leftjoin('bookmark_calon','appusers.id','=',DB::raw('bookmark_calon.id_calon AND bookmark_calon.id_user = ' . $user->id))
				->where('gender','=',$opposite)
				->orderBy('appusers.created_at','desc')->count()/12);

				$response = array(
					'message' => "content retrieved succesfully",
					'data'=> $data,
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

		*/

	}

		public function profilepage(Request $request){

		$rules = array(
			'api_key'=>'required|max:100'
		);

		$validator = Validator::make($request->all(), $rules);

		if($validator->passes()){

			$user = Appusers::where('remember_token',$request->input('api_key'))->first();

			if($user != null){



				$profiles = DB::table('profiles')->where('id_user',$user->id)->first();
				$hidden_status = DB::table('profiles_hidden_status')->where('id_user',$user->id)->first();

				$profile['data']=$profiles;
				$profile['hidden_status']=$hidden_status;

				$response = array(
					'data'=>$profile,
					'success' => true,
					'message' => 'cobawaebosku',
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

	public function calonpage(Request $request){

		$rules = array(
			'api_key'=>'required|max:100'
		);

		$validator = Validator::make($request->all(), $rules);

		if($validator->passes()){

			$user = Appusers::where('remember_token',$request->input('api_key'))->first();

			if($user != null){

				//ambil data proposal 
				$data['profile'] = DB::table('proposal')
				->select(DB::RAW("proposal.id_penerima, appusers.id,appusers.gender,bookmark_calon.id_user as bookmarked,	
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
				profiles.foto,profiles.nama_samaran,profiles.tanggal_lahir,profiles.tempat_lahir,profiles.status_pernikahan,profiles.ktp_kotakab,profiles.ktp_provinsi,profiles.ktp_kodepos,profiles.level_pendidikan_tertinggi,profiles.pend_sd,profiles.pend_smp,profiles.pend_slta,profiles.pend_diploma,profiles.pend_s1,profiles.pend_s2,profiles.pend_s3,profiles.pend_lain,profiles.pend_nonformal,profiles.nama_pekerjaan,profiles.tipe_pekerjaan,profiles.golongan_pekerjaan,profiles.penghasilan_pekerjaan,profiles.hobby,profiles.keahlian,profiles.tinggi_badan,profiles.berat_badan,profiles.warna_kulit,profiles.penilaian_wajah,profiles.riwayat_penyakit,profiles.tinggal_bersama,profiles.pekerjaan_ayah,profiles.pekerjaan_ibu,profiles.anak_ke,profiles.jumlah_saudara,profiles.jum_kakak,profiles.jum_adik,profiles.apakah_ikut_kajian_rutin,profiles.solat_5_waktu,profiles.membaca_alquran,profiles.sholat_sunnah,profiles.puasa_sunnah,profiles.afiliasi_keagamaan,profiles.max_anak,profiles.jumlah_anak,profiles.jum_kakak_laki,profiles.jum_kakak_perem,profiles.jum_adik_laki,profiles.jum_adik_perem,profiles.max_usia,profiles.min_usia,profiles.kriteria_afiliasi_keagamaan,profiles.pendidikan_minimal,profiles.kriteria_status,profiles.minimum_penghasilan,profiles.min_tinggi,profiles.max_tinggi,profiles.min_berat,profiles.max_berat"))
				->join('profiles','profiles.id_user','=',
					DB::RAW("CASE 
						WHEN proposal.id_penerima = ".$user->id." THEN proposal.id_pengirim WHEN proposal.id_pengirim = ".$user->id." THEN proposal.id_penerima END"))
				->join('profiles_hidden_status','profiles_hidden_status.id_user','=',
					DB::RAW("CASE 
						WHEN proposal.id_penerima = ".$user->id." THEN proposal.id_pengirim WHEN proposal.id_pengirim = ".$user->id." THEN proposal.id_penerima END"))
				->join('appusers','appusers.id','=',
					DB::RAW("CASE 
						WHEN proposal.id_penerima = ".$user->id." THEN proposal.id_pengirim WHEN proposal.id_pengirim = ".$user->id." THEN proposal.id_penerima END"))
				->leftjoin('bookmark_calon','appusers.id','=',DB::raw('bookmark_calon.id_calon AND bookmark_calon.id_user = '. $user->id))
				->where(DB::RAW('proposal.id_pengirim = '.$user->id.' OR proposal.id_penerima = '.$user->id.''))

				->where('proposal.respon','diterima')
				->get()->toArray();


				$response = array(
					'data'=>$data['profile'],
					'success' => true,
					'message' => 'cobawaebosku',
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

	public function citypage(Request $request){
		
		$rules = array(
			'api_key'=>'required|max:100'
		);

		$validator = Validator::make($request->all(), $rules);

		if($validator->passes()){

			$user = Appusers::where('remember_token',$request->input('api_key'))->first();

			if($user != null){

				$kota = KotaTaaruf::with(['city_data','province_data','subdistrict_data'])->get()->toArray();

				$response = array(
					'message' => "content retrieved succesfully",
					'data'=> $kota,	
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



	public function searchpage(Request $request){


		$data = $request->json()->all();



		if(true){

			$user = Appusers::where('remember_token',$data['api_key'])->first();

			if($user != null){

				$field_name = $data['orderby'];
				$ordertype = $data['ordertype'];

				$field_data = FieldProfile::where('field_name',$field_name)->first();

				if($user->gender == "L"){
					$opposite = "P";
				}else if($user->gender == "P"){
					$opposite = "L";
				}
				$page = $data['page'];

				if($page < 1){
					$page = 1;
				}

				//get AVG facerate
				$avgwajah = ceil(DB::table('profiles')->avg('penilaian_wajah'));
				
				$criteria = $data['search_criteria'];

				//return response($criteria);
				//die();

				$stringwhere = " profiles.status_pernikahan = '".$criteria['status_pernikahan']."'";
				if($criteria['status_pernikahan'] == "sudah"){
					$stringwhere =$stringwhere ." AND profiles.jumlah_anak <= ".$criteria['jumlah_anak'];
				} 
				if($criteria['paras_wajah'] == "diatas_rata"){
					$stringwhere = $stringwhere." AND profiles.penilaian_wajah > ".$avgwajah;
				}else{
					$stringwhere = $stringwhere." AND profiles.penilaian_wajah <= ".$avgwajah;
				}
				
				$count = Appusers::select('appusers.id')
				->leftjoin('bookmark_calon','appusers.id','=',DB::raw('bookmark_calon.id_calon AND bookmark_calon.id_user = ' . $user->id))
				->join('profiles','profiles.id_user','=', DB::raw("appusers.id AND appusers.gender = '".$opposite."' AND appusers.verified = 'true'"))
				->join('profiles_hidden_status','profiles_hidden_status.id_user','appusers.id')
				->whereRaw($stringwhere)
				->whereRaw("profiles.afiliasi_keagamaan ='".$criteria['afiliasi_agama']."'")
				->whereBetween(DB::raw('TIMESTAMPDIFF(YEAR,profiles.tanggal_lahir,CURDATE())'),array($criteria['usia_min'],$criteria['usia_max']))
				->whereRaw("profiles.tinggi_badan BETWEEN ".$criteria['tinggi_min']." AND ".$criteria['tinggi_max'])
				->where('profiles.tipe_pekerjaan',$criteria['pekerjaan'])
				->whereBetween('profiles.tinggi_badan',array($criteria['tinggi_min'],$criteria['tinggi_max']))
				->whereRaw("lower(profiles.ktp_kotakab) = lower('".$criteria['daerah_asal']."') AND  CASE WHEN profiles.tinggal_kotakab IS NULL THEN lower(profiles.ktp_kotakab) = lower('".$criteria['daerah_tinggal']."') ELSE lower(profiles.tinggal_kotakab) = lower('".$criteria['daerah_tinggal']."') END")
				->count();

				$last_page = ceil($count/12);

				$newData['last_page'] = $last_page;
				$newData['profiles'] = Appusers::select(DB::RAW("appusers.id,appusers.gender,bookmark_calon.id_user as bookmarked,	
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
				->leftjoin('bookmark_calon','appusers.id','=',DB::raw('bookmark_calon.id_calon AND bookmark_calon.id_user = ' . $user->id))
				->join('profiles','profiles.id_user','=', DB::raw("appusers.id AND appusers.gender = '".$opposite."' AND appusers.verified = 'true'"))
				->join('profiles_hidden_status','profiles_hidden_status.id_user','appusers.id')
				->whereRaw($stringwhere)
				->whereRaw("profiles.afiliasi_keagamaan ='".$criteria['afiliasi_agama']."'")
				->whereBetween(DB::raw('TIMESTAMPDIFF(YEAR,profiles.tanggal_lahir,CURDATE())'),array($criteria['usia_min'],$criteria['usia_max']))
				->whereRaw("profiles.tinggi_badan BETWEEN ".$criteria['tinggi_min']." AND ".$criteria['tinggi_max'])
				->where('profiles.tipe_pekerjaan',$criteria['pekerjaan'])
				->whereBetween('profiles.tinggi_badan',array($criteria['tinggi_min'],$criteria['tinggi_max']))
				->whereRaw("lower(profiles.ktp_kotakab) = lower('".$criteria['daerah_asal']."') AND  CASE WHEN profiles.tinggal_kotakab IS NULL THEN lower(profiles.ktp_kotakab) = lower('".$criteria['daerah_tinggal']."') ELSE lower(profiles.tinggal_kotakab) = lower('".$criteria['daerah_tinggal']."') END")
				->orderBy('profiles.'.$field_name,$ordertype)
				->skip(($page-1)*12)
				->limit(12)
				->get()
				->toArray();

				$response = array(
					'message' => "content retrieved succesfully",
					'data'=> $newData,
					'success' => true,
				);

				return response($response);
				
			}else{

				$response = array(
				'success' => false,
				'message' => 'iaaa'
				);

				return response($response);
			}


		}else{

			$response = array(
				'success' => false,
				'message' => 'invalid bb'
			);

			return response($response);
		}


        
	}

}

