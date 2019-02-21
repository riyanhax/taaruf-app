<?php

namespace App\Repositories;

use App\KotaTaaruf;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class KotaTaarufRepository
 * @package App\Repositories
 * @version April 27, 2018, 7:24 am UTC
 *
 * @method KotaTaaruf findWithoutFail($id, $columns = ['*'])
 * @method KotaTaaruf find($id, $columns = ['*'])
 * @method KotaTaaruf first($columns = ['*'])
*/
class KotaTaarufRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nama',
        'city',
        'province',
        'subdistrict',
        'address'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return KotaTaaruf::class;
    }
}
