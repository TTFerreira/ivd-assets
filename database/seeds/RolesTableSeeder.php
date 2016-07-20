<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $superAdmin = new Role();
      $superAdmin->name         = 'super-admin';
      $superAdmin->display_name = 'Super Administrator';
      $superAdmin->description  = 'Permission to everything.';
      $superAdmin->save();

      $admin = new Role();
      $admin->name         = 'admin';
      $admin->display_name = 'Administrator';
      $admin->description  = 'Permission to view assets, but not edit them. Plus, same permissions as User role.';
      $admin->save();

      $user = new Role();
      $user->name         = 'user';
      $user->display_name = 'User';
      $user->description  = 'Can create tickets and view knowledgebase articles.';
      $user->save();
    }
}
