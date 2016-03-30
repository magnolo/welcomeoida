<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Partner;

class PagesController extends Controller
{
    //
    public function getHome(){
      $partners = Partner::where('is_public', 1)->with('image')->get();
      
      return view('pages.home')
        ->with('partners', $partners);
    }
}
