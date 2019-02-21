<?php

namespace App;

use Eloquent as Model;

/**
 * Class Blog
 * @package App
 * @version April 27, 2018, 7:44 am UTC
 *
 * @property string title
 * @property string slug
 * @property string picture
 * @property string content
 */
class Blog extends Model
{

    public $table = 'blogs';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'title',
        'slug',
        'picture',
        'content'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'slug' => 'string',
        'picture' => 'string',
        'content' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
