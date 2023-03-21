<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvailabilityScheduleTable extends Migration
{
    public function up()
    {
        Schema::create('availability_schedule', function (Blueprint $table) {
            $table->id();
            $table->enum('availability_type', ['Once', 'Daily', 'Weekly', 'Monthly']);
            $table->integer('start_time');
            $table->integer('end_time');
            $table->boolean('can_book_between');
            $table->unsignedBigInteger('event_id');
            $table->unsignedBigInteger('seat_id');
            $table->foreign('event_id')->references('id')->on('event');
            $table->foreign('seat_id')->references('id')->on('seat');
            $table->index('event_id');
            $table->index('seat_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('availability_schedule');
    }
}
