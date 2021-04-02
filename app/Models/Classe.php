<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Classe extends Model
{

    use SoftDeletes;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'classes';

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
        'limit',
        'subpart_id',
        'parent_id'
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
     * Get the subpart for this model.
     *
     * @return App\Models\Subpart
     */
    public function subpart()
    {
        return $this->belongsTo('App\Models\Subpart', 'subpart_id');
    }

    /**
     * Get the parent for this model.
     *
     * @return App\Models\Classe
     */
    public function parent()
    {
        return $this->belongsTo('App\Models\Classe', 'parent_id');
    }


    // Possible Rooms
    public function possibleRooms()
    {
        return $this->hasMany(ClassPossibleRoom::class);
    }

    // Possible Times
    public function possibleTimes()
    {
        return $this->hasMany(ClassPossibleTime::class);
    }
}
