<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;

class RoleShowController extends Controller
{
    /**
     * @var Permission
     */
    protected $permission;

    /**
     * @param Permission $permission
     */
    public function __construct(Permission $permission)
    {
        $this->middleware([
            'auth'
        ]);
        $this->permission = $permission;
    }

    /**
     * @param Role $role
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Role $role)
    {
        $role->load([
            'permissions' => function ($query) {
                $query->oldest('name');
            }
        ]);
        $permissions = $this->permission
            ->oldest('name')
            ->get();
        return view('roles.edit', ['role' => $role, 'permissions' => $permissions]);
    }
}
