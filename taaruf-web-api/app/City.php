<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
	protected $table = 'city';
	protected $fillable = ['province_id', 'type', 'city_name', 'postal_code'];

	public function province() {
		return $this->belongsTo('\App\Province', 'province_id');
	}
}
