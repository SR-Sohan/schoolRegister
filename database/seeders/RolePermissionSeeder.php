<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run()
    {
        $adminRole = Role::create(['name' => 'admin']);
        $modules = ['institute', 'manage', 'students', 'teachers', 'fees', 'communication', 'notice','school','registration'];
        $actions = ['view', 'create', 'edit', 'delete'];

        foreach ($modules as $module) {
            foreach ($actions as $action) {
                Permission::firstOrCreate(['name' => "$action.$module"]);
            }
        }

        // Admin permissions
        Permission::firstOrCreate(['name' => 'manage-roles']);
        Permission::firstOrCreate(['name' => 'manage-permissions']);
        $adminRole->givePermissionTo(Permission::all());
    }
}
