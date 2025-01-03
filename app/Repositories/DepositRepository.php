<?php

namespace App\Repositories;

use App\Models\Deposit;
use App\Repositories\BaseRepository;

/**
 * Class DepositRepository
 * @package App\Repositories
 * @version October 6, 2019, 3:50 pm UTC
*/

class DepositRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'inyection',
        'amount',
        'user_id'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Deposit::class;
    }
}
