<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;

class ManufacturerTest extends TestCase
{
    use DatabaseTransactions;

    public function testUserCannotAccessManufacturersView()
    {
      $user = User::where('name', 'User User')->get()->first();

      $this->actingAs($user)
           ->get('/manufacturers')
           ->assertResponseStatus('403');
    }

    public function testAdminCannotAccessManufacturersView()
    {
      $user = User::where('name', 'Admin User')->get()->first();

      $this->actingAs($user)
           ->get('/manufacturers')
           ->assertResponseStatus('403');
    }

    public function testManufacturersViewWithLoggedInSuperAdmin()
    {
      $user = User::where('name', 'Super Admin User')->get()->first();

      $this->actingAs($user)
           ->visit('/manufacturers')
           ->see('Manufacturers');
    }

    public function testCreateNewManufacturer()
    {
      $user = User::where('name', 'Super Admin User')->get()->first();

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
      $user = User::where('name', 'Super Admin User')->get()->first();

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
