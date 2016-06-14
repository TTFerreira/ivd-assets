<?php

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
      factory(App\User::class, 4)->create();
      DB::table('users')->insert([
        'name' => 'Terry Ferreira',
        'email' => 'terry@pixelcandy.co.za',
        'password' => bcrypt('secret'),
        'api_token' => str_random(60),
        'remember_token' => str_random(10),
      ]);
    }
}
