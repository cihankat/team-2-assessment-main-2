<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        DB::table('roles')->truncate();
        DB::table('permissions')->truncate();

        // Define permissions
        Permission::create(['name' => 'access_admin']);
        Permission::create(['name' => 'view_user']);
        Permission::create(['name' => 'add_user']);
        Permission::create(['name' => 'edit_user']);
        Permission::create(['name' => 'remove_user']);
        Permission::create(['name' => 'view_class']);
        Permission::create(['name' => 'add_class']);
        Permission::create(['name' => 'edit_class']);
        Permission::create(['name' => 'remove_class']);
        Permission::create(['name' => 'add_assessment']);
        Permission::create(['name' => 'view_assessment']);
        Permission::create(['name' => 'edit_assessment']);
        Permission::create(['name' => 'delete_assessment']);
        Permission::create(['name' => 'add_checklist']);
        Permission::create(['name' => 'view_checklist']);
        Permission::create(['name' => 'edit_checklist']);
        Permission::create(['name' => 'delete_checklist']);
        Permission::create(['name' => 'add_userstory']);
        Permission::create(['name' => 'view_userstory']);
        Permission::create(['name' => 'edit_userstory']);
        Permission::create(['name' => 'delete_userstory']);

        // Define roles and assign permissions
        $role = Role::create(['name' => 'student']);



        $role = Role::create(['name' => 'teacher']);
        $role->givePermissionTo('access_admin');
        $role->givePermissionTo('view_class');
        $role->givePermissionTo('edit_class');
        $role->givePermissionTo('remove_class');
        $role->givePermissionTo('add_assessment');
        $role->givePermissionTo('view_assessment');
        $role->givePermissionTo('edit_assessment');
        $role->givePermissionTo('delete_assessment');
        $role->givePermissionTo('add_checklist');
        $role->givePermissionTo('view_checklist');
        $role->givePermissionTo('edit_checklist');
        $role->givePermissionTo('delete_checklist');
        $role->givePermissionTo('add_userstory');
        $role->givePermissionTo('view_userstory');
        $role->givePermissionTo('edit_userstory');
        $role->givePermissionTo('delete_userstory');


        $role = Role::create(['name' => 'administrator']);
        $getPermissions = Permission::all();

        foreach ($getPermissions as $permission) {
            $role->givePermissionTo($permission);
        }
    }
}
