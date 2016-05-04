<?php

use Illuminate\Database\Seeder;

class WarrantyTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('warranty_types')->insert([
        ['name' => 'Carry In'],
        ['name' => 'On-Site'],
      ]);
    }
}
