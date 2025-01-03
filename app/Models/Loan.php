<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon;

/**
 * @SWG\Definition(
 *      definition="Loan",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="client",
 *          description="client",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="amount",
 *          description="amount",
 *          type="number",
 *          format="number"
 *      ),
 *      @SWG\Property(
 *          property="percent",
 *          description="percent",
 *          type="number",
 *          format="number"
 *      ),
 *      @SWG\Property(
 *          property="dues",
 *          description="dues",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="finished",
 *          description="finished",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="client_percents",
 *          description="client_percents",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="expires_at",
 *          description="expires_at",
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
 *          property="user_id",
 *          description="user_id",
 *          type="integer",
 *          format="int32"
 *      )
 * )
 */
class Loan extends Model
{
    use SoftDeletes;

    public $table = 'loans';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'client_id',
        'amount',
        'percent',
        'dues',
        'finished',
        'client_percents',
        'expires_at',
        'date',
        'user_id',
        'observation'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'client' => 'integer',
        'amount' => 'float',
        'percent' => 'float',
        'dues' => 'integer',
        'finished' => 'boolean',
        'client_percents' => 'string',
        'expires_at' => 'date:Y-m-d',
        'user_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'client_id' => 'required',
        'amount' => 'required',
        'percent' => 'required',
        'dues' => 'required',
        //'finished' => 'required',
        //'client_percents' => 'required',
        //'expires_at' => 'required',
        'user_id' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function client()
    {
        return $this->belongsTo(\App\Models\User::class, 'client_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function activities()
    {
        return $this->hasMany(\App\Models\Activity::class, 'loan_id');
    }

    public function getExpiresAtAttribute($date)
    {
        return Carbon\Carbon::parse($date)->format('d-m-Y');
    }

    public function getDateAttribute($date)
    {
        return Carbon\Carbon::parse($date)->format('d-m-Y');
    }

    public function getFinishedAttribute($finished)
    {
        $text = 'No';
        if($finished){
            $text = 'Yes';
        }
        return $text;
    }
}
