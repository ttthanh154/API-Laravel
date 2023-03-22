<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
         // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $arrayOfPermissionNames = [
            'messages create','messages view','messages edit','messages delete',
            'settings create','settings view','settings edit','settings delete',
            'users create','users view','users edit','users delete',
            'posts create','posts view','posts edit','posts delete',
            'blogs create','blogs view','blogs edit','blogs delete',
        ];
        
        $permissions = collect($arrayOfPermissionNames)->map(function($permissions){
            return ['name' => $permissions, 'guard_name' => 'web'];
        });

        Permission::insert($permissions->toArray());
        $role = Role::create(['name' => 'super admin'])->givePermissionTo($arrayOfPermissionNames);
        
    }
}
