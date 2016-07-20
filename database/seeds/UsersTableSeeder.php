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
        'name' => 'Terry Ferreira',
        'email' => 'terry@pixelcandy.co.za',
        'password' => bcrypt('secret'),
        'api_token' => str_random(60),
        'created_at' => $now
      ]);

      DB::table('users')->insert([
        'name' => 'Admin Doe',
        'email' => 'admindoe@pixelcandy.co.za',
        'password' => bcrypt('secret'),
        'api_token' => str_random(60),
        'created_at' => $now
      ]);

      DB::table('users')->insert([
        'name' => 'User Doe',
        'email' => 'userdoe@pixelcandy.co.za',
        'password' => bcrypt('secret'),
        'api_token' => str_random(60),
        'created_at' => $now
      ]);
    }
}
