<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DistributionClass extends Model
{
    
    use SoftDeletes;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'distribution_classes';

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
                  'classe_id',
                  'distribution_id'
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
     * Get the classe for this model.
     *
     * @return App\Models\Classe
     */
    public function classe()
    {
        return $this->belongsTo('App\Models\Classe','classe_id');
    }

    /**
     * Get the distribution for this model.
     *
     * @return App\Models\Distribution
     */
    public function distribution()
    {
        return $this->belongsTo('App\Models\Distribution','distribution_id');
    }



}
