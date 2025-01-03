<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon;
use Illuminate\Support\Arr;

/**
 * @SWG\Definition(
 *      definition="Activity",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="amount",
 *          description="amount",
 *          type="number",
 *          format="number"
 *      ),
 *      @SWG\Property(
 *          property="earnings",
 *          description="earnings",
 *          type="number",
 *          format="number"
 *      ),
 *      @SWG\Property(
 *          property="client_earnings",
 *          description="client_earnings",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="due",
 *          description="due",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="date",
 *          description="date",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="created_at",
 *          description="created_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="deleted_at",
 *          description="deleted_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="activity_type_id",
 *          description="activity_type_id",
 *          type="integer",
 *          format="int32"
 *      )
 * )
 */
class Activity extends Model
{
    use SoftDeletes;

    public $table = 'activities';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'amount',
        'earnings',
        'client_earnings',
        'due',
        'date',
        'activity_type_id',
        'loan_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'amount' => 'float',
        'earnings' => 'float',
        'client_earnings' => 'string',
        'due' => 'integer',
        'date' => 'date:Y-m-d H:i',
        'activity_type_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        //'name' => 'required',
        'amount' => 'required',
        'earnings' => 'required',
        //'client_earnings' => 'required',
        'due' => 'required',
        'date' => 'required',
        'activity_type_id' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function activityType()
    {
        return $this->belongsTo(\App\Models\ActivityType::class, 'activity_type_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'activity_type_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function loan()
    {
        return $this->belongsTo(\App\Models\Loan::class);
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    }

    public function getDateAttribute($date)
    {
        return Carbon\Carbon::parse($date)->format('d-m-Y');
    }

    public function getUserPercent()
    {
        $user = auth()->user();
        $array = json_decode($this->client_earnings);

        $array = Arr::where($array, function ($value, $key) use($user){
            return $value->id === $user->id;
        });

        if(isset($array[0])){
            return $array[0]->percent;
        }else{
            return 0;
        }
    }

}
