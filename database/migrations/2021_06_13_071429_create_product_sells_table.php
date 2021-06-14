<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSellsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_sells', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user');
            $table->unsignedBigInteger('product');
            $table->unsignedBigInteger('customer');
            $table->string('invoice_no')->unique();
            $table->date('invoice_date');
            $table->string('product_qty');
            $table->decimal('product_price',8,2);
            $table->string('tax')->nullable();
            $table->decimal('product_discount',8,2)->nullable();
            // $table->decimal('shipping_cost',8,2)->nullable();
            // $table->decimal('previous_due',8,2)->nullable();
            $table->decimal('total_amount',8,2);
            $table->enum('payment_status', ['Paid','Partial','Due']);
            $table->decimal('receive_amount',8,2)->nullable();
            $table->decimal('due_amount',8,2)->nullable();
            $table->string('payment_type')->nullable();
            $table->string('account_name')->nullable();
            $table->timestamps();

            $table->foreign('user')->on('users')->references('id')->onDelete('cascade');
            $table->foreign('product')->on('products')->references('id')->onDelete('cascade');
            $table->foreign('customer')->on('customers')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_sells');
    }
}
