<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSummaryHasProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('summary_has_products', function (Blueprint $table) {
            $table->id();
            $table->integer('summary_id')->nullable()->unsigned();

            $table->integer('product_id')->nullable()->unsigned();

            $table->timestamps();
        });

        Schema::table('summary_has_products', function($table) {
            // TODO:: Set all foreign key constrains AFTER initial
//            $table->foreign('summary_id')->references('id')->on('summaries');
            $table->foreign('product_id')->references('id')->on('products');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('summary_has_products');
    }
}
