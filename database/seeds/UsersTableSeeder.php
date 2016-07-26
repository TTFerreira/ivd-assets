<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $now = new Carbon();

      DB::table('users')->insert([
        'name' => 'Super Admin User',
        'email' => 'superadmin@terryferreira.com',
        'password' => bcrypt('superadmin'),
        'api_token' => str_random(60),
        'created_at' => $now
      ]);
    }
}
