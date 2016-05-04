<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(DivisionsTableSeeder::class);
        $this->call(LocationsTableSeeder::class);
        $this->call(TicketsStatusesTableSeeder::class);
        $this->call(TicketsTypesTableSeeder::class);
        $this->call(TicketsPrioritiesTableSeeder::class);
        $this->call(StatusesTableSeeder::class);
        $this->call(WarrantyTypesTableSeeder::class);
        $this->call(SuppliersTableSeeder::class);
        $this->call(PcspecsTableSeeder::class);
        $this->call(AssetTypesTableSeeder::class);
        $this->call(ManufacturersTableSeeder::class);
        $this->call(AssetModelsTableSeeder::class);
    }
}
