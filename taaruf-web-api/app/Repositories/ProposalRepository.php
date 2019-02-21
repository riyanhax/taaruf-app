<?php

namespace App\Repositories;

use App\Proposal;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProposalRepository
 * @package App\Repositories
 * @version June 23, 2018, 2:32 pm UTC
 *
 * @method Proposal findWithoutFail($id, $columns = ['*'])
 * @method Proposal find($id, $columns = ['*'])
 * @method Proposal first($columns = ['*'])
*/
class ProposalRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id_pengirim',
        'id_penerima',
        'isi_proposal',
        'readed',
        'respon',
        'balasan_penerima'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Proposal::class;
    }
}
