<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'admin'],
            ['name' => 'editor'],
            ['name' => 'user'],
        ];

        foreach ($roles as $role) {
            \App\Models\Role::create($role);
        }

        $permissions = [
            ['name' => 'users.create'],
            ['name' => 'users.update'],
            ['name' => 'users.delete'],
            ['name' => 'roles.create'],
            ['name' => 'roles.update'],
            ['name' => 'roles.delete'],
        ];

        foreach ($permissions as $permission) {
            \App\Models\Permission::create($permission);
        }

        $adminRole = \App\Models\Role::where('name', 'admin')->first();
        $permissions = \App\Models\Permission::all();
        $adminRole->permissions()->sync($permissions->pluck('id')->toArray());

        $admin = User::where('email', '=', 'info@abdullahdheir.dev')->first();

        if ($admin) {
            $admin->assignRole($adminRole);
        }
    }
}
