<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Poi;

class PoiController extends Controller
{
    //
    public function humans(){
      $pois = Poi::where('type_id', 1)->with('type')->get();
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
    public function events(){
      $pois = Poi::where('type_id', 2)->with('type')->get();
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
      $title = $request->input('firstname');
      if(strlen($request->input('lastname'))){
        $title .= " ".substr($request->input('lastname'),0,1).".";
      }

      $human = new Poi();
      $human->type_id = 1;
      $human->lat = $request->input('lat');
      $human->lng = $request->input('lng');
      $human->email = $request->input('email');
      $human->title = $title;
      $human->first_name = $request->input('first_name');
      $human->last_name = $request->input('last_name');
      $human->slug = str_slug($title);
      $human->ip_address = $request->ip();
      $human->save();

      return $human;
    }
}
