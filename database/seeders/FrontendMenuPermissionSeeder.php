<?php
/*
 * Copyright CWSPS154. All rights reserved.
 * @auth CWSPS154
 * @link  https://github.com/CWSPS154
 */

namespace CWSPS154\FilamentFrontendMenu\Database\Seeders;

use CWSPS154\FilamentUsersRolesPermissions\Models\Permission;
use Illuminate\Database\Seeder;

class FrontendMenuPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $id = Permission::create([
            'name' => 'Menu',
            'identifier' => 'Menu',
            'route' => null,
            'parent_id' => null,
            'status' => true
        ])->id;

        Permission::create([
            'name' => 'View Menu',
            'identifier' => 'view-menu',
            'route' => 'filament.admin.resources.menus.index',
            'parent_id' => $id,
            'status' => true
        ]);

        Permission::create([
            'name' => 'Create Menu',
            'identifier' => 'create-menu',
            'route' => null,
            'parent_id' => $id,
            'status' => true
        ]);

        Permission::create([
            'name' => 'Edit Menu',
            'identifier' => 'edit-menu',
            'route' => null,
            'parent_id' => $id,
            'status' => true
        ]);

        Permission::create([
            'name' => 'Delete Menu',
            'identifier' => 'delete-menu',
            'route' => null,
            'parent_id' => $id,
            'status' => true
        ]);
    }
}
