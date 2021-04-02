<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentCourse extends Model
{
    
    use SoftDeletes;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'student_courses';

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
                  'student_id',
                  'course_id'
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
     * Get the student for this model.
     *
     * @return App\Models\Student
     */
    public function student()
    {
        return $this->belongsTo('App\Models\Student','student_id');
    }

    /**
     * Get the course for this model.
     *
     * @return App\Models\Course
     */
    public function course()
    {
        return $this->belongsTo('App\Models\Course','course_id');
    }



}
