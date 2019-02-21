<?php

namespace App;

use Eloquent as Model;

/**
 * Class KotaTaaruf
 * @package App
 * @version April 27, 2018, 7:23 am UTC
 *
 * @property string nama
 * @property string city
 * @property string province
 * @property string subdistrict
 * @property string address
 */
class KotaTaaruf extends Model
{

    public $table = 'kota_taaruf';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'nama',
        'city',
        'province',
        'subdistrict',
        'address'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nama' => 'string',
        'city' => 'string',
        'province' => 'string',
        'subdistrict' => 'string',
        'address' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
