<?php

namespace App\Repositories;

use App\Models\Loan;
use App\Repositories\BaseRepository;

/**
 * Class LoanRepository
 * @package App\Repositories
 * @version October 6, 2019, 4:30 pm UTC
*/

class LoanRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'client',
        'amount',
        'percent',
        'dues',
        'finished',
        'client_percents',
        'expires_at',
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
        return Loan::class;
    }
}
