<?php

namespace App;

use Eloquent as Model;

/**
 * Class Banner
 * @package App
 * @version April 27, 2018, 9:25 am UTC
 *
 * @property string name
 * @property string link
 * @property string image
 * @property string status
 */
class Banner extends Model
{

    public $table = 'banners';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'name',
        'link',
        'image',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'link' => 'string',
        'image' => 'string',
        'status' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
