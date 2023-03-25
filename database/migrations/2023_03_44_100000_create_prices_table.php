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
            $table->unsignedBigInteger('equipment_id');
            $table->foreign('equipment_id')->references('id')->on('equipment')->onDelete('cascade');
            $table->index('equipment_id');
            $table->unsignedBigInteger('tax_group_id');
            $table->foreign('tax_group_id')->references('id')->on('tax_groups')->onDelete('cascade');
            $table->index('tax_group_id');

            $table->integer('total');
            $table->integer('deposit');
            $table->integer('tax');
            $table->enum('tax_type', ['fixed', 'percent']);
            $table->string('currency');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('prices');
    }
};
