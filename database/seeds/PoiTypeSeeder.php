<?php

use Illuminate\Database\Seeder;

use App\Models\PoiType;

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
        DB::table('point_of_interests_types')->delete();
        $poiType = new PoiType([
          'id' => 1,
          'slug' => 'human',
          'title' => 'Human'
        ]);
        $poiType->save();
        $poiType = new PoiType([
          'id' => 2,
          'slug' => 'event',
          'title' => 'Event'
        ]);
        $poiType->save();

    }
}
