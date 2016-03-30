<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Partner;

class PartnerController extends Controller
{
    //
    public function createPartner(Request $request){
      $partner = new Partner();

      $partner->name = $request->input('name');
      $partner->email = $request->input('email');
      $partner->phone = $request->input('phone');
      $partner->address = $request->input('address');
      $partner->url = $request->input('url');
      $partner->organisation = $request->input('organisation');
      $partner->message = $request->input('message');
      $partner->is_public = false;
      $partner->image_id = $request->input('image_id');

      $partner->save();

      return $partner;
    }
}
