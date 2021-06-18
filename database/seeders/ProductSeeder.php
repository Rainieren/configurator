<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
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
        foreach(range(1, 100) as $index) {

            $product_name = $faker->sentence($nbWords = rand(2,3), $variableNbWords = true);

            DB::table('products')->insert([
                // Create a random name with random 2 or 3 words
                'name' => $product_name,
                // Create a random price bwteen null and 100
                'price' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 1000),
                // Create a random percentage between null and 100
                'percentage_increase' => 0.00,
                // Create a random in Stock number between 0 and 1000
                'stock' => 1,
                // Create radom status whether it is enabled or not
                'status' => $faker->boolean($chanceOfGettingTrue = 50),
                // Create random status whether it is visible or not
                'visibility' => $faker->boolean($chanceOfGettingTrue = 50),
                // Create a random description
                'description' => $faker->realText($maxNbChars = 200, $indexSize = 2),
                // Fetch a random image
                'thumbnail' => '/storage/images/placeholder.png',
                'visualisation' => null,
                'weight' => $faker->numberBetween($min = 0, $max = 100),
                'height' => $faker->numberBetween($min = 0, $max = 100),
                'length' => $faker->numberBetween($min = 0, $max = 100),
                'width' => $faker->numberBetween($min = 0, $max = 100),
                'url_key' => preg_replace('/\s+/', '_', strtolower($product_name)),
                'new_from' => null,
                'new_to' => null,
                'user_id' => 1,
                'sku' => $faker->randomNumber($nbDigits = NULL, $strict = false),
                'step_id' => $index > 4 ? rand(1,5) : NULL,
                'configurable' => $index < 5,
                'interaction_type_id' => 1,
                'manufacturer_id' => $faker->numberBetween($min = 0, $max = 50),
                'configurator_id' => rand(1,3),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

    }
}
