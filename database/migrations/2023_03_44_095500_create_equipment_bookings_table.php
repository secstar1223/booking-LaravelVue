<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipment_bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('team_id');
            $table->unsignedBigInteger('equipment_id');
            $table->unsignedBigInteger('customer_id');
            $table->index(['team_id','equipment_id']);
            $table->index('customer_id');
            $table->foreign('equipment_id')->references('id')->on('equipment');
            $table->foreign('team_id')->references('id')->on('teams');
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->unsignedBigInteger('start_time');
            $table->unsignedBigInteger('end_time');
            $table->integer('equipment_number');
            $table->integer('is_order_reserved');
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
        Schema::dropIfExists('seat_bookings');
    }
};
