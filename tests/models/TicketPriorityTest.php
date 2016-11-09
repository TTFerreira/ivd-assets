<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;

class TicketPriorityTest extends TestCase
{
    use DatabaseTransactions;

    public function testUserCannotAccessTicketPrioritiesView()
    {
      $user = User::where('name', 'User User')->get()->first();

      $this->actingAs($user)
           ->get('/admin/ticket-priorities')
           ->assertResponseStatus('403');
    }

    public function testAdminCannotAccessTicketPrioritiesView()
    {
      $user = User::where('name', 'Admin User')->get()->first();

      $this->actingAs($user)
           ->get('/admin/ticket-priorities')
           ->assertResponseStatus('403');
    }

    public function testTicketPrioritiesViewWithLoggedInSuperAdmin()
    {
      $user = User::where('name', 'Super Admin User')->get()->first();

      $this->actingAs($user)
           ->visit('/admin/ticket-priorities')
           ->see('Ticket Priorities');
    }

    public function testCreateNewTicketPriority()
    {
      $user = User::where('name', 'Super Admin User')->get()->first();

      $this->actingAs($user)
           ->visit('/admin/ticket-priorities')
           ->see('Create Ticket Priority')
           ->type('Random Priority', 'priority')
           ->press('Add New Ticket Priority')
           ->seePageIs('/admin/ticket-priorities')
           ->see('Successfully created')
           ->seeInDatabase('tickets_priorities', ['priority' => 'Random Priority']);
    }

    public function testEditTicketPriority()
    {
      $user = User::where('name', 'Super Admin User')->get()->first();

      $this->actingAs($user)
           ->visit('/admin/ticket-priorities')
           ->see('Create Ticket Priority')
           ->type('Random Priority', 'priority')
           ->press('Add New Ticket Priority')
           ->seePageIs('/admin/ticket-priorities')
           ->see('Successfully created')
           ->seeInDatabase('tickets_priorities', ['priority' => 'Random Priority']);

      $ticketPriority = App\TicketsPriority::get()->last();

      $this->actingAs($user)
           ->visit('/admin/ticket-priorities/' . $ticketPriority->id . '/edit')
           ->see('Random Priority')
           ->type('Different Priority', 'priority')
           ->press('Edit Ticket Priority')
           ->seePageIs('/admin/ticket-priorities')
           ->see('Successfully updated')
           ->seeInDatabase('tickets_priorities', ['priority' => 'Different Priority']);
    }
}
