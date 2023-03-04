<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeatBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seat_bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_session_id');
            $table->unsignedBigInteger('seat_id');
            $table->unsignedBigInteger('customer_id');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->integer('seat_number');
            $table->timestamps();

            $table->foreign('event_session_id')->references('id')->on('event_sessions')->onDelete('cascade');
            $table->foreign('seat_id')->references('id')->on('seats')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seat_bookings');
    }
}
