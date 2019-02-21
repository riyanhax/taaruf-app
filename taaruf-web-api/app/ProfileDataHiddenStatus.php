<?php

namespace App;

use Eloquent as Model;
use Awobaz\Compoships\Compoships;
/**
 * Class Proposal
 * @package App
 * @version June 23, 2018, 2:32 pm UTC
 *
 * @property integer id_pengirim
 * @property integer id_penerima
 * @property string isi_proposal
 * @property string readed
 * @property string respon
 * @property string balasan_penerima
 */
class ProfileDataHiddenStatus extends Model
{
    use Compoships;

    public $table = 'profile_data_hidden_status';
    
    public $fillable = [
        'id_user',
        'id_field_profile',
        'status_hidden'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id_user' => 'integer',
        'id_field_profile' => 'integer',
        'status_hidden' => 'string'
    ];
    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];


    public function filedprofile(){
        return $this->belongsTo('App\FieldProfile', 'id_field_profile');  
    }

    public function profiledata_field(){
        return $this->belongsTo('App\ProfileData', 'id_field_profile','id_field_profile');  
    }

    public function statusprofile_data(){
        return $this->hasOne('\App\ProfileData', ['id_user','id_field_profile'],['id_user','id_field_profile']);  
    }

    public function appusers(){
        return $this->belongsTo('App\Appusers', 'id_users');   
    }   


    
}
