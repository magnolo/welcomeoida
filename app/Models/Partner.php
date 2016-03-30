<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    //
    protected $table="partners";

    public function image(){
      return $this->belongsTo('App\Models\Photo', 'image_id');
    }
}
