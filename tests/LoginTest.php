<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginTest extends TestCase
{
  use DatabaseTransactions;

  public function testVisitHomepageWhenNotLoggedIn()
  {
    $this->visit('/')
       ->see('Sign in to start your session')
       ->press('Sign In')
       ->see('Whoops!')
       ->seePageIs('/login');
  }


  public function testLogin()
  {
    $this->visit('/')
       ->see('Sign in to start your session')
       ->type('terry@pixelcandy.co.za', 'email')
       ->type('secret', 'password')
       ->press('Sign In')
       ->see('Latest Movement Activity')
       ->seePageIs('/');
  }
}
