<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = "Admin";
        $user->email = "admin@mail.com";
        $user->password = Hash::make("secret");
        $user->role_id = 1;
        $user->save();

        $user = new User();
        $user->name = "Client";
        $user->email = "user@mail.com";
        $user->password = Hash::make("secret");
        $user->role_id = 2;
        $user->save();
    }
}
