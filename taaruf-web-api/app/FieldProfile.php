<?php

namespace App;

use Eloquent as Model;

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
class FieldProfile extends Model
{

    public $table = 'field_profile';
    
    public $fillable = [
 
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'field_name' => 'string',
        'field_category' => 'string',
        'required' => 'string',
        'can_hidden' => 'string',
        'data_type' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function profiledata(){
        return $this->hasMany('App\ProfileData', 'id_field_profile', 'id');
    }
    public function profiledataHiddenstatus(){
       return $this->hasMany('App\ProfileDataHiddenStatus', 'id_field_profile', 'id'); 
    }
    

    
}

