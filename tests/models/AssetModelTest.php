<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;

class AssetModelTest extends TestCase
{
    use DatabaseTransactions;

    public function testAssetModelsViewWithLoggedInUser()
    {
      $user = User::get()->first();

      $this->actingAs($user)
           ->visit('/models')
           ->see('Models');
    }

    public function testCreateNewAssetModelWithoutPartNumberAndPCSpec()
    {
      $user = User::get()->first();

      $this->actingAs($user)
           ->visit('/models')
           ->see('Create New Model')
           ->select(1, 'asset_type_id')
           ->select(1, 'manufacturer_id')
           ->type('Fake Model Name', 'asset_model')
           ->press('Add New Model')
           ->seePageIs('/models')
           ->see('Successfully created')
           ->seeInDatabase('asset_models', ['asset_type_id' => 1, 'manufacturer_id' => 1, 'asset_model' => 'Fake Model Name']);
    }

    public function testCreateNewAssetModelWithPartNumberAndPCSpec()
    {
      $user = User::get()->first();

      $this->actingAs($user)
           ->visit('/models')
           ->see('Create New Model')
           ->select(1, 'asset_type_id')
           ->select(1, 'manufacturer_id')
           ->type('Fake Model Name', 'asset_model')
           ->type('Fake Part Number', 'part_number')
           ->select(1, 'pcspec_id')
           ->press('Add New Model')
           ->seePageIs('/models')
           ->see('Successfully created')
           ->seeInDatabase('asset_models', ['asset_type_id' => 1, 'manufacturer_id' => 1, 'asset_model' => 'Fake Model Name', 'part_number' => 'Fake Part Number', 'pcspec_id' => 1]);
    }

    public function testEditAssetModel()
    {
      $user = User::get()->first();

      $this->actingAs($user)
           ->visit('/models')
           ->see('Create New Model')
           ->select(1, 'asset_type_id')
           ->select(1, 'manufacturer_id')
           ->type('Fake Model Name', 'asset_model')
           ->type('Fake Part Number', 'part_number')
           ->select(1, 'pcspec_id')
           ->press('Add New Model')
           ->seePageIs('/models')
           ->see('Successfully created')
           ->seeInDatabase('asset_models', ['asset_type_id' => 1, 'manufacturer_id' => 1, 'asset_model' => 'Fake Model Name', 'part_number' => 'Fake Part Number', 'pcspec_id' => 1]);

      $asset_model = App\AssetModel::get()->last();

      $this->actingAs($user)
           ->visit('/models/' . $asset_model->id . '/edit')
           ->see('Fake Model Name')
           ->select(2, 'asset_type_id')
           ->select(2, 'manufacturer_id')
           ->type('Another Fake Model Name', 'asset_model')
           ->type('Another Fake Part Number', 'part_number')
           ->select(2, 'pcspec_id')
           ->press('Edit Model')
           ->seePageIs('/models')
           ->see('Successfully updated')
           ->seeInDatabase('asset_models', ['asset_type_id' => 2, 'manufacturer_id' => 2, 'asset_model' => 'Another Fake Model Name', 'part_number' => 'Another Fake Part Number', 'pcspec_id' => 2]);
    }
}
