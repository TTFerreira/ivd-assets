<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;

class TicketStatusTest extends TestCase
{
    use DatabaseTransactions;

    public function testTicketStatusesViewWithLoggedInUser()
    {
      $user = User::get()->first();

      $this->actingAs($user)
           ->visit('/admin/ticket-statuses')
           ->see('Ticket Statuses');
    }

    public function testCreateNewTicketStatus()
    {
      $user = User::get()->first();

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
      $user = User::get()->first();

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
