<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->first_name = 'Super';
        $user->last_name = 'Admin';
        $user->email = 'sadmin@localhost.com';
        $user->phone = '3000000000';
        $user->password = bcrypt('password');
        $user->email_verified_at = Carbon::now();
        $user->remember_token = Str::random(10);
        $user->role_id = 1;
        $user->save();

        User::factory()->count(100)->create();
    }
}
