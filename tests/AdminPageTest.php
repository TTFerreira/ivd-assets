<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;

class AdminPageTest extends TestCase
{
    use DatabaseTransactions;

    public function testUserCannotAccessAdminView()
    {
      $user = User::where('name', 'User User')->get()->first();

      $this->actingAs($user)
           ->get('/admin')
           ->assertResponseStatus('403');
    }

    public function testAdminCannotAccessAdminView()
    {
      $user = User::where('name', 'Admin User')->get()->first();

      $this->actingAs($user)
           ->get('/admin')
           ->assertResponseStatus('403');
    }

    public function testAdminViewWithLoggedInSuperAdmin()
    {
      $user = User::where('name', 'Super Admin User')->get()->first();

      $this->actingAs($user)
           ->visit('/admin')
           ->see('User Management')
           ->see('Ticket Configurations');
    }
}
