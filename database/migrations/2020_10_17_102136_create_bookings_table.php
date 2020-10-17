<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('table_id');
            $table->integer('table_place');
            $table->unsignedBigInteger('slot_id');
            $table->date('booked_for');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('table_id')->references('id')->on('tables');
            $table->foreign('slot_id')->references('id')->on('slots');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
