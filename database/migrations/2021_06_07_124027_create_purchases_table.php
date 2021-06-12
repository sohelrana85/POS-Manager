<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user');
            $table->string('memo_no');
            $table->date('memo_date');
            $table->string('warehouse');
            $table->unsignedBigInteger('supplier');
            $table->unsignedBigInteger('purchase_status');
            $table->unsignedBigInteger('product_name');
            $table->integer('product_qty');
            $table->integer('free_qty');
            $table->decimal('unit_price',8,2);
            $table->decimal('total_price',8,2);
            $table->decimal('order_tax',8,2);
            $table->decimal('order_discount',8,2);
            $table->decimal('shipping_cost',8,2);
            $table->enum('payment_status',['Due','Paid','Partial']);
            $table->decimal('paid_amount',8,2)->nullable();
            $table->decimal('due_amount',8,2)->nullable();
            $table->unsignedBigInteger('payment_type')->nullable();
            $table->unsignedBigInteger('bank_account')->nullable();
            $table->tinyInteger('status')->default('0');
            $table->timestamps();

            $table->foreign('user')->on('users')->references('id')->onDelete('cascade');
            $table->foreign('supplier')->on('suppliers')->references('id')->onDelete('cascade');
            $table->foreign('payment_type')->on('payment_types')->references('id')->onDelete('cascade');
            $table->foreign('product_name')->on('products')->references('id')->onDelete('cascade');
            $table->foreign('purchase_status')->on('purchase_statuses')->references('id')->onDelete('cascade');
            $table->foreign('bank_account')->on('bank_accounts')->references('id')->onDelete('cascade');
            // $table->foreign('payment_status')->on('payment_statuses')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchases');
    }
}
