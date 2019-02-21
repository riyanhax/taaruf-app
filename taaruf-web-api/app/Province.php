<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
	protected $table = 'provinces';
	protected $fillable = ['province'];

	public function cities() {
		return $this->hasMany('App\City', 'province_id', 'id');
	}
}
