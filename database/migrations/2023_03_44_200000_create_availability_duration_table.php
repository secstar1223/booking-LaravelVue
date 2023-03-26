<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('availability_duration', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('availability_id');
            $table->foreign('availability_id')->references('id')->on('availabilities')->onDelete('cascade');
            $table->index('availability_id');

            $table->unsignedBigInteger('duration_id');
            $table->foreign('duration_id')->references('id')->on('durations')->onDelete('cascade');
            $table->index('duration_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('availabilities_durations');
    }
};
