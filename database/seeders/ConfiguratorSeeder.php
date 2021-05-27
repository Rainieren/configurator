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
            'name' => 'Stoels',
            'theme_color' => $faker->hexColor,
            'language_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('configurators')->insert([
            'name' => 'Tafels',
            'theme_color' => $faker->hexColor,
            'language_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('configurators')->insert([
            'name' => 'Plantenpot',
            'theme_color' => $faker->hexColor,
            'language_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

    }
}
