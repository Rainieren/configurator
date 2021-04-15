<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();

        Schema::create('products', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name');
            // Price is nullable in case the product has a price increase
            $table->decimal('price', $scale = 2)->nullable();
            // If the product has a percentage increase instead of the price
            $table->integer('percentage_increase')->nullable();
            $table->integer('stock');
            $table->boolean('status');
            $table->boolean('visibility');
            $table->text('description')->nullable();
            $table->string('thumbnail')->nullable();
            // An image thgat visuablises the product configuration
            $table->string('visualisation')->nullable();
            $table->integer('weight')->nullable();
            $table->integer('height')->nullable();
            $table->integer('length')->nullable();
            $table->string('url_key')->unique();
            $table->dateTime('new_from')->nullable();
            $table->dateTime('new_to')->nullable();
            $table->string('sku');

            $table->integer('sub_product_id')->unsigned()->nullable();

            $table->integer('manufacturer_id')->unsigned()->nullable();

            $table->integer('step_id')->unsigned()->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
