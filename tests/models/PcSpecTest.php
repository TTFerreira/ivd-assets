<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;

class PcSpecTest extends TestCase
{
  use DatabaseTransactions;

  public function testUserCannotAccessPcSpecsView()
  {
    $user = User::where('name', 'User User')->get()->first();

    $this->actingAs($user)
         ->get('/pcspecs')
         ->assertResponseStatus('403');
  }

  public function testAdminCannotAccessPcSpecsView()
  {
    $user = User::where('name', 'Admin User')->get()->first();

    $this->actingAs($user)
         ->get('/pcspecs')
         ->assertResponseStatus('403');
  }

  public function testPcSpecsViewWithLoggedInSuperAdmin()
  {
    $user = User::where('name', 'Super Admin User')->get()->first();

    $this->actingAs($user)
         ->visit('/pcspecs')
         ->see('PC Specifications');
  }

  public function testCreateNewPcSpec()
  {
    $user = User::where('name', 'Super Admin User')->get()->first();

    $this->actingAs($user)
         ->visit('/pcspecs')
         ->see('PC Specifications')
         ->type('Core i3 5123', 'cpu')
         ->type('4GB', 'ram')
         ->type('500GB', 'hdd')
         ->press('Add New PC Specification')
         ->seePageIs('/pcspecs')
         ->see('Successfully created')
         ->seeInDatabase('pcspecs', ['cpu' => 'Core i3 5123', 'ram' => '4GB', 'hdd' => '500GB']);
  }

  public function testEditPcSpec()
  {
    $user = User::where('name', 'Super Admin User')->get()->first();

    $this->actingAs($user)
         ->visit('/pcspecs')
         ->see('PC Specifications')
         ->type('Core i3 5123', 'cpu')
         ->type('4GB', 'ram')
         ->type('500GB', 'hdd')
         ->press('Add New PC Specification')
         ->seePageIs('/pcspecs')
         ->see('Successfully created')
         ->seeInDatabase('pcspecs', ['cpu' => 'Core i3 5123', 'ram' => '4GB', 'hdd' => '500GB']);

    $pcspec = App\PcSpec::get()->last();

    $this->actingAs($user)
         ->visit('/pcspecs/' . $pcspec->id . '/edit')
         ->see('Core i3 5123')
         ->type('Core i7 5555', 'cpu')
         ->type('8GB', 'ram')
         ->type('500GB', 'hdd')
         ->press('Edit PC Specification')
         ->seePageIs('/pcspecs')
         ->see('Successfully updated')
         ->seeInDatabase('pcspecs', ['cpu' => 'Core i7 5555', 'ram' => '8GB', 'hdd' => '500GB']);
  }
}
