<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Guard;

class Authenticate
{

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    // public function handle($request, Closure $next, $guard = null)
    // {
    //     if (Auth::guard($guard)->guest()) {
    //         if ($request->ajax() || $request->wantsJson()) {
    //             return response('Unauthorized.', 401);
    //         } else {
    //             return redirect()->guest('login');
    //         }
    //     }
    //
    //     return $next($request);
    // }
    public function handle($request, Closure $next, $role)
    {

        if(!$this->auth->check())
        {
            if($request->ajax()){
              return response('Not allowed', 401);
            }
            else{
              return redirect()->route('auth.login')
                  ->with('status', 'error')
                  ->with('message', 'Bitte melde dich an.');
            }

        }

        if($role == 'all')
        {
            return $next($request);
        }
        if( $this->auth->guest() || !$this->auth->user()->hasRole($role))
        {
          return redirect()->route('auth.login')
              ->with('status', 'error')
              ->with('message', 'Bitte melde dich an.');
        }
        return $next($request);
    }
}
