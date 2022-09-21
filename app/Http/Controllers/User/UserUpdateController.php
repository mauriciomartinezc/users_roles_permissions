<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\User;

class UserUpdateController extends Controller
{
    public function __construct()
    {
        $this->middleware([
            'auth'
        ]);
    }

    /**
     * @param UserUpdateRequest $userUpdateRequest
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UserUpdateRequest $userUpdateRequest, User $user)
    {
        $attributes = $userUpdateRequest->all();
        $user->setDataUpdate($attributes);
        $user->save();
        return redirect('/users');
    }
}
