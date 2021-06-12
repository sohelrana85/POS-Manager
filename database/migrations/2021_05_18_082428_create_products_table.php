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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user');
            $table->string('product_name')->unique();
            $table->string('product_code')->unique();
            $table->string('product_desc');
            $table->unsignedBigInteger('category');
            $table->unsignedBigInteger('brand');
            $table->unsignedBigInteger('unit_type');
            $table->unsignedBigInteger('package_size');
            // $table->integer('product_qty');
            // $table->integer('free_qty');
            // $table->decimal('unit_price',8,2);
            // $table->decimal('buying_price',8,2);
            $table->integer('stock_qty')->nullable();
            $table->decimal('total_price',8,2)->nullable();
            $table->decimal('unit_selling_price',8,2)->nullable();
            $table->integer('vat')->nullable();
            $table->decimal('discount_price',8,2)->nullable();
            $table->integer('discount_percentage')->nullable();
            $table->dateTime('discount_price_from')->nullable();
            $table->dateTime('discount_price_to')->nullable();
            $table->tinyInteger('status')->default('0');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user')->on('users')->references('id')->onDelete('cascade');
            $table->foreign('category')->on('categories')->references('id')->onDelete('cascade');
            $table->foreign('brand')->on('brands')->references('id')->onDelete('cascade');
            $table->foreign('unit_type')->on('unit_types')->references('id')->onDelete('cascade');
            $table->foreign('package_size')->on('package_sizes')->references('id')->onDelete('cascade');
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
