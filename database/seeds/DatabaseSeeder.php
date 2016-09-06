<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Example: call an external seeder
        // $this->call(UsersTableSeeder::class);
        
        // Seed the Permissions and Roles tables
        $this->call(PermissionTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        
        // Create an "Admin" user
        $admin =            new User();
        $admin->name =      "Admin Dude";
        $admin->email =     "admin@test.com";
        $admin->password =  Hash::make('password123');
        $admin->save();
        
        // assign the "Admin" role
        $adminRole = Role::where('name', '=', 'admin')->first();
        $admin->attachRole($adminRole);
                
        // Create an "Item Manager" user
        $manager =          new User();
        $manager->name =    "Manager Dude";
        $manager->email =   "manager@test.com";
        $manager->password = Hash::make('password123');
        $manager->save();
        
        // assign the "Item Manager" role
        $managerRole = Role::where('name', '=', 'item-manager')->first();
        $manager->attachRole($managerRole);
    }
}
