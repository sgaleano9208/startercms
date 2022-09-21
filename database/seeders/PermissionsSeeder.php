<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create default permissions
        Permission::create(['name' => 'list clients']);
        Permission::create(['name' => 'view clients']);
        Permission::create(['name' => 'create clients']);
        Permission::create(['name' => 'update clients']);
        Permission::create(['name' => 'delete clients']);

        Permission::create(['name' => 'list clientcooperativehistories']);
        Permission::create(['name' => 'view clientcooperativehistories']);
        Permission::create(['name' => 'create clientcooperativehistories']);
        Permission::create(['name' => 'update clientcooperativehistories']);
        Permission::create(['name' => 'delete clientcooperativehistories']);

        Permission::create(['name' => 'list contacts']);
        Permission::create(['name' => 'view contacts']);
        Permission::create(['name' => 'create contacts']);
        Permission::create(['name' => 'update contacts']);
        Permission::create(['name' => 'delete contacts']);

        Permission::create(['name' => 'list cooperatives']);
        Permission::create(['name' => 'view cooperatives']);
        Permission::create(['name' => 'create cooperatives']);
        Permission::create(['name' => 'update cooperatives']);
        Permission::create(['name' => 'delete cooperatives']);

        Permission::create(['name' => 'list countries']);
        Permission::create(['name' => 'view countries']);
        Permission::create(['name' => 'create countries']);
        Permission::create(['name' => 'update countries']);
        Permission::create(['name' => 'delete countries']);

        Permission::create(['name' => 'list salespeople']);
        Permission::create(['name' => 'view salespeople']);
        Permission::create(['name' => 'create salespeople']);
        Permission::create(['name' => 'update salespeople']);
        Permission::create(['name' => 'delete salespeople']);

        Permission::create(['name' => 'list states']);
        Permission::create(['name' => 'view states']);
        Permission::create(['name' => 'create states']);
        Permission::create(['name' => 'update states']);
        Permission::create(['name' => 'delete states']);

        Permission::create(['name' => 'list typologies']);
        Permission::create(['name' => 'view typologies']);
        Permission::create(['name' => 'create typologies']);
        Permission::create(['name' => 'update typologies']);
        Permission::create(['name' => 'delete typologies']);

        // Create user role and assign existing permissions
        $currentPermissions = Permission::all();
        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo($currentPermissions);

        // Create admin exclusive permissions
        Permission::create(['name' => 'list roles']);
        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'update roles']);
        Permission::create(['name' => 'delete roles']);

        Permission::create(['name' => 'list permissions']);
        Permission::create(['name' => 'view permissions']);
        Permission::create(['name' => 'create permissions']);
        Permission::create(['name' => 'update permissions']);
        Permission::create(['name' => 'delete permissions']);

        Permission::create(['name' => 'list users']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);

        // Create admin role and assign all permissions
        $allPermissions = Permission::all();
        $adminRole = Role::create(['name' => 'super-admin']);
        $adminRole->givePermissionTo($allPermissions);

        $user = \App\Models\User::whereEmail('admin@admin.com')->first();

        if ($user) {
            $user->assignRole($adminRole);
        }
    }
}
