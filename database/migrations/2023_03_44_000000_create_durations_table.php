<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('durations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('detailID');
            $table->foreign('detailID')->references('id')->on('details')->onDelete('cascade');
            $table->index('detailID');

            $table->string('name');
            $table->integer('duration');
            $table->integer('buffer');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('durations');
    }
};