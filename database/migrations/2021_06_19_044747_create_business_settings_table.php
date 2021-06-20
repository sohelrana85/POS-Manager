<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user');
            $table->string('business_name')->unique();
            $table->date('start_date');
            $table->string('logo');
            $table->string('currency');
            $table->string('currency_symbol');
            $table->string('date_format');
            $table->string('time_format');
            $table->string('address');
            $table->string('country');
            $table->string('city');
            $table->string('mobile');
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->timestamps();

            $table->foreign('user')->on('users')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('business_settings');
    }
}
