<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassPossibleRoom extends Model
{
    
    use SoftDeletes;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'class_possible_rooms';

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
                  'room_id',
                  'penalty',
                  'classe_id'
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
        return $this->belongsTo('App\Models\Room','room_id');
    }

    /**
     * Get the classe for this model.
     *
     * @return App\Models\Classe
     */
    public function classe()
    {
        return $this->belongsTo('App\Models\Classe','classe_id');
    }



}
