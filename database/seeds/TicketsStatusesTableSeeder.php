<?php

use Illuminate\Database\Seeder;

class TicketsStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('tickets_statuses')->insert([
        ['status' => 'Open'],
        ['status' => 'Pending'],
        ['status' => 'Resolved'],
      ]);
    }
}
