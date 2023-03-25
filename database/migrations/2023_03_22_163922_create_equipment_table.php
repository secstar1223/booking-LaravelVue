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
        $table->unsignedBigInteger('team_id');
        $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
        $table->index('team_id');
        $table->unsignedBigInteger('rental_product_id');
        $table->foreign('rental_product_id')->references('id')->on('rental_products')->onDelete('cascade');
        $table->index(['team_id', 'rental_product_id']);

        $table->string('name');
//        $table->string('short_name', 10);
        $table->string('color');
//        $table->integer('quantity'); // now max_quantity
//        $table->integer('capacity'); // now human_capacity
        $table->boolean('resource_tracking');
        $table->text('description')->nullable();

        $table->integer('min_order')->default(0);
        $table->integer('max_order')->default(0);
        $table->integer('max_quantity')->default(0);
        $table->integer('human_capacity')->default(1);
        $table->integer('order')->default(0);

        $table->text('prices');
        /*
[{
"id":13,
"name":"hour",
"duration":3600,
"order":0,
"price": 1000,
"currency":"USD"
},{
"id":234,
"name":"4 hours",
"duration": 14400,
"order":0,
"price": 4000,
"currency":"USD"
},{
"id":3542,
"name":"8 hours",
"duration":28800,
"order":0,
"price": 7000,
"currency":"USD"
},{
"id":3456,
"name":"24 hour",
"duration":86400,
"order":0,
"price": 14000,
"currency":"USD"
},{
"id":123453,
"name":"48 hour",
"duration":172800,
"order":0,
"price": 28000,
"currency":"USD"
}]
        */

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
