<?php

use Illuminate\Database\Seeder;

use App\PoiType;

class PoiTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $poiType = new PoiType([
          'id' => 1,
          'slug' => 'human',
          'title' => 'Human'
        ]);
        $poiType->save();

    }
}
