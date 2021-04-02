<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Distribution extends Model
{

    use SoftDeletes;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'distributions';

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
        'type',
        'is_required',
        'penalty',
        'param1',
        'param2',
        'problem_id'
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
     * Get the problem for this model.
     *
     * @return App\Models\Problem
     */
    public function problem()
    {
        return $this->belongsTo('App\Models\Problem', 'problem_id');
    }


    // Classes
    public function classes()
    {
        return $this->hasMany(DistributionClass::class);
    }
}
