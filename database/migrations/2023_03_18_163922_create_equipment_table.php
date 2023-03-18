<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('equipment', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('short_name', 10);
        $table->string('color');
        $table->integer('quantity');
        $table->integer('capacity');
        $table->boolean('resource_tracking');
        $table->text('description');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment');
    }
};
