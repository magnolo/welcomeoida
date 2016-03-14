<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poi extends Model
{
    //
    protected $table="point_of_interests";

    public function type(){
      return $this->belongsTo('App\PoiType','type_id');
    }
}
