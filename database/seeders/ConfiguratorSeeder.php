<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfiguratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        DB::table('configurators')->insert([
            'name' => 'Auto',
            'theme_color' => $faker->hexColor,
            'language_id' => 1,
            'thumbnail' => '/storage/images/placeholder.png',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('configurators')->insert([
            'name' => 'Bus',
            'theme_color' => $faker->hexColor,
            'language_id' => 1,
            'thumbnail' => '/storage/images/placeholder.png',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('configurators')->insert([
            'name' => 'Vrachtwagen',
            'theme_color' => $faker->hexColor,
            'language_id' => 1,
            'thumbnail' => '/storage/images/placeholder.png',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

    }
}
