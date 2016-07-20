<?php

use App\Role;
use App\Permission;
use Illuminate\Database\Seeder;

class AddPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // Permissions
      $createUser = Permission::where('name', '=', 'create-user')->first();
      $editUser = Permission::where('name', '=', 'edit-user')->first();
      $changeRole = Permission::where('name', '=', 'change-role')->first();
      $createAsset = Permission::where('name', '=', 'create-asset')->first();
      $editAsset = Permission::where('name', '=', 'edit-asset')->first();

      // Super Administrator
      $superAdmin = Role::where('name', '=', 'super-admin')->first();
      $superAdmin->attachPermissions(array($createUser, $editUser, $changeRole, $createAsset, $editAsset));

      // Administrator
      $admin = Role::where('name', '=', 'admin')->first();
      $admin->attachPermissions(array($createAsset, $editAsset));
    }
}
