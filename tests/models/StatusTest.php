<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;

class StatusTest extends TestCase
{
    use DatabaseTransactions;

    public function testStatusesViewWithLoggedInUser()
    {
      $user = User::get()->first();

      $this->actingAs($user)
           ->visit('/admin/assets-statuses')
           ->see('Statuses');
    }

    public function testCreateNewStatus()
    {
      $user = User::get()->first();

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
      $user = User::get()->first();

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
