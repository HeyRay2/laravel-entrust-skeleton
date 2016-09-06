<?php

use Illuminate\Database\Seeder;
use App\Permission;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create admin role 
        $admin =                new Role();
        $admin->name =          'admin';
        $admin->display_name =  'User Administrator'; // optional
        $admin->description =   'User is allowed to manage and edit other users, roles, and items'; // optional
        $admin->save();

        $adminPermissions = Permission::pluck('id');
        
        // and assign all permission like as below
        foreach ($adminPermissions as $permission) {
            $admin->attachPermission($permission);
        }
        
        // create Item Manager role
        $itemManager =                  new Role();
        $itemManager->name =            'item-manager';
        $itemManager->display_name =    'Item Manager';
        $itemManager->description =     'User is allowed to manage items (CRUD)';
        
        // get Item permissions
        $managerPermissions = Permission::where('name', 'like', 'item-%');
        
        // assign Item permissions to role
        foreach ($managerPermissions as $permission) {
            $itemManager->attachPermission($permission);
        }
    
    }
}
