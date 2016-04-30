<?php

use Illuminate\Database\Seeder;

class TicketsPrioritiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('tickets_priorities')->insert([
        ['priority' => 'Low'],
        ['priority' => 'Medium'],
        ['priority' => 'High'],
      ]);
    }
}
