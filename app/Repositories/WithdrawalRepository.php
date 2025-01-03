<?php

namespace App\Repositories;

use App\Models\Withdrawal;
use App\Repositories\BaseRepository;

/**
 * Class WithdrawalRepository
 * @package App\Repositories
 * @version October 6, 2019, 3:51 pm UTC
*/

class WithdrawalRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
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
        return Withdrawal::class;
    }
}
