<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\RoleUpdateRequest;
use App\Models\Role;

class RoleUpdateController extends Controller
{
    public function __construct()
    {
        $this->middleware([
            'auth'
        ]);
    }

    /**
     * @param RoleUpdateRequest $roleUpdateRequest
     * @param Role $role
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(RoleUpdateRequest $roleUpdateRequest, Role $role)
    {
        $attributes = $roleUpdateRequest->all();
        $role->setDataUpdate($attributes);
        $role->save();
        $role->permissions()->sync($attributes['permissions']);
        return redirect('/roles');
    }
}
