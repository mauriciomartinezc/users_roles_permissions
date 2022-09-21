<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserShowController extends Controller
{
    /**
     * @var Role
     */
    protected $role;

    /**
     * @param Role $role
     */
    public function __construct(Role $role)
    {
        $this->middleware([
            'auth'
        ]);
        $this->role = $role;
    }

    /**
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(User $user)
    {
        $roles = $this->role
            ->oldest('name')
            ->get();
        return view('users.edit', ['user' => $user, 'roles' => $roles]);
    }
}
