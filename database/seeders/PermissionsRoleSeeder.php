<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class PermissionsRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        Role::truncate();
        Permission::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
       
         // Reset cached roles and permissions
         app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

         $author = [
             'edit-blog',
             'delete-blog',
             'create-blog',
             'view-blog',
             'export-blog',
         ];

         // create permissions
         Permission::create(['name' => 'edit-blog']);
         Permission::create(['name' => 'delete-blog']);
         Permission::create(['name' => 'create-blog']);
         Permission::create(['name' => 'view-blog']);


        Permission::create(['name' => 'import-blog']);
        Permission::create(['name' => 'export-blog']);

        // create users
        Permission::create(['name' => 'edit-user']);
        Permission::create(['name' => 'delete-user']);
        Permission::create(['name' => 'create-user']);
        Permission::create(['name' => 'view-user']);

        Permission::create(['name' => 'assign-role']);


         // update cache to know about the newly created permissions (required if using WithoutModelEvents in seeders)
         app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
 
 
         // create roles and assign created permissions
 
         // this can be done as separate statements
         $role = Role::create(['name' => 'author']);
         $role->givePermissionTo($author);
 
         $role = Role::create(['name' => 'super-admin']);
         $role->givePermissionTo(Permission::all());
    }
}
