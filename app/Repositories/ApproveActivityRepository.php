<?php

namespace App\Repositories;

use App\Models\ApproveActivity;
use App\Repositories\BaseRepository;

/**
 * Class ApproveActivityRepository
 * @package App\Repositories
 * @version October 6, 2019, 4:31 pm UTC
*/

class ApproveActivityRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'name',
        'amount',
        'earnings',
        'client_earnings',
        'due',
        'date',
        'activity_type_id'
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
        return ApproveActivity::class;
    }
}
