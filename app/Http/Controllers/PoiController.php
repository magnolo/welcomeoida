<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Poi;

class PoiController extends Controller
{
    //
    public function humans(){
      $pois = Poi::with('type')->get();
      $data = ["features"=>[],"type" => "FeatureCollection"];
      foreach($pois as $poi){
        $entry = [
          "type" => "Feature",
          "geometry" => [
            "type" => "Point",
            "coordinates" => [$poi->lat, $poi->lng]
          ],
          "properties" => [
            "name" => $poi->title,
            //"marker-symbol" => 'harbor'
          ]
        ];
        $data["features"][] = $entry;
      }
      return $data;
    }

    public function createHuman(Request $request){
      $human = new Poi();
      $human->type_id = 1;
      $human->lat = $request->input('lat');
      $human->lng = $request->input('lng');
      $human->title = $request->input('name');
      $human->slug = str_slug($request->input('name'));
      $human->save();

      return $human;
    }
}
