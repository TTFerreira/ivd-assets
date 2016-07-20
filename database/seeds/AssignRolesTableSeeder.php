<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class AssignRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // Roles
      $superAdmin = Role::where('name', '=', 'super-admin')->first();
      $admin = Role::where('name', '=', 'admin')->first();
      $user = Role::where('name', '=', 'user')->first();

      $superAdminUser = User::where('name', '=', 'Terry Ferreira')->first();
      $superAdminUser->attachRole($superAdmin);

      $adminUser = User::where('name', '=', 'Admin Doe')->first();
      $adminUser->attachRole($admin);

      $userUser = User::where('name', '=', 'User Doe')->first();
      $userUser->attachRole($user);
    }
}
