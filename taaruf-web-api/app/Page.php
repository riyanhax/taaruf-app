<?php

namespace App;

use Eloquent as Model;

/**
 * Class Page
 * @package App
 * @version June 1, 2018, 4:13 pm UTC
 *
 * @property string title
 * @property string slug
 * @property string content
 */
class Page extends Model
{

    public $table = 'pages';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'title',
        'slug',
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
