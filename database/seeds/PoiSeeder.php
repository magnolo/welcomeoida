<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;
use App\Models\Poi;

class PoiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker::create();
    	foreach (range(1,300) as $index) {
          $firstname = $faker->firstName;
          $lastname = $faker->lastName;

          $title = $firstname." ".substr($lastname,0,1).".";
          $poi = new Poi([
              'slug' => str_slug($title),
	            'title' => $title,
              'first_name' => $firstname,
              'last_name' => $lastname,
              'email' => $faker->email,
	            'lat' => $faker->latitude(47.940267,48.349861),
	            'lng' => $faker->longitude(16.158142,16.586609),
              'ip_address' => $faker->ipv4,
	            'type_id' => 1
	        ]);
          $poi->save();
        }
    }
}
