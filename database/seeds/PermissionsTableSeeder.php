<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $createUser = new Permission();
      $createUser->name         = 'create-user';
      $createUser->display_name = 'Create Users';
      $createUser->description  = 'Create new users';
      $createUser->save();

      $editUser = new Permission();
      $editUser->name         = 'edit-user';
      $editUser->display_name = 'Edit Users';
      $editUser->description  = 'Edit existing users';
      $editUser->save();

      $changeRole = new Permission();
      $changeRole->name         = 'change-role';
      $changeRole->display_name = 'Change Role';
      $changeRole->description  = 'Change a user\'s role';
      $changeRole->save();

      $createAsset = new Permission();
      $createAsset->name         = 'create-asset';
      $createAsset->display_name = 'Create Asset';
      $createAsset->description  = 'Create new assets';
      $createAsset->save();

      $editAsset = new Permission();
      $editAsset->name         = 'edit-asset';
      $editAsset->display_name = 'Edit Asset';
      $editAsset->description  = 'Edit assets';
      $editAsset->save();
    }
}
