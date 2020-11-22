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
        $user->name = "Default User";
        $user->email = "user@mail.com";
        $user->password = Hash::make("secret");
        $user->rol = "Admin";
        $user->save();
    }
}