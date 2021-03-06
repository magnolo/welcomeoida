<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Poi;
use App\Models\User;
use App\Models\Role;
use App\Models\Partner;
use Illuminate\Http\Request;
use App\Logic\User\UserRepository;

use App\Http\Requests;

class AdminController extends Controller{


  public function home(){
    return view('admin.home');
      //->with('user', $this->auth->user());
  }
  public function all(){
    $people =  Poi::with('type', 'image', 'user')->orderBy('created_at', 'DESC')->get();
    return $people;
  }
  public function roles(){
    return Role::all();
  }
  public function users(){
    return User::with('roles')->get();
  }
  public function partners(){
    return Partner::with('image')->orderBy('created_at', 'DESC')->get();
  }
  public function usersRole(Request $request, $id){
    $roles = Role::all();
    $role = Role::findOrFail($request->input('roleId'));
    $user = User::findOrFail($id);

    foreach ($roles as $key => $r) {
      $user->removeRole($r);
    }
    $user->assignRole($role);
    return $role;

  }
  public function update(Request $request, UserRepository $userRepository, $id ){
    $poi = Poi::findOrFail($id);
    $poi->is_public = $request->input('is_public');
    $poi->save();
    if($poi->is_public){
      if($poi->user_id){
        $user = User::find($poi->user_id);
        $userRepository->publicEvent( $user, $poi );
      }

    }

    return $poi;
  }
  public function updatePartner(Request $request, UserRepository $userRepository, $id ){
    $partner = Partner::findOrFail($id);
    $partner->is_public = $request->input('is_public');
    $partner->save();
    if($partner->is_public){
        $userRepository->publicPartner( $partner );
    }

    return $partner;
  }
  public function bulkPublic(Request $request, UserRepository $userRepository){
    $pois = Poi::whereIn('id', $request->input('ids'));
    $pois->update([
      'is_public' => $request->input('is_public')
    ]);
    if($request->input('is_public')){
      foreach ($pois as $key => $poi) {
        if($poi->user_id){
          $user = User::find($poi->user_id);
          $userRepository->publicEvent( $user, $poi );
        }
      }
    }

    return $pois;
  }
  public function bulkDelete(Request $request){
    $pois = Poi::whereIn('id', $request->input('ids'))->delete();
    return $pois;
  }
}
