<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;

class AssetTypeTest extends TestCase
{
    use DatabaseTransactions;

    public function testAssetTypesViewWithLoggedInUser()
    {
      $user = User::get()->first();

      $this->actingAs($user)
           ->visit('/asset-types')
           ->see('Asset Types');
    }

    public function testCreateNewAssetType()
    {
      $user = User::get()->first();

      $this->actingAs($user)
           ->visit('/asset-types')
           ->see('Create New Asset Type')
           ->type('Random Type', 'type_name')
           ->type('Random Abbreviation', 'abbreviation')
           ->press('Add New Asset Type')
           ->seePageIs('/asset-types')
           ->see('Successfully created')
           ->seeInDatabase('asset_types', ['type_name' => 'Random Type', 'abbreviation' => 'Random Abbreviation']);
    }

    public function testEditAssetType()
    {
      $user = User::get()->first();

      $this->actingAs($user)
           ->visit('/asset-types')
           ->see('Create New Asset Type')
           ->type('Random Type', 'type_name')
           ->type('Random Abbreviation', 'abbreviation')
           ->press('Add New Asset Type')
           ->seePageIs('/asset-types')
           ->see('Successfully created')
           ->seeInDatabase('asset_types', ['type_name' => 'Random Type', 'abbreviation' => 'Random Abbreviation']);

      $assetType = App\Location::get()->last();

      $this->actingAs($user)
           ->visit('/asset-types/' . $assetType->id . '/edit')
           ->see('Random Type')
           ->type('Different Type', 'type_name')
           ->type('Different Abbreviation', 'abbreviation')
           ->press('Edit Asset Type')
           ->seePageIs('/asset-types')
           ->see('Successfully updated')
           ->seeInDatabase('asset_types', ['type_name' => 'Different Type', 'abbreviation' => 'Different Abbreviation']);
    }
}
