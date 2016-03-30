<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Poi;

class EventController extends Controller
{
    //

    public function userEvents(){
      $events = Poi::where('type_id', 2)->where('user_id', \Auth::user()->id)->with('type', 'image')->orderBy('updated_at', 'DESC')->paginate(15);
      foreach($events as &$event){
        $event->date = date('H:i', strtotime($event->from_date));
        if($event->to_date != "0000-00-00 00:00:00"){
          $event->date .= " - ".date('H:i', strtotime($event->to_date));
        }
      }
      return view('pages.events')
          ->with('events', $events);
    }
    public function showEvent($id){
      $event = Poi::where('id', $id)->with('type', 'image')->first();
      $event->from_time = date('H:i', strtotime($event->from_date));
      $event->to_time = date('H:i', strtotime($event->to_date));
      return view('pages.event')
          ->with('event', $event);
    }
    public function updateEvent(Request $request, $id){
      $address = array();
      if(isset($request->input['location'])){
          $address = json_decode($request->input('location'));
          $address = $address->properties;
      }

      $title = $request->input('title');

      $user =  \Auth::user();

      $event = Poi::find($id);
      $event->image_id = $request->input('image_id');
      $event->lat = $request->input('lat');
      $event->lng = $request->input('lng');

      $event->url = $request->input('url');
      $event->phone = $request->input('phone');
      $event->title = $title;
      $event->description = $request->input('description');
      $event->slug = str_slug($title);
      $event->ip_address = $request->ip();
      $event->street_name = isset($address['street']) ? $address['street'] : null ;
      $event->country = isset($address['country']) ? $address['country'] : '';
      $event->building_number = isset($address['housenumber']) ? $address['housenumber'] : null;
      $event->address = $request->input('address');
      //$event->city = $address['layer'] == 'region' ? $address['name'] : $address['county'];
      //$event->type_id = 2;
      $event->from_date = '2016-06-21 '.$request->input('from_time');
      $event->to_date = $request->input('to_time') != '' ? '2016-06-21 '.$request->input('to_time') : null;
      $event->user_id = $user->id;
      $event->save();

      return redirect()->back()
          ->with('status', 'success')
          ->with('title', 'Event erfolgreich gespeichert')
          ->with('message', '');
    }
}
