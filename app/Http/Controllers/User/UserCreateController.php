<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserCreateRequest;
use App\Models\Role;
use App\Models\User;

class UserCreateController extends Controller
{
    /**
     * @var User
     */
    protected $user;

    /**
     * @var Role
     */
    protected $role;

    /**
     * @param User $user
     * @param Role $role
     */
    public function __construct(User $user, Role $role)
    {
        $this->middleware([
            'auth'
        ]);
        $this->user = $user;
        $this->role = $role;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $roles = $this->role
            ->oldest('name')
            ->get();
        return view('users.create', ['roles' => $roles]);
    }

    /**
     * @param UserCreateRequest $userCreateRequest
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(UserCreateRequest $userCreateRequest)
    {
        $attributes = $userCreateRequest->all();
        $dataCreate = $this->user->setDataCreate($attributes);
        $this->user->create($dataCreate);
        return redirect('/users');
    }
}
