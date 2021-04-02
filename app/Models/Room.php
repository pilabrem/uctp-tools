<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{

    use SoftDeletes;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'rooms';

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
        'id_room',
        'capacity',
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


    // Travels
    public function travels()
    {
        return $this->hasMany(Travel::class);
    }

    // Room unavailabilities
    public function unavailabilities()
    {
        return $this->hasMany(RoomUnavailable::class);
    }
}
