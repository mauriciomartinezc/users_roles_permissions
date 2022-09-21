<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = new Permission();
        $permission->name = 'Super administrador';
        $permission->save();
        $permission->roles()->attach(1);
        Permission::factory()->count(100)->create();
        $roles = Role::all();
        foreach ($roles as $role) {
            $permissions = Permission::inRandomOrder()->limit(3)->pluck('id')->toArray();
            $role->permissions()->sync($permissions);
        }
    }
}
