<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'api_token' => str_random(60),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Division::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->company
    ];
});

$factory->define(App\Location::class, function (Faker\Generator $faker) {
    return [
        'building' => $faker->regexify('[A-H]{1}[1-5]{2}'),
        'office' => $faker->numerify('###'),
        'location_name' => $faker->secondaryAddress,
        'storeroom' => 0
    ];
});

$factory->define(App\Supplier::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->company,
    ];
});

$factory->define(App\AssetType::class, function (Faker\Generator $faker) {
    return [
        'type_name' => $faker->word,
        'abbreviation' => $faker->regexify('[A-H]{3}'),
        'spare' => 0
    ];
});

$factory->define(App\Manufacturer::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->company,
    ];
});

$factory->define(App\AssetModel::class, function (Faker\Generator $faker) {
    return [
        'manufacturer_id' => $faker->numberBetween($min = 1, $max = 4),
        'asset_type_id' => $faker->numberBetween($min = 1, $max = 4),
        'pcspec_id' => $faker->numberBetween($min = 1, $max = 4),
        'asset_model' => $faker->regexify('[A-Z]{3}[0-9]{3}[A-Z]{2}'),
        'part_number' => $faker->regexify('[A-Z]{3}[0-9]{3}[A-Z]{2}'),
        'created_at' => new Carbon\Carbon,
        'updated_at' => new Carbon\Carbon,
    ];
});
