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
            $table->enum('availability_type', ['once', 'daily', 'weekly', 'monthly']);
            $table->integer('first_time');
            $table->integer('last_time');
            $table->integer('starts_every');
            $table->integer('buffer_time');
            $table->text('starts_specific');
            $table->string('created_timezone');
            $table->boolean('display_created_timezone');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('availabilities');
    }
};
