<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;
use App\Models\Poi;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker::create('de_AT');
    	foreach (range(1,300) as $index) {
          $firstname = $faker->firstName;
          $lastname = $faker->lastName;

          $title = $faker->sentence;
          $poi = new Poi([
              'slug' => str_slug($title),
	            'title' => $title,
              'first_name' => $firstname,
              'last_name' => $lastname,
              'email' => $faker->email,
	            'lng' => $faker->latitude($min = 47.940267,$max =48.349861),
	            'lat' => $faker->longitude($min = 16.158142,$max = 16.586609),
              'ip_address' => $faker->ipv4,
              'street_name' => $faker->streetName,
              'country' => $faker->country,
              'building_number' => $faker->buildingNumber,
              'postcode' => $faker->postcode,
              //'state' => $faker->state,
              'city' => $faker->city,
	            'type_id' => 2,
              'from_date' => $faker->dateTime,
              'to_date' => $faker->dateTime
	        ]);
          $poi->save();
        }
    }
}
