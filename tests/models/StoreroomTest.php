<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;

class StoreroomTest extends TestCase
{
    use DatabaseTransactions;

    public function testUserCannotAccessStoreroomView()
    {
      $user = User::where('name', 'User User')->get()->first();

      $this->actingAs($user)
           ->get('/admin/storeroom')
           ->assertResponseStatus('403');
    }

    public function testAdminCannotAccessStoreroomView()
    {
      $user = User::where('name', 'Admin User')->get()->first();

      $this->actingAs($user)
           ->get('/admin/storeroom')
           ->assertResponseStatus('403');
    }

    public function testStoreroomViewWithLoggedInSuperAdmin()
    {
      $user = User::where('name', 'Super Admin User')->get()->first();

      $this->actingAs($user)
           ->visit('/admin/storeroom')
           ->see('Default Storeroom');
    }

    public function testSetNewDefaultStoreroom()
    {
      $user = User::where('name', 'Super Admin User')->get()->first();

      $this->actingAs($user)
           ->visit('/admin/storeroom')
           ->see('Default Storeroom')
           ->select(1, 'store')
           ->press('Set as Default Storeroom')
           ->seePageIs('/admin/storeroom')
           ->see('New Default Storeroom Saved')
           ->seeInDatabase('locations', ['id' => 1, 'storeroom' => 1]);
    }

    public function testSetDifferentDefaultStoreroom()
    {
      $user = User::where('name', 'Super Admin User')->get()->first();

      $this->actingAs($user)
           ->visit('/admin/storeroom')
           ->see('Default Storeroom')
           ->select(2, 'store')
           ->press('Set as Default Storeroom')
           ->seePageIs('/admin/storeroom')
           ->see('New Default Storeroom Saved')
           ->seeInDatabase('locations', ['id' => 1, 'storeroom' => 0])
           ->seeInDatabase('locations', ['id' => 2, 'storeroom' => 1]);
    }
}
