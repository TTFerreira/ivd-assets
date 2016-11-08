<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;

class DivisionTest extends TestCase
{
    use DatabaseTransactions;

    public function testUserCannotAccessDivisionsView()
    {
      $user = User::where('name', 'User User')->get()->first();

      $this->actingAs($user)
           ->get('/divisions')
           ->assertResponseStatus('403');
    }

    public function testAdminCannotAccessDivisionsView()
    {
      $user = User::where('name', 'Admin User')->get()->first();

      $this->actingAs($user)
           ->get('/divisions')
           ->assertResponseStatus('403');
    }

    public function testDivisionsViewWithLoggedInSuperAdmin()
    {
      $user = User::where('name', 'Super Admin User')->get()->first();

      $this->actingAs($user)
           ->visit('/divisions')
           ->see('Divisions');
    }

    public function testCreateNewDivision()
    {
      $user = User::where('name', 'Super Admin User')->get()->first();

      $this->actingAs($user)
           ->visit('/divisions')
           ->see('Create New Division')
           ->type('Human Resources', 'name')
           ->press('Add New Division')
           ->seePageIs('/divisions')
           ->see('Successfully created')
           ->seeInDatabase('divisions', ['name' => 'Human Resources']);
    }

    public function testEditDivision()
    {
      $user = User::where('name', 'Super Admin User')->get()->first();

      $this->actingAs($user)
           ->visit('/divisions')
           ->see('Create New Division')
           ->type('Human Resources', 'name')
           ->press('Add New Division')
           ->seePageIs('/divisions')
           ->see('Successfully created')
           ->seeInDatabase('divisions', ['name' => 'Human Resources']);

      $division = App\Division::get()->last();

      $this->actingAs($user)
           ->visit('/divisions/' . $division->id . '/edit')
           ->see('Human Resources')
           ->type('Accounting', 'name')
           ->press('Edit Division')
           ->seePageIs('/divisions')
           ->see('Successfully updated')
           ->seeInDatabase('divisions', ['name' => 'Accounting']);
    }
}
