<?php

use Illuminate\Database\Seeder;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('statuses')->insert([
        ['name' => 'Ready to Deploy'],
        ['name' => 'Deployed'],
        ['name' => 'Out for Repairs'],
        ['name' => 'Waiting for Repairs'],
        ['name' => 'Written Off - Broken'],
        ['name' => 'Written Off - Age'],
      ]);
    }
}
