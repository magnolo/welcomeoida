<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Poi;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

use App\Http\Requests;

class AdminController extends Controller{


  public function home(){
    return view('admin.home');
      //->with('user', $this->auth->user());
  }
  public function all(){
    $people =  Poi::with('type', 'image')->orderBy('created_at', 'DESC')->get();
    return $people;
  }
  public function roles(){
    return Role::all();
  }
  public function users(){
    return User::with('roles')->get();
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
  public function update(Request $request, $id ){
    $poi = Poi::findOrFail($id);
    $poi->is_public = $request->input('is_public');
    $poi->save();
    return $poi;
  }
  public function bulkPublic(Request $request){
    $pois = Poi::whereIn('id', $request->input('ids'))->update([
      'is_public' => $request->input('is_public')
    ]);
    return $pois;
  }
  public function bulkDelete(Request $request){
    $pois = Poi::whereIn('id', $request->input('ids'))->delete();
    return $pois;
  }
}
