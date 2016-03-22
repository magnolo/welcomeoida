<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Poi;

class PoiController extends Controller
{
    //
    public function all(){
      $pois = Poi::with(['type', 'image'])->get();
      $data = ["features"=>[],"type" => "FeatureCollection"];

      $eventView = \View::make('includes.map.popups.event', [])->render();
      $personView = \View::make('includes.map.popups.person', [])->render();

      foreach($pois as $poi){
        $popup = $personView;
        $icon = "/images/markers/ball.png";
        if($poi->type_id == 2){
          $popup = $eventView;
          $icon = "/images/markers/ball.png";
        }
        $entry = [
          "type" => "Feature",
          "geometry" => [
            "type" => "Point",
            "coordinates" => [$poi->lat, $poi->lng]
          ],
          "properties" => $poi->toArray(),
          "style" => [
               "icon" => [
                   "iconUrl" => $icon,
                   "iconSize" => [16,16],
                   "iconAnchor" => [8,8]
                 ]
            ],
          "popupTemplate" => $popup

        ];
        $data["features"][] = $entry;
      }
      return $data;
    }
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
            //"marker-color" => "#63b6e5",
             "marker-symbol"=> "marker"
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

    public function createEvent(Request $request){
      $title = $request->input('title');
      $address = $request->input('address');
      $address = $address['properties'];


      $event = new Poi();
      $event->image_id = $request->input('image_id');
      $event->lat = $request->input('lat');
      $event->lng = $request->input('lng');
      $event->email = $request->input('email');
      $event->title = $title;
      $event->first_name = $request->input('first_name');
      $event->last_name = $request->input('last_name');
      $event->slug = str_slug($title);
      $event->ip_address = $request->ip();
      $event->street_name = $address['street'];
      $event->country = $address['country'];
      $event->building_number = $address['housenumber'];
      $event->address = $address['label'];
      $event->city = $address['locality'];
      $event->type_id = 2;
      $event->from_date = $request->input('from_date');
      $event->to_date = $request->input('to_date');
      $event->save();

      if($request->input('solidarisch')){
        $this->createHuman($request);
      }

      return $event;
    }
}
