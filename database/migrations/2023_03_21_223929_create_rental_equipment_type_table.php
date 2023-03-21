<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentalEquipmentTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rental_equipment_type', function (Blueprint $table) {
            $table->id();
            $table->string('display_name');
            $table->string('equipment_pool');
            $table->text('description')->nullable();
            $table->string('widget_image')->nullable();
            $table->boolean('widget_display')->default(false);
            $table->integer('min_value')->nullable();
            $table->integer('max_value')->nullable();
            $table->boolean('require_min')->default(false);
            $table->string('category')->nullable();
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
        Schema::dropIfExists('rental_equipment_type');
    }
}
This migration file will create a rental_equipment_type table with columns id, display_name, equipment_pool, description, widget_image, widget_display, min_value, max_value, require_min, category, and timestamps. The id column will be the primary key of the table, and the timestamps column will automatically track the creation and modification times of each row.





