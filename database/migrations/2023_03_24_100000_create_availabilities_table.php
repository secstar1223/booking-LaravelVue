<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('availabilities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rental_product_id');
            $table->foreign('rental_product_id')->references('id')->on('rental_products')->onDelete('cascade');
            $table->index('rental_product_id');
            $table->enum('times', ['repeats','specific']);
            $table->integer('start_time');
            $table->integer('end_time');
            $table->integer('starts_every');
            $table->boolean('mon');
            $table->boolean('tue');
            $table->boolean('wed');
            $table->boolean('thu');
            $table->boolean('fri');
            $table->boolean('sat');
            $table->boolean('sun');
            $table->text('starts_specific');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('availabilities');
    }
};
