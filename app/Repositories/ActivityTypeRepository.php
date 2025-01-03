<?php

namespace App\Repositories;

use App\Models\ActivityType;
use App\Repositories\BaseRepository;

/**
 * Class ActivityTypeRepository
 * @package App\Repositories
 * @version October 6, 2019, 4:50 pm UTC
*/

class ActivityTypeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'
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
        return ActivityType::class;
    }
}
