<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user');
            $table->date('date');
            $table->unsignedBigInteger('expense_type');
            $table->enum('payment_status', ['Paid','Partial','Due']);
            $table->decimal('paid_amount',8,2)->nullable();
            $table->decimal('due_amount',8,2)->nullable();
            $table->unsignedBigInteger('payment_type')->nullable();
            $table->unsignedBigInteger('bank_account')->nullable();
            $table->longText('remarks');
            $table->timestamps();

            $table->foreign('user')->on('users')->references('id')->onDelete('cascade');
            $table->foreign('expense_type')->on('expense_types')->references('id')->onDelete('cascade');
            $table->foreign('payment_type')->on('payment_types')->references('id')->onDelete('cascade');
            $table->foreign('bank_account')->on('bank_accounts')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expenses');
    }
}
