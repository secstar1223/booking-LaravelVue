<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tax_rules', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('team_id');
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
            $table->index('team_id');

            $table->string('name');
            $table->integer('amount');
            $table->enum('type', ['fixed', 'percent']);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tax_rules');
    }
};
