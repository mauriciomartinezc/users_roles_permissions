<?php

namespace App\Http\Controllers\Permission;

use App\Http\Controllers\Controller;
use App\Http\Requests\Permission\PermissionUpdateRequest;
use App\Models\Permission;

class PermissionUpdateController extends Controller
{
    public function __construct()
    {
        $this->middleware([
            'auth'
        ]);
    }

    /**
     * @param PermissionUpdateRequest $permissionUpdateRequest
     * @param Permission $permission
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(PermissionUpdateRequest $permissionUpdateRequest, Permission $permission)
    {
        $attributes = $permissionUpdateRequest->all();
        $permission->setDataUpdate($attributes);
        $permission->save();
        $permission->roles()->sync($attributes['roles']);
        return redirect('/permissions');
    }
}
