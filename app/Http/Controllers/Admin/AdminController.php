<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Poi;

class AdminController extends Controller{

  public function home(){
    $people =  Poi::with('type')->get();

    return view('admin.home')
      ->with('people', $people);
  }
}
