<?php

namespace App;

use Eloquent as Model;

/**
 * Class Appusers
 * @package App
 * @version June 24, 2018, 11:49 am UTC
 *
 * @property string gender
 * @property string email
 * @property string no_hp
 * @property integer otp_code
 * @property string verified
 * @property string remember_token
 * @property string device_id
 */
class Appusers extends Model
{

    public $table = 'appusers';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'gender',
        'email',
        'no_hp',
        'otp_code',
        'verified',
        'remember_token',
        'device_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'gender' => 'string',
        'email' => 'string',
        'no_hp' => 'string',
        'otp_code' => 'integer',
        'verified' => 'string',
        'remember_token' => 'string',
        'device_id' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function profiledata_data(){
        return $this->hasMany('\App\ProfileData', 'id_user');   
    }


    
}
