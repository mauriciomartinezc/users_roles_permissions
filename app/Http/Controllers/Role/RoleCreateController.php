<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\RoleCreateRequest;
use App\Models\Permission;
use App\Models\Role;

class RoleCreateController extends Controller
{
    /**
     * @var Role
     */
    protected $role;

    /**
     * @var Permission
     */
    protected $permission;

    /**
     * @param Role $role
     * @param Permission $permission
     */
    public function __construct(Role $role, Permission $permission)
    {
        $this->middleware([
            'auth'
        ]);
        $this->role = $role;
        $this->permission = $permission;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $permissions = $this->permission
            ->oldest('name')
            ->get();
        return view('roles.create', ['permissions' => $permissions]);
    }

    /**
     * @param RoleCreateRequest $roleCreateRequest
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(RoleCreateRequest $roleCreateRequest)
    {
        $attributes = $roleCreateRequest->all();
        $dataCreate = $this->role->setDataCreate($attributes);
        $this->role = $this->role->create($dataCreate);
        $this->role->permissions()->sync($attributes['permissions']);
        return redirect('/roles');
    }
}
