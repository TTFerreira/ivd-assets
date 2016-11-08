<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;

class AssetTypeTest extends TestCase
{
    use DatabaseTransactions;

    public function testUserCannotAccessAssetTypesView()
    {
      $user = User::where('name', 'User User')->get()->first();

      $this->actingAs($user)
           ->get('/asset-types')
           ->assertResponseStatus('403');
    }

    public function testAdminCannotAccessAssetTypesView()
    {
      $user = User::where('name', 'Admin User')->get()->first();

      $this->actingAs($user)
           ->get('/asset-types')
           ->assertResponseStatus('403');
    }

    public function testAssetTypesViewWithLoggedInSuperAdmin()
    {
      $user = User::where('name', 'Super Admin User')->get()->first();

      $this->actingAs($user)
           ->visit('/asset-types')
           ->see('Asset Types');
    }

    public function testCreateNewAssetType()
    {
      $user = User::where('name', 'Super Admin User')->get()->first();

      $this->actingAs($user)
           ->visit('/asset-types')
           ->see('Create New Asset Type')
           ->type('Random Type', 'type_name')
           ->type('Random Abbreviation', 'abbreviation')
           ->type(0, 'spare')
           ->press('Add New Asset Type')
           ->seePageIs('/asset-types')
           ->see('Successfully created')
           ->seeInDatabase('asset_types', ['type_name' => 'Random Type', 'abbreviation' => 'Random Abbreviation', 'spare' => 0]);
    }

    public function testEditAssetType()
    {
      $user = User::where('name', 'Super Admin User')->get()->first();

      $this->actingAs($user)
           ->visit('/asset-types')
           ->see('Create New Asset Type')
           ->type('Random Type', 'type_name')
           ->type('Random Abbreviation', 'abbreviation')
           ->type(0, 'spare')
           ->press('Add New Asset Type')
           ->seePageIs('/asset-types')
           ->see('Successfully created')
           ->seeInDatabase('asset_types', ['type_name' => 'Random Type', 'abbreviation' => 'Random Abbreviation', 'spare' => 0]);

      $assetType = App\AssetType::get()->last();

      $this->actingAs($user)
           ->visit('/asset-types/' . $assetType->id . '/edit')
           ->see('Random Type')
           ->type('Different Type', 'type_name')
           ->type('Different Abbreviation', 'abbreviation')
           ->type(1, 'spare')
           ->press('Edit Asset Type')
           ->seePageIs('/asset-types')
           ->see('Successfully updated')
           ->seeInDatabase('asset_types', ['type_name' => 'Different Type', 'abbreviation' => 'Different Abbreviation', 'spare' => 1]);
    }
}
