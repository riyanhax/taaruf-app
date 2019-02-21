<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subdistrict extends Model
{
	protected $table = 'subdistrict';
	protected $fillable = ['city_id', 'subdistrict_name'];

	public function city() {
		return $this->belongsTo('\App\City', 'city_id');
	}
}
