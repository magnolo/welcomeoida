<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poi extends Model
{
    //
    protected $table="point_of_interests";

    public function type(){
      return $this->belongsTo('App\Models\PoiType','type_id');
    }
    public function image(){
      return $this->belongsTo('App\Models\Photo', 'image_id');
    }
}
