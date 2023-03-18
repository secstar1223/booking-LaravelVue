<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seats', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('minimum_order')->default(0);
            $table->integer('max_capacity')->default(0);
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
            $table->unsignedBigInteger('team_id');
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
            $table->index('team_id');
            $table->unsignedBigInteger('event_id');
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->index(['team_id', 'event_id']);
            $table->index(['id', 'event_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seats');
    }
}
