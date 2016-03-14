<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Poi;

class PoiController extends Controller
{
    //
    public function humans(){
      return Poi::with('type')->get();
    }
}
