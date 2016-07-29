<?php

namespace App\Repositories;

use Illuminate\Support\ServiceProvider;

class BackendServiceProvider extends ServiceProvider {
  public function register()
  {
    $this->app->bind('App\Repositories\Locations\LocationRepositoryInterface', 'App\Repositories\Locations\LocationRepository');
    $this->app->bind('App\Repositories\Manufacturers\ManufacturerRepositoryInterface', 'App\Repositories\Manufacturers\ManufacturerRepository');
    $this->app->bind('App\Repositories\AssetModels\AssetModelRepositoryInterface', 'App\Repositories\AssetModels\AssetModelRepository');
    $this->app->bind('App\Repositories\Assets\AssetRepositoryInterface', 'App\Repositories\Assets\AssetRepository');
  }
}
