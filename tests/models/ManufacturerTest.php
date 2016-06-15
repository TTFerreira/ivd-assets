<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;

class ManufacturerTest extends TestCase
{
    use DatabaseTransactions;

    public function testManufacturersViewWithLoggedInUser()
    {
      $user = User::get()->first();

      $this->actingAs($user)
           ->visit('/manufacturers')
           ->see('Manufacturers');
    }

    public function testCreateNewManufacturer()
    {
      $user = User::get()->first();

      $this->actingAs($user)
           ->visit('/manufacturers')
           ->see('Manufacturers')
           ->type('Acme', 'name')
           ->press('Add New Manufacturer')
           ->seePageIs('/manufacturers')
           ->see('Successfully created')
           ->seeInDatabase('manufacturers', ['name' => 'Acme']);
    }

    public function testEditManufacturer()
    {
      $user = User::get()->first();

      $this->actingAs($user)
           ->visit('/manufacturers')
           ->see('Manufacturers')
           ->type('Acme', 'name')
           ->press('Add New Manufacturer')
           ->seePageIs('/manufacturers')
           ->see('Successfully created')
           ->seeInDatabase('manufacturers', ['name' => 'Acme']);

      $manufacturer = App\Manufacturer::get()->last();

      $this->actingAs($user)
           ->visit('/manufacturers/' . $manufacturer->id . '/edit')
           ->see('Acme')
           ->type('Acme Inc.', 'name')
           ->press('Edit Manufacturer')
           ->seePageIs('/manufacturers')
           ->see('Successfully updated')
           ->seeInDatabase('manufacturers', ['name' => 'Acme Inc.']);
    }
}
