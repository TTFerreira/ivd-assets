<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;

class SupplierTest extends TestCase
{
  use DatabaseTransactions;

  public function testUserCannotAccessSuppliersView()
  {
    $user = User::where('name', 'User User')->get()->first();

    $this->actingAs($user)
         ->get('/suppliers')
         ->assertResponseStatus('403');
  }

  public function testAdminCannotAccessSuppliersView()
  {
    $user = User::where('name', 'Admin User')->get()->first();

    $this->actingAs($user)
         ->get('/suppliers')
         ->assertResponseStatus('403');
  }

  public function testSuppliersViewWithLoggedInSuperAdmin()
  {
    $user = User::where('name', 'Super Admin User')->get()->first();

    $this->actingAs($user)
         ->visit('/suppliers')
         ->see('Suppliers');
  }

  public function testCreateNewSupplier()
  {
    $user = User::where('name', 'Super Admin User')->get()->first();

    $this->actingAs($user)
         ->visit('/suppliers')
         ->see('Create New Supplier')
         ->type('Acme', 'name')
         ->press('Add New Supplier')
         ->seePageIs('/suppliers')
         ->see('Successfully created')
         ->seeInDatabase('suppliers', ['name' => 'Acme']);
  }

  public function testEditSupplier()
  {
    $user = User::where('name', 'Super Admin User')->get()->first();

    $this->actingAs($user)
         ->visit('/suppliers')
         ->see('Create New Supplier')
         ->type('Acme', 'name')
         ->press('Add New Supplier')
         ->seePageIs('/suppliers')
         ->see('Successfully created')
         ->seeInDatabase('suppliers', ['name' => 'Acme']);

    $supplier = App\Supplier::get()->last();

    $this->actingAs($user)
         ->visit('/suppliers/' . $supplier->id . '/edit')
         ->see('Acme')
         ->type('Spacely Space Sprockets', 'name')
         ->press('Edit Supplier')
         ->seePageIs('/suppliers')
         ->see('Successfully updated')
         ->seeInDatabase('suppliers', ['name' => 'Spacely Space Sprockets']);
  }
}
