<?php

use Illuminate\Database\Seeder;

class AssetTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('asset_types')->insert([
        'type_name' => 'Desktop PC',
        'abbreviation' => 'DPC'
      ]);
      DB::table('asset_types')->insert([
        'type_name' => 'All-in-One PC',
        'abbreviation' => 'APC'
      ]);
      DB::table('asset_types')->insert([
        'type_name' => 'Laptop',
        'abbreviation' => 'LAP'
      ]);
      DB::table('asset_types')->insert([
        'type_name' => 'Monitor',
        'abbreviation' => 'MON'
      ]);
      DB::table('asset_types')->insert([
        'type_name' => 'Docking Station',
        'abbreviation' => 'DCK'
      ]);
      DB::table('asset_types')->insert([
        'type_name' => 'UPS',
        'abbreviation' => 'UPS'
      ]);
      DB::table('asset_types')->insert([
        'type_name' => 'USB Printer',
        'abbreviation' => 'UPR'
      ]);
      DB::table('asset_types')->insert([
        'type_name' => 'Network Printer',
        'abbreviation' => 'NPR'
      ]);
      DB::table('asset_types')->insert([
        'type_name' => 'Scanner',
        'abbreviation' => 'SCN'
      ]);
      DB::table('asset_types')->insert([
        'type_name' => 'Receipt Printer',
        'abbreviation' => 'RPR'
      ]);
      DB::table('asset_types')->insert([
        'type_name' => 'Bar Code Scanner',
        'abbreviation' => 'BAR'
      ]);
      DB::table('asset_types')->insert([
        'type_name' => 'Card Reader',
        'abbreviation' => 'CRD'
      ]);
      DB::table('asset_types')->insert([
        'type_name' => 'Cash Drawer',
        'abbreviation' => 'DRW'
      ]);
      DB::table('asset_types')->insert([
        'type_name' => 'Touch Monitor',
        'abbreviation' => 'TMN'
      ]);
      DB::table('asset_types')->insert([
        'type_name' => 'Fax Machine',
        'abbreviation' => 'FAX'
      ]);
      DB::table('asset_types')->insert([
        'type_name' => 'Projector',
        'abbreviation' => 'PJR'
      ]);
      DB::table('asset_types')->insert([
        'type_name' => 'Tablet',
        'abbreviation' => 'TAB'
      ]);
      DB::table('asset_types')->insert([
        'type_name' => 'Display Pole',
        'abbreviation' => 'POL'
      ]);
    }
}
