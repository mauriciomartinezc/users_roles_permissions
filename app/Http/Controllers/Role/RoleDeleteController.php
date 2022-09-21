<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Models\Role;

class RoleDeleteController extends Controller
{
    public function __construct()
    {
        $this->middleware([
            'auth'
        ]);
    }

    /**
     * @param Role $role
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect('/roles');
    }
}
