<?php

namespace App\Http\Controllers\Permission;

use App\Http\Controllers\Controller;
use App\Models\Permission;

class PermissionIndexController extends Controller
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

    public function index()
    {
        $permissions = $this->permission
            ->latest('id')
            ->paginate(20);
        return view('permissions.index', ['permissions' => $permissions]);
    }
}
