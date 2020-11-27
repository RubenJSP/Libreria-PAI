<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create(['name' => 'Admin']);
        $client =  Role::create(['name' => 'User']);

        //Categories
        Permission::create(['name' => 'crud categories']);
        //Books
        Permission::create(['name' => 'view books']);
        Permission::create(['name' => 'edit books']);
        Permission::create(['name' => 'create books']);
        Permission::create(['name' => 'delete books']);
        //Users
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'delete users']);
        //Loans
        Permission::create(['name' => 'view loans']);
        Permission::create(['name' => 'edit loans']);
        Permission::create(['name' => 'create loans']);
        Permission::create(['name' => 'delete loans']);
        //Dashboard
        Permission::create(['name' => 'view dashboard']);
        $admin->givePermissionTo([
        'view dashboard',
        
        'crud categories',
        'view books',
        'edit books',
        'create books',
        'delete books',

        'view users',
        'edit users',
        'create users',
        'delete users',

        'view loans',
        'edit loans',
        'create loans',
        'delete loans'
        ]);

        $client->givePermissionTo([
        'view books',

        'view loans',
        'edit loans',
        'create loans',]);

        $users = User::all();

        foreach ($users as $user) {
            if($user->role_id != null)
                $user->assignRole($user->role_id);
        }
    } 
}
