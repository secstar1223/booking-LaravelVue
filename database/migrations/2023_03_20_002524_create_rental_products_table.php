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
Schema::create('rental_products', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('team_id');
    $table->index('team_id');
    $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');

    $table->string('name');
    $table->text('description');
    $table->string('image')->nullable();
    $table->text('language'); // json blob like below.
    $table->string('timezone');
    $table->boolean('display_product_timezone');
/*
{"seats_label":"Select Number of Waverunners(s)","duration_label":"Duration:","time_label":"Time:","book_now":"Book now","total_label":"Total: ","start_label":"Start time: ","end_label":"End time: "}
*/
    $table->text('options'); // json blob like i dunno?
    $table->timestamps();
});
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rental_products');
    }
};
