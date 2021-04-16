<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SetForeignKeyConstraints extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::table('products', function($table) {
//            $table->foreign('sub_product_id')->references('id')->on('products');
//            $table->foreign('manufacturer_id')->references('id')->on('manufacturers');
//            $table->foreign('step_id')->references('id')->on('steps');
//        });
//
//        Schema::table('manufacturers', function($table) {
//            $table->foreign('country_id')->references('id')->on('countries');
//        });
//
//        Schema::table('steps', function ($table) {
//            $table->foreign('step_type_id')->references('id')->on('step_types');
//        });
//
//        Schema::table('inputs', function ($table) {
//            $table->foreign('product_id')->references('id')->on('products');
//            $table->foreignId('input_type_id')->references('id')->on('input_types');
//        });
//
//        Schema::table('products_has_images', function($table) {
//            $table->foreign('product_id')->references('id')->on('products');
//            $table->foreign('image_id')->references('id')->on('images');
//        });
//
//        Schema::table('summary_has_products', function($table) {
//            $table->foreign('summary_id')->references('id')->on('summaries');
//            $table->foreign('product_id')->references('id')->on('products');
//        });
//
//        Schema::table('configurators', function($table) {
//            $table->foreign('language_id')->references('id')->on('countries');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
