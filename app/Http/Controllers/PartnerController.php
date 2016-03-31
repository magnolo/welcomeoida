<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Partner;
use App\Logic\User\UserRepository;

class PartnerController extends Controller
{
    //
    public function createPartner(Request $request,  UserRepository $userRepository){
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
      $partner->load('image');
      $userRepository->newPartner($partner );
      return $partner;
    }
}
