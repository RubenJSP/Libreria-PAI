<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::Class);
        $this->call(CategorySeeder::Class);
        $this->call(BookSeeder::Class);
        $this->call(PermissionsTableSeeder::Class);
        $this->call(LoanSeeder::Class);
        // \App\Models\User::factory(10)->create();
    }
}
