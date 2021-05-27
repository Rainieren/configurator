<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductStepSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(range(1, 5) as $index) {

            DB::table('product_step')->insert([
                'product_id' => rand(1,4),
                'step_id' => rand(1,5),
            ]);
        }
    }
}
