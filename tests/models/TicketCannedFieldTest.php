<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;

class TicketCannedFieldTest extends TestCase
{
    use DatabaseTransactions;

    public function testUserCannotAccessTicketCannedFieldView()
    {
      $user = User::where('name', 'User User')->get()->first();

      $this->actingAs($user)
           ->get('/admin/ticket-canned-fields')
           ->assertResponseStatus('403');
    }

    public function testAdminCannotAccessTicketCannedFieldView()
    {
      $user = User::where('name', 'Admin User')->get()->first();

      $this->actingAs($user)
           ->get('/admin/ticket-canned-fields')
           ->assertResponseStatus('403');
    }

    public function testTicketCannedFieldViewWithLoggedInSuperAdmin()
    {
      $user = User::where('name', 'Super Admin User')->get()->first();

      $this->actingAs($user)
           ->visit('/admin/ticket-canned-fields')
           ->see('Canned Ticket Fields');
    }

    public function testCreateNewTicketCannedField()
    {
      $user = User::where('name', 'Super Admin User')->get()->first();

      $this->actingAs($user)
           ->visit('/admin/ticket-canned-fields')
           ->see('Create Canned Ticket Field')
           ->select(1, 'user_id')
           ->select(1, 'location_id')
           ->select(1, 'ticket_status_id')
           ->select(1, 'ticket_type_id')
           ->select(1, 'ticket_priority_id')
           ->type('Random Subject', 'subject')
           ->type('Random Description', 'description')
           ->press('Add New Ticket Canned Fields')
           ->seePageIs('/admin/ticket-canned-fields')
           ->see('Successfully created')
           ->seeInDatabase('tickets_canned_fields', ['user_id' => 1, 'location_id' => 1, 'ticket_status_id' => 1, 'ticket_type_id' => 1, 'ticket_priority_id' => 1, 'subject' => 'Random Subject', 'description' => 'Random Description']);
    }

    public function testEditTicketCannedField()
    {
      $user = User::where('name', 'Super Admin User')->get()->first();

      $this->actingAs($user)
           ->visit('/admin/ticket-canned-fields')
           ->see('Create Canned Ticket Field')
           ->select(1, 'user_id')
           ->select(1, 'location_id')
           ->select(1, 'ticket_status_id')
           ->select(1, 'ticket_type_id')
           ->select(1, 'ticket_priority_id')
           ->type('Random Subject', 'subject')
           ->type('Random Description', 'description')
           ->press('Add New Ticket Canned Fields')
           ->seePageIs('/admin/ticket-canned-fields')
           ->see('Successfully created')
           ->seeInDatabase('tickets_canned_fields', ['user_id' => 1, 'location_id' => 1, 'ticket_status_id' => 1, 'ticket_type_id' => 1, 'ticket_priority_id' => 1, 'subject' => 'Random Subject', 'description' => 'Random Description']);

      $ticketCannedField = App\TicketsCannedField::get()->last();

      $this->actingAs($user)
           ->visit('/admin/ticket-canned-fields/' . $ticketCannedField->id . '/edit')
           ->see('Random Subject')
           ->type('Different Subject', 'subject')
           ->select(2, 'location_id')
           ->press('Edit Ticket Canned Fields')
           ->seePageIs('/admin/ticket-canned-fields')
           ->see('Successfully updated')
           ->seeInDatabase('tickets_canned_fields', ['user_id' => 1, 'location_id' => 2, 'ticket_status_id' => 1, 'ticket_type_id' => 1, 'ticket_priority_id' => 1, 'subject' => 'Different Subject', 'description' => 'Random Description']);
    }
}
