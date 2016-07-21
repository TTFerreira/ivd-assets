<?php

use Illuminate\Database\Seeder;

class ManufacturersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('manufacturers')->insert([
        'name' => 'Acer'
      ]);
      DB::table('manufacturers')->insert([
        'name' => 'Apple'
      ]);
      DB::table('manufacturers')->insert([
        'name' => 'Axiohm'
      ]);
      DB::table('manufacturers')->insert([
        'name' => 'Canon'
      ]);
      DB::table('manufacturers')->insert([
        'name' => 'Electronic Services'
      ]);
      DB::table('manufacturers')->insert([
        'name' => 'Epson'
      ]);
      DB::table('manufacturers')->insert([
        'name' => 'Hewlett Packard'
      ]);
      DB::table('manufacturers')->insert([
        'name' => 'Lenovo'
      ]);
      DB::table('manufacturers')->insert([
        'name' => 'LG'
      ]);
      DB::table('manufacturers')->insert([
        'name' => 'Mecer'
      ]);
      DB::table('manufacturers')->insert([
        'name' => 'Mindeo'
      ]);
      DB::table('manufacturers')->insert([
        'name' => 'Nashua'
      ]);
      DB::table('manufacturers')->insert([
        'name' => 'Partner'
      ]);
      DB::table('manufacturers')->insert([
        'name' => 'Posiflex'
      ]);
      DB::table('manufacturers')->insert([
        'name' => 'Proline'
      ]);
      DB::table('manufacturers')->insert([
        'name' => 'RCT'
      ]);
      DB::table('manufacturers')->insert([
        'name' => 'Samsung'
      ]);
      DB::table('manufacturers')->insert([
        'name' => 'Symbol'
      ]);
      DB::table('manufacturers')->insert([
        'name' => 'TPG'
      ]);
      DB::table('manufacturers')->insert([
        'name' => 'Unknown'
      ]);
      DB::table('manufacturers')->insert([
        'name' => 'Xerox'
      ]);
    }
}
