<?php

namespace App\Http\Controllers\TwoFactorAuth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TwoFactorAuthResendController extends Controller
{
    public function __construct()
    {
        $this->middleware([
            'auth'
        ]);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resend(): \Illuminate\Http\RedirectResponse
    {
        $user = Auth::user();
        $user->generateTwoFactorAuthCode();
        return back()->with('success', 'Te enviamos el código a tu número de teléfono.');
    }
}
