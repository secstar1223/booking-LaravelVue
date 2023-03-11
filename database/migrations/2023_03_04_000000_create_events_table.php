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
            $table->text('schedule');
            /*
            {'mon' => [
                '15:30',
                '16:30',
            ],
            'tue' => [

            ]}
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