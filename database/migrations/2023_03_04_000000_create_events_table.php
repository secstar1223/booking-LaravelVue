<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('team_id');
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
            $table->unique(['id', 'team_id']);
            $table->index('team_id');

            $table->string('name');
            $table->string('image');
            $table->text('description');
            $table->text('language');
/*
{"seats_label":"Select Number of Waverunners(s)","duration_label":"Duration:","time_label":"Time:","book_now":"Book now","total_label":"Total: ","start_label":"Start time: ","end_label":"End time: "}
*/
            $table->text('options');
/*
{"time":12,"lead_time":24,"cutoff_time":0,"fixed_duration":true,"fixed_timezone":true,"timezone_offset":0}
*/
            $table->text('schedule');
            /*
{"repeats_every":7,"days":[[0,32400,39600,41400,43200,45000,46800,82800,86400],[32400,36000,37800,39600,41400,43200,45000,46800,82800],[],[],[36000,37800,39600,41400,43200,45000,46800,82800],[36000,37800,39600,41400,43200,45000,46800,82800],[36000,37800,39600,41400,43200,45000,46800,82800]],"messages":{"2":"Closed Tuesdays & Wednesdays","3":"Closed Tuesdays & Wednesdays"}}
            */
            $table->text('schedule_exceptions');
            /*
[
    {
        'available' => false,
        'date' => '16-02-23',
        'time' => 'all day',
        'description' => 'Day off',
    },
    {
        'available' => false,
        'date' => '13-02-23',
        'time' => '16:30',
        'description' => '',
    },
    {
        'available' => true,
        'date' => '21-02-23',
        'time' => '20:00',
        'description' => 'Special show',
    }
]
            */
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
        Schema::dropIfExists('events');
    }
}