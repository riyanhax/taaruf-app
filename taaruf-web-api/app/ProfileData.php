<?php

namespace App;

use Eloquent as Model;
use \App\Appusers;
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
class ProfileData extends Model
{
    use Compoships;

    public $table = 'profile_data';

    const CREATED_AT = 'created_at';
    
    public $fillable = [
        'id_field_profile',
        'id_user',
        'data_varchar',
        'data_integer',
        'data_date'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id_field_profile' => 'integer',
        'id_user' => 'integer',
        'data_varchar' => 'string',
        'data_integer' => 'integer',
        'data_date' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];


    /*public function fieldprofile(){
        return $this->belongsTo('\App\FieldProfile', 'id_field_profile');  
    } */

    public function appusers_data(){
        return $this->belongsTo('\App\Appusers', 'id_user');   
    }

    public function fieldprofile_data(){
        return $this->belongsTo('\App\FieldProfile','id_field_profile');
    }

   public function proposal_penerima(){
        return $this->hasMany('\App\Proposal','id_user','id_penerima');
    }

    public function proposal_pengirim(){
        return $this->hasMany('\App\Proposal','id_user','id_pengirim');
    }

    public function hiddenstatus_data(){
        return $this->hasOne('\App\ProfileDataHiddenStatus', ['id_user','id_field_profile'],['id_user','id_field_profile']);  
    }


    
}
