<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDeleteController extends Controller
{
    public function __construct()
    {
        $this->middleware([
            'auth'
        ]);
    }

    /**
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(User $user)
    {
        if (Auth::user()->id != $user->id) {
            $user->delete();
        }
        return redirect('/users');
    }
}
