<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;

class SupplierTest extends TestCase
{
  use DatabaseTransactions;

  public function testSuppliersViewWithLoggedInUser()
  {
    $user = User::get()->first();

    $this->actingAs($user)
         ->visit('/suppliers')
         ->see('View Suppliers');
  }

  public function testCreateNewSupplier()
  {
    $user = User::get()->first();

    $this->actingAs($user)
         ->visit('/suppliers')
         ->see('Create New Supplier')
         ->type('Acme', 'name')
         ->press('Add New Supplier')
         ->seePageIs('/suppliers')
         ->seeInDatabase('suppliers', ['name' => 'Acme']);
  }

  public function testEditSupplier()
  {
    $user = User::get()->first();

    $this->actingAs($user)
         ->visit('/suppliers')
         ->see('Create New Supplier')
         ->type('Acme', 'name')
         ->press('Add New Supplier')
         ->seePageIs('/suppliers')
         ->seeInDatabase('suppliers', ['name' => 'Acme']);

    $supplier = App\Supplier::get()->last();

    $this->actingAs($user)
         ->visit('/suppliers/' . $supplier->id . '/edit')
         ->see('Acme')
         ->type('Spacely Space Sprockets', 'name')
         ->press('Edit Supplier')
         ->seePageIs('/suppliers')
         ->seeInDatabase('suppliers', ['name' => 'Spacely Space Sprockets']);
  }
}
