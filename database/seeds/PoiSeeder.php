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
          $name = $faker->name;
          $poi = new Poi([
              'slug' => str_slug($name),
	            'title' => $name,
	            'lat' => $faker->latitude,
	            'lng' => $faker->longitude,
	            'type_id' => 1
	        ]);
          $poi->save();
        }
    }
}
