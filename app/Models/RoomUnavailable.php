<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoomUnavailable extends Model
{

    use SoftDeletes;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'room_unavailables';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'days',
        'start',
        'length',
        'weeks',
        'room_id'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    /**
     * Get the room for this model.
     *
     * @return App\Models\Room
     */
    public function room()
    {
        return $this->belongsTo('App\Models\Room', 'room_id');
    }

    /**
     * Set the days.
     *
     * @param  string  $value
     * @return void
     */

    public function setDaysAttribute($value)
    {
        $this->attributes['days'] = json_encode($value);
    }


    /**
     * Set the weeks.
     *
     * @param  string  $value
     * @return void
     */

    public function setWeeksAttribute($value)
    {
        $this->attributes['weeks'] = json_encode($value);
    }


    /**
     * Get days in array format
     *
     * @param  string  $value
     * @return array
     */

    public function getDaysAttribute($value)
    {
        return json_decode($value) ?: [];
    }

    /**
     * Get weeks in array format
     *
     * @param  string  $value
     * @return array
     */

    public function getWeeksAttribute($value)
    {
        return json_decode($value) ?: [];
    }
}
