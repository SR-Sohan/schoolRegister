<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller implements HasMiddleware
{

      public static function middleware(): array
    {
        return [
            // read
            new Middleware('permission:rolepermission-permission.view', only: ['index','show']),

            // create
            new Middleware('permission:rolepermission-permission.create', only: ['create','store']),

            // update
            new Middleware('permission:rolepermission-permission.edit', only: ['edit','update']),

            // delete
            new Middleware('permission:rolepermission-permission.delete', only: ['destroy']),
        ];
    }

    public function index()
    {
        $roles = Role::with('permissions')->get();
        $permissions = Permission::all()->groupBy(function ($permission) {
            return explode('-', $permission->name)[1] ?? 'general';
        });
        return view('dashboard.pages.roles.index', compact('roles', 'permissions'));
    }

    public function create()
    {
      $allPermissions = Permission::all();

        $permissions = $allPermissions->groupBy(function ($perm) {
            // Split by '-' or '.' and take the first segment
            $firstWord = preg_split('/[-.]/', $perm->name)[0];
            return strtolower($firstWord);
        });
        return view('dashboard.pages.roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'array',
        ]);

        $role = Role::create(['name' => $request->name]);
        $role->syncPermissions($request->permissions ?? []);

        return redirect()->route('roles.index')->with('success', 'Role created successfully.');
    }

    public function edit(Role $role)
    {
        $allPermissions = Permission::all();

        $permissions = $allPermissions->groupBy(function ($perm) {
            // Split by '-' or '.' and take the first segment
            $firstWord = preg_split('/[-.]/', $perm->name)[0];
            return strtolower($firstWord);
        });

        return view('dashboard.pages.roles.edit', compact('role', 'permissions'));
    }


    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
            'permissions' => 'array',
        ]);

        $role->update(['name' => $request->name]);
        $role->syncPermissions($request->permissions ?? []);

        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }
}
