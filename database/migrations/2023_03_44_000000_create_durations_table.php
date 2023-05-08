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
            $table->unsignedBigInteger('rental_product_id');
            $table->foreign('rental_product_id')->references('id')->on('rental_products')->onDelete('cascade');
            $table->index('rental_product_id');

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