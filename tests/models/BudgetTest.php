<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;

class BudgetTest extends TestCase
{
    use DatabaseTransactions;

    public function testUserCannotAccessBudgetsView()
    {
      $user = User::where('name', 'User User')->get()->first();

      $this->actingAs($user)
           ->get('/budgets')
           ->assertResponseStatus('403');
    }

    public function testAdminCannotAccessBudgetsView()
    {
      $user = User::where('name', 'Admin User')->get()->first();

      $this->actingAs($user)
           ->get('/budgets')
           ->assertResponseStatus('403');
    }

    public function testBudgetsViewWithLoggedInSuperAdmin()
    {
      $user = User::where('name', 'Super Admin User')->get()->first();

      $this->actingAs($user)
           ->visit('/budgets')
           ->see('Budgets');
    }

    public function testCreateNewBudget()
    {
      $user = User::get()->first();

      $this->actingAs($user)
           ->visit('/budgets')
           ->see('Create Budget')
           ->select(1, 'division_id')
           ->type('2099', 'year')
           ->type(199999.99, 'total')
           ->press('Add New Budget')
           ->seePageIs('/budgets')
           ->see('Successfully created')
           ->seeInDatabase('budgets', ['division_id' => 1, 'year' => '2099', 'total' => 199999.99]);
    }

    public function testEditBudget()
    {
      $user = User::get()->first();

      $this->actingAs($user)
           ->visit('/budgets')
           ->see('Create Budget')
           ->select(1, 'division_id')
           ->type('2099', 'year')
           ->type(199999.99, 'total')
           ->press('Add New Budget')
           ->seePageIs('/budgets')
           ->see('Successfully created')
           ->seeInDatabase('budgets', ['division_id' => 1, 'year' => '2099', 'total' => 199999.99]);

      $budget = App\Budget::get()->last();

      $this->actingAs($user)
           ->visit('/budgets/' . $budget->id . '/edit')
           ->see('2099')
           ->select(2, 'division_id')
           ->type(200000, 'total')
           ->press('Edit Budget')
           ->seePageIs('/budgets')
           ->see('Successfully updated')
           ->seeInDatabase('budgets', ['division_id' => 2, 'year' => '2099', 'total' => 200000]);
    }
}
