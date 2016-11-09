<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;

class TicketStatusTest extends TestCase
{
    use DatabaseTransactions;

    public function testUserCannotAccessTicketStatusesView()
    {
      $user = User::where('name', 'User User')->get()->first();

      $this->actingAs($user)
           ->get('/admin/ticket-statuses')
           ->assertResponseStatus('403');
    }

    public function testAdminCannotAccessTicketStatusesView()
    {
      $user = User::where('name', 'Admin User')->get()->first();

      $this->actingAs($user)
           ->get('/admin/ticket-statuses')
           ->assertResponseStatus('403');
    }

    public function testTicketStatusesViewWithLoggedInSuperAdmin()
    {
      $user = User::where('name', 'Super Admin User')->get()->first();

      $this->actingAs($user)
           ->visit('/admin/ticket-statuses')
           ->see('Ticket Statuses');
    }

    public function testCreateNewTicketStatus()
    {
      $user = User::where('name', 'Super Admin User')->get()->first();

      $this->actingAs($user)
           ->visit('/admin/ticket-statuses')
           ->see('Create Ticket Status')
           ->type('Random Status', 'status')
           ->press('Add New Ticket Status')
           ->seePageIs('/admin/ticket-statuses')
           ->see('Successfully created')
           ->seeInDatabase('tickets_statuses', ['status' => 'Random Status']);
    }

    public function testEditTicketStatus()
    {
      $user = User::where('name', 'Super Admin User')->get()->first();

      $this->actingAs($user)
           ->visit('/admin/ticket-statuses')
           ->see('Create Ticket Status')
           ->type('Random Status', 'status')
           ->press('Add New Ticket Status')
           ->seePageIs('/admin/ticket-statuses')
           ->see('Successfully created')
           ->seeInDatabase('tickets_statuses', ['status' => 'Random Status']);

      $ticketStatus = App\TicketsStatus::get()->last();

      $this->actingAs($user)
           ->visit('/admin/ticket-statuses/' . $ticketStatus->id . '/edit')
           ->see('Random Status')
           ->type('Different Status', 'status')
           ->press('Edit Ticket Status')
           ->seePageIs('/admin/ticket-statuses')
           ->see('Successfully updated')
           ->seeInDatabase('tickets_statuses', ['status' => 'Different Status']);
    }
}
