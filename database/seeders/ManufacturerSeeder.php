<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ManufacturerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        // Make 100 new Products
        foreach(range(1, 50) as $index) {


            DB::table('manufacturers')->insert([

                'name' => $faker->word,
                'logo' => $faker->imageUrl(640, 480, 'cats', true),
                'address' => $faker->streetAddress,
                'zip_code' => $faker->postcode,
                'state' => $faker->word,
                'city' => $faker->city,
                'country_id' => $faker->numberBetween($min = 1, $max = 249),
                'description' => $faker->realText(),


                'created_at' => Carbon::now(),

                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
