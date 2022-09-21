<?php

namespace App\Http\Controllers\Permission;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;

class PermissionShowController extends Controller
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
     * @param Permission $permission
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Permission $permission)
    {
        $permission->load([
            'roles' => function ($query) {
                $query->oldest('name');
            }
        ]);
        $roles = $this->role
            ->oldest('name')
            ->get();
        return view('permissions.edit', ['permission' => $permission, 'roles' => $roles]);
    }
}
