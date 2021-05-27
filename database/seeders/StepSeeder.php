<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StepSeeder extends Seeder
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
        foreach(range(1, 5) as $index) {

            DB::table('steps')->insert([
                'name' => $faker->word,
                'interaction_type' => 1,
                'is_optional' => $faker->boolean(50),
                'allow_multiple' => $faker->boolean(50),
                'order' => $index,
                'default_product' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
