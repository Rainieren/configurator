<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SummariesSeeder extends Seeder
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
        foreach(range(1, 20) as $index) {

            DB::table('summaries')->insert([
                // Create a random name with random 2 or 3 words
                'code' => strtoupper(bin2hex(openssl_random_pseudo_bytes(4))),
                'total' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 3000),
                'created_at' => Carbon::now()->addDays(rand(1, 365)),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
