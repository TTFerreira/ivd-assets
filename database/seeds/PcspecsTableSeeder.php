<?php

use Illuminate\Database\Seeder;

class PcspecsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('pcspecs')->insert([
        ['cpu' => 'Core i5 1234', 'ram' => '4GB', 'hdd' => '500GB'],
        ['cpu' => 'Core i3 4311', 'ram' => '4GB', 'hdd' => '500GB'],
        ['cpu' => 'Core i7 3214', 'ram' => '8GB', 'hdd' => '500GB'],
        ['cpu' => 'Core i7 2323', 'ram' => '16GB', 'hdd' => '500GB'],
      ]);
    }
}
