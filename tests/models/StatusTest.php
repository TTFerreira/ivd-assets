<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;

class StatusTest extends TestCase
{
    use DatabaseTransactions;

    public function testUserCannotAccessStatusView()
    {
      $user = User::where('name', 'User User')->get()->first();

      $this->actingAs($user)
           ->get('/admin/assets-statuses')
           ->assertResponseStatus('403');
    }

    public function testAdminCannotAccessStatusView()
    {
      $user = User::where('name', 'Admin User')->get()->first();

      $this->actingAs($user)
           ->get('/admin/assets-statuses')
           ->assertResponseStatus('403');
    }

    public function testStatusViewWithLoggedInSuperAdmin()
    {
      $user = User::where('name', 'Super Admin User')->get()->first();

      $this->actingAs($user)
           ->visit('/admin/assets-statuses')
           ->see('Statuses');
    }

    public function testCreateNewStatus()
    {
      $user = User::where('name', 'Super Admin User')->get()->first();

      $this->actingAs($user)
           ->visit('/admin/assets-statuses')
           ->see('Create New Status')
           ->type('Random Status', 'name')
           ->press('Add New Status')
           ->seePageIs('/admin/assets-statuses')
           ->see('Successfully created')
           ->seeInDatabase('statuses', ['name' => 'Random Status']);
    }

    public function testEditStatus()
    {
      $user = User::where('name', 'Super Admin User')->get()->first();

      $this->actingAs($user)
           ->visit('/admin/assets-statuses')
           ->see('Create New Status')
           ->type('Random Status', 'name')
           ->press('Add New Status')
           ->seePageIs('/admin/assets-statuses')
           ->see('Successfully created')
           ->seeInDatabase('statuses', ['name' => 'Random Status']);

      $status = App\Status::get()->last();

      $this->actingAs($user)
           ->visit('/admin/assets-statuses/' . $status->id . '/edit')
           ->see('Random Status')
           ->type('Another Status', 'name')
           ->press('Edit Status')
           ->seePageIs('/admin/assets-statuses')
           ->see('Successfully updated')
           ->seeInDatabase('statuses', ['name' => 'Another Status']);
    }
}
