<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Models\Role;

class RoleIndexController extends Controller
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

    public function index()
    {
        $roles = $this->role
            ->latest('id')
            ->paginate(20);
        return view('roles.index', ['roles' => $roles]);
    }
}
