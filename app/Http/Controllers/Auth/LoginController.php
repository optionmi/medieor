<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // protected function sendLoginResponse(Request $request)
    // {
    //     $request->session()->regenerate();

    //     $this->clearLoginAttempts($request);

    //     return $this->authenticated($request, $this->guard()->user())
    //         ?: redirect()->intended($request->session()->pull('previous_url', '/'));
    // }

    protected function authenticated(Request $request, $user)
    {
        // Store the previous last login time in the session
        // session('last_login_at', $user->last_login_at);
        $request->session()->put('last_login_at', $user->last_login_at);

        // Update last login time to the current time
        $user->last_login_at = Carbon::now();
        $user->save();

        return redirect()->intended($request->session()->pull('previous_url', '/'));
    }
}
