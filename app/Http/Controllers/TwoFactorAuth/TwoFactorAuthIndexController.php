<?php

namespace App\Http\Controllers\TwoFactorAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TwoFactorAuthIndexController extends Controller
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
    public function index()
    {
        return view('2fa.index');
    }
}
