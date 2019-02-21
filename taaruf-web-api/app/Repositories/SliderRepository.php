<?php

namespace App\Repositories;

use App\Slider;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SliderRepository
 * @package App\Repositories
 * @version May 8, 2018, 10:51 am UTC
 *
 * @method Slider findWithoutFail($id, $columns = ['*'])
 * @method Slider find($id, $columns = ['*'])
 * @method Slider first($columns = ['*'])
*/
class SliderRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'image',
        'description'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Slider::class;
    }
}
