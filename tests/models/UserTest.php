<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    public function testUserCannotAccessUsersView()
    {
      $user = User::where('name', 'User User')->get()->first();

      $this->actingAs($user)
           ->get('/admin/users')
           ->assertResponseStatus('403');
    }

    public function testAdminCannotAccessUsersView()
    {
      $user = User::where('name', 'Admin User')->get()->first();

      $this->actingAs($user)
           ->get('/admin/users')
           ->assertResponseStatus('403');
    }

    public function testUsersViewWithLoggedInSuperAdmin()
    {
      $user = User::where('name', 'Super Admin User')->get()->first();

      $this->actingAs($user)
           ->visit('/admin/users')
           ->see('Users');
    }

    public function testCreateNewUser()
    {
      $user = User::where('name', 'Super Admin User')->get()->first();

      $this->actingAs($user)
           ->visit('/admin/users/')
           ->see('Create New User')
           ->type('Test User', 'name')
           ->type('test@terryferreira.com', 'email')
           ->type('secret', 'password')
           ->press('Add New User')
           ->seePageIs('/admin/users')
           ->see('Successfully created')
           ->seeInDatabase('users', ['name' => 'Test User', 'email' => 'test@terryferreira.com']);
    }

    public function testLoginWithNewUser()
    {
      $user = User::where('name', 'Super Admin User')->get()->first();

      $this->actingAs($user)
           ->visit('/admin/users/')
           ->see('Create New User')
           ->type('Test User', 'name')
           ->type('test@terryferreira.com', 'email')
           ->type('secret', 'password')
           ->press('Add New User')
           ->seePageIs('/admin/users')
           ->see('Successfully created')
           ->seeInDatabase('users', ['name' => 'Test User', 'email' => 'test@terryferreira.com']);

      Auth::logout();

      $this->visit('/')
         ->see('Sign in to start your session')
         ->type('test@terryferreira.com', 'email')
         ->type('secret', 'password')
         ->press('Sign In')
         ->see('Tickets')
         ->seePageIs('/tickets');
    }

    public function testEditNonSuperAdminUser()
    {
      $user = User::where('name', 'Super Admin User')->get()->first();

      $this->actingAs($user)
           ->visit('/admin/users/')
           ->see('Create New User')
           ->type('Test User', 'name')
           ->type('test@terryferreira.com', 'email')
           ->type('secret', 'password')
           ->press('Add New User')
           ->seePageIs('/admin/users')
           ->see('Successfully created')
           ->seeInDatabase('users', ['name' => 'Test User', 'email' => 'test@terryferreira.com']);

      $newUser = User::get()->last();
      $adminRole = App\Role::where('name', 'admin')->get()->first();

      $this->actingAs($user)
           ->visit('/admin/users/' . $newUser->id . '/edit')
           ->see('Test User')
           ->type('Test Test', 'name')
           ->type('testtest@terryferreira.com', 'email')
           ->type('foobar', 'password')
           ->type('foobar', 'password_confirmation')
           ->select($adminRole->id, 'role_id')
           ->press('Edit User')
           ->seePageIs('/admin/users')
           ->see('Successfully updated')
           ->seeInDatabase('users', ['name' => 'Test Test', 'email' => 'testtest@terryferreira.com'])
           ->seeInDatabase('role_user', ['user_id' => $newUser->id, 'role_id' => $adminRole->id]);
    }

    public function testPasswordLengthSixOrMoreCharactersOnCreateNewUser()
    {
      $user = User::where('name', 'Super Admin User')->get()->first();

      $this->actingAs($user)
           ->visit('/admin/users')
           ->see('Create New User')
           ->type('Test User', 'name')
           ->type('test@terryferreira.com', 'email')
           ->type('12345', 'password')
           ->press('Add New User')
           ->see('The password must be a minimum of six (6) characters long.')
           ->type('123456', 'password')
           ->press('Add New User')
           ->seePageIs('/admin/users')
           ->see('Successfully created')
           ->seeInDatabase('users', ['name' => 'Test User', 'email' => 'test@terryferreira.com']);
    }

    public function testPasswordLengthSixOrMoreCharactersOnEditUser()
    {
      $user = User::where('name', 'Super Admin User')->get()->first();
      $adminUser = User::where('name', 'Admin User')->get()->first();

      $this->actingAs($user)
           ->visit('/admin/users/' . $adminUser->id . '/edit')
           ->see('Admin User')
           ->type('12345', 'password')
           ->type('12345', 'password_confirmation')
           ->press('Edit User')
           ->see('The password must be a minimum of six (6) characters long.');
    }

    public function testPasswordMatchOnEditUser()
    {
      $user = User::where('name', 'Super Admin User')->get()->first();
      $adminUser = User::where('name', 'Admin User')->get()->first();

      $this->actingAs($user)
           ->visit('/admin/users/' . $adminUser->id . '/edit')
           ->see('Admin User')
           ->type('123456', 'password')
           ->type('654321', 'password_confirmation')
           ->press('Edit User')
           ->see('The passwords do not match.');
    }

    public function testCannotChangeSuperAdminToNonSuperAdminIfThereIsOnlyOneSuperAdminUser()
    {
      $user = User::where('name', 'Super Admin User')->get()->first();
      $adminRole = App\Role::where('name', 'admin')->get()->first();
      $superAdminRole = App\Role::where('name', 'super-admin')->get()->first();

      $this->actingAs($user)
           ->visit('/admin/users/' . $user->id . '/edit')
           ->see('Super Admin User')
           ->select($adminRole->id, 'role_id')
           ->press('Edit User')
           ->see('Cannot change role as there must be one (1) or more users with the role of ' . $superAdminRole->display_name . '.');
    }
}
