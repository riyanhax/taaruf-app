<?php

namespace App\Repositories;

use App\Appusers;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class AppusersRepository
 * @package App\Repositories
 * @version June 24, 2018, 11:49 am UTC
 *
 * @method Appusers findWithoutFail($id, $columns = ['*'])
 * @method Appusers find($id, $columns = ['*'])
 * @method Appusers first($columns = ['*'])
*/
class AppusersRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'gender',
        'email',
        'no_hp',
        'otp_code',
        'verified',
        'remember_token',
        'device_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Appusers::class;
    }
}
