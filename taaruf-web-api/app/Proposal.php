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
class Proposal extends Model
{

    public $table = 'proposal';
    
    const CREATED_AT = 'created_at';



    public $fillable = [
        'id_pengirim',
        'id_penerima',
        'isi_proposal',
        'readed',
        'respon',
        'balasan_penerima'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'id_pengirim' => 'integer',
        'id_penerima' => 'integer',
        'isi_proposal' => 'string',
        'readed' => 'string',
        'respon' => 'string',
        'balasan_penerima' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function penerima() {
        return $this->belongsTo('\App\Appusers','id_penerima');
    }


    public function pengirim() {
        return $this->belongsTo('\App\Appusers', 'id_pengirim');
    }

    //public function profile_data() {
      //  return $this->belongsTo('\App\ProfileData', 'id_user');
    //}

    public function pengirim_profile(){
        return $this->hasMany('\App\ProfileData','id_user','id_pengirim');
    }

    public function penerima_profile(){
        return $this->hasMany('\App\ProfileData','id_user','id_penerima');
    }


    

}
