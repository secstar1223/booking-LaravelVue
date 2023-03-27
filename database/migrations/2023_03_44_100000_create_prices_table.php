<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('prices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('duration_id');
            $table->foreign('duration_id')->references('id')->on('durations')->onDelete('cascade');
            $table->index('duration_id');
            $table->unsignedBigInteger('equipmenttype_id');
            $table->foreign('equipmenttype_id')->references('id')->on('equipmenttype')->onDelete('cascade');
            $table->index('equipmenttype_id');
            $table->unsignedBigInteger('details_id');
            $table->foreign('details_id')->references('id')->on('details')->onDelete('cascade');
            $table->index('details_id');

            $table->integer('total');
            $table->integer('deposit');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('prices');
    }
};
