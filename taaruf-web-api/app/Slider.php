<?php

namespace App;

use Eloquent as Model;

/**
 * Class Slider
 * @package App
 * @version May 8, 2018, 10:51 am UTC
 *
 * @property string title
 * @property string image
 * @property string description
 */
class Slider extends Model
{

    public $table = 'sliders';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'title',
        'image',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'image' => 'string',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
