<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        $modules = [
            'Users' => ['Users-User'],
            'Sessions' => ['Sessions-Class', 'Sessions-Group', 'Sessions-Subject', 'Sessions-Register', 'Sessions-Form'],
            'Students' => ['Students-Admin-List', 'Students-Admin-Exports-Image', 'Students-Admin-Card', 'Students-School-List', 'Students-School-Exports-Image', 'Students-School-Id-Card'],
            'Teachers' => ['Teachers-Admin', 'Teachers-School', 'Teachers-School-Id-Card', 'Teachers-Admin-Id-Card'],
            'Fees' => ['Fees-Admin-Set-Fees', 'Fees-Admin-Fees-List', 'Fees-Admin-Fees-Payment', 'Fees-School-Fees-list', 'Fees-School-Fees-Pay'],
            'Notice' => ['Notice-Create-Notice', 'Notice-Show-Notice'],
            'Communication' => ['Communication-SendMessage', 'Communication-School-Message-List'],
            'Registration' => ['Registration-School-Register', 'Registration-Admin-Register'],
            'Reports' => ['Reports-School-Reports', 'Reports-Admin-Reports'],
            'FormFilap' => ['FormFilap-Admin-Form-Filap', 'FormFilap-School-Form-Filap'],
            'Rolepermission' => ['Rolepermission-Permission']
        ];

        // 1️⃣ Module-level permissions (only "create")
        foreach ($modules as $moduleName => $items) {
            Permission::firstOrCreate(['name' => strtolower($moduleName)]);
        }


        // 2️⃣ Item-level permissions (view, create, edit, delete)
        $actions = ['view', 'create', 'edit', 'delete'];
        foreach ($modules as $module => $items) {
            foreach ($items as $item) {
                foreach ($actions as $action) {
                    Permission::firstOrCreate(['name' => strtolower($item) . '.' . $action]);
                }
            }
        }

        // 3️⃣ Create Super Admin and give all permissions
        $adminRole = Role::firstOrCreate(['name' => 'Super Admin']);
        $adminRole->givePermissionTo(Permission::all());
    }
}
