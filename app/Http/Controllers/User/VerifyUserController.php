<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class VerifyUserController extends Controller
{
    public function __construct()
    {
        $this->middleware([
            'auth'
        ]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function verify()
    {
        $user = Auth::user();
        $user->verifyEmail();
        $user->save();
        return view('verifyUser.index');
    }
}
