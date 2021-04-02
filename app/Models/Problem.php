<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Problem extends Model
{

    use SoftDeletes;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'problems';

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
        'name',
        'nr_days',
        'nr_weeks',
        'slots_per_day',
        'begin_hour',
        'week_days',
        'minutes_per_slot',
        'time_optimization',
        'room_optimization',
        'distribution_optimization',
        'student_optimisation',
        'is_random',
        'problem_class'
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


    // rooms
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }


    // courses
    public function courses()
    {
        return $this->hasMany(Course::class);
    }


    // distributions
    public function distributions()
    {
        return $this->hasMany(Distribution::class);
    }


    // students
    public function students()
    {
        return $this->hasMany(Student::class);
    }







    // Get weeks list in readable format
    public function getWeeksBinary(array $allWeeks)
    {
        $weeks = "";

        for ($i = 1; $i <= $this->nr_weeks; $i++) {
            if (in_array('' . $i, $allWeeks)) {
                $weeks .= "1";
            } else {
                $weeks .= "0";
            }
        }

        return $weeks;
    }

    // Get days list in readable format
    public function getDaysBinary(array $allDays)
    {
        $days = "";

        for ($i = 1; $i <= $this->nr_days; $i++) {
            if (in_array('' . $i, $allDays)) {
                $days .= "1";
            } else {
                $days .= "0";
            }
        }

        return $days;
    }

    // Get days list in printable format
    public function getDays(array $allDays)
    {
        $weekDays = [
            1 => "Lundi",
            2 => "Mardi",
            3 => "Mercredi",
            4 => "Jeudi",
            5 => "Vendredi",
            6 => "Samedi",
            7 => "Dimanche"
        ];

        $days = "";
        $nbDays = count($allDays);

        for ($i = 0; $i < $nbDays; $i++) {
            $dayNum = intval($allDays[$i]);

            if (is_int($dayNum)) {
                $days .= $weekDays[$dayNum] . ", ";
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
