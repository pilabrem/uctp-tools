<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProblemViewForm extends Model
{

    use SoftDeletes;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'problem_view_forms';

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
        'problem_instance',
        'begin_hour',
        'days',
        'minutes_per_slot'
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

    // Get weeks list in readable format
    public function getWeeks($allWeeks)
    {
        $weeks = "";
        $nbWeeks = strlen($allWeeks);

        for ($i = 0; $i < $nbWeeks; $i++) {
            if ($allWeeks[$i] == '1') {
                $weeks .= ($i + 1) . ", ";
            }
        }

        return $weeks;
    }

    // Get days list in printable format
    public function getDays($allDays)
    {
        $days = "";
        $nbWeeks = strlen($allDays);
        $daysArray = explode(',', $this->days);

        for ($i = 0; $i < $nbWeeks; $i++) {
            if ($allDays[$i] == '1') {
                $days .= $daysArray[$i] . ", ";
            }
        }

        return $days;
    }

    // Get hour by number of time slots
    public function getHour($slots)
    {
        $hour = "";
        $startHour = $this->begin_hour + intdiv(intval($slots) * $this->minutes_per_slot, 60);
        $startMinutes = (intval($slots) * $this->minutes_per_slot) % 60;

        $hour = sprintf('%02d', $startHour) . 'h' . sprintf('%02d', $startMinutes);

        return $hour;
    }
}
