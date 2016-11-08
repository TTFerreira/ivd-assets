<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;

class LocationTest extends TestCase
{
  use DatabaseTransactions;

  public function testUserCannotAccessLocationsView()
  {
    $user = User::where('name', 'User User')->get()->first();

    $this->actingAs($user)
         ->get('/locations')
         ->assertResponseStatus('403');
  }

  public function testAdminCannotAccessLocationsView()
  {
    $user = User::where('name', 'Admin User')->get()->first();

    $this->actingAs($user)
         ->get('/locations')
         ->assertResponseStatus('403');
  }

  public function testLocationsViewWithLoggedInSuperAdmin()
  {
    $user = User::where('name', 'Super Admin User')->get()->first();

    $this->actingAs($user)
         ->visit('/locations')
         ->see('Locations');
  }

  public function testCreateNewLocation()
  {
    $user = User::where('name', 'Super Admin User')->get()->first();

    $this->actingAs($user)
         ->visit('/locations')
         ->see('Create New Location')
         ->type('F14', 'building')
         ->type('123', 'office')
         ->type('Test Location', 'location_name')
         ->press('Add New Location')
         ->seePageIs('/locations')
         ->see('Successfully created')
         ->seeInDatabase('locations', ['building' => 'F14', 'office' => '123', 'location_name' => 'Test Location']);
  }

  public function testEditLocation()
  {
    $user = User::where('name', 'Super Admin User')->get()->first();

    $this->actingAs($user)
         ->visit('/locations')
         ->see('Create New Location')
         ->type('F14', 'building')
         ->type('123', 'office')
         ->type('Test Location', 'location_name')
         ->press('Add New Location')
         ->seePageIs('/locations')
         ->see('Successfully created')
         ->seeInDatabase('locations', ['building' => 'F14', 'office' => '123', 'location_name' => 'Test Location']);

    $location = App\Location::get()->last();

    $this->actingAs($user)
         ->visit('/locations/' . $location->id . '/edit')
         ->see('F14')
         ->type('A11', 'building')
         ->type('456', 'office')
         ->type('Other Location', 'location_name')
         ->press('Edit Location')
         ->seePageIs('/locations')
         ->see('Successfully updated')
         ->seeInDatabase('locations', ['building' => 'A11', 'office' => '456', 'location_name' => 'Other Location']);
  }
}
