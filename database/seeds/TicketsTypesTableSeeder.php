<?php

use Illuminate\Database\Seeder;

class TicketsTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('tickets_types')->insert([
        ['type' => 'Incident'],
        ['type' => 'Problem'],
        ['type' => 'Loan'],
      ]);
    }
}
