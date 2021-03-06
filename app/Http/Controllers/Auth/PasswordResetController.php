<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Logic\User\UserRepository;
use App\Models\User;
use App\Models\Password;
use Validator, Hash;
use Illuminate\Support\Facades\Input;

class PasswordResetController extends Controller {
    public function getPasswordReset()
    {
        return view('auth.password-reset');
    }
    public function postPasswordReset( UserRepository $userRepository)
    {
        $rules = [
            'email' => 'email|required'
        ];
        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails())
        {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $email  = Input::get('email');
        $user   = User::where('email', '=', $email)->first();
        if(empty($user))
        {
            return redirect()->back()
                ->withErrors(['Ein Benutzer mit dieser Email ist uns nicht bekannt']);
        }
        $userRepository->resetPassword( $user );
        return redirect()->back()
            ->with('status', 'success')
            ->with('title', 'Anfrage erfolgreich')
            ->with('message', 'Du hast Post!');
    }
    public function getPasswordResetForm( $token )
    {
        return view('auth.password-reset-form', compact('token'));
    }
    public function postPasswordResetForm( $token )
    {
        $rules = [
            'password'              => 'required|min:6|max:20',
            'password_confirmation' => 'required|same:password'
        ];
        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails())
        {
            return redirect()->back()
                ->with('title', 'Fehler bei der Eingabe')
                ->withErrors($validator);
        }
        $password = Password::where('token', '=', $token)->first();
        if(empty($password))
        {
            return view('pages.status')
                ->with('error', 'Reset token ist ungültig');
        }
        $user = User::where('email', '=', $password->email)->first();
        $user->password = Hash::make(Input::get('password'));
        $user->save();
        $password->delete();
        return redirect()->route('auth.login')
            ->with('status', 'success')
            ->with('title', 'Passwort erfolgreich geändert!');
    }
}
