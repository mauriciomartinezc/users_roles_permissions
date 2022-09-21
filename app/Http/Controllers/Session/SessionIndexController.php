<?php

namespace App\Http\Controllers\Session;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SessionIndexController extends Controller
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
        $sessions = Auth::user()
            ->sessions()
            ->paginate(20);
        return view('sessions.index', ['sessions' => $sessions]);
    }
}
