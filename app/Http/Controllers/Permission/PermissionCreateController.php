<?php

namespace App\Http\Controllers\Permission;

use App\Http\Controllers\Controller;
use App\Http\Requests\Permission\PermissionCreateRequest;
use App\Models\Permission;
use App\Models\Role;

class PermissionCreateController extends Controller
{
    /**
     * @var Permission
     */
    protected $permission;

    /**
     * @var Role
     */
    protected $role;

    /**
     * @param Permission $permission
     * @param Role $role
     */
    public function __construct(Permission $permission, Role $role)
    {
        $this->middleware([
            'auth'
        ]);
        $this->permission = $permission;
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
        return view('permissions.create', ['roles' => $roles]);
    }

    /**
     * @param PermissionCreateRequest $permissionCreateRequest
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(PermissionCreateRequest $permissionCreateRequest)
    {
        $attributes = $permissionCreateRequest->all();
        $dataCreate = $this->permission->setDataCreate($attributes);
        $this->permission = $this->permission->create($dataCreate);
        $this->permission->roles()->sync($attributes['roles']);
        return redirect('/permissions');
    }
}
