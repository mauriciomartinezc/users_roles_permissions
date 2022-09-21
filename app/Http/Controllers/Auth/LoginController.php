<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            auth()->user()->generateTwoFactorAuthCode();
            return redirect()->route('2fa.index');
        }

        return redirect("login")->withSuccess('Ops! Ha ingresado credenciales no válidas');
    }

    protected function authenticated(Request $request, $user)
    {
        if (!$user->email_verified_at) {
            return redirect()->route('users.verify');
        }
        $lastSession = $user->sessions()->latest('created_at')->first();
        if ($lastSession && Carbon::parse($lastSession->created_at)->diffInDays(Carbon::now(), true) >= 1) {
            return redirect()->route('sessions.index');
        }
        return redirect('/');
    }
}
