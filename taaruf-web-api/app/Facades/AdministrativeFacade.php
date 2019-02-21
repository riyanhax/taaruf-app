<?php
namespace App\Facades;
use App\Province;
use App\City;
use App\Subdistrict;

class AdministrativeFacade {
	public function province() {
		$province = Province::get();
		$data = [];
		$data[0] = 'Semua';
		foreach($province as $d) {
			$data[$d->id] = $d->province;
		}
		return $data;
	}

	public function city($province_id) {
		$city = City::whereProvinceId($province_id)->get();
		$data = [];
		$data[] = 'Semua';
		foreach($city as $d) {
			$data[$d->id] = $d->city_name . ' ('. $d->type .')';
		}
		return $data;
	}

	public function subdistrict($city_id) {
		$subdistrict = Subdistrict::whereCityId($city_id)->get();
		$data = [];
		$data[] = 'Semua';
		foreach($subdistrict as $d) {
			$data[$d->id] = $d->subdistrict_name;
		}
		return $data;
	}

	public function search($keyword) {
		$city = City::where('city_name', 'like', '%' . $keyword . '%')->get();
		$d = [];
		foreach($city as $c) {
			$d[] = [
				'name' => $c->province->province . ' > ' . $c->city_name . ' (' . $c->type . ')',
				'real_name' => $c->city_name . ' (' . $c->type . ')',
				'id' => $c->id
			];
		}
		return $d;
	}
}