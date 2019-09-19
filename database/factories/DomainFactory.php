<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define( App\Domain::class, function ( Faker $faker ) {
	return [
		'software_id'  => $faker->buildingNumber,
		'domain_name' => $faker->domainName,
		'domain_text' => $faker->text( 50 ),
		'domain_end'  => $faker->dateTimeBetween( 'now', '+1years' )
	];
} );
